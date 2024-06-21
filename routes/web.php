<?php

use App\Http\Controllers\Admin\AssetCategoryController;
use App\Http\Controllers\Admin\AssetManufacturerController;
use App\Http\Controllers\Admin\AssetStatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Company\AdminController;
use App\Http\Controllers\Company\LeaveController;
use App\Http\Controllers\Company\RolesController;
use App\Http\Controllers\Company\StateController;
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\Employee\NewsController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CountryController;
use App\Http\Controllers\Company\HolidayController;
use App\Http\Controllers\Employee\PolicyController;
use App\Http\Controllers\Admin\AdminStateController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Company\EmployeeController;
use App\Http\Controllers\Employee\AccountController;
use App\Http\Controllers\Employee\SupportController;
use App\Http\Controllers\Admin\CompanySizeController;
use App\Http\Controllers\Admin\LeaveStatusController;
use App\Http\Controllers\Company\LanguagesController;
use App\Http\Controllers\Admin\AdminCompanyController;
use App\Http\Controllers\Admin\AdminCountryController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Company\DepartmentController;
use App\Http\Controllers\Employee\ContactUsController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\HRServiceController;
use App\Http\Controllers\Admin\CompanyStatusController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\Company\OfficeShiftController;
use App\Http\Controllers\Company\PermissionsController;
use App\Http\Controllers\Company\UserDetailsController;
use App\Http\Controllers\Admin\AdminLanguagesController;
use App\Http\Controllers\Admin\EmployeeStatusController;
use App\Http\Controllers\Company\DesignationsController;
use App\Http\Controllers\Employee\ResignationController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Employee\NotificationController;
use App\Http\Controllers\company\LeaveStatusLogController;
use App\Http\Controllers\Admin\AdminDesignationsController;
use App\Http\Controllers\Company\CompanyBranchesController;
use App\Http\Controllers\Company\PreviousCompanyController;
use App\Http\Controllers\Company\UserBankDetailsController;
use App\Http\Controllers\Employee\ForgetPasswordController;
use App\Http\Controllers\Employee\LeaveMangementController;
use App\Http\Controllers\Company\AssignPermissionController;
use App\Http\Controllers\Company\AttendanceStatusController;
use App\Http\Controllers\Employee\DailyAttendanceController;
use App\Http\Controllers\Company\OfficeTimingConfigController;
use App\Http\Controllers\Company\UserAddressDetailsController;
use App\Http\Controllers\Company\UserAdvanceDetailsController;
use App\Http\Controllers\Employee\AttendanceServiceController;
use App\Http\Controllers\Employee\HolidaysMangementController;
use App\Http\Controllers\Employee\PayslipsMangementController;
use App\Http\Controllers\Company\UserDocumentDetailsController;
use App\Http\Controllers\Company\UserPastWorkDetailsController;
use App\Http\Controllers\Company\UserRelativeDetailsController;
use App\Http\Controllers\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Admin\AdminCompanyBranchesController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Company\UserQualificationDetailsController;

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

Route::get('skill_data', [SkillController::class, 'skill_data'])->name('skill_data');

