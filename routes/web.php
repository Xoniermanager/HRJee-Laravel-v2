<?php

use App\Http\Controllers\Company\OfficeShiftController;
use App\Http\Controllers\Company\UserAddressDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Company\AdminController;
use App\Http\Controllers\Company\RolesController;
use App\Http\Controllers\Company\StateController;
use App\Http\Controllers\Employee\AuthController;
use App\Http\Controllers\Employee\NewsController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CountryController;
use App\Http\Controllers\Employee\PolicyController;
use App\Http\Controllers\Company\EmployeeController;
use App\Http\Controllers\Employee\AccountController;
use App\Http\Controllers\Employee\SupportController;
use App\Http\Controllers\Admin\CompanySizeController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Company\DepartmentController;
use App\Http\Controllers\Employee\ContactUsController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\HRServiceController;
use App\Http\Controllers\Company\OfficeTimingConfigController;
use App\Http\Controllers\Admin\CompanyStatusController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\Company\PermissionsController;
use App\Http\Controllers\Admin\EmployeeStatusController;
use App\Http\Controllers\Company\DesignationsController;
use App\Http\Controllers\Company\UserAdvanceDetailsController;
use App\Http\Controllers\Company\UserBankDetailsController;
use App\Http\Controllers\Company\UserDocumentDetailsController;
use App\Http\Controllers\Company\UserPastWorkDetailsController;
use App\Http\Controllers\Company\UserQualificationDetailsController;
use App\Http\Controllers\Company\UserRelativeDetailsController;
use App\Http\Controllers\Employee\ResignationController;
use App\Http\Controllers\Employee\NotificationController;
use App\Http\Controllers\Company\CompanyBranchesController;
use App\Http\Controllers\Company\PreviousCompanyController;
use App\Http\Controllers\Employee\ForgetPasswordController;
use App\Http\Controllers\Employee\LeaveMangementController;
use App\Http\Controllers\Employee\DailyAttendanceController;
use App\Http\Controllers\Employee\AttendanceServiceController;
use App\Http\Controllers\Employee\HolidaysMangementController;
use App\Http\Controllers\Employee\PayslipsMangementController;

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


Route::get('demo', [SkillController::class, 'demo'])->name('demo');
Route::get('skill_data', [SkillController::class, 'skill_data'])->name('skill_data');

Route::middleware(['dashboard.access'])->group(function () {
    Route::view('/dashboard', 'company.dashboard.dashboard')->name('company.dashboard');

    Route::get('company/profile', [CompanyController::class, 'company_profile'])->name('company.profile');
    Route::patch('company/update/{id}/', [CompanyController::class, 'update_company'])->name('update.company');
    Route::post('company/change/password', [CompanyController::class, 'company_change_password'])->name('company.change.password');

    Route::get('branch', [CompanyBranchesController::class, 'index'])->name('branch');
    Route::get('branch/create', [CompanyBranchesController::class, 'branch_form'])->name('create.branch.form');
    Route::post('add-branch', [CompanyBranchesController::class, 'add_branch'])->name('add.branch');

    Route::get('branch/{id}/edit', [CompanyBranchesController::class, 'edit_branch'])->name('edit.branch');
    Route::post('branch/{id}/', [CompanyBranchesController::class, 'update_branch'])->name('update.branch');
    Route::get('delete-branch/{id}', [CompanyBranchesController::class, 'delete_branch'])->name('delete.branch');

    //Department Module
    Route::prefix('/department')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('department.index');
        Route::post('/create', 'store')->name('department.store');
        Route::post('/update', 'update')->name('department.update');
        Route::get('/delete', 'destroy')->name('department.delete');
        Route::get('/status/update', 'statusUpdate')->name('department.statusUpdate');
    });

    //Designation Module
    Route::prefix('/designation')->controller(DesignationsController::class)->group(function () {
        Route::get('/', 'index')->name('designation.index');
        Route::post('/create', 'store')->name('designation.store');
        Route::post('/update', 'update')->name('designation.update');
        Route::get('/delete', 'destroy')->name('designation.delete');
        Route::get('/status/update', 'statusUpdate')->name('designation.statusUpdate');
        Route::get('/get/all/designation', 'getAllDesignation')->name('get.all.designation');
    });

    //Country Module
    Route::prefix('/country')->controller(CountryController::class)->group(function () {
        Route::get('/', 'index')->name('country.index');
        Route::post('/create', 'store')->name('country.store');
        Route::post('/update', 'update')->name('country.update');
        Route::get('/delete', 'destroy')->name('country.delete');
        Route::get('/status/update', 'statusUpdate')->name('country.statusUpdate');
    });

    //State Module
    Route::prefix('/state')->controller(StateController::class)->group(function () {
        Route::get('/', 'index')->name('state.index');
        Route::post('/create', 'store')->name('state.store');
        Route::post('/update', 'update')->name('state.update');
        Route::get('/delete', 'destroy')->name('state.delete');
        Route::get('/status/update', 'statusUpdate')->name('state.statusUpdate');
        Route::get('/get/all/state', 'getAllStates')->name('get.all.country.state');
    });

    //Previous Company Module
    Route::prefix('/previous-company')->controller(PreviousCompanyController::class)->group(function () {
        Route::get('/', 'index')->name('previous.company.index');
        Route::post('/create', 'store')->name('previous.company.store');
        Route::post('/update', 'update')->name('previous.company.update');
        Route::get('/delete', 'destroy')->name('previous.company.delete');
        Route::get('/status/update', 'statusUpdate')->name('previous.company.statusUpdate');

        // for ajax call 
        Route::get('/previous_company_data', 'get_all_previous_company_ajax_call');
        Route::get('/ajax_store_previous_company', 'ajax_store_previous_company');
    
    });

    

    // Route::get('employee/index', [EmployeeController::class, 'index'])->name('employee.index');
    // Route::get('employee/{id}/view', [EmployeeController::class, 'view_employee'])->name('view.employee');
    // Route::get('employee/create', [EmployeeController::class, 'add_employee'])->name('create.employee');
    // Route::post('add-employee', [EmployeeController::class, 'add_employee'])->name('add.employee');
    // Route::get('employee/{id}/edit', [EmployeeController::class, 'edit_employee'])->name('edit.employee');
    // Route::patch('employee/{id}/', [EmployeeController::class, 'update_employee'])->name('update.employee');
    // Route::get('delete-employee/{id}', [EmployeeController::class, 'delete_employee'])->name('delete.employee');

    Route::get('roles', [RolesController::class, 'index'])->name('roles');
    Route::get('roles/create', [RolesController::class, 'role_form'])->name('create.role.form');
    Route::post('add-roles', [RolesController::class, 'add_roles'])->name('add.roles');
    Route::get('roles/{id}/edit', [RolesController::class, 'edit_roles'])->name('edit.role');
    Route::patch('roles/{id}/', [RolesController::class, 'update_roles'])->name('update.roles');
    Route::get('delete-roles/{id}', [RolesController::class, 'delete_roles'])->name('delete.roles');

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
    });
    
    // Office Shifts
    Route::prefix('/office-shifts')->controller(OfficeShiftController::class)->group(function () {
        Route::get('/', 'index')->name('shifts.index');
            Route::post('/create', 'store')->name('shift.store');
            Route::post('/update', 'update')->name('shift.update');
            Route::get('/delete', 'destroy')->name('shift.delete');
            Route::get('/status/update', 'statusUpdate')->name('shift.statusUpdate');
    });
});

