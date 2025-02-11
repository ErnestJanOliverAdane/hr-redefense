<?php

namespace App\Providers;

use App\Models\MasterlistModel;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Configure Fortify
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Admin authentication with validation
        Fortify::authenticateUsing(function (Request $request) {
            $validated = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $user = User::where('email', $request->email)->first();

            Log::info('Login attempt', [
                'email' => $request->email,
                'user_found' => $user ? 'Yes' : 'No'
            ]);

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        // Define the admin login view
        Fortify::loginView(function () {
            return view('auth.admin-login');
        });

        // Add rate limiting for admin login
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->email) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        // Add rate limiting for employee login
        RateLimiter::for('employee-login', function (Request $request) {
            return Limit::perMinute(5)->by($request->employee_id . '|' . $request->ip());
        });

        // Define routes for employee login
        Route::middleware(['web'])->group(function () {
            Route::get('/employee/login', function () {
                return view('auth.employee-login');
            })->name('employee.login');

            Route::post('/employee/login', function (Request $request) {
                // Update validation to only require employee_id
                $validated = $request->validate([
                    'employee_id' => ['required', 'string'], // Remove any email validation
                    'password' => ['required'],
                ]);


                // Check rate limiting
                if (RateLimiter::tooManyAttempts('employee-login:' . $request->employee_id, 5)) {
                    $seconds = RateLimiter::availableIn('employee-login:' . $request->employee_id);
                    return back()->withErrors([
                        'employee_id' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.',
                    ]);
                }

                $employee = MasterlistModel::where('employee_id', $request->employee_id)->first();

                if ($employee && Hash::check($request->password, $employee->password)) {
                    RateLimiter::clear('employee-login:' . $request->employee_id);
                    auth('employee')->login($employee);  // Specify the guard
                    return redirect()->intended('dashboard_emp');
                }
                RateLimiter::hit('employee-login:' . $request->employee_id);
                return back()
                    ->withErrors([
                        'employee_id' => 'The provided credentials are incorrect.',
                    ])
                    ->withInput($request->only('employee_id'));
            })->name('employee.login.submit')
                ->middleware('throttle:employee-login');
        });

        // Add rate limiting for two-factor authentication
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}