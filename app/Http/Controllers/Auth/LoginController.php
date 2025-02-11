<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MasterlistModel;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $loginType = $request->input('login_type');

        if ($loginType === 'admin') {
            // Admin login using users table
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
        } else if ($loginType === 'employee') {
            // Employee login using masterlist table
            $employee = MasterlistModel::where('employee_id', $request->employee_id)->first();

            if ($employee && Hash::check($request->password, $employee->password)) {
                Auth::guard('masterlist')->login($employee);
                $request->session()->regenerate();
                return redirect()->intended('employee/dashboard');
            }
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
