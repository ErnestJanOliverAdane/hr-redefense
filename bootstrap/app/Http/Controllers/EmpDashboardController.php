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

        // Monthly data arrays for dashboard charts/statistics
        $monthlyFacultyData = []; // Array of 12 months faculty counts
        $monthlyStaffData = [];   // Array of 12 months staff counts

        // TODO: Populate these arrays with actual data from your database
        // Example implementation:
        /*
        for ($month = 1; $month <= 12; $month++) {
            $monthlyFacultyData[] = Employee::where('employee_type', 'faculty')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->count();
            
            $monthlyStaffData[] = Employee::where('employee_type', 'staff')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->count();
        }
        */

        return view('employee.dashboard.index', compact(
            'employee', 
            'personalInformation', 
            'monthlyFacultyData', 
            'monthlyStaffData'
        ));
    }
}