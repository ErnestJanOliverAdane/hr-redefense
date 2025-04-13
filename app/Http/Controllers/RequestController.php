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


        $coe = RequestModel::all();
        $employee = Auth::user();
        $masterlist = MasterlistModel::where('employee_id', $employee->employee_id)->first();
        $dateStarted = $masterlist ? $masterlist->created_at->format('Y-m-d') : '';
        $personalInformation = $employee->personal_information;
        return view('employee.request.index', compact('coe', 'employee', 'personalInformation', 'masterlist', 'dateStarted'));
    }

    public function store(Request $request)
    {
        // Get authenticated employee
        $employee = Auth::user();

        // Check daily submission limit
        $todaySubmissions = RequestModel::where('Email', $employee->email)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        if ($todaySubmissions >= 2) {
            return redirect()->back()->with('error', 'You can only submit 2 requests per day.');
        }

        // Validate the request
        $validated = $request->validate([
            'inp_fn' => 'required|string|max:50',
            'inp_ln' => 'required|string|max:50',
            'inp_email' => 'required|email',
            'inp_position' => 'nullable|string|max:50',
            'inp_date_started' => 'nullable|date',
            'inp_or' => 'required|string|max:50',
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

        // Check if a pending request exists for this employee
        $existingRequest = RequestModel::where('employee_id', $employee->employee_id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            // Update the existing pending request
            $existingRequest->update([
                'FirstName' => $validated['inp_fn'],
                'LastName' => $validated['inp_ln'],
                'Email' => $validated['inp_email'],
                'Position' => $validated['inp_position'],
                'DateStarted' => $validated['inp_date_started'],
                'or_number' => $validated['inp_or'],
                'proof_payment_path' => $path ?? $existingRequest->proof_payment_path,
            ]);
        } else {
            // Create a new request
            RequestModel::create([
                'employee_id' => $employee->employee_id,
                'FirstName' => $validated['inp_fn'],
                'LastName' => $validated['inp_ln'],
                'Email' => $validated['inp_email'],
                'Position' => $validated['inp_position'],
                'DateStarted' => $validated['inp_date_started'],
                'or_number' => $validated['inp_or'],
                'proof_payment_path' => $path ?? null,
                'status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Request submitted successfully!');
    }


}
