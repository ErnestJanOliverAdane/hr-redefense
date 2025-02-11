<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        // Logic to check admin user
        return $next($request);
    }
}
