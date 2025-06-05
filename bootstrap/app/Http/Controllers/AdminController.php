<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::CheckAdmin()) {
            $user_type = Auth::user()->usertype;

            if ($user_type == 'admin') {
                return view('admin.index');
            } else if ($user_type == 'employee') {
                return view('user.index');
            } else {
                return redirect('/')->with('error', 'Unauthorized access');
            }
        } else {
            return redirect('/login')->with('error', 'Please log in first');
        }
    }
}
