<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\PRMController;
use App\Http\Controllers\Employee\NewsController;
use App\Http\Controllers\Employee\CourseController;
use App\Http\Controllers\Employee\PolicyController;
use App\Http\Controllers\Employee\AccountController;
use App\Http\Controllers\Employee\SupportController;
use App\Http\Controllers\Employee\ContactUsController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\HRServiceController;
use App\Http\Controllers\Employee\ApplyLeaveController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\HrComplainController;
use App\Http\Controllers\Employee\ResignationController;
use App\Http\Controllers\Employee\NotificationController;
use App\Http\Controllers\Employee\AnnouncementsController;
use App\Http\Controllers\Employee\LeaveTrackingController;
use App\Http\Controllers\Employee\AddressRequestController;
use App\Http\Controllers\Employee\LeaveAvailableController;
use App\Http\Controllers\Employee\DailyAttendanceController;
use App\Http\Controllers\Employee\AttendanceRequestController;
use App\Http\Controllers\Employee\CompOffController;
use App\Http\Controllers\Employee\HolidaysMangementController;
use App\Http\Controllers\Employee\PayslipsMangementController;
use App\Http\Controllers\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Employee\EmployeeBreakHistoryController;

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

// Route::middleware(['check.employee.status', 'Check2FA'])->group(function (){
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });

