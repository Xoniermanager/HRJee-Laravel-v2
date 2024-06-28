<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\AdminController;
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Employee\ForgetPasswordController;

/**---------------Reset And Forget Password Route----------------*/
Route::controller(ForgetPasswordController::class)->group(function () {
    Route::get('/forget/password', 'index')->name('forget.password');
    Route::post('/submit/ForgetPassword/Form', 'submitForgetPasswordForm')->name('submitForgetPasswordForm');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
});
/**---------------End Reset And Forget Password Route----------------*/


/**---------------Employee Auth Route----------------*/
Route::prefix('employee')->controller(AuthController::class)->group(function () {
    Route::get('/signin', 'index')->name('employee');
    Route::post('/login', 'employeeLogin')->name('employee.login');
    Route::get('/logout', 'emoloyeeLogout')->name('employee.logout');
    Route::get('/verify/otp', 'verifyOtp')->name('employee.verifyOtp');
    Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('employee.verifyOtpCheck');
    Route::get('/resend/otp', 'resendOtp')->name('employee.resendOtp');
});
/**---------------End Employee Auth Route----------------*/

/**---------------Company Panel Route----------------*/
Route::prefix('company')->controller(AdminController::class)->group(function () {
    Route::post('/login', 'companyLogin')->name('company.login');
    Route::get('/logout', 'companyLogout')->name('company.logout');
    Route::get('/signin', 'signin')->name('signin');
    Route::get('/signup', 'signup')->name('signup');
    Route::get('/resend/otp', 'resendOtp')->name('employee.resendOtp');
    Route::get('/verify/otp', 'verifyOtp')->name('verifyOtp');
    Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('verifyOtpCheck');
});
/**---------------End Company Auth Route----------------*/

/** ----------------- Super Admin Started -------------------- **/
Route::prefix('/admin')->controller(SuperAdminController::class)->group(function () {
    Route::get('/login', 'login')->name('super_admin.login.form');
    Route::get('/verify/otp', 'verifyOtp')->name('super_admin.verifyOtp');
    Route::get('/resend/otp', 'resendOtp')->name('super_admin.resendOtp');
    Route::post('/verify/otp/submit', 'verifyOtpCheck')->name('super_admin.verifyOtpCheck');
    Route::post('/super_admin_login', 'super_admin_login')->name('super.admin.login');
});
/**---------------End Super Admin Auth Route----------------*/

