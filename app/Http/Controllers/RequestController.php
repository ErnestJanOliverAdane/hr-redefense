<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MasterlistModel;
use Illuminate\Http\Request;
use App\Models\RequestModel;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        // Fetch all employees from the database
        $coe = RequestModel::all();
        $employee = Auth::user();
        $masterlist = MasterlistModel::where('job_title', $employee->job_title)->first();

        $personalInformation = $employee->personal_information;

        // Return the view with employee data
        return view('employee.request.index', compact('coe', 'employee', 'personalInformation', 'masterlist'));
    }




    public function store(Request $request)
    {
        // Get authenticated employee
        $employee = Auth::user();

        // Check daily submission limit
        $todaySubmissions = RequestModel::where('Email', $employee->email)
            ->whereDate('created_at', now()->toDateString()) // Filter submissions made today
            ->count();

        if ($todaySubmissions >= 2) {
            return redirect()->back()->with('error', 'You can only submit 2 requests per day.');
        }

        // Add file validation
        $validated = $request->validate([
            'inp_fn' => 'required|string|max:50',
            'inp_ln' => 'required|string|max:50',
            'inp_email' => 'required|email',
            'inp_position' => 'nullable|string|max:50',
            'inp_date_started' => 'nullable|date',
            'ern_text' => 'nullable|string|max:100',
            'ern_digits' => 'nullable|numeric|min:0',
            'inp_proof_payment' => 'required|file|mimes:jpg,png,pdf|max:5120', // 5MB max
        ]);

        // Handle file upload
        if ($request->hasFile('inp_proof_payment')) {
            $path = $request->file('inp_proof_payment')->storeAs(
                'proof_payments',
                $request->file('inp_proof_payment')->hashName(),
                ['disk' => 'public', 'visibility' => 'public']
            );
        }

        // Create a new request record with employee_id
        RequestModel::create([
            'employee_id' => $employee->employee_id,  // Add this line
            'FirstName' => $validated['inp_fn'],
            'LastName' => $validated['inp_ln'],
            'Email' => $validated['inp_email'],
            'Position' => $validated['inp_position'],
            'DateStarted' => $validated['inp_date_started'],
            'MonthlyCompensationText' => $validated['ern_text'],
            'MonthlyCompensationDigits' => $validated['ern_digits'],
            'proof_payment_path' => $path ?? null,
            'status' => 'pending',  // Add default status
        ]);

        return redirect()->back()->with('success', 'Request submitted successfully!');
    }

}
