<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ResignationController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\LeaveManagementController;
use App\Http\Controllers\Api\LocationVisitAPiController;
use App\Http\Controllers\Api\LeaveAvailableApiController;
use App\Http\Controllers\Api\ResignationStatusController;
use App\Http\Controllers\Api\LeaveManagementApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:30,1');
Route::post('sendOtp', [AuthController::class, 'sendOtp']);
Route::post('forgot/password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('reset/password', [ForgotPasswordController::class, 'resetPassword']);
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword']);
Route::post('verify/otp', [AuthController::class, 'verifyOtp'])->middleware('throttle:30,1');

Route::group(['middleware' =>  'auth:sanctum'], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('user/details', [AuthController::class, 'userAllDetails']);

    Route::get('company-details', [AuthController::class, 'getCompanyDetails']);
    Route::get('menu-access', [AuthController::class, 'getMenuAccess']);

    Route::post('update/profile', [AuthController::class, 'updateProfile']);
    Route::post('change/password', [AuthController::class, 'changePassword']);
    Route::put('update/address', [AddressController::class, 'updateAddress']);

    /**For Leave Management API */
    Route::get('/leave-types', [LeaveManagementApiController::class, 'leaveType']);
    Route::get('/leaves', [LeaveManagementApiController::class, 'allLeaves']);
    Route::post('/apply/leave', [LeaveManagementApiController::class, 'applyLeave']);
    Route::get('/available-leaves', [LeaveAvailableApiController::class, 'getAllLeaveAvailableByUserId']);
    Route::get('applied/leave/history', [LeaveManagementApiController::class, 'appliedLeaveHistory']);

    /** Punch In */
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/employee/make/attendance', 'makeAttendance');
        Route::post('/search/filter/attendance', 'getAttendanceByFromAndToDate');
        Route::get('/get-today-attendance', 'getTodayAttendance');
        Route::get('/get-last-attendance', 'getLastTenDaysAttendance');
        Route::get('/attendance', 'getParticularDateAttendance');
    });

    /** News Module  */
    Route::prefix('news')->controller(NewsController::class)->group(function () {
        Route::get('/list', 'allAssignedNews');
        Route::get('/view-details/{news:id}', 'viewNewsDetails');
    });

    /** Policy Modules */
    Route::prefix('policy')->controller(PolicyController::class)->group(function () {
        Route::get('/list', 'allAssignedPolicy');
        Route::get('/view-details/{policies:id}', 'viewPolicyDetails');
    });

    /** Announcement Modules */
    Route::prefix('announcements')->controller(AnnouncementController::class)->group(function () {
        Route::get('/list', 'allAssignedAnnouncement');
        Route::get('/view-details/{announcements:id}', 'viewAnnouncementDetails');
    });

    /** Resignation Modules */
    Route::prefix('resignation')->controller(ResignationController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'view');
        Route::post('/', 'apply');
        Route::put('/{id}', 'edit');
        Route::put('/{id}/withdraw', 'withdraw');
    });


    Route::prefix('assets')->controller(AssetController::class)->group(function () {
        Route::get('/', 'assetDetails');
    });

    /** For Holiday Management API */
    Route::get('/holidays', [HolidayController::class, 'getHolidays']);


     /** for Location Visit And Assigned Task */
     Route::controller(LocationVisitAPiController::class)->group(function () {
        Route::get('/assign/task', 'assignedTask');
        Route::get('/get/disposition/code', 'getDispositionCode');
    });
});
