<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterlistModel;

class SettingsController extends Controller
{
    public function index()
    {
        $faculty = MasterlistModel::all();
        return view('admin.settings.index', compact('faculty'));
    }
    public function toggleStatus($id)
    {
        $faculty = MasterlistModel::findOrFail($id);

        if ($faculty->employment_type === 'disabled') {
            $faculty->employment_type = 'active';
            $faculty->disabled_at = null;
        } else {
            $faculty->employment_type = 'disabled';
            $faculty->disabled_at = now();
        }

        $faculty->save();

        return back()->with('status', 'Account status updated.');
    }


}
