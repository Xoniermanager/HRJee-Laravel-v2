<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\Api\PRMApiController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CompOffController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ConfigDataController;
use App\Http\Controllers\Api\ResignationController;
use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\Api\AnnouncementController;
use Illuminate\Foundation\Console\RouteCacheCommand;
use App\Http\Controllers\Admin\LogActivityController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\LocationTrackingController;
use App\Http\Controllers\Api\LocationVisitAPiController;
use App\Http\Controllers\Api\LeaveAvailableApiController;
use App\Http\Controllers\Api\LeaveManagementApiController;
use App\Http\Controllers\Employee\EmployeeBreakHistoryController;
use App\Models\Support;

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

Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

Route::middleware('log.route')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/login-by-id', 'loginByEmpId');
    Route::post('sendOtp', 'sendOtp');
    Route::post('verify/otp', 'verifyOtp');
    Route::post('/face/login', 'faceLogin');
});

Route::controller(ForgotPasswordController::class)->middleware('log.route')->group(function () {
    Route::post('forgot/password', 'forgotPassword');
    Route::post('reset/password', 'resetPassword');
    Route::post('password/reset', 'resetPassword');
});

Route::middleware(['auth:sanctum', 'log.route'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout');
        Route::get('profile/details', 'profileDetails');
        Route::get('company-details', 'getCompanyDetails');
        Route::get('menu-access', 'getMenuAccess');
        Route::get('get/team/details/{userId}', 'getTeamDetailsByUserId');
        Route::get('/shift', 'getTodaysShift');
        Route::post('save/token', 'saveDeviceToken');
        Route::post('send/notification/battery/percentage', 'sendNotificationBatteryPercentage');
        Route::post('/notifications/{id}', 'updateNotificationStatus');

        Route::post('update/profile', 'updateProfile');
        Route::patch('toggle-location-tracking', 'toggleUserLocationTracking');
        Route::post('update/documents', 'updateDocuments');
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
        Route::post('/employee/make/attendance', 'makeAttendance');
        Route::post('/employee/face/attendance', 'makeAttendanceUsingFace');
        Route::get('/employee/shifts', 'getTodaysShifts');
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
        Route::get('/attendance/details/{month}', 'attendanceDetailsbyMonth');
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

    /** Support Modules */
    Route::prefix('support')->controller(SupportController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'view');
        Route::post('/', 'apply');
        Route::put('/{id}', 'edit');
        Route::delete('/{id}', 'delete');
    });


    Route::prefix('assets')->controller(AssetController::class)->group(function () {
        Route::get('/', 'assetDetails');
    });

    /** For Holiday Management API */
    Route::get('/holidays', [HolidayController::class, 'getHolidays']);
    Route::get('/holiday/list', [HolidayController::class, 'getHolidays']);


    /** for Location Visit And Assigned Task */
    Route::controller(LocationVisitAPiController::class)->group(function () {
        Route::get('/assign/task', 'assignedTask');
        Route::get('/assign/report', 'taskReport');
        Route::get('/get/disposition/code', 'getDispositionCode');
        Route::post('/update/task/status/{id}', 'updateTaskStatusDetails');
        Route::post('/change/task/status/{id}', 'changeStatus');
        Route::get('/visit-locations', 'fetchVisitLocations');
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


    /** for Live Location Tracking */
    Route::middleware('checkMenuAccess:location-tracking')->controller(LocationTrackingController::class)->group(function () {
        Route::get('/location-tracking/get-locations', 'getLocations');
        Route::post('/location-tracking/send', 'sendLocations');
    });
      /** Course Details Modules */
      Route::prefix('course')->controller(CourseController::class)->group(function () {
        Route::get('/list', 'courseList');
        Route::get('/details/{courses:id}', 'courseDetails');
    });
    //Employee Break History
    Route::controller(EmployeeBreakHistoryController::class)->group(function () {
        Route::get('/break-type/list', 'getBreakTypeList');
        Route::post('/break-in', 'breakIn');
        Route::get('/break-out/{employee_break_histories:breakId}', 'breakOutbyApi');
        Route::get('/break-details/{employee_attendances:attendanceId}', 'getBreakDetailsByAttendanceId');
    });

    /** Config Data APIs */
    Route::controller(ConfigDataController::class)->group(function(){
        Route::get('/config/required-documents', 'requiredDocuments');
    });
});
/** Log Activity */
Route::prefix('log-activity')->controller(LogActivityController::class)->group(function () {
    Route::post('/create', 'createActivityLog');
});

