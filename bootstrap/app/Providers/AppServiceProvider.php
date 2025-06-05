<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Share promotion request counts with all views
        View::composer('*', function ($view) {
            $pendingCount = DB::table('tbl_ranking')
                ->where('status', 'pending')
                ->count();

            $rejectedCount = DB::table('tbl_ranking')
                ->where('status', 'rejected')
                ->count();

            $approvedCount = DB::table('tbl_ranking')
                ->where('status', 'approved')
                ->count();

            $view->with('pendingPromotionCount', $pendingCount);
            $view->with('rejectedPromotionCount', $rejectedCount);
            $view->with('approvedPromotionCount', $approvedCount);
        });
    }
}
