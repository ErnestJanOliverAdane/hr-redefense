<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function index()
    {
        // Get files only for the logged-in employee
        $files = FileModel::where('masterlist_id', Auth::id())
            ->latest()
            ->get();
        return view('employee.files.index', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Store in the uploads directory inside public disk
        $path = $file->storeAs('uploads', $fileName, 'public');

        FileModel::create([
            'masterlist_id' => Auth::id(), // Add the employee_id from the authenticated user
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'size' => $file->getSize(),
            'type' => $file->getClientMimeType(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    public function destroy($id)
    {
        // Only allow deletion if the file belongs to the logged-in employee
        $file = FileModel::where('masterlist_id', Auth::id())
            ->findOrFail($id);

        Storage::delete('public/' . $file->path);
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully');
    }

    public function show($id)
    {
        $file = FileModel::where('masterlist_id', Auth::id())
            ->findOrFail($id);

        if (!Storage::disk('public')->exists($file->path)) {
            abort(404);
        }

        // Get the file mime type
        $mimeType = Storage::disk('public')->mimeType($file->path);
        
        // Stream the file
        return response()->file(storage_path('app/public/' . $file->path), [
            'Content-Type' => $mimeType
        ]);
    }

}