Route::middleware(['dashboard.access'])->group(function () {
    Route::view('/dashboard', 'company.dashboard.dashboard')->name('company.dashboard');

    Route::controller(CompanyController::class)->group(function () {
        Route::get('company/profile', 'company_profile')->name('company.profile');
        Route::patch('company/update/{id}/', 'update_company')->name('update.company');
        Route::post('company/change/password', 'company_change_password')->name('company.change.password');
    });

    Route::controller(CompanyBranchesController::class)->group(function () {
        Route::get('branch', 'index')->name('branch');
        Route::post('create', 'store')->name('company.branch.store');
        Route::post('/update', 'update')->name('company.branch.update');
        Route::get('/delete', 'destroy')->name('company.branch.delete');
        Route::get('/status/update', 'statusUpdate')->name('company.branch.statusUpdate');
        Route::get('/company/branch/search', 'searchBranchFilter')->name('company.branch.search');
    });

    //Department Module
    Route::prefix('/department')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('department.index');
        Route::post('/create', 'store')->name('department.store');
        Route::post('/update', 'update')->name('department.update');
        Route::get('/delete', 'destroy')->name('department.delete');
        Route::get('/status/update', 'statusUpdate')->name('department.statusUpdate');
        Route::get('/search/filter', 'serachDepartmentFilterList');
    });

    //Designation Module
    Route::prefix('/designation')->controller(DesignationsController::class)->group(function () {
        Route::get('/', 'index')->name('designation.index');
        Route::post('/create', 'store')->name('designation.store');
        Route::post('/update', 'update')->name('designation.update');
        Route::get('/delete', 'destroy')->name('designation.delete');
        Route::get('/status/update', 'statusUpdate')->name('designation.statusUpdate');
        Route::get('/get/all/designation', 'getAllDesignation')->name('get.all.designation');
        Route::get('/search/filter', 'serachDesignationFilterList');
    });

    //Country Module
    Route::prefix('/country')->controller(CountryController::class)->group(function () {
        Route::get('/', 'index')->name('country.index');
        Route::post('/create', 'store')->name('country.store');
        Route::post('/update', 'update')->name('country.update');
        Route::get('/delete', 'destroy')->name('country.delete');
        Route::get('/status/update', 'statusUpdate')->name('country.statusUpdate');
        Route::get('/search/filter', 'serachFilterList');
    });

    //State Module
    Route::prefix('/state')->controller(StateController::class)->group(function () {
        Route::get('/', 'index')->name('state.index');
        Route::post('/create', 'store')->name('state.store');
        Route::post('/update', 'update')->name('state.update');
        Route::get('/delete', 'destroy')->name('state.delete');
        Route::get('/status/update', 'statusUpdate')->name('state.statusUpdate');
        Route::get('/get/all/state', 'getAllStates')->name('get.all.country.state');
        Route::get('/search', 'searchStateFilter');
    });

    //Previous Company Module
    Route::prefix('/previous-company')->controller(PreviousCompanyController::class)->group(function () {
        Route::get('/', 'index')->name('previous.company.index');
        Route::post('/create', 'store')->name('previous.company.store');
        Route::post('/update', 'update')->name('previous.company.update');
        Route::get('/delete', 'destroy')->name('previous.company.delete');
        Route::get('/status/update', 'statusUpdate')->name('previous.company.statusUpdate');
        Route::get('/search', 'searchPreviousCompanyFilter');

        // for ajax call 
        Route::get('/previous_company_data', 'get_all_previous_company_ajax_call');
        Route::get('/ajax_store_previous_company', 'ajax_store_previous_company');
    });
    Route::prefix('/language')->controller(LanguagesController::class)->group(function () {
        Route::post('/create', 'store')->name('language.create');
        Route::get('/delete', 'destroy')->name('language.delete');
    });

    //Employee Module
    Route::prefix('/employee')->controller(EmployeeController::class)->group(function () {
        Route::get('/index', 'index')->name('employee.index');
        Route::get('/add', 'add')->name('employee.add');
        Route::post('/store', 'store')->name('employee.store');
        Route::get('/edit/{user:id}', 'edit')->name('employee.edit');
        Route::get('/get/filter/list', 'getfilterlist');
    });

    //Holiday Module
    Route::prefix('/holiday')->controller(HolidayController::class)->group(function () {
        Route::get('/', 'index')->name('holiday.index');
        Route::post('/create', 'store')->name('holiday.store');
        Route::post('/update', 'update')->name('holiday.update');
        Route::get('/delete', 'destroy')->name('holiday.delete');
        Route::get('/status/update', 'statusUpdate')->name('holiday.statusUpdate');
    });

    //Leave Module
    Route::prefix('/leave')->controller(LeaveController::class)->group(function () {
        Route::get('/', 'index')->name('leave.index');
        Route::get('/add', 'applyLeave')->name('leave.add');
        Route::post('/create', 'store')->name('leave.store');
        Route::post('/update', 'update')->name('leave.update');
        Route::get('/delete', 'destroy')->name('leave.delete');
    });

    //Leave Status Log Module
    Route::prefix('/leave-status-log')->controller(LeaveStatusLogController::class)->group(function () {
        Route::get('/', 'index')->name('leave.status.log.index');
        Route::get('/add', 'add')->name('leave.status.log.add');
        Route::post('/create', 'create')->name('leave.status.log.create');
        Route::get('/leave/details', 'getLeaveAppliedDetailsbyId')->name('leave.applied.details');
    });

    //Roles and Permission Module
    Route::prefix('/roles')->controller(RolesController::class)->group(function () {
        Route::get('/', 'index')->name('roles');
        Route::post('/create', 'store')->name('role.store');
        Route::post('/update', 'update')->name('role.update');
        Route::get('/delete', 'destroy')->name('role.delete');
        Route::get('/status/update', 'statusUpdate')->name('role.statusUpdate');
    });

    Route::prefix('/permissions')->controller(PermissionsController::class)->group(function () {
        Route::get('/', 'index')->name('permissions');
        Route::post('/create', 'store')->name('permission.store');
        Route::post('/update', 'update')->name('permission.update');
        Route::get('/delete', 'destroy')->name('permission.delete');
        Route::get('/status/update', 'statusUpdate')->name('permission.statusUpdate');
    });

    //TODO assign permission
    Route::prefix('/assign_permissions')->controller(AssignPermissionController::class)->group(function () {
        Route::get('/', 'index')->name('assign_permission');
        Route::post('/create', 'store')->name('assign_permissions.store');
        Route::post('/update', 'update')->name('assign_permissions.update');
        Route::get('/delete', 'destroy')->name('assign_permissions.delete');
        Route::get('/status/update', 'statusUpdate')->name('assign_permissions.statusUpdate');
    });

    // Route::get('roles', [RolesController::class, 'index'])->name('roles');
    // Route::get('roles/create', [RolesController::class, 'role_form'])->name('create.role.form');
    // Route::post('add-roles', [RolesController::class, 'add_roles'])->name('add.roles');
    // Route::get('roles/{id}/edit', [RolesController::class, 'edit_roles'])->name('edit.role');
    // Route::patch('roles/{id}/', [RolesController::class, 'update_roles'])->name('update.roles');
    // Route::get('delete-roles/{id}', [RolesController::class, 'delete_roles'])->name('delete.roles');

    Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions');
    Route::get('permissions/create', [PermissionsController::class, 'permissions_form'])->name('create.permissions.form');
    Route::post('add-permissions', [PermissionsController::class, 'add_permissions'])->name('add.permissions');
    Route::get('permissions/{id}/edit', [PermissionsController::class, 'edit_permissions'])->name('edit.permissions');
    Route::patch('permissions/{id}/', [PermissionsController::class, 'update_permissions'])->name('update.permissions');
    Route::get('delete-permissions/{id}', [PermissionsController::class, 'delete_permissions'])->name('delete.permissions');

    // Office Time Configs
    Route::prefix('/office-time')->controller(OfficeTimingConfigController::class)->group(function () {
        Route::get('/', 'index')->name('office_time_config.index');
        Route::post('/create', 'store')->name('office_time_config.store');
        Route::post('/update', 'update')->name('office_time_config.update');
        Route::get('/delete', 'destroy')->name('office_time_config.delete');
        Route::get('/status/update', 'statusUpdate')->name('office_time_config.statusUpdate');
        Route::get('/search/filter', 'searchOfficeTimeFilter');
    });
    // Office Shifts
    Route::prefix('/office-shifts')->controller(OfficeShiftController::class)->group(function () {
        Route::get('/', 'index')->name('shifts.index');
        Route::post('/create', 'store')->name('shift.store');
        Route::post('/update', 'update')->name('shift.update');
        Route::get('/delete', 'destroy')->name('shift.delete');
        Route::get('/status/update', 'statusUpdate')->name('shift.statusUpdate');
        Route::get('/search/filter', 'searchShiftFilter');
    });

    //Attendance Status Module
    Route::prefix('/attendance-status')->controller(AttendanceStatusController::class)->group(function () {
        Route::get('/', 'index')->name('attendance.status.index');
        Route::get('/add', 'applyLeave')->name('attendance.status.add');
        Route::post('/create', 'store')->name('attendance.status.store');
        Route::post('/update', 'update')->name('attendance.status.update');
        Route::get('/delete', 'destroy')->name('attendance.status.delete');
        Route::get('/status/update', 'statusUpdate')->name('attendance.status.statusUpdate');
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::post('/company_login', 'companyLogin')->name('company_login');
    Route::post('/logout', 'logout')->name('company.logout');
    Route::get('/signin', 'signin')->name('signin');
    Route::get('/signup', 'signup')->name('signup');
});

