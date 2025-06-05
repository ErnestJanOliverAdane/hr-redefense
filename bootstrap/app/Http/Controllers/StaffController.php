<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterlistModel;

class StaffController extends Controller
{
    public function index()
    {
        // Retrieve staff members sorted alphabetically by name
        $facultys = MasterlistModel::where('job_type', 'staff')
            ->orderBy('full_name', 'asc')
            ->get();

        // Pass the sorted data to the view
        return view('admin.masterlist.faculty.index', compact('facultys'));
    }
    // public function permanent()
    // {
    //     $employees = EmployeeModel::whereHas('department', function ($query) {
    //         $query->where('depart_name', 'Permanent');
    //     })->with('department')->get();

    //     return view('admin.staff.permanent', compact('employees'));
    // }
}