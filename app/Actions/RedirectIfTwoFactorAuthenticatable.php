<?php

namespace App\Actions;

use Closure;
use Illuminate\Http\Request;

class RedirectIfTwoFactorAuthenticatable
{
    /**
     * Handle the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if two-factor authentication is required
        if ($request->session()->get('two_factor')) {
            return redirect()->route('two-factor.challenge');
        }

        // Allow the request to proceed
        return $next($request);
    }
}
