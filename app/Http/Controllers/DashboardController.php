<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterlistModel;
use App\Models\RequestModel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the total number of employees
        $totalemployeescount = MasterlistModel::count();
        $totalfacultycount = MasterlistModel::where('job_type', 'faculty')->count();
        $totalstaffcount = MasterlistModel::where('job_type', 'Staff')->count();
        $totalcoereqcount = RequestModel::count();
        $thisMonth = MasterlistModel::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()])->count();
        $thisWeek = MasterlistModel::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->count();
        $last30Days = MasterlistModel::whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->count();

        // Pass the data to the dashboard view
        return view('admin.dashboard.index', [
            'totalemployeescount' => $totalemployeescount,
            'totalfacultycount' => $totalfacultycount,
            'totalstaffcount' => $totalstaffcount,
            'totalcoereqcount' => $totalcoereqcount,
            'thisMonth' => $thisMonth,
            'thisWeek' => $thisWeek,
            'last30Days' => $last30Days,

        ]);
    }

}
