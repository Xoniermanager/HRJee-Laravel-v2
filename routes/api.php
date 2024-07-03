<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HolidayApiController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\LeaveAvailableApiController;
use App\Http\Controllers\Api\LeaveManagementController;
use App\Http\Controllers\Api\LeaveManagementApiController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('sendOtp', [AuthController::class, 'sendOtp']);

Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword']);

Route::group(['middleware' =>  'auth:sanctum'], function () {

    Route::post('verify/otp', [AuthController::class, 'verifyOtp']);

    // Route::group(['middleware' => 'Check2FA'], function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('user/details', [AuthController::class, 'userAllDetails']);
    Route::post('update/profile', [AuthController::class, 'updateProfile']);
    Route::post('change/password', [AuthController::class, 'changePassword']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user/address', [AddressController::class, 'addressDetails']);
    Route::get('user/addresses', [AddressController::class, 'getAllAddresses']);
    Route::put('update/address', [AddressController::class, 'updateAddress']);

    /**For Leave Management API */
    Route::get('/leave/type', [LeaveManagementApiController::class, 'leaveType']);
    Route::post('/apply/leave', [LeaveManagementApiController::class, 'storeApplyLeave']);

    /** For Holiday Management API */
    Route::get('/holiday/list', [HolidayApiController::class, 'list']);

    /** Get All Leave Avaialble of Employee */
    Route::get('/get/leave/available', [LeaveAvailableApiController::class, 'getAllLeaveAvailableByUserId']);
});
