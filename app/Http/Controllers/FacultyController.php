<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterlistModel;

class FacultyController extends Controller
{
    public function index()
    {
        // Retrieve faculty members sorted alphabetically by name
        $facultys = MasterlistModel::where('job_type', 'faculty')
            ->orderBy('full_name', 'asc')
            ->get();

        // Pass the sorted data to the view
        return view('admin.masterlist.faculty.index', compact('facultys'));
    }
}
