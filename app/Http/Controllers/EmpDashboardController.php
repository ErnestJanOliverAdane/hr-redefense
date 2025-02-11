<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpDashboardController extends Controller
{
    public function index()
    {
        // Get the logged-in employee
        $employee = Auth::user();

        // Fetch related personal information using the defined relationship
        $personalInformation = $employee->personal_information;

        // Pass the data to the view
        return view('employee.dashboard.index', compact('employee', 'personalInformation'));
    }
}
