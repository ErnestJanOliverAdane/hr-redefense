<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterlistModel;
use App\Models\RankModel;
use App\Models\RankingHistoryModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Db;

class PromotionController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        $employeeInfo = MasterlistModel::where('employee_id', $employee->employee_id)->first();

        $rankInfo = RankModel::where('masterlist_id', $employeeInfo->id)->first();

        return view('employee.promotion.index', compact('employeeInfo', 'rankInfo'));
    }

    public function status()
    {
        $employee = Auth::user();

        $employeeInfo = MasterlistModel::where('employee_id', $employee->employee_id)->first();

        $rankInfo = RankModel::where('masterlist_id', $employeeInfo->id)->first();

        return view('employee.promotion.status', compact('employeeInfo', 'rankInfo'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'employee_id' => 'required|string|max:50',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'date_of_hiring' => 'required|date',
            'current_rank' => 'required|string|max:255',
            'current_qua' => 'required|string|max:255',
            'last_promotion_date' => 'nullable|date',
            'requested_rank' => 'required|string|max:255',
            'justification' => 'nullable|string',
            'certificate' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'cert_earning_units_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'tor' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        $employee = Auth::user();
        $employeeInfo = MasterlistModel::where('employee_id', $employee->employee_id)->first();

        $certificatePath = null;
        $certEarningUnitsPath = null;
        $torPath = null;

        if ($request->hasFile('certificate')) {
            $certificate = $request->file('certificate');
            $certificateName = time() . '_' . $employee->employee_id . '_certificate.' . $certificate->getClientOriginalExtension();
            $certificatePath = $certificate->storeAs('promotion_documents', $certificateName, 'public');
        }

        if ($request->hasFile('cert_earning_units')) {
            $certEarningUnits = $request->file('cert_earning_units');
            $certEarningUnitsName = time() . '_' . $employee->employee_id . '_cert_earning_units.' . $certEarningUnits->getClientOriginalExtension();
            $certEarningUnitsPath = $certEarningUnits->storeAs('promotion_documents', $certEarningUnitsName, 'public');
        }

        if ($request->hasFile('tor')) {
            $tor = $request->file('tor');
            $torName = time() . '_' . $employee->employee_id . '_tor.' . $tor->getClientOriginalExtension();
            $torPath = $tor->storeAs('promotion_documents', $torName, 'public');
        }

        try {

            \DB::beginTransaction();

            $rankInfo = RankModel::where('masterlist_id', $employeeInfo->id)->first();

            $rankingData = [
                'masterlist_id' => $employeeInfo->id,
                'current_rank' => $request->current_rank,
                'current_qua' => $request->current_qua,
                'requested_rank' => $request->requested_rank,
                'last_promotion_date' => $request->last_promotion_date,
                'justification' => $request->justification,
                'certificate_path' => $certificatePath,
                'cert_earning_units_path' => $certEarningUnitsPath,
                'tor_path' => $torPath,
                'status' => 'pending'
            ];

            if ($rankInfo) {

                $rankInfo->update($rankingData);
            } else {

                RankModel::create($rankingData);
            }


            RankingHistoryModel::create([
                'masterlist_id' => $employeeInfo->id,
                'employee_id' => $employee->employee_id,
                'previous_rank' => $request->current_rank,
                'current_rank' => $request->current_rank,
                'current_qua' => $request->current_qua,
                'requested_rank' => $request->requested_rank,
                'justification' => $request->justification,
                'certificate_path' => $certificatePath,
                'cert_earning_units_path' => $certEarningUnitsPath,
                'tor_path' => $torPath,
                'status' => 'pending'
            ]);

            \DB::commit();
            return redirect()->to('/promotion/status')->with('success', 'Ranking request submitted successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();

            if ($certificatePath) {
                Storage::disk('public')->delete($certificatePath);
            }
            if ($certEarningUnitsPath) {
                Storage::disk('public')->delete($certEarningUnitsPath);
            }
            if ($torPath) {
                Storage::disk('public')->delete($torPath);
            }

            \Log::error('Promotion submission error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to submit ranking request. Error: ' . $e->getMessage());
        }
    }
}