//Employee Module
Route::prefix('/employee')->controller(EmployeeController::class)->group(function () {
    Route::get('/index', 'index')->name('employee.index');
    Route::get('/add', 'add')->name('employee.add');
    Route::post('/store', 'store')->name('employee.store');
    Route::get('/edit/{user:id}', 'edit')->name('employee.edit');
    Route::get('/get/personal/details/{users:id}', 'getPersonalDetails')->name('employee.personal.details');
    Route::get('/view/{user:id}', 'view')->name('employee.view');
});

//Advance Details for employee
Route::controller(UserAdvanceDetailsController::class)->group(function () {
    Route::post('/employee/advance/details', 'store')->name('employee.advance.details');
    Route::get('/get/advance/details/{id}', 'getAdvanceDetails');
});

//Address Details for employee
Route::controller(UserAddressDetailsController::class)->group(function () {
    Route::post('/employee/addresss/details', 'store')->name('employee.address.details');
    Route::get('/get/address/details/{id}', 'getAddressDetails');
});

//Bank Details for employee
Route::controller(UserBankDetailsController::class)->group(function () {
    Route::post('/employee/bank/details', 'store')->name('employee.banks.details');
    Route::get('/get/bank/details/{id}', 'getBankDetails');
});

//Qualification Details for employee
Route::post('/employee/qualification/details', [UserQualificationDetailsController::class, 'store'])->name('employee.qualification.details');
Route::get('/employee/qualification/delete/{id}', [UserQualificationDetailsController::class, 'delete']);

