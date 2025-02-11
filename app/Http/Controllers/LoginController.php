<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'employee') {
        return redirect()->route('employee.dashboard');
    }

    return redirect('/');
}
}
