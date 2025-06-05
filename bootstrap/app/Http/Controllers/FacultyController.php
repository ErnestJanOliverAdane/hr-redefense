<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterlistModel;

class FacultyController extends Controller
{
    public function index()
    {

        $facultys = MasterlistModel::where('job_type', 'faculty')
            ->orderBy('full_name', 'asc')
            ->get();

        return view('admin.masterlist.faculty.index', compact('facultys'));
    }
}