Route::post('/company_login', [AdminController::class, 'companyLogin'])->name('company_login');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::get('/signin', [AdminController::class, 'signin'])->name('signin');
Route::get('/signup', [AdminController::class, 'signup'])->name('signup');

//Employee Module
Route::prefix('/employee')->controller(EmployeeController::class)->group(function () {
    Route::get('/index', 'index')->name('employee.index');
    Route::get('/add', 'add')->name('employee.add');
    Route::post('/store', 'store')->name('employee.store');
    Route::get('/edit/{user:id}', 'edit')->name('employee.edit');
    // Route::post('/update', 'update')->name('previous.company.update');
    // Route::get('/delete', 'destroy')->name('previous.company.delete');
    // Route::get('/status/update', 'statusUpdate')->name('previous.company.statusUpdate');
});

//Advance Details for employee
Route::post('/employee/advance/details', [UserAdvanceDetailsController::class, 'store'])->name('employee.advance.details');

//Address Details for employee
Route::post('/employee/addresss/details', [UserAddressDetailsController::class, 'store'])->name('employee.address.details');

//Bank Details for employee
Route::post('/employee/bank/details', [UserBankDetailsController::class, 'store'])->name('employee.banks.details');

//Qualification Details for employee
Route::post('/employee/qualification/details', [UserQualificationDetailsController::class, 'store'])->name('employee.qualification.details');

//Past Work Details for employee
Route::post('/employee/past/work/details', [UserPastWorkDetailsController::class, 'store'])->name('employee.past.work.details');

//Family Details for employee
Route::post('/employee/family/details', [UserRelativeDetailsController::class, 'store'])->name('employee.family.details');

//Document Details for employee
Route::post('/employee/document/details', [UserDocumentDetailsController::class, 'store'])->name('employee.document.details');


/** ---------------Employee Pannel Started--------------  */

//Login Process
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

    //Contact Module
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('employee.contact.us');

    //Attendance Service
    Route::get('/attendance/service', [AttendanceServiceController::class, 'index'])->name('employee.attendance.service');

    //Leave Management
    Route::controller(LeaveMangementController::class)->group(function () {
        Route::get('/leave', 'index')->name('employee.leave');
        Route::get('/apply/leave', 'applyLeave')->name('employee.apply.leave');
    });

    //Holidays Management
    Route::get('/holidays', [HolidaysMangementController::class, 'index'])->name('employee.holidays');

    //Payslips Management
    Route::get('/payslips', [PayslipsMangementController::class, 'index'])->name('employee.payslips');

    //Resignation Management
    Route::controller(ResignationController::class)->group(function () {
        Route::get('/resignation', 'index')->name('employee.resignation');
        Route::get('/apply/resignation', 'applyResignation')->name('employee.apply.resignation');
    });
});


/** -----------------Super Admin Started--------------------*/

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
