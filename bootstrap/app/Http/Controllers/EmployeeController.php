<?php

namespace App\Http\Controllers;

use App\Imports\EmployeesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MasterlistModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = MasterlistModel::orderBy('full_name', 'asc')->get();
        return view('admin.masterlist.index', compact('employees'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'employee_id' => 'required|string|max:255',
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'middle_initial' => 'nullable|string|max:1',
                'contact_information' => 'required|string|max:100',
                'employment_status' => 'required|string|max:50',
                'job_title' => 'required|string|max:100',
                'department' => 'required|string|max:100',
                'job_type' => 'required|string|max:255'
            ]);

            $employee = MasterlistModel::create($validated);

            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Employee created successfully',
                    'employee' => $employee,
                    'redirect' => route('masterlist.index')
                ], 201);
            }

            return redirect()->route('masterlist.index')
                ->with('success', 'Employee created successfully');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => 'An error occurred while creating the employee'], 500);
            }
            return back()->withErrors(['error' => 'An error occurred while creating the employee']);
        }
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new EmployeesImport, $request->file('file'));
            return redirect()->back()->with('success', 'Employees imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'There was an error importing the file: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $employee = MasterlistModel::findOrFail($id);
            return response()->json($employee);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = MasterlistModel::findOrFail($id);

            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'gender' => 'required|in:male,female',
                'status' => 'required|in:single,married,separated,widowed,divorced',
                'birthdate' => 'required|date',
                'position_title' => 'required|string|max:255',
                'contact_number' => 'required|string|max:20',
                'educational_attainment' => 'required|max:255',
                'salary' => 'required|numeric|min:0',
                'email' => 'required|email|max:255',
                'work_status' => 'required|in:job_order,permanent'
            ]);

            $employee->update($validated);

            return response()->json([
                'message' => 'Employee updated successfully',
                'employee' => $employee
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Employee not found'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the employee'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = MasterlistModel::findOrFail($id);
            $employee->delete();
            return redirect()->back()->with('success', 'Employee deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error deleting employee: ' . $e->getMessage()]);
        }
    }
    public function show($id)
    {
        try {

            $masterlistEmployee = MasterlistModel::findOrFail($id);

            $personalInfo = DB::table('personal_informations')
                ->where('employee_id', $masterlistEmployee->employee_id)
                ->first();

            $employeeData = [
                'id' => $masterlistEmployee->id,
                'employee_id' => $masterlistEmployee->employee_id,
                'first_name' => $masterlistEmployee->first_name,
                'last_name' => $masterlistEmployee->last_name,
                'middle_initial' => $masterlistEmployee->middle_initial ?? 'N/A',
                'contact_information' => $masterlistEmployee->contact_information ?? 'N/A',
                'employment_status' => $masterlistEmployee->employment_status ?? 'N/A',
                'job_title' => $masterlistEmployee->job_title ?? 'N/A',
                'department' => $masterlistEmployee->department ?? 'N/A',
                'job_type' => $masterlistEmployee->job_type ?? 'N/A',
                'sex' => $personalInfo->sex ?? 'N/A',
                'civil_status' => $personalInfo->civil_status ?? 'N/A',
                'place_of_birth' => $personalInfo->place_of_birth ?? 'N/A',
                'date_of_birth' => $personalInfo->date_of_birth ?? 'N/A',

                // Combine Family Names
                'spouse_name' => trim(
                    ($personalInfo->spouse_first_name ?? '') . ' ' .
                    ($personalInfo->spouse_middle_name ?? '') . ' ' .
                    ($personalInfo->spouse_surname ?? '') . ' ' .
                    ($personalInfo->spouse_name_extension ?? '')
                ) ?: 'N/A',

                'father_name' => trim(
                    ($personalInfo->father_first_name ?? '') . ' ' .
                    ($personalInfo->father_middle_name ?? '') . ' ' .
                    ($personalInfo->father_surname ?? '') . ' ' .
                    ($personalInfo->father_name_extension ?? '')
                ) ?: 'N/A',

                'mother_name' => trim(
                    ($personalInfo->mother_first_name ?? '') . ' ' .
                    ($personalInfo->mother_middle_name ?? '') . ' ' .
                    ($personalInfo->mother_surname ?? '')
                ) ?: 'N/A',

                // Personal Information
                'citizenship' => $personalInfo->citizenship ?? 'N/A',
                'religion' => $personalInfo->religion ?? 'N/A',
                'residential_address' => $personalInfo->residential_address ?? 'N/A',
                'permanent_address' => $personalInfo->permanent_address ?? 'N/A',
                'height' => $personalInfo->height ? $personalInfo->height . ' m' : 'N/A',
                'weight' => $personalInfo->weight ? $personalInfo->weight . ' kg' : 'N/A',
                'blood_type' => $personalInfo->blood_type ?? 'N/A',

                // Government IDs
                'gsis_no' => $personalInfo->gsis_no ?? 'N/A',
                'pagibig_no' => $personalInfo->pagibig_no ?? 'N/A',
                'philhealth_no' => $personalInfo->philhealth_no ?? 'N/A',
                'sss_no' => $personalInfo->sss_no ?? 'N/A',
                'tin_no' => $personalInfo->tin_no ?? 'N/A',

                // Educational Background
                'highest_degree' => $personalInfo->highest_degree ?? 'N/A',
                'school_graduated' => $personalInfo->school_graduated ?? 'N/A',
                'year_graduated' => $personalInfo->year_graduated ?? 'N/A',

                // Other Details
                'special_skills' => $personalInfo->special_skills ?? 'N/A',
                'languages_spoken' => $personalInfo->languages_spoken ?? 'N/A',
                'hobbies' => $personalInfo->hobbies ?? 'N/A',
            ];

            return response()->json($employeeData);
        } catch (\Exception $e) {
            log::error('Error fetching employee data: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch employee data'], 500);
        }


    }
    public function getEmployeeFiles($masterlistId)
    {
        try {
            // Fetch files where masterlist_id matches the provided id
            $files = DB::table('files')
                ->where('masterlist_id', $masterlistId)
                ->select('name', 'path', 'size', 'type', 'created_at')
                ->get();

            if ($files->isEmpty()) {
                return response()->json(['files' => []]);
            }

            return response()->json(['files' => $files]);
        } catch (\Exception $e) {
            Log::error('Error fetching employee files: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch files for this employee'], 500);
        }
    }




}
