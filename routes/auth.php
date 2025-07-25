<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Company\AdminController;
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\EmployeeComplainController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\Company\EmployeeSalaryController;
use App\Http\Controllers\Employee\LeaveTrackingController;
use App\Http\Controllers\Employee\ForgetPasswordController;
use App\Http\Controllers\Admin\ForgetPasswordController as AdminForgetPasswordController;
use App\Http\Controllers\Company\ForgetPasswordController as CompanyForgetPasswordController;

// /**---------------Reset And Forget Password Route----------------*/
Route::controller(ForgetPasswordController::class)->middleware('log.route')->group(function () {
    Route::get('/forget/password', 'index')->name('forget.password');
    Route::post('/submit/ForgetPassword/Form', 'submitForgetPasswordForm')->name('submitForgetPasswordForm');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
});
// /**---------------End Reset And Forget Password Route----------------*/

// /**---------------Reset And Forget Password Route FOR Company----------------*/
// Route::prefix('company')->controller(CompanyForgetPasswordController::class)->group(function () {
//     Route::get('/forget/password', 'index')->name('company.forget.password');
//     Route::post('/submit/ForgetPassword/Form', 'submitForgetPasswordForm')->name('company.submitForgetPasswordForm');
//     Route::get('reset-password/{token}', 'showResetPasswordForm')->name('company.reset.password.get');
//     Route::post('reset-password', 'submitResetPasswordForm')->name('company.reset.password.post');
// });
// /**---------------End Reset And Forget Password Route FOR Company----------------*/

// /**---------------Reset And Forget Password Route FOR Admin----------------*/
Route::prefix('admin')->controller(AdminForgetPasswordController::class)->group(function () {
    Route::get('/forget/password', 'index')->name('admin.forget.password');
    Route::post('/submit/ForgetPassword/Form', 'submitForgetPasswordForm')->name('admin.submitForgetPasswordForm');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('admin.reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('admin.reset.password.post');
});
// /**---------------End Reset And Forget Password Route FOR Admin----------------*/


// /**---------------Employee Auth Route----------------*/
// Route::get('/', [AuthController::class, 'index'])->name('employee');

// Route::prefix('employee')->controller(AuthController::class)->group(function () {
//     Route::post('/login', 'employeeLogin')->name('employee.login');
//     Route::get('/logout', 'emoloyeeLogout')->name('employee.logout');
//     Route::get('/verify/otp', 'verifyOtp')->name('employee.verifyOtp');
//     Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('verifyOtpCheck');
//     Route::get('/resend/otp', 'resendOtp')->name('resendOtp');
//     Route::post('/change/password','changePassword')->name('change.password');
// });
// /**---------------End Employee Auth Route----------------*/

// /**---------------Company Panel Route----------------*/
// Route::prefix('company')->controller(AdminController::class)->group(function () {
//     Route::post('/login', 'companyLogin')->name('company.login');
//     Route::get('/logout', 'companyLogout')->name('company.logout');
//     Route::get('/signin', 'signin')->name('signin');
//     // Route::get('/forget/password', 'forgetPassword')->name('signin');
//     Route::get('/signup', 'signup')->name('signup');
//     Route::get('/resend/otp', 'resendOtp')->name('company.resendOtp');
//     Route::get('/verify/otp', 'verifyOtp')->name('verifyOtp');
//     Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('verifyOtpCheck');
// });
// /**---------------End Company Auth Route----------------*/

// /** ----------------- Super Admin Started -------------------- **/

Route::prefix('/admin')->controller(AdminAuthController::class)->group(function () {
    Route::middleware('guest.admin')->group(function () {
        Route::get('/login', 'login')->name('admin.login');

        Route::post('/admin_login', 'admin_login')->name('super.admin.login');
    });
    Route::get('/verify/otp', 'verifyOtp')->name('admin.verifyOtp');
    Route::get('/resend/otp', 'resendOtp')->name('admin.resendOtp');
    Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('admin.verifyOtpCheck');
    Route::get('/logout', 'adminLogout')->name('admin.logout');
});
// /**---------------End Super Admin Auth Route----------------*/

// /** Employee Complain */
Route::prefix('employee')->middleware('log.route')->controller(EmployeeComplainController::class)->group(function () {
    Route::post('/send/message/{employee_complains:id}', 'sendMessage')->name('send.message');
});
Route::controller(AuthController::class)->middleware('log.route')->group(function () {
    Route::get('/', 'index')->name('base');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/verify/otp', 'verifyOtp')->name('verifyOtp');
    Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('verifyOtpCheck');
    Route::get('/resend/otp', 'resendOtp')->name('resendOtp');
    Route::post('/change/password', 'adminChangePassword')->name('change.password');
    Route::post('/update/change/password', 'userUpdateChangePassword')->name('user.update.password');
});

// Route::get('/', [AuthController::class, 'index'])->name('employee');
 //Leave Tracking
 Route::get('/leave-tracking/{id}', [LeaveTrackingController::class, 'index'])->name('employee.leave.tracking');

Route::middleware('log.route')->get('/employee/payslip/generate-pdf', [EmployeeSalaryController::class,'generatePDF']);

Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/read/{id}', [PushNotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/clear-all', [PushNotificationController::class, 'clearAll'])->name('notifications.clearAll');
});
