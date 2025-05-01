<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterlistModel;

class ApromotionController extends Controller
{
    /**
     * Display pending promotion requests
     */
    public function index()
    {
        // Get all pending promotion requests from tbl_ranking
        $pendingRequests = DB::table('tbl_ranking')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // Debug: Check if any pending requests were found
        \Log::info('Pending requests count: ' . count($pendingRequests));

        // Get employee info for each request
        $requestsWithEmployeeInfo = [];
        foreach ($pendingRequests as $request) {
            // Debug: Log each request ID
            \Log::info('Processing request ID: ' . $request->id);

            $employee = MasterlistModel::find($request->masterlist_id);

            // Debug: Check if employee was found
            \Log::info('Employee found for request ' . $request->id . ': ' . ($employee ? 'Yes' : 'No'));

            if ($employee) {
                $request->employee_name = $employee->full_name;
                $request->department = $employee->department;
                $request->position = $employee->job_title;

                try {
                    // Convert created_at to Carbon instance
                    $request->created_at = \Carbon\Carbon::parse($request->created_at);
                    $requestsWithEmployeeInfo[] = $request;
                    \Log::info('Request ' . $request->id . ' added to display list');
                } catch (\Exception $e) {
                    \Log::error('Error parsing date for request ' . $request->id . ': ' . $e->getMessage());
                }
            }
        }

        // Debug: Final count of requests with employee info
        \Log::info('Requests with employee info count: ' . count($requestsWithEmployeeInfo));

        return view('admin.promotionrequest.request', [
            'requests' => $requestsWithEmployeeInfo
        ]);
    }

    /**
     * Display rejected promotion requests
     */
    public function rejected()
    {
        // Get all rejected promotion requests
        $rejectedRequests = DB::table('tbl_ranking')
            ->where('status', 'rejected')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get employee info for each request
        $requestsWithEmployeeInfo = [];
        foreach ($rejectedRequests as $request) {
            $employee = MasterlistModel::find($request->masterlist_id);
            if ($employee) {
                $request->employee_name = $employee->full_name;
                $request->department = $employee->department;
                $request->position = $employee->job_title;
                // Convert dates to Carbon instances
                $request->created_at = \Carbon\Carbon::parse($request->created_at);
                $request->updated_at = \Carbon\Carbon::parse($request->updated_at);
                $requestsWithEmployeeInfo[] = $request;
            }
        }

        return view('admin.promotionrequest.rejected', [
            'requests' => $requestsWithEmployeeInfo
        ]);
    }

    public function approved()
    {
        // Get all approved promotion requests
        $approvedRequests = DB::table('tbl_ranking')
            ->where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get employee info for each request
        $requestsWithEmployeeInfo = [];
        foreach ($approvedRequests as $request) {
            $employee = MasterlistModel::find($request->masterlist_id);
            if ($employee) {
                $request->employee_name = $employee->full_name;
                $request->department = $employee->department;
                $request->position = $employee->job_title;
                // Convert dates to Carbon instances
                $request->created_at = \Carbon\Carbon::parse($request->created_at);
                $request->updated_at = \Carbon\Carbon::parse($request->updated_at);
                $requestsWithEmployeeInfo[] = $request;
            }
        }

        return view('admin.promotionrequest.approved', [
            'requests' => $requestsWithEmployeeInfo
        ]);
    }

    /**
     * Show the details of a specific promotion request
     */
    public function show($id)
    {
        // Find the request in tbl_ranking
        $request = DB::table('tbl_ranking')->where('id', $id)->first();

        if (!$request) {
            return redirect()->back()->with('error', 'Promotion request not found');
        }

        // Get employee information
        $employee = MasterlistModel::find($request->masterlist_id);

        // Convert dates to Carbon instances
        if ($request->created_at) {
            $request->created_at = \Carbon\Carbon::parse($request->created_at);
        }
        if ($request->updated_at) {
            $request->updated_at = \Carbon\Carbon::parse($request->updated_at);
        }

        return view('admin.promotionrequest.show', [
            'request' => $request,
            'employee' => $employee
        ]);
    }

