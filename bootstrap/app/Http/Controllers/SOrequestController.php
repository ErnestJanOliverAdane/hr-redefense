<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SOrequestModel;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterlistModel;

class SOrequestController extends Controller
{
    public function index()
    {
        // Fetch all employees from the database
        $so = SOrequestModel::all();
        $employee = Auth::user();
        $masterlist = MasterlistModel::where('job_title', $employee->job_title)->first();

        $personalinformation = $employee->personal_information;

        // Return the view with employee data
        return view('employee.sorequest.index', compact('so', 'employee', 'personalinformation', 'masterlist'));
    }

    public function sostatusrequest()
    {
        $employee = Auth::user();
        $so_request = SOrequestModel::where('employee_id', $employee->employee_id)
            ->latest()
            ->first();

        return view('employee.sorequest.sorequeststatus', compact('so_request', 'employee'));
    }


    public function show($id)
    {
        $so_request = SOrequestModel::findOrFail($id);
        // Pass the retrieved data to the view
        return view('admin.others.so', compact('so_request'));
    }



    public function store(Request $request)
    {
        // Get authenticated employee
        $employee = Auth::user();

        // Check daily submission limit
        $todaySubmissions = SOrequestModel::where('Email', $employee->email)
            ->whereDate('created_at', now()->toDateString()) // Filter submissions made today
            ->count();

        if ($todaySubmissions >= 2) {
            return redirect()->back()->with('error', 'You can only submit 2 requests per day.');
        }

        // Add file validation
        $validated = $request->validate([
            'inp_email' => 'required|email',
            // 'inp_tin' => 'required|string|digits_between:4,11',
            'inp_bd' => 'required|string|max:255',
            'inp_bp' => 'required|string|max:255',
            'inp_purpose' => 'required|string|max:255',
            'inp_photocopy' => 'nullable|file|mimes:jpg,png,pdf|max:5120', // 5MB max
        ]);

        // Handle file upload
        if ($request->hasFile('inp_photocopy')) {
            $path = $request->file('inp_photocopy')->storeAs(
                'attachment',
                $request->file('inp_photocopy')->hashName(),
                ['disk' => 'public', 'visibility' => 'public']
            );
        }

        // Create a new request record with employee_id
        SOrequestModel::create([
            'employee_id' => $employee->employee_id,  // Add this line
            'Email' => $validated['inp_email'],
            // 'tin' => $validated['inp_tin'],
            'birthdate' => $validated['inp_bd'],
            'birthplace' => $validated['inp_bp'],
            'purpose' => $validated['inp_purpose'],
            'attachment' => $path ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('employee.sorequest.sorequeststatus')->with('success', 'Request submitted successfully!');
    }

}
