<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel's authentication system to redirect users
     * after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';  // You can change this to '/dashboard' or any other route you prefer.

    /**
     * Define your route model bindings, pattern filters, and other route services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
