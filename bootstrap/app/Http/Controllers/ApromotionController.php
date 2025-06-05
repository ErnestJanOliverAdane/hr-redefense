<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterlistModel;

class ApromotionController extends Controller
{

    public function index()
    {

        $pendingRequests = DB::table('tbl_ranking')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        \Log::info('Pending requests count: ' . count($pendingRequests));


        $requestsWithEmployeeInfo = [];
        foreach ($pendingRequests as $request) {

            \Log::info('Processing request ID: ' . $request->id);

            $employee = MasterlistModel::find($request->masterlist_id);

            \Log::info('Employee found for request ' . $request->id . ': ' . ($employee ? 'Yes' : 'No'));

            if ($employee) {
                $request->employee_name = $employee->full_name;
                $request->department = $employee->department;
                $request->position = $employee->job_title;

                try {
                    $request->created_at = \Carbon\Carbon::parse($request->created_at);
                    $requestsWithEmployeeInfo[] = $request;
                    \Log::info('Request ' . $request->id . ' added to display list');
                } catch (\Exception $e) {
                    \Log::error('Error parsing date for request ' . $request->id . ': ' . $e->getMessage());
                }
            }
        }
        \Log::info('Requests with employee info count: ' . count($requestsWithEmployeeInfo));

        return view('admin.promotionrequest.request', [
            'requests' => $requestsWithEmployeeInfo
        ]);
    }

    public function rejected()
    {

        $rejectedRequests = DB::table('tbl_ranking')
            ->where('status', 'rejected')
            ->orderBy('updated_at', 'desc')
            ->get();


        $requestsWithEmployeeInfo = [];
        foreach ($rejectedRequests as $request) {
            $employee = MasterlistModel::find($request->masterlist_id);
            if ($employee) {
                $request->employee_name = $employee->full_name;
                $request->department = $employee->department;
                $request->position = $employee->job_title;
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

        $approvedRequests = DB::table('tbl_ranking')
            ->where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->get();

        $requestsWithEmployeeInfo = [];
        foreach ($approvedRequests as $request) {
            $employee = MasterlistModel::find($request->masterlist_id);
            if ($employee) {
                $request->employee_name = $employee->full_name;
                $request->department = $employee->department;
                $request->position = $employee->job_title;
                $request->created_at = \Carbon\Carbon::parse($request->created_at);
                $request->updated_at = \Carbon\Carbon::parse($request->updated_at);
                $requestsWithEmployeeInfo[] = $request;
            }
        }

        return view('admin.promotionrequest.approved', [
            'requests' => $requestsWithEmployeeInfo
        ]);
    }

    public function show($id)
    {

        $request = DB::table('tbl_ranking')->where('id', $id)->first();

        if (!$request) {
            return redirect()->back()->with('error', 'Promotion request not found');
        }


        $employee = MasterlistModel::find($request->masterlist_id);


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


    public function approveRequest(Request $request, $id)
    {
        try {

            if ($request->attachments_reviewed !== 'true') {
                return redirect()->back()->with('error', 'All attachments must be reviewed before approval');
            }

            DB::beginTransaction();


            $promotionRequest = DB::table('tbl_ranking')->where('id', $id)->first();

            if (!$promotionRequest) {
                return redirect()->back()->with('error', 'Promotion request not found');
            }
            $employeeId = DB::table('masterlist')->where('id', $promotionRequest->masterlist_id)->value('employee_id');
            DB::table('tbl_ranking')
                ->where('id', $id)
                ->update([
                    'status' => 'approved',
                    'remarks' => $request->remarks,
                    'updated_rank' => $promotionRequest->requested_rank,
                    'updated_at' => now()
                ]);
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

            $promotionRequest = DB::table('tbl_ranking')->where('id', $id)->first();

            if (!$promotionRequest) {
                return redirect()->back()->with('error', 'Promotion request not found');
            }
            $employeeId = DB::table('masterlist')->where('id', $promotionRequest->masterlist_id)->value('employee_id');
            DB::table('tbl_ranking')
                ->where('id', $id)
                ->update([
                    'status' => 'rejected',
                    'remarks' => $request->remarks,
                    'updated_at' => now()
                ]);
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
