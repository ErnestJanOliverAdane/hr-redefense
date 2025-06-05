<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SOController extends Controller
{
    public function index(Request $request)
    {
        // Fetch records where employment_status is 'Contract of Service'
        $masterlists = MasterlistModel::where('employment_status', 'Contract of Service')->get();

        // Pass the filtered masterlist data to the view
        return view('admin.other.so', compact('masterlists'));
    }
}