//Past Work Details for employee
Route::post('/employee/past/work/details', [UserPastWorkDetailsController::class, 'store'])->name('employee.past.work.details');

//Family Details for employee
Route::post('/employee/family/details', [UserRelativeDetailsController::class, 'store'])->name('employee.family.details');

//Document Details for employee
Route::post('/employee/document/details', [UserDocumentDetailsController::class, 'store'])->name('employee.document.details');

//User / Permission Details for employee
Route::post('/employee/user/details', [UserDetailsController::class, 'store'])->name('employee.users.details');


/** ---------------Employee Panel Started--------------  */

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('employee');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
});
Route::controller(ForgetPasswordController::class)->group(function () {
    Route::get('/forget/password', 'index')->name('forget.password');
    Route::post('/submit/ForgetPassword/Form', 'submitForgetPasswordForm')->name('submitForgetPasswordForm');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
});

// Route::prefix('employee')->middleware(["auth", "employee"])->group(function () {
Route::prefix('employee')->group(function () {

    //Employee Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('employee.dashboard');

    //Daily Attendance
    Route::get('/daily/attendance', [DailyAttendanceController::class, 'index'])->name('employee.daily.attendance');

    //News Module
    Route::controller(NewsController::class)->group(function () {
        Route::get('/news', 'index')->name('employee.news');
        Route::get('/news/details', 'viewDetails')->name('employee.news.details');
    });

    //Policy Module
    Route::get('/policy', [PolicyController::class, 'index'])->name('employee.policy');

    //HR Service Module
    Route::get('/hr/service', [HRServiceController::class, 'index'])->name('employee.hr.service');

    //Support Module
    Route::get('/support', [SupportController::class, 'index'])->name('employee.support');

    //talk to us
    Route::get('/talk-to-us', [SupportController::class, 'talk_to_us'])->name('employee.talk');

    //Notification Module
    Route::get('/notification', [NotificationController::class, 'index'])->name('employee.notification');

    //Account Module
    Route::get('/account', [AccountController::class, 'index'])->name('employee.account');

    // Contact Module
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('employee.contact.us');

    // Attendance Service
    Route::get('/attendance/service', [AttendanceServiceController::class, 'index'])->name('employee.attendance.service');

    // Leave Management
    Route::controller(LeaveMangementController::class)->group(function () {
        Route::get('/leave', 'index')->name('employee.leave');
        Route::get('/apply/leave', 'applyLeave')->name('employee.apply.leave');
    });

    // Holidays Management
    Route::get('/holidays', [HolidaysMangementController::class, 'index'])->name('employee.holidays');

    // Payslips Management
    Route::get('/payslips', [PayslipsMangementController::class, 'index'])->name('employee.payslips');

    // Resignation Management
    Route::controller(ResignationController::class)->group(function () {
        Route::get('/resignation', 'index')->name('employee.resignation');
        Route::get('/apply/resignation', 'applyResignation')->name('employee.apply.resignation');
    });

    //Employee Attendance Management]
    Route::post('/employee/attendance', [EmployeeAttendanceController::class, 'makeAttendance'])->name('employee.attendance');
});

