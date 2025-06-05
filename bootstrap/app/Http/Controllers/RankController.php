<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterlistModel;
use App\Models\RankModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RankController extends Controller
{
    public function index()
    {

        $masterlistTable = (new MasterlistModel())->getTable();


        $ranks = DB::table($masterlistTable)
            ->leftJoin('tbl_ranking', $masterlistTable . '.id', '=', 'tbl_ranking.masterlist_id')
            ->where($masterlistTable . '.job_type', 'faculty')
            ->select(
                $masterlistTable . '.id',
                $masterlistTable . '.employee_id',
                $masterlistTable . '.first_name',
                $masterlistTable . '.last_name',
                'tbl_ranking.field',
                'tbl_ranking.current_qua as qualification',
                'tbl_ranking.current_rank as rank',
                'tbl_ranking.requested_rank',
                'tbl_ranking.status'
            )
            ->orderBy($masterlistTable . '.first_name')
            ->get();

        return view('admin.ranks.index', compact('ranks'));
    }
    public function update(Request $request)
    {
        // Validate input
        $request->validate([
            'employee_id' => 'required',
            'updated_field' => 'required|string',
            'updated_qua' => 'required|string',
            'updated_rank' => 'required|string',
        ]);


        $employee = MasterlistModel::where('employee_id', $request->input('employee_id'))
            ->where('job_type', 'faculty')
            ->first();

        if (!$employee) {
            return redirect()->back()->withErrors(['employee_id' => 'Faculty member not found.']);
        }

        $oldField = $employee->field;
        $oldQualification = $employee->qualification;
        $oldRank = $employee->rank;


        $employee->update([
            'field' => $request->input('updated_field'),
            'qualification' => $request->input('updated_qua'),
            'rank' => $request->input('updated_rank'),
        ]);


        try {

            $existingRecord = DB::table('tbl_ranking')
                ->where('masterlist_id', $employee->id)
                ->first();

            if ($existingRecord) {

                DB::table('tbl_ranking')
                    ->where('masterlist_id', $employee->id)
                    ->update([
                        'field' => $request->input('updated_field'),
                        'current_qua' => $request->input('updated_qua'),
                        'current_rank' => $request->input('updated_rank'),
                        'requested_rank' => $request->input('updated_rank'), // Store the final rank designation in requested_rank
                        'updated_field' => $oldField != $request->input('updated_field') ? $oldField : $request->input('updated_field'),
                        'updated_qua' => $oldQualification != $request->input('updated_qua') ? $oldQualification : $request->input('updated_qua'),
                        'updated_rank' => $oldRank != $request->input('updated_rank') ? $oldRank : $request->input('updated_rank'),
                        'updated_at' => now()
                    ]);
            } else {

                DB::table('tbl_ranking')->insert([
                    'masterlist_id' => $employee->id,
                    'employee_id' => $employee->employee_id,
                    'field' => $request->input('updated_field'),
                    'current_qua' => $request->input('updated_qua'),
                    'current_rank' => $request->input('updated_rank'),
                    'requested_rank' => $request->input('updated_rank'), // Store the final rank designation in requested_rank
                    'updated_field' => $oldField ?: $request->input('updated_field'),
                    'updated_qua' => $oldQualification ?: $request->input('updated_qua'),
                    'updated_rank' => $oldRank ?: $request->input('updated_rank'),
                    'status' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        } catch (\Exception $e) {

            Log::error('Failed to update tbl_ranking: ' . $e->getMessage(), [
                'employee_id' => $employee->employee_id,
                'request_data' => $request->all()
            ]);

            return redirect()->back()->withErrors(['error' => 'Failed to update rank information: ' . $e->getMessage()]);
        }


        try {
            RankModel::create([
                'masterlist_id' => $employee->id,
                'employee_id' => $employee->employee_id,
                'previous_field' => $oldField,
                'previous_qualification' => $oldQualification,
                'previous_rank' => $oldRank,
                'current_field' => $request->input('updated_field'),
                'current_qualification' => $request->input('updated_qua'),
                'current_rank' => $request->input('updated_rank'),
                'updated_by' => auth()->id() ?? 1,
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {

            Log::error('Failed to create rank history: ' . $e->getMessage());
        }


        Log::info('Faculty rank updated', [
            'employee_id' => $employee->employee_id,
            'name' => $employee->first_name . ' ' . $employee->last_name,
            'old_rank' => $oldRank,
            'new_rank' => $request->input('updated_rank'),
            'updated_by' => auth()->id() ?? 1
        ]);

        return redirect()->back()->with('success', 'Faculty rank updated successfully.');
    }
    public function search(Request $request)
    {
        $query = $request->get('query');

        $employees = MasterlistModel::where('job_type', 'faculty')
            ->where(function ($q) use ($query) {
                $q->where('first_name', 'LIKE', "%{$query}%")
                    ->orWhere('last_name', 'LIKE', "%{$query}%");
            })
            ->select('id', 'employee_id', 'first_name', 'last_name', 'job_type', 'department')
            ->limit(10)
            ->get();

        return response()->json($employees);
    }

    public function searchMasterlist(Request $request)
    {
        $query = $request->get('query');

        $employees = MasterlistModel::where('job_type', 'Faculty')
            ->where(function ($q) use ($query) {
                $q->where('first_name', 'LIKE', "%{$query}%")
                    ->orWhere('last_name', 'LIKE', "%{$query}%");
            })
            ->select('id', 'employee_id', 'first_name', 'last_name', 'job_type', 'department')
            ->limit(10)
            ->get();

        return response()->json($employees);
    }

    public function rankHistory($employeeId)
    {

        $history = RankModel::where('employee_id', $employeeId)
            ->orderBy('updated_at', 'desc')
            ->get();

        $employee = MasterlistModel::where('employee_id', $employeeId)->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found');
        }

        return view('admin.ranks.history', compact('history', 'employee'));
    }

    public function showRankingRecord(Request $request)
    {
        $ranks = RankModel::with('masterlist')
            ->orderBy('updated_at', 'desc')
            ->get();

        $fullName = $request->input('full_name');
        $employeeId = null;

        if ($fullName) {
            $masterlist = MasterlistModel::whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$fullName])->first();
            $employeeId = $masterlist ? $masterlist->employee_id : null;
        }

        return view('admin.record.ranking', compact('ranks', 'employeeId'));
    }
}
