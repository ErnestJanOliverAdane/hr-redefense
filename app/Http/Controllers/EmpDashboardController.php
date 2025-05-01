<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpDashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        if ($employee->employment_status === 'disabled') {
            return redirect('/emp/dashboard')->with('error', 'Your account is disabled.');
        }

        $personalInformation = $employee->personal_information;

        return view('employee.dashboard.index', compact('employee', 'personalInformation'));
    }

}