/** ----------------- Super Admin Started -------------------- **/
Route::prefix('/admin')->controller(SuperAdminController::class)->group(function () {
    Route::get('/login', 'login')->name('super_admin.login.form');
    Route::post('/super_admin_login', 'super_admin_login')->name('super.admin.login');
});

Route::prefix('/admin')->group(function () {
    Route::view('/dashboard', 'super_admin.dashboard')->name('super_admin.dashboard');

    Route::prefix('/department')->controller(AdminDepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.departments');
        Route::post('/create', 'store')->name('super_admin.department.store');
        Route::post('/update', 'update')->name('super_admin.department.update');
        Route::get('/delete', 'destroy')->name('super_admin.department.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.department.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.department.search');
    });

    Route::prefix('/designation')->controller(AdminDesignationsController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.designations');
        Route::post('/create', 'store')->name('super_admin.designation.store');
        Route::post('/update', 'update')->name('super_admin.designation.update');
        Route::get('/delete', 'destroy')->name('super_admin.designation.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.designation.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.designation.search');
    });

    Route::prefix('/state')->controller(AdminStateController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.state');
        Route::post('/create', 'store')->name('super_admin.state.store');
        Route::post('/update', 'update')->name('super_admin.state.update');
        Route::get('/delete', 'destroy')->name('super_admin.state.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.state.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.state.search');
        Route::get('/get/all/state', 'getAllStates')->name('super_admin.get.all.country.state');
    });

    Route::prefix('/country')->controller(AdminCountryController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.country');
        Route::post('/create', 'store')->name('super_admin.country.store');
        Route::post('/update', 'update')->name('super_admin.country.update');
        Route::get('/delete', 'destroy')->name('super_admin.country.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.country.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.country.search');
    });

    Route::prefix('/qualifications')->controller(QualificationController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.qualification');
        Route::post('/create', 'store')->name('super_admin.qualification.store');
        Route::post('/update', 'update')->name('super_admin.qualification.update');
        Route::get('/delete', 'destroy')->name('super_admin.qualification.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.qualification.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.qualification.search');
    });

    Route::prefix('/previous-company')->controller(PreviousCompanyController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.previous_company');
        Route::post('/create', 'store')->name('super_admin.previous_company.store');
        Route::post('/update', 'update')->name('super_admin.previous_company.update');
        Route::get('/delete', 'destroy')->name('super_admin.previous_company.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.previous_company.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.previous_company.search');
    });

    Route::prefix('/skills')->controller(SkillController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.skill');
        Route::post('/create', 'store')->name('super_admin.skill.store');
        Route::post('/update', 'update')->name('super_admin.skill.update');
        Route::get('/delete', 'destroy')->name('super_admin.skill.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.skill.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.skill.search');
    });

    Route::prefix('/document-type')->controller(DocumentTypeController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.document.type');
        Route::post('/create', 'store')->name('super_admin.document.type.store');
        Route::post('/update', 'update')->name('super_admin.document.type.update');
        Route::get('/delete', 'destroy')->name('super_admin.document.type.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.document.type.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.document.type.search');
    });

    Route::prefix('/employee-status')->controller(EmployeeStatusController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.employee_status');
        Route::post('/create', 'store')->name('super_admin.employee_status.store');
        Route::post('/update', 'update')->name('super_admin.employee_status.update');
        Route::get('/delete', 'destroy')->name('super_admin.employee_status.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.employee_status.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.document.employee_status.search');
    });

    Route::prefix('/employee-type')->controller(EmployeeTypeController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.employee_type');
        Route::post('/create', 'store')->name('super_admin.employee_type.store');
        Route::post('/update', 'update')->name('super_admin.employee_type.update');
        Route::get('/delete', 'destroy')->name('super_admin.employee_type.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.employee_type.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.employee_type.search');
    });

    // Route::prefix('/languages')->controller(AdminLanguagesController::class)->group(function () {
    //     Route::post('/create', 'store')->name('language.create');
    //     Route::get('/delete', 'destroy')->name('language.delete');
    // });

    Route::prefix('/languages')->controller(AdminLanguagesController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.languages');
        Route::post('/create', 'store')->name('super_admin.languages.store');
        Route::post('/update', 'update')->name('super_admin.languages.update');
        Route::get('/delete', 'destroy')->name('super_admin.languages.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.languages.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.languages.search');
    });

    Route::prefix('/company')->controller(AdminCompanyController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.company');
        Route::get('/add-company', 'add_company')->name('super_admin.add_company');
        Route::get('/edit-company', 'edit_company')->name('super_admin.edit_company');
        Route::post('/create-or-update', 'store')->name('super_admin.company.store');
        Route::get('/delete', 'destroy')->name('super_admin.company.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.company.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.company.search');
    });

    //Company Status Module
    Route::prefix('/company-status')->controller(CompanyStatusController::class)->group(function () {
        Route::get('/', 'index')->name('company.status.index');
        Route::post('/create', 'store')->name('company.status.store');
        Route::post('/update', 'update')->name('company.status.update');
        Route::get('/delete', 'destroy')->name('company.status.delete');
        Route::get('/status/update', 'statusUpdate')->name('company.status.statusUpdate');
    });

    //Company Size Module
    Route::prefix('/company-size')->controller(CompanySizeController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.company.size');
        Route::post('/create', 'store')->name('super_admin.company.size.store');
        Route::post('/update', 'update')->name('super_admin.company.size.update');
        Route::get('/delete', 'destroy')->name('super_admin.company.size.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.company.size.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.company.size.search');
    });

    Route::prefix('/company-status')->controller(CompanyStatusController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.company.status');
        Route::post('/create', 'store')->name('super_admin.company.status.store');
        Route::post('/update', 'update')->name('super_admin.company.status.update');
        Route::get('/delete', 'destroy')->name('super_admin.company.status.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.company.status.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.company.status.search');
    });

    Route::prefix('/company-branch')->controller(AdminCompanyBranchesController::class)->group(function () {
        Route::get('/', 'index')->name('super_admin.branch');
        Route::post('/create', 'store')->name('super_admin.company.branch.store');
        Route::post('/update', 'update')->name('super_admin.company.branch.update');
        Route::get('/delete', 'destroy')->name('super_admin.company.branch.delete');
        Route::get('/status/update', 'statusUpdate')->name('super_admin.company.branch.statusUpdate');
        Route::get('/search', 'search')->name('super_admin.company.branch.search');
    });
});


