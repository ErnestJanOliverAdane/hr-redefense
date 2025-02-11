<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::guard('employee')->check());
        if (!Auth::guard('employee')->check()) {
            return redirect()->route('employee.login');
        }
        return $next($request);
    }
}