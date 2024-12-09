<?php

use App\Http\Controllers\Admin\ForgetPasswordController as AdminForgetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\AdminController;
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Company\ForgetPasswordController as CompanyForgetPasswordController;
use App\Http\Controllers\Employee\ForgetPasswordController;
use App\Http\Controllers\EmployeeComplainController;
use Illuminate\Support\Facades\Artisan;

/**---------------Reset And Forget Password Route----------------*/
Route::controller(ForgetPasswordController::class)->group(function () {
    Route::get('/forget/password', 'index')->name('forget.password');
    Route::post('/submit/ForgetPassword/Form', 'submitForgetPasswordForm')->name('submitForgetPasswordForm');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
});
/**---------------End Reset And Forget Password Route----------------*/

/**---------------Reset And Forget Password Route FOR Company----------------*/
Route::prefix('company')->controller(CompanyForgetPasswordController::class)->group(function () {
    Route::get('/forget/password', 'index')->name('company.forget.password');
    Route::post('/submit/ForgetPassword/Form', 'submitForgetPasswordForm')->name('company.submitForgetPasswordForm');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('company.reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('company.reset.password.post');
});
/**---------------End Reset And Forget Password Route FOR Company----------------*/

/**---------------Reset And Forget Password Route FOR Admin----------------*/
Route::prefix('admin')->controller(AdminForgetPasswordController::class)->group(function () {
    Route::get('/forget/password', 'index')->name('admin.forget.password');
    Route::post('/submit/ForgetPassword/Form', 'submitForgetPasswordForm')->name('admin.submitForgetPasswordForm');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('admin.reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('admin.reset.password.post');
});
/**---------------End Reset And Forget Password Route FOR Admin----------------*/


/**---------------Employee Auth Route----------------*/
Route::get('/', [AuthController::class, 'index'])->name('employee');

Route::prefix('employee')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'employeeLogin')->name('employee.login');
    Route::get('/logout', 'emoloyeeLogout')->name('employee.logout');
    Route::get('/verify/otp', 'verifyOtp')->name('employee.verifyOtp');
    Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('employee.verifyOtpCheck');
    Route::get('/resend/otp', 'resendOtp')->name('employee.resendOtp');
});
/**---------------End Employee Auth Route----------------*/

/**---------------Company Panel Route----------------*/
Route::prefix('company')->controller(AdminController::class)->group(function () {
    Route::get('/clear-cache', function () {
        Artisan::call('optimize:clear');
        return '<h1>Cache cleared</h1>';
    });
    Route::post('/login', 'companyLogin')->name('company.login');
    Route::get('/logout', 'companyLogout')->name('company.logout');
    Route::get('/signin', 'signin')->name('signin');
    // Route::get('/forget/password', 'forgetPassword')->name('signin');
    Route::get('/signup', 'signup')->name('signup');
    Route::get('/resend/otp', 'resendOtp')->name('company.resendOtp');
    Route::get('/verify/otp', 'verifyOtp')->name('verifyOtp');
    Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('verifyOtpCheck');
});
/**---------------End Company Auth Route----------------*/

/** ----------------- Super Admin Started -------------------- **/
Route::prefix('/admin')->controller(SuperAdminController::class)->group(function () {
    Route::get('/login', 'login')->name('admin.login.form');
    Route::get('/verify/otp', 'verifyOtp')->name('admin.verifyOtp');
    Route::get('/resend/otp', 'resendOtp')->name('admin.resendOtp');
    Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('admin.verifyOtpCheck');
    Route::post('/admin_login', 'admin_login')->name('super.admin.login');
});
/**---------------End Super Admin Auth Route----------------*/

/** Employee Complain */
Route::prefix('employee')->controller(EmployeeComplainController::class)->group(function () {
    Route::post('/send/message/{employee_complains:id}', 'sendMessage')->name('send.message');
});
