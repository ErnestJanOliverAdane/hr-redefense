<?php

namespace App\Http\Controllers;

use App\Models\MasterlistModel;
use App\Exports\EmployeesExport;

class EmployeeReportController extends Controller
{
    public function index()
    {
        $masterlists = MasterlistModel::whereIn('employment_status', ['Casual', 'Contractual'])
            ->orderBy('full_name', 'asc')
            ->get();

        return view('admin.record.casual_contructual', compact('masterlists'));
    }

    public function exportExcel()
    {
        $export = new EmployeesExport();
        return $export->download();
    }
}
