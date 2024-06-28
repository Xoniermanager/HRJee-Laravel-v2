<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\Employee\NewsController;
use App\Http\Controllers\Employee\PolicyController;
use App\Http\Controllers\Employee\AccountController;
use App\Http\Controllers\Employee\SupportController;
use App\Http\Controllers\Employee\ContactUsController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\HRServiceController;
use App\Http\Controllers\Employee\ResignationController;
use App\Http\Controllers\Employee\NotificationController;
use App\Http\Controllers\Employee\LeaveMangementController;
use App\Http\Controllers\Employee\DailyAttendanceController;
use App\Http\Controllers\Employee\AttendanceServiceController;
use App\Http\Controllers\Employee\HolidaysMangementController;
use App\Http\Controllers\Employee\PayslipsMangementController;
use App\Http\Controllers\Employee\EmployeeAttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('skill_data', [SkillController::class, 'skill_data'])->name('skill_data');

/** ---------------Employee Panel Started--------------  */
Route::get('/', [AuthController::class, 'index'])->name('employee');

Route::prefix('employee')->middleware('Check2FA')->group(function () {

    //Employee Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('employee.dashboard');

    //Daily Attendance
    Route::get('/daily/attendance', [DailyAttendanceController::class, 'index'])->name('employee.daily.attendance');

    //News Module
    Route::controller(NewsController::class)->group(function () {
        Route::get('/news', 'index')->name('employee.news');
        Route::get('/news/details', 'viewDetails')->name('employee.news.details');
    });

    //Policy Module
    Route::get('/policy', [PolicyController::class, 'index'])->name('employee.policy');

    //HR Service Module
    Route::get('/hr/service', [HRServiceController::class, 'index'])->name('employee.hr.service');

    //Support Module
    Route::get('/support', [SupportController::class, 'index'])->name('employee.support');

    //talk to us
    Route::get('/talk-to-us', [SupportController::class, 'talk_to_us'])->name('employee.talk');

    //Notification Module
    Route::get('/notification', [NotificationController::class, 'index'])->name('employee.notification');

    //Account Module
    Route::get('/account', [AccountController::class, 'index'])->name('employee.account');

    // Contact Module
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('employee.contact.us');

    // Attendance Service
    Route::get('/attendance/service', [AttendanceServiceController::class, 'index'])->name('employee.attendance.service');

    // Leave Management
    Route::controller(LeaveMangementController::class)->group(function () {
        Route::get('/leave', 'index')->name('employee.leave');
        Route::get('/apply/leave', 'applyLeave')->name('employee.apply.leave');
    });

    // Holidays Management
    Route::get('/holidays', [HolidaysMangementController::class, 'index'])->name('employee.holidays');

    // Payslips Management
    Route::get('/payslips', [PayslipsMangementController::class, 'index'])->name('employee.payslips');

    // Resignation Management
    Route::controller(ResignationController::class)->group(function () {
        Route::get('/resignation', 'index')->name('employee.resignation');
        Route::get('/apply/resignation', 'applyResignation')->name('employee.apply.resignation');
    });

    //Employee Attendance Management]
    Route::post('/employee/attendance', [EmployeeAttendanceController::class, 'makeAttendance'])->name('employee.attendance');
});
/**----------------- End Employee Pannel Route ----------------------*/
