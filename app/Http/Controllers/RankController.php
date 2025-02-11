<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterlistModel;
use App\Models\RankModel;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
    public function index()
    {
        // Get faculty members with their rank information
        $ranks = MasterlistModel::where('job_type', 'faculty')
            ->select('id', 'employee_id', 'first_name', 'last_name', 'field', 'qualification', 'rank')
            ->get()
            ->sortBy(function($faculty) {
                // Get the first letter of the first name for sorting
                return strtolower(substr($faculty->first_name, 0, 1));
            })
            ->values(); // Reset array keys after sorting
        
        return view('admin.ranks.index', compact('ranks'));
    }
    
    // public function save(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'm_emp' => 'required|string|max:255',
    //         'field' => 'required|string|max:255',
    //         'current_qua' => 'required|string|max:255',
    //         'role' => 'required|string|max:255',
    //         'masterlist_id' => 'required|exists:masterlist,id'
    //     ]);

    //     // Check if this employee already has a rank
    //     $existingRank = RankModel::where('masterlist_id', $request->masterlist_id)->first();
        
    //     if ($existingRank) {
    //         return redirect()->back()
    //             ->with('error', 'This employee already has a rank assigned.');
    //     }

    //     // Create new rank record
    //     $rankData = new RankModel([
    //         'masterlist_id' => $request->masterlist_id,
    //         'field' => $request->field,
    //         'current_qua' => $request->current_qua,
    //         'current_rank' => $request->role,
    //     ]);

    //     $rankData->save();
        
    //     \Log::info('New rank created for masterlist_id: ' . $request->masterlist_id);

    //     return redirect()->back()->with('success', 'Employee rank added successfully.');
    // }

    // public function saveEmployee(Request $request)
    // {

    //     $request->validate([
    //         'm_emp' => 'required|string|max:255',
    //         'field' => 'required|string|max:255',
    //         'current_qua' => 'required|string|max:255',
    //         'role' => 'required|string|max:255',
    //     ]);

    //     try {

    //         $employee = new RankModel();
    //         $employee->full_name = $request->input('m_emp');
    //         $employee->field = $request->input('field');
    //         $employee->current_qualification = $request->input('current_qua');
    //         $employee->current_rank = $request->input('role');
    //         $employee->save();


    //         return redirect()->back()->with('success', 'Employee saved successfully.');
    //     } catch (\Exception $e) {

    //         return redirect()->back()->with('error', 'Failed to save employee: ' . $e->getMessage());
    //     }
    // }

    public function update(Request $request)
    {
        // Validate input
        $request->validate([
            'r_emp' => 'required|string',
            'updated_field' => 'required|string',
            'updated_qua' => 'required|string',
            'updated_rank' => 'required|string',
        ]);

        // Find the employee by name
        $employeeName = $request->input('r_emp');
        $nameParts = explode(' ', $employeeName);
        
        $employee = MasterlistModel::where('job_type', 'faculty')
            ->where(function($query) use ($nameParts) {
                $query->where('first_name', 'like', '%' . $nameParts[0] . '%')
                    ->where('last_name', 'like', '%' . end($nameParts) . '%');
            })
            ->first();

        if (!$employee) {
            return redirect()->back()->withErrors(['r_emp' => 'Faculty member not found.']);
        }

        // Update the fields
        $employee->update([
            'field' => $request->input('updated_field'),
            'qualification' => $request->input('updated_qua'),
            'rank' => $request->input('updated_rank'),
        ]);

        return redirect()->back()->with('success', 'Faculty rank updated successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        $employees = MasterlistModel::where('job_type', 'faculty')
            ->where(function($q) use ($query) {
                $q->where('first_name', 'LIKE', "%{$query}%")
                ->orWhere('last_name', 'LIKE', "%{$query}%");
            })
            ->select('id', 'first_name', 'last_name', 'job_type', 'department')
            ->limit(10)
            ->get();

        return response()->json($employees);
    }

    public function searchMasterlist(Request $request)
    {
        $query = $request->get('query');
        
        // First, get all existing masterlist_ids from ranks table
        $existingIds = RankModel::pluck('masterlist_id')->toArray();
        
        // Log the existing IDs for debugging
        \Log::info('Existing rank IDs:', $existingIds);

        $employees = MasterlistModel::where('job_type', 'Faculty')
            ->whereNotIn('id', $existingIds)  // Exclude employees already in ranks
            ->where(function($q) use ($query) {
                $q->where('first_name', 'LIKE', "%{$query}%")
                ->orWhere('last_name', 'LIKE', "%{$query}%");
            })
            ->select('id', 'first_name', 'last_name', 'job_type', 'department')
            ->limit(10)
            ->get();
        
        // Log the query results for debugging
        \Log::info('Search results:', $employees->toArray());

        return response()->json($employees);
    }

    public function showRankingRecord(Request $request)
    {
        $ranks = RankModel::with('masterlist')->get(); // Fetch rank data with related masterlist

        // If searching for a specific full name
        $fullName = $request->input('full_name');
        $masterlistId = null;

        if ($fullName) {
            $masterlist = MasterlistModel::whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$fullName])->first();
            $masterlistId = $masterlist ? $masterlist->id : null;
        }

        return view('admin.record.ranking', compact('ranks', 'masterlistId'));
    }

}