//Company Status Module
Route::prefix('/company-status')->controller(CompanyStatusController::class)->group(function () {
    Route::get('/', 'index')->name('company.status.index');
    Route::post('/create', 'store')->name('company.status.store');
    Route::post('/update', 'update')->name('company.status.update');
    Route::get('/delete', 'destroy')->name('company.status.delete');
    Route::get('/status/update', 'statusUpdate')->name('company.status.statusUpdate');
});

//Company Size Module
Route::prefix('/company-size')->controller(CompanySizeController::class)->group(function () {
    Route::get('/', 'index')->name('company.size.index');
    Route::post('/create', 'store')->name('company.size.store');
    Route::post('/update', 'update')->name('company.size.update');
    Route::get('/delete', 'destroy')->name('company.size.delete');
    Route::get('/status/update', 'statusUpdate')->name('company.size.statusUpdate');
});

//Skills Module
Route::prefix('/skills')->controller(SkillController::class)->group(function () {
    Route::get('/', 'index')->name('skills.index');
    Route::get('/create', 'store')->name('skills.store');
    Route::post('/update', 'update')->name('skills.update');
    Route::get('/delete', 'destroy')->name('skills.delete');
    Route::get('/status/update', 'statusUpdate')->name('skills.statusUpdate');

    // for ajax call 
    Route::get('/ajax_get_all', 'get_all_skills');
    Route::get('/ajax_store_skills', 'ajax_store_skills');
});

//Qualification Module
Route::prefix('/qualifications')->controller(QualificationController::class)->group(function () {
    Route::get('/', 'index')->name('qualification.index');
    Route::post('/create', 'store')->name('qualification.store');
    Route::post('/update', 'update')->name('qualification.update');
    Route::get('/delete', 'destroy')->name('qualification.delete');
    Route::get('/status/update', 'statusUpdate')->name('qualification.statusUpdate');

    // for ajax call 
    Route::get('/qualification_data', 'get_all_qualification_ajax_call');
    Route::get('/ajax_store_qualification', 'ajax_store_qualification');
});

