<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function academic()
    {
        return view('admin.departments.academic');
    }

    public function artsci()
    {
        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Arts and Science');
        })->with('department')->get();

        return view('admin.departments.artsci', compact('employees'));
    }

    public function businessad()
    {
        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Business Administration');
        })->with('department')->get();

        return view('admin.departments.businessad', compact('employees'));

    }

    public function criminal()
    {

        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Criminal Justice & Public Safety');
        })->with('department')->get();

        return view('admin.departments.criminaljustice', compact('employees'));
    }

    public function educ()
    {
        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Education');
        })->with('department')->get();

        return view('admin.departments.educ', compact('employees'));
    }

    public function engtech()
    {

        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Midwifery');
        })->with('department')->get();

        return view('admin.departments.engtech', compact('employees'));
    }

    public function infotech()
    {

        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Information Technology');
        })->with('department')->get();

        return view('admin.departments.infotech', compact('employees'));
    }

    public function libraryinfo()
    {

        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Library Information Science');
        })->with('department')->get();

        return view('admin.departments.libraryinfo', compact('employees'));
    }

    public function medwif()
    {
        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Midwifery');
        })->with('department')->get();

        return view('admin.departments.medwif', compact('employees'));
    }
    public function hm()
    {
        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'College of Hospitality Management');
        })->with('department')->get();

        return view('admin.departments.hm', compact('employees'));
    }

    public function architect()
    {
        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'ARCHITECT');
        })->with('department')->get();

        return view('designation.architect', compact('employees'));
    }

    public function driver()
    {
        $employees = EmployeeModel::whereHas('department', function ($query) {
            $query->where('depart_name', 'DRIVER');
        })->with('department')->get();

        return view('designation.driver', compact('employees'));
    }





    public function registration()
    {
        return view('admin.departments.register');
    }
    public function create()
    {
        return view('department.create');

    }


    public function store(Request $request)
    {
        $request->validate([
            'depart_name' => 'required|string|max:255',
        ]);


        DepartmentModel::create([
            'depart_name' => $request->depart_name,
        ]);

        return redirect()->back()->with('success', 'Department registered successfully!');
    }


}
