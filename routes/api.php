<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BankController;
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
Route::get('sendOtp', [AuthController::class, 'sendOtp']);
Route::post('verify/otp', [AuthController::class, 'verifyOtp']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('update/profile', [AuthController::class, 'updateProfile']);
    Route::post('change/password', [AuthController::class, 'changePassword']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user/bank/details', [BankController::class, 'bankDetails']);
});