//Employee Status Module
Route::prefix('/employee-status')->controller(EmployeeStatusController::class)->group(function () {
    Route::get('/', 'index')->name('employee.status.index');
    Route::post('/create', 'store')->name('employee.status.store');
    Route::post('/update', 'update')->name('employee.status.update');
    Route::get('/delete', 'destroy')->name('employee.status.delete');
    Route::get('/status/update', 'statusUpdate')->name('employee.status.statusUpdate');
});

//Employee Type Module
Route::prefix('/employee-type')->controller(EmployeeTypeController::class)->group(function () {
    Route::get('/', 'index')->name('employee.type.index');
    Route::post('/create', 'store')->name('employee.type.store');
    Route::post('/update', 'update')->name('employee.type.update');
    Route::get('/delete', 'destroy')->name('employee.type.delete');
    Route::get('/status/update', 'statusUpdate')->name('employee.type.statusUpdate');
});

//Document Type Module
Route::prefix('/document-type')->controller(DocumentTypeController::class)->group(function () {
    Route::get('/', 'index')->name('document.type.index');
    Route::post('/create', 'store')->name('document.type.store');
    Route::post('/update', 'update')->name('document.type.update');
    Route::get('/delete', 'destroy')->name('document.type.delete');
    Route::get('/status/update', 'statusUpdate')->name('document.type.statusUpdate');
});

//Leave Type Module
Route::prefix('/leave-type')->controller(LeaveTypeController::class)->group(function () {
    Route::get('/', 'index')->name('leave.type.index');
    Route::post('/create', 'store')->name('leave.type.store');
    Route::post('/update', 'update')->name('leave.type.update');
    Route::get('/delete', 'destroy')->name('leave.type.delete');
    Route::get('/status/update', 'statusUpdate')->name('leave.type.statusUpdate');
});

//Leave Status Module
Route::prefix('/leave-status')->controller(LeaveStatusController::class)->group(function () {
    Route::get('/', 'index')->name('leave.status.index');
    Route::post('/create', 'store')->name('leave.status.store');
    Route::post('/update', 'update')->name('leave.status.update');
    Route::get('/delete', 'destroy')->name('leave.status.delete');
    Route::get('/status/update', 'statusUpdate')->name('leave.status.statusUpdate');
});

//Asset Manufacturer Module
Route::prefix('/asset-manufacturer')->controller(AssetManufacturerController::class)->group(function () {
    Route::get('/', 'index')->name('asset.manufacturer.index');
    Route::post('/create', 'store')->name('asset.manufacturer.store');
    Route::post('/update', 'update')->name('asset.manufacturer.update');
    Route::get('/delete', 'destroy')->name('asset.manufacturer.delete');
    Route::get('/status/update', 'statusUpdate')->name('asset.manufacturer.statusUpdate');
    Route::get('/search/filter', 'serachAssetManufacturerFilterList');
});

//Asset Status Module
Route::prefix('/asset-status')->controller(AssetStatusController::class)->group(function () {
    Route::get('/', 'index')->name('asset.status.index');
    Route::post('/create', 'store')->name('asset.status.store');
    Route::post('/update', 'update')->name('asset.status.update');
    Route::get('/delete', 'destroy')->name('asset.status.delete');
    Route::get('/status/update', 'statusUpdate')->name('asset.status.statusUpdate');
    Route::get('/search/filter', 'serachAssetStatusFilterList');
});

//Asset Category Module
Route::prefix('/asset-category')->controller(AssetCategoryController::class)->group(function () {
    Route::get('/', 'index')->name('asset.category.index');
    Route::post('/create', 'store')->name('asset.category.store');
    Route::post('/update', 'update')->name('asset.category.update');
    Route::get('/delete', 'destroy')->name('asset.category.delete');
    Route::get('/status/update', 'statusUpdate')->name('asset.category.statusUpdate');
    Route::get('/search/filter', 'serachAssetCategoryFilterList');
});

//Asset Module
Route::prefix('/asset')->controller(AssetController::class)->group(function () {
    Route::get('/', 'index')->name('asset.index');
    Route::get('/add', 'add')->name('asset.add');
    Route::post('/store', 'store')->name('asset.store');
    Route::get('/edit/{assets:id}', 'edit')->name('asset.edit');
    Route::post('/update/{id}', 'update')->name('asset.update');
    Route::get('/delete', 'destroy')->name('asset.delete');
    Route::get('/search/filter', 'serachAssetFilterList');
});