/** ---------------Employee Panel Started--------------  */
Route::prefix('employee')->middleware(['checkAccountStatus', 'Check2FA'])->group(function () {
    //Employee Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('employee.dashboard');
    Route::get('/impersonate', [DashboardController::class, 'startImpersonate'])->name('employee.impersonate');
    Route::get('/unset-impersonate', [DashboardController::class, 'endImpersonate'])->name('employee.unset-impersonate');
    //Daily Attendance
    Route::get('/daily/attendance', [DailyAttendanceController::class, 'index'])->name('employee.daily.attendance');

    //News Module
    Route::controller(NewsController::class)->group(function () {
        Route::get('/news', 'index')->name('employee.news');
        Route::get('/news/details/{news:id}', 'viewDetails')->name('employee.news.details');
    });

    // Resignation Management
    Route::prefix('resignation')->name('resignation.')->controller(ResignationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/apply', 'applyResignation')->name('apply');
        Route::post('/{id}', 'editResignation')->name('edit');
        Route::get('/{id}', 'view')->name('view');
        Route::post('/{id}/status', 'changeStatus')->name('change-status');

        Route::get('/delete/{id?}', 'destroy')->name('delete');
        Route::post('/cancel', 'actionResignation')->name('actionResignation');
    });

    //   // Resignation Management
    //   Route::controller(ResignationController::class)->group(function () {
    //     Route::get('/resignation', 'index')->name('employee.resignation');
    //     Route::get('/apply/resignation', 'applyResignation')->name('employee.apply.resignation');
    // });

    //Policy Module
    Route::controller(PolicyController::class)->group(function () {
        Route::get('/policy', 'index')->name('employee.policy');
        Route::get('/policy/details/{policies:id}', 'viewDetails')->name('employee.policy.details');
    });

    //Announcement Module
    Route::controller(AnnouncementsController::class)->group(function () {
        Route::get('/announcement', 'index')->name('employee.announcement');
        Route::get('/announcement/details/{announcements:id}', 'viewDetails')->name('employee.announcement.details');
    });

    //Account Module
    Route::controller(AccountController::class)->group(function () {
        Route::get('/account', 'index')->name('employee.account');
        Route::post('/update/basic/details', 'basicDetailsUpdate')->name('update.basicDetails.employee');
        Route::post('/update/bank/details', 'bankDetailsUpdate')->name('update.bankDetails.employee');
        Route::post('/update/address/details', 'addressDetailsUpdate')->name('update.addressDetails.employee');
    });

    //HR Service Module
    Route::get('/hr/service', [HRServiceController::class, 'index'])->name('employee.hr.service');
    Route::get('/show/payslip', [HRServiceController::class, 'salaryIndex'])->name('employee.salary.index');

    //Support Module
    Route::get('/support', [SupportController::class, 'index'])->name('employee.support');

    //talk to us
    Route::get('/talk-to-us', [SupportController::class, 'talk_to_us'])->name('employee.talk');

    //Notification Module
    Route::get('/notification', [NotificationController::class, 'index'])->name('employee.notification');

    // Contact Module
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('employee.contact.us');

    // Attendance Service
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/attendance/service', 'index')->name('employee.attendance.service');
        Route::get('/search/filter/date', 'getAttendanceByFromAndToDate')->name('search.filter.attendance');
    });


    // Leave Management
    Route::controller(ApplyLeaveController::class)->group(function () {
        Route::get('/leave', 'index')->name('employee.leave');
        Route::get('/apply/leave', 'applyLeave')->name('employee.apply.leave');
        Route::post('/create/leave', 'store')->name('employee.apply.store');
    });

    // Holidays Management
    Route::controller(HolidaysMangementController::class)->group(function () {
        Route::get('/holidays', 'index')->name('employee.holidays');
        Route::get('/update/calendar', 'updateCalendar')->name('update.calendar');
        Route::get('/holiday_by_date', 'holidayByDate')->name('holiday.by.date');
    });

    // Payslips Management
    Route::get('/payslips', [PayslipsMangementController::class, 'index'])->name('employee.payslips');

    //Employee Attendance Management]
    Route::get('/employee/attendance', [EmployeeAttendanceController::class, 'makeAttendance'])->name('employee.attendance');

    //Employee Leave Available
    Route::get('get/leave/available', [LeaveAvailableController::class, 'getAllLeaveAvailableByUserId'])->name('employee.leave.available');

    //Leave Tracking
    Route::get('/leave-tracking/{id}', [LeaveTrackingController::class, 'index'])->name('employee.leave.tracking');

    //Employee Break History
    Route::controller(EmployeeBreakHistoryController::class)->group(function () {
        Route::post('/break-in', 'breakIn')->name('employee_break_in');
        Route::get('/break-out/{id}', 'breakOut')->name('employee_break_out');
    });

    //Employee Complain
    Route::prefix('/hr-complain')->controller(HrComplainController::class)->group(function () {
        Route::get('/index', 'index')->name('hr_complain.index');
        Route::get('/add', 'add')->name('hr_complain.add');
        Route::post('/store', 'store')->name('hr_complain.store');
        Route::get('/chat/{employee_complains:id}', 'getComplainDetails')->name('employee.getComplainDetails');
    });

    //Employee PRM
    Route::prefix('/prm')->controller(PRMController::class)->group(function () {
        Route::get('/', 'index')->name('prm.index');
        Route::get('/add', 'add')->name('prm.add');
        Route::post('/store', 'store')->name('prm.store');
        Route::get('/edit/{id}', 'edit')->name('prm.edit');
        Route::post('/update/{id}', 'update')->name('prm.update');
        Route::get('/view/{id}', 'getDetails')->name('prm.view');
        Route::get('/delete', 'delete')->name('prm.delete');
    });

    //Course Details
    Route::controller(CourseController::class)->group(function () {
        Route::get('/course', 'index')->name('employee.course');
        Route::get('/course/details/{courses:id}', 'viewDetails')->name('employee.course.details');
    });

    //Attendance Request Module
    Route::prefix('/attendance/request')->controller(AttendanceRequestController::class)->group(function () {
        Route::get('/', 'index')->name('employee.attendance.request.index');
        Route::get('/add','add')->name('employee.attendance.request.add');
        Route::get('/edit/{id}','edit')->name('employee.attendance.request.edit');
        Route::post('/store', 'store')->name('employee.attendance.request.store');
        Route::post('/update/{id}','update')->name('employee.attendance.request.update');
        Route::get('/delete','delete')->name('employee.attendance.request.delete');
        Route::get('/search/filter', 'serachFilterList')->name('employee.attendance.request.search');
    });
     //Attendance Request Module
     Route::prefix('/address/request')->controller(AddressRequestController::class)->group(function () {
        Route::get('/', 'index')->name('employee.address.request.index');
        Route::post('/create', 'store')->name('employee.address.request.store');
        Route::post('/update', 'update')->name('employee.address.request.update');
        Route::get('/delete', 'destroy')->name('employee.address.request.delete');
        Route::get('/search/filter', 'serachFilterList');
    });

    //Comp Off Module
    Route::prefix('/comp-offs')->controller(CompOffController::class)->group(function () {
        Route::get('/', 'index')->name('employee.comp.off.index');
        Route::get('/add','add')->name('employee.comp.off.add');
        Route::post('/store', 'store')->name('employee.comp.off.store');
        Route::get('/delete','delete')->name('employee.comp.off.delete');
        Route::get('/search/filter', 'serachFilterList')->name('employee.comp.off.search');
    });
});
/**----------------- End Employee Pannel Route ----------------------*/
