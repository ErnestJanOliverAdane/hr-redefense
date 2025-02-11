<?php

// app/Http/Controllers/ImportController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\YourDataImport; // Replace with your specific import class

class ImportController extends Controller
{
    public function showImportForm()
    {
        return view('import'); // points to import.blade.php
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        try {
            Excel::import(new YourDataImport, $request->file('file'));
            return redirect()->route('import.form')->with('success', 'File imported successfully!');
        } catch (\Exception $e) {
            return redirect()->route('import.form')->withErrors('Error importing file: ' . $e->getMessage());
        }
    }
}