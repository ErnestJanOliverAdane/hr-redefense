<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddEmployeeController;
use App\Http\Controllers\EmpDashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\PersonalDataSheetController;
use App\Http\Controllers\ContructualController;
use App\Http\Controllers\COSController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReqStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\EmployeeReportController;
use App\Models\MasterlistModel;
use App\Http\Controllers\SOrequestController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ApromotionController;
use App\Http\Controllers\SettingsController;





// Route::post('   ', [LoginController::class, 'login'])->name('employee.login');





Route::middleware(['auth:web'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/addemployees', [AddEmployeeController::class, 'index'])->name('addemployees.index');
    // Route::get('/addemployees', [AddEmployeeController::class, 'showForm'])->name('employee.index');
    Route::post('/employee/registration', [AddEmployeeController::class, 'store'])->name('employee.save');
    Route::post('/addemployees/save', [AddEmployeeController::class, 'store'])->name('addemployees.save');

    Route::get('/departments/register', [DepartmentController::class, 'registration'])->name('departments.register');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('faculty')->name('faculty.')->group(function () {
        Route::get('/', [FacultyController::class, 'index'])->name('index');
        Route::get('/create', [FacultyController::class, 'create'])->name('create');
        Route::post('/', [FacultyController::class, 'store'])->name('store');
        Route::get('/{id}', [FacultyController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [FacultyController::class, 'edit'])->name('edit');
        Route::put('/{id}', [FacultyController::class, 'update'])->name('update');
        Route::delete('/{id}', [FacultyController::class, 'destroy'])->name('destroy');
    });


    //Reports
    // Route::get('/record/employee', function () {
    //     return view('admin.record.employee');
    // })->name('admin.record.employee');

    // Route::get('/record', function () {
    //     return view('admin.others.record');
    // })->name('admin.others.record');
    // Route::get('/ranks', function () {
    //     return view('admin.ranks.index');
    // })->name('admin.ranks.index');


    //Service Record only veiw
    Route::get('/others/so', function () {
        return view('admin.others.so');
    })->name('admin.others.so');



    Route::get('/ccosreport', [EmployeeReportController::class, 'index'])->name('ccosreport.index');
    Route::get('/employee/export/excel', [EmployeeReportController::class, 'exportExcel'])->name('employee.export.excel');

    Route::get('/contractuals', [ContructualController::class, 'index'])->name('contractuals.index');
    Route::post('/contractuals', [ContructualController::class, 'save'])->name('contractuals.save');
    Route::get('/contractuals/searchMasterlist', [ContructualController::class, 'searchMasterlist'])->name('contractuals.searchMasterlist');

    Route::get('/jocosmoareport', [COSController::class, 'index'])->name('jocosmoareport.index');
    Route::post('/cosreps', [COSController::class, 'store'])->name('cosreps.store');
    Route::get('/cosreps/searchMasterlist', [COSController::class, 'searchMasterlist'])->name('cosreps.searchMasterlist');


    Route::get('/RankingRecord', [RankController::class, 'showRankingRecord'])->name('admin.record.daily');

    Route::get('/record/daily', function () {
        return view('admin.record.daily');
    })->name('admin.record.daily');

    Route::prefix('masterlist')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('masterlist.index');
        Route::post('/', [EmployeeController::class, 'store'])->name('masterlist.store');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('masterlist.edit');
        Route::post('/{id}/update', [EmployeeController::class, 'update'])->name('masterlist.update'); // Changed to POST
        Route::get('/{id}/delete', [EmployeeController::class, 'destroy'])->name('masterlist.destroy'); // Changed to GET for simplicity
        Route::post('/import', [EmployeeController::class, 'import'])->name('employees.import');
        Route::get('/{id}', [EmployeeController::class, 'show'])->name('masterlist.show');


    });


    //

    Route::get('/employee/{masterlistId}/files', [EmployeeController::class, 'getEmployeeFiles']);



    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');


    Route::post('/rank/update', [RankController::class, 'update'])->name('rank.update');

    Route::get('/search', [RankController::class, 'searchUpdate']);

    Route::get('/search-employees', [RankController::class, 'search'])->name('employees.search');
    Route::get('/search-masterlist', [RankController::class, 'searchMasterlist'])->name('masterlist.search');
    Route::post('/employee/save', [RankController::class, 'save'])->name('employee.save');
    Route::get('/ranks', [RankController::class, 'index']);

    Route::get('/search', [RankController::class, 'search'])->name('rank.search');
    Route::get('/search', [RankController::class, 'search'])->name('search');


    Route::get('/staff', [StaffController::class, 'index'])->name('staff.job');
    Route::get('/staff/permanent', [StaffController::class, 'permanent'])->name('staff.permanent');

    Route::get('/others/coe', [OtherController::class, 'coe'])->name(name: 'others.coe');
    Route::get('/department/register', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('/department/register', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/departments/filter', [AddEmployeeController::class, 'filterDepartments'])->name('departments.filter');


    Route::post('/request-certificate', [RequestController::class, 'store'])->name('request.store');

    Route::prefix('others')->group(function () {
        // Main request routes
        Route::get('/request', [OtherController::class, 'coe_request'])->name('admin.others.request');
        Route::get('/approved', [OtherController::class, 'approved_requests'])->name('admin.others.Approve'); // Changed to match blade
        Route::get('/rejected', [OtherController::class, 'rejected_requests'])->name('admin.others.rejected');


        // route sa pag pa display sa mga request sa mga fucking employee sa /so so
        Route::get('/sorequestlist', [OtherController::class, 'soindex'])->name('admin.others.sorequestlist');


        Route::get('/so-request/{id}', [SOrequestController::class, 'show'])->name('so_request.view');



        // route pag pa display sa mga approved na so request
        Route::get('/soapprove', [OtherController::class, 'soapprovedrequests'])->name('admin.others.soapprove');


        // route sa pag pag display sa mga reject na so request
        Route::get('/soreject', [OtherController::class, 'sorejectedrequests'])->name('admin.others.soareject');


        // approve og reject function route sa so
        Route::put('/sorequest/{soreqid}/approve', [OtherController::class, 'soapprove'])->name('so_request.approve');
        Route::put('/sorequest/{soreqid}/reject', [OtherController::class, 'soreject'])->name('so_request.reject');


        // Action routes for COE requests
        Route::put('/request/{coe_id}/approve', [OtherController::class, 'approve'])->name('request.approve');
        Route::put('/request/{coe_id}/reject', [OtherController::class, 'reject'])->name('request.reject');

        // Edit routes
        Route::put('/request/{coe_id}', [OtherController::class, 'update'])->name('admin.others.update');

        Route::put('/others/request/{coe_id}', [OtherController::class, 'update'])->name('request.update');

    });

    Route::get('/admin/others/{coe_id}/edit', [OtherController::class, 'edit'])->name('admin.others.edit');
    Route::put('/admin/others/{coe_id}', [OtherController::class, 'update'])->name('admin.others.update');

    Route::get('/get-date-started/{employee_id}', function ($employee_id) {
        $dateStarted = DB::table('masterlist')
            ->where('employee_id', $employee_id)
            ->value('created_at');

        return response()->json([
            'date_started' => date('F d, Y', strtotime($dateStarted))
        ]);
    });
    Route::get('/get-date-started/{employee_id}', [OtherController::class, 'getDateStarted']);


    Route::get('/promote/request', [App\Http\Controllers\ApromotionController::class, 'index'])->name('admin.promotion.index');
    Route::get('/promote/reject', [App\Http\Controllers\ApromotionController::class, 'rejected'])->name('admin.promotion.rejected');
    Route::get('/promote/approve', [App\Http\Controllers\ApromotionController::class, 'approved'])->name('admin.promotion.approved');

    Route::get('/promote/request/{id}', [App\Http\Controllers\ApromotionController::class, 'show'])->name('admin.promotion.show');
    Route::post('/promote/request/approve/{id}', [App\Http\Controllers\ApromotionController::class, 'approveRequest'])->name('admin.promotion.approve');
    Route::post('/promote/request/reject/{id}', [App\Http\Controllers\ApromotionController::class, 'rejectRequest'])->name('admin.promotion.reject');


    Route::get('/settings', [SettingsController::class, 'index']);
    Route::patch('/faculty/{id}/toggle', [SettingsController::class, 'toggleStatus'])->name('faculty.toggle');





});







// Employee auth routes
// Employee authentication routes
Route::middleware(['web'])->group(function () {

    Route::post('/emp/dashboard', function (Request $request) {
        $validated = $request->validate([
            'employee_id' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $employee = MasterlistModel::where('employee_id', $request->employee_id)->first();

        if ($employee && Hash::check($request->password, $employee->password)) {
            Auth::guard('employee')->login($employee);
            return redirect('/emp/dashboard');
        }

        return back()->withErrors(['employee_id' => 'Invalid credentials'])->withInput($request->only('employee_id'));
    })->name('employee.login.submit');
});

// Protected employee routes
Route::middleware(['auth:employee'])->group(function () {
    Route::get('/emp/dashboard', [EmpDashboardController::class, 'index'])
        ->middleware('auth')
        ->name('employee.dashboard');

    //request in admin
    // Route::get('/request', [OtherController::class, 'coe_request']);

    Route::get('/import', [ImportController::class, 'showImportForm'])->name('import.form');
    Route::post('/import', [ImportController::class, 'import'])->name('import');
    Route::get('/request/status', [ReqStatusController::class, 'index'])->name('status.index');

    //User Update Profile
    Route::get('/personal-data-sheet', [PersonalDataSheetController::class, 'index'])->name('personal.data.sheet.index');
    Route::post('/personal-data-sheet', [PersonalDataSheetController::class, 'store'])->name('personal.data.sheet.store');
    Route::get('/personal-data-sheet/{personal_information_id}', [PersonalDataSheetController::class, 'edit'])->name('personal.data.sheet.edit');
    Route::post('/personal-data-sheet/{personal_information_id}/update', [PersonalDataSheetController::class, 'update'])->name('personal.data.sheet.update');

    //coerequest
    Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    Route::post('/request', [RequestController::class, 'store'])->name('request.store');

    //sorequest
    Route::get('/sorequest', [SOrequestController::class, 'index'])->name('sorequest.index');
    Route::post('/sorequest', [SOrequestController::class, 'store'])->name('sorequest.store');


    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/files', [FileController::class, 'index'])->name('files.index');
        Route::post('/files', [FileController::class, 'store'])->name('files.store');
        Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
        Route::get('/files/{file}/show', [FileController::class, 'show'])->name('files.show');  // Add this line
        Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    });

    Route::get('/promotion', [PromotionController::class, 'index']);
    Route::get('/promotion/status', [PromotionController::class, 'status']);
    Route::post('/promotion/store', [PromotionController::class, 'store']);

    Route::get('/sorequest/sorequeststatus', [SOrequestController::class, 'sostatusrequest'])->name('employee.sorequest.sorequeststatus');

});
