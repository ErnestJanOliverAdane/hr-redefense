<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RequestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReqStatusController extends Controller
{
    public function index()
    {
        $employee = Auth::user();
        // Get request for the authenticated employee
        $request = RequestModel::where('employee_id', $employee->employee_id)->first();

        return view('employee.request.status-request', [
            'request' => $request
        ]);
    }

    // When saving a new request
    public function store(Request $request)
    {
        $employee = Auth::user();
        $requestData = $request->validated();
        $requestData['employee_id'] = $employee->employee_id;

        RequestModel::create($requestData);

        return redirect()->route('request.status')
            ->with('success', 'Request submitted successfully');
    }
}