    /**
     * Approve a promotion request
     */
    public function approveRequest(Request $request, $id)
    {
        try {
            // Validate if attachments have been reviewed
            if ($request->attachments_reviewed !== 'true') {
                return redirect()->back()->with('error', 'All attachments must be reviewed before approval');
            }

            DB::beginTransaction();

            // Find the request in tbl_ranking
            $promotionRequest = DB::table('tbl_ranking')->where('id', $id)->first();

            if (!$promotionRequest) {
                return redirect()->back()->with('error', 'Promotion request not found');
            }

            // Get employee ID
            $employeeId = DB::table('masterlist')->where('id', $promotionRequest->masterlist_id)->value('employee_id');

            // Update the existing record in tbl_ranking
            DB::table('tbl_ranking')
                ->where('id', $id)
                ->update([
                    'status' => 'approved',
                    'remarks' => $request->remarks,
                    'updated_rank' => $promotionRequest->requested_rank,
                    'updated_at' => now()
                ]);

            // Create a history record in tbl_ranking_history
            DB::table('tbl_ranking_history')->insert([
                'masterlist_id' => $promotionRequest->masterlist_id,
                'employee_id' => $employeeId,
                'previous_rank' => $promotionRequest->current_rank,
                'current_rank' => $promotionRequest->current_rank,
                'current_qua' => $promotionRequest->current_qua,
                'requested_rank' => $promotionRequest->requested_rank,
                'justification' => $promotionRequest->justification,
                'certificate_path' => $promotionRequest->certificate_path,
                'cert_earning_units_path' => $promotionRequest->cert_earning_units_path,
                'tor_path' => $promotionRequest->tor_path,
                'status' => 'approved',
                'remarks' => $request->remarks,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Log this action
            \Log::info('Promotion request ' . $id . ' approved by user ID: ' . auth()->id());

            DB::commit();
            return redirect()->route('admin.promotion.index')->with('success', 'Promotion request approved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to approve promotion request: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to approve promotion request: ' . $e->getMessage());
        }
    }

    public function rejectRequest(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Find the request in tbl_ranking
            $promotionRequest = DB::table('tbl_ranking')->where('id', $id)->first();

            if (!$promotionRequest) {
                return redirect()->back()->with('error', 'Promotion request not found');
            }

            // Get employee ID
            $employeeId = DB::table('masterlist')->where('id', $promotionRequest->masterlist_id)->value('employee_id');

            // Update the existing record in tbl_ranking
            DB::table('tbl_ranking')
                ->where('id', $id)
                ->update([
                    'status' => 'rejected',
                    'remarks' => $request->remarks,
                    'updated_at' => now()
                ]);

            // Create a history record in tbl_ranking_history
            DB::table('tbl_ranking_history')->insert([
                'masterlist_id' => $promotionRequest->masterlist_id,
                'employee_id' => $employeeId,
                'previous_rank' => $promotionRequest->current_rank,
                'current_rank' => $promotionRequest->current_rank,
                'current_qua' => $promotionRequest->current_qua,
                'requested_rank' => $promotionRequest->requested_rank,
                'justification' => $promotionRequest->justification,
                'certificate_path' => $promotionRequest->certificate_path,
                'cert_earning_units_path' => $promotionRequest->cert_earning_units_path,
                'tor_path' => $promotionRequest->tor_path,
                'status' => 'rejected',
                'remarks' => $request->remarks,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Log this action
            \Log::info('Promotion request ' . $id . ' rejected by user ID: ' . auth()->id());

            DB::commit();
            return redirect()->route('admin.promotion.index')->with('success', 'Promotion request rejected successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to reject promotion request: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reject promotion request: ' . $e->getMessage());
        }
    }
}
