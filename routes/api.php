<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HolidayApiController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\LeaveAvailableApiController;
use App\Http\Controllers\Api\LeaveManagementController;
use App\Http\Controllers\Api\LeaveManagementApiController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\Api\ResignationController;
use App\Http\Controllers\Api\ResignationStatusController;
use Illuminate\Support\Facades\Route;

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

Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword']);
Route::post('verify/otp', [AuthController::class, 'verifyOtp'])->middleware('throttle:30,1');

Route::group(['middleware' =>  'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('user/details', [AuthController::class, 'userAllDetails']);
    Route::post('update/profile', [AuthController::class, 'updateProfile']);
    Route::post('change/password', [AuthController::class, 'changePassword']);
    Route::put('update/address', [AddressController::class, 'updateAddress']);
    Route::get('announcement', [AnnouncementController::class, 'announcement']);
    Route::post('punch/in', [AttendanceController::class, 'punchIn']);
    Route::get('news', [NewsController::class, 'assignedNews']);
    Route::get('announcement', [AnnouncementController::class, 'getAllAssignedAnnouncement']);
    Route::get('policy', [PolicyController::class, 'getAllAssignedPolicy']);
    Route::get('asset/details', [AssetController::class, 'assetDetails']);
    Route::get('applied/leave/history', [LeaveManagementApiController::class, 'appliedLeaveHistory']);

    /**For Leave Management API */
    Route::get('/leave/type', [LeaveManagementApiController::class, 'leaveType']);
    Route::post('/apply/leave', [LeaveManagementApiController::class, 'storeApplyLeave']);

    /** For Holiday Management API */
    Route::get('/holiday/list', [HolidayApiController::class, 'list']);

    /** Get All Leave Avaialble of Employee */
    Route::get('/get/leave/available', [LeaveAvailableApiController::class, 'getAllLeaveAvailableByUserId']);

  /** resignation route */
  Route::post('/resignation-apply', [ResignationController::class, 'applyResignation']);
  Route::get('/resignation/details/{id?}', [ResignationController::class, 'resignationDetails']);
  Route::post('/change/resignation/status', [ResignationStatusController::class, 'changeResignationStatus']);
  Route::get('/resignation/status/lists', [ResignationStatusController::class, 'getResignationStatusList']);

});
