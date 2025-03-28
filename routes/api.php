<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\Api\PRMApiController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\CompOffController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ResignationController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\LocationVisitAPiController;
use App\Http\Controllers\Api\LeaveAvailableApiController;
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
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->middleware('throttle:30,1');
    Route::post('sendOtp', 'sendOtp');
    Route::post('verify/otp', 'verifyOtp')->middleware('throttle:30,1');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::post('forgot/password', 'forgotPassword');
    Route::post('reset/password', 'resetPassword');
    Route::post('password/reset', 'resetPassword');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout');
        Route::get('profile/details', 'profileDetails');
        Route::get('company-details', 'getCompanyDetails');
        Route::get('menu-access', 'getMenuAccess');

        Route::post('update/profile', 'updateProfile');
        Route::post('change/password', 'changePassword');
        Route::post('user/kyc/registration', 'userKycRegistration');
        Route::post('user/punchIn/image', 'userPunchInImage');

    });
    Route::controller(AddressController::class)->group(function () {
        Route::put('update/address', 'updateAddress');
        Route::post('/address/request/store', 'storeAddressRequest');
        Route::post('/address/request/update/{id}', 'updateAddressRequest');
        Route::get('/address/request/delete/{id}', 'deleteAttendanceRequest');
        Route::get('/address/request/details/{id}', 'detailsAddressRequest');
        Route::get('/address/request/list', 'getAllAddressRequestList');
    });

    /**For Leave Management API */
    Route::controller(LeaveManagementApiController::class)->group(function () {
        Route::get('/leave-types', 'leaveType');
        Route::get('/leaves', 'allLeaves');
        Route::post('/apply/leave', 'applyLeave');
        Route::get('applied/leave/history', 'appliedLeaveHistory');
    });

    Route::get('/available-leaves', [LeaveAvailableApiController::class, 'getAllLeaveAvailableByUserId']);

    /** Punch In */
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/employee/make/attendance', 'makeAttendance');
        Route::post('/search/filter/attendance', 'getAttendanceByFromAndToDate');
        Route::get('/get-today-attendance', 'getTodayAttendance');
        Route::get('/get-last-attendance', 'getLastTenDaysAttendance');
        Route::get('/attendance', 'getParticularDateAttendance');
        Route::post('/attendance/export', 'generateAttendanceExport');
        Route::get('/generatePaySlip', 'generatePaySlip');
        Route::post('/attendance/request/store', 'storeAttendanceRequest');
        Route::post('/attendance/request/update/{id}', 'updateAttendanceRequest');
        Route::get('/attendance/request/delete/{id}', 'deleteAttendanceRequest');
        Route::get('/attendance/request/details/{id}', 'detailsAttendanceRequest');
        Route::get('/attendance/request/list', 'getAllAttendanceRequestList');
    });

    /** Comp off Module  */
    Route::prefix('comp-offs')->controller(CompOffController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/add', 'store');
        Route::delete('/delete/{compOffId}', 'delete');
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
        Route::post('/update/task/status/{id}', 'updateTaskStatusDetails');
        Route::post('/change/task/status/{id}', 'changeStatus');
    });

    /** for PRM Request and PRM Category */
    Route::controller(PRMApiController::class)->group(function () {
        Route::get('/get/all/prm/request', 'getAllPRMList');
        Route::get('/get/prm/Category', 'getAllPRMCategory');
        Route::get('/get/prm/request/details/{id}', 'getPRMRequestDetails');
        Route::post('/add/prm/request', 'addPRMRequest');
        Route::post('/update/prm/request/{id}', 'updatePRMRequest');
        Route::get('/delete/prm/request/{id}', 'deletePRMRequest');
    });
});

