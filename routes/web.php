<?php

use App\Http\Controllers\AttendanceScanController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MyAttendanceOverviewController;
use App\Http\Controllers\MyPayrollCOntroller;
use App\Http\Controllers\MyProjectController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// check in check out
Route::get('check', [CheckController::class, 'check'])->name('check');
Route::post('checkin', [CheckController::class, 'checkin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.layout.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // users
    Route::resource('user', UserController::class);
    Route::get('dataTable/user', [UserController::class, 'dataTable']);
    // department
    Route::resource('department', DepartmentController::class);
    Route::get('dataTable/department', [DepartmentController::class, 'dataTable']);
    // role
    Route::resource('role', RoleController::class);
    Route::get('dataTable/role', [RoleController::class, 'dataTable']);
    // permission
    Route::resource('permission', PermissionController::class);
    Route::get('dataTable/permission', [PermissionController::class, 'dataTable']);
    // company setting
    Route::resource('companySetting', CompanyController::class);
    Route::post('companyUpdate/{$id}', [CompanyController::class, 'companyUpdate'])->name('companyUpdate');
    // check in check out
    Route::resource('attendance', CheckController::class);
    Route::get('dataTable/attendance', [CheckController::class, 'dataTable']);
    // attendance scan
    Route::get('scan', [AttendanceScanController::class, 'scan'])->name('scan');
    Route::post('attendance', [AttendanceScanController::class, 'attendance'])->name('attendance');
    Route::get('attendance-overview', [AttendanceScanController::class, 'overview'])->name('attendance-overview');
    Route::get('my-attendance-overview', [MyAttendanceOverviewController::class, 'overviewTable'])->name('my-attendance-overview');
    Route::get('attendance-overview-table', [AttendanceScanController::class, 'overviewTable'])->name('overviewTable');
    Route::get('dataTable/myAttendance', [MyAttendanceOverviewController::class, 'dataTable']);
    // salary
    Route::resource('salary', SalaryController::class);
    Route::get('dataTable/salary', [SalaryController::class, 'dataTable']);
    // payroll
    Route::get('payroll-overview', [PayrollController::class, 'overview'])->name('payroll-overview');
    Route::get('payroll-overview-table', [PayrollController::class, 'overviewTable'])->name('PayrollOverviewTable');
    Route::get('my-payroll', [MyPayrollCOntroller::class, 'myPayroll'])->name('myPayroll');
    // project
    Route::resource('project', ProjectController::class);
    Route::get('dataTable/project', [ProjectController::class, 'dataTable']);
    // my project
    Route::resource('myProject', MyProjectController::class);
    Route::get('dataTable/myProject', [MyProjectController::class, 'dataTable']);

});

require __DIR__ . '/auth.php';
