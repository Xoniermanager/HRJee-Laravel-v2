<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Company\NewsController;
use App\Http\Controllers\Company\LeaveController;
use App\Http\Controllers\Company\RolesController;
use App\Http\Controllers\Company\StateController;
use App\Http\Controllers\Company\PolicyController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CountryController;
use App\Http\Controllers\Company\HolidayController;
use App\Http\Controllers\Company\WeekendController;
use App\Http\Controllers\Company\EmployeeController;
use App\Http\Controllers\Admin\AssetStatusController;
use App\Http\Controllers\Admin\CompanySizeController;
use App\Http\Controllers\Admin\LeaveStatusController;
use App\Http\Controllers\Company\BreakTypeController;
use App\Http\Controllers\Company\LanguagesController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Company\AttendanceController;
use App\Http\Controllers\Company\DepartmentController;
use App\Http\Controllers\Admin\AssetCategoryController;
use App\Http\Controllers\Admin\CompanyStatusController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\Company\OfficeShiftController;
use App\Http\Controllers\Company\PermissionsController;
use App\Http\Controllers\Company\SpreadsheetController;
use App\Http\Controllers\Admin\EmployeeStatusController;
use App\Http\Controllers\Company\AnnouncementController;
use App\Http\Controllers\Company\DesignationsController;
use App\Http\Controllers\Company\NewsCategoryController;
use App\Http\Controllers\Company\ComplainStatusController;
use App\Http\Controllers\Company\LeaveStatusLogController;
use App\Http\Controllers\Company\PolicyCategoryController;
use App\Http\Controllers\Admin\AssetManufacturerController;
use App\Http\Controllers\Company\CompanyBranchesController;
use App\Http\Controllers\Company\PreviousCompanyController;
use App\Http\Controllers\Company\UserBankDetailsController;
use App\Http\Controllers\Company\AssignPermissionController;
use App\Http\Controllers\Company\AttendanceStatusController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\Company\ComplainCategoryController;
use App\Http\Controllers\Company\UserAssetDetailsController;
use App\Http\Controllers\Company\ResignationStatusController;
use App\Http\Controllers\Company\OfficeTimingConfigController;
use App\Http\Controllers\Company\UserAddressDetailsController;
use App\Http\Controllers\Company\UserAdvanceDetailsController;
use App\Http\Controllers\Company\UserDocumentDetailsController;
use App\Http\Controllers\Company\UserPastWorkDetailsController;
use App\Http\Controllers\Company\UserRelativeDetailsController;
use App\Http\Controllers\Company\LeaveCreditManagementController;
use App\Http\Controllers\Company\EmployeeLeaveAvailableController;
use App\Http\Controllers\Export\EmployeeAttendanceExportController;
use App\Http\Controllers\Company\UserQualificationDetailsController;


//Common Route Used in Employee and Company Panel
Route::get('/company/state/get/all/state', [StateController::class, 'getAllStates'])->name('get.all.country.state');

Route::prefix('company')->middleware(['check.company.status', 'Check2FA', 'checkUrlAcess'])->group(function () {
    Route::controller(CompanyController::class)->group(function () {
        Route::get('company/profile', 'company_profile')->name('company.profile');
        Route::post('company/update/{id}', 'update_company')->name('update.company');
        Route::post('company/change/password', 'company_change_password')->name('company.change.password');
    });
    Route::controller(CompanyDashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('company.dashboard');
        Route::get('/employee-search-filter', 'searchFilterEmployee')->name('company.employee_search.filter');
    });

    Route::controller(CompanyBranchesController::class)->group(function () {
        Route::get('branch', 'index')->name('branch');
        Route::post('create', 'store')->name('company.branch.store');
        Route::post('/update', 'update')->name('company.branch.update');
        Route::get('/delete/{id?}', 'destroy')->name('company.branch.delete');
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
        Route::get('/get-designation-by-departments', 'getAllDesignation')->name('get.all.designation');
        Route::get('/search/filter', 'serachDesignationFilterList');
    });

    //Announcement Module
    Route::prefix('/announcement')->controller(AnnouncementController::class)->group(function () {
        Route::get('/', 'index')->name('announcement.index');
        Route::get('/add', 'add')->name('announcement.add');
        Route::post('/create', 'store')->name('announcement.store');
        Route::get('/edit/{announcements:id}', 'edit')->name('announcement.edit');
        Route::get('/view/{announcements:id}', 'view')->name('announcement.view');
        Route::post('/update/{id}', 'update')->name('announcement.update');
        Route::get('/delete/{id}', 'destroy')->name('announcement.delete');
        Route::get('/status/update', 'statusUpdate')->name('announcement.statusUpdate');
        Route::get('/search/filter', 'serachAnnouncementFilterList');
        Route::get('get-all-user', 'getAllUserByBranchIds');
        Route::post('/assign', 'updateAssignAnnounce')->name('assign.announcement');
    });

    //Resignation Status Module
    Route::prefix('/resignation/status')->name('resignation.')->controller(ResignationStatusController::class)->group(function () {
        Route::get('/', 'index')->name('status.index');
        Route::post('/create', 'store')->name('status.store');
        Route::post('/update', 'update')->name('status.update');
        Route::get('/delete/{id?}', 'destroy')->name('status.delete');
        Route::get('/status/update', 'statusUpdate')->name('status.statusUpdate');
        Route::get('/search', 'searchResignationStatusFilter')->name('status.search');
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
        Route::get('/', 'index')->name('employee.index');
        Route::get('/add', 'add')->name('employee.add');
        Route::post('/store', 'store')->name('employee.store');
        Route::get('/edit/{user:id}', 'edit')->name('employee.edit');
        Route::get('/get/filter/list', 'getfilterlist');
        Route::get('/get/personal/details/{users:id}', 'getPersonalDetails')->name('employee.personal.details');
        Route::get('/view/{user:id}', 'view')->name('employee.view');
    });

    Route::controller(SpreadsheetController::class)->group(function () {
        Route::post('/export/employee', 'exportEmployee')->name('export.employee');
        Route::post('/export/employee/bank/details', 'exportEmployeeBankDetails')->name('export.employee.bank.details');
        Route::post('/export/employee/address/details', 'exportEmployeeAddressDetails')->name('export.employee.address.details');
    });
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
    Route::prefix('/employee/qualification')->controller(UserQualificationDetailsController::class)->group(function () {
        Route::post('/details', 'store')->name('employee.qualification.details');
        Route::get('/delete/{id}', 'delete');
    });


    //Past Work Details for employee
    Route::prefix('/employee/past/work/')->controller(UserPastWorkDetailsController::class)->group(function () {
        Route::post('/details', 'store')->name('employee.past.work.details');
        Route::get('/delete/{id}', 'delete');
    });

    //Family Details for employee
    Route::prefix('/employee/family/')->controller(UserRelativeDetailsController::class)->group(function () {
        Route::post('/details', 'store')->name('employee.family.details');
        Route::get('/delete/{id}', 'delete');
    });

    //Document Details for employee
    Route::post('/employee/document/details', [UserDocumentDetailsController::class, 'store'])->name('employee.document.details');

    // //User / Permission Details for employee
    // Route::post('/employee/user/details', [UserDetailsController::class, 'store'])->name('employee.users.details');


    //Asset Details for user
    Route::prefix('/employee/assets/')->controller(UserAssetDetailsController::class)->group(function () {
        Route::post('/details/store', 'store')->name('employee.asset.details');
        Route::post('/details/update', 'updateDetails')->name('employee.asset.details.update');
        Route::post('/export/employee/asset/details', 'exportEmployeeAssetDetails')->name('export.employee.asset.details');
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

    Route::prefix('/roles')->group(function () {
        //Roles and Permission Module
        Route::controller(RolesController::class)->group(function () {
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

        //permission
        Route::prefix('/assign_permissions')->controller(AssignPermissionController::class)->group(function () {
            Route::get('/', 'index')->name('assign_permission');
            Route::get('/add', 'add')->name('add_assign_permission');
            Route::post('/create', 'store')->name('assign_permission.store');
            Route::get('/assigned-permission', 'getAssignedPermissions')->name('assign_permission.assigned');
            Route::get('/delete', 'destroy')->name('assign_permissions.delete');
        });

        Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions');
        Route::get('permissions/create', [PermissionsController::class, 'permissions_form'])->name('create.permissions.form');
        Route::post('add-permissions', [PermissionsController::class, 'add_permissions'])->name('add.permissions');
        Route::get('permissions/{id}/edit', [PermissionsController::class, 'edit_permissions'])->name('edit.permissions');
        Route::patch('permissions/{id}/', [PermissionsController::class, 'update_permissions'])->name('update.permissions');
        Route::get('delete-permissions/{id}', [PermissionsController::class, 'delete_permissions'])->name('delete.permissions');
    });

    // Office Shifts
    Route::prefix('/shifts')->group(function () {
        // Office Time Configs
        Route::prefix('/office-time')->controller(OfficeTimingConfigController::class)->group(function () {
            Route::get('/', 'index')->name('office_time_config.index');
            Route::post('/create', 'store')->name('office_time_config.store');
            Route::post('/update', 'update')->name('office_time_config.update');
            Route::get('/delete', 'destroy')->name('office_time_config.delete');
            Route::get('/status/update', 'statusUpdate')->name('office_time_config.statusUpdate');
            Route::get('/search/filter', 'searchOfficeTimeFilter');
        });

        Route::prefix('/office-shifts')->controller(OfficeShiftController::class)->group(function () {
            Route::get('/', 'index')->name('shifts.index');
            Route::post('/create', 'store')->name('shift.store');
            Route::post('/update', 'update')->name('shift.update');
            Route::get('/delete', 'destroy')->name('shift.delete');
            Route::get('/status/update', 'statusUpdate')->name('shift.statusUpdate');
            Route::get('/search/filter', 'searchShiftFilter');
        });
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

    Route::prefix('/asset')->group(function () {
        //Asset Module
        Route::controller(AssetController::class)->group(function () {
            Route::get('/', 'index')->name('asset.index');
            Route::get('/add', 'add')->name('asset.add');
            Route::post('/store', 'store')->name('asset.store');
            Route::get('/edit/{assets:id}', 'edit')->name('asset.edit');
            Route::post('/update/{id}', 'update')->name('asset.update');
            Route::get('/delete', 'destroy')->name('asset.delete');
            Route::get('/search/filter', 'serachAssetFilterList');
            Route::get('/get/all/asset/{id}', 'getAllAssetByCategory');
            Route::get('/dashboard', 'getDashboard')->name('asset.dashboard');
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
    });

    Route::prefix('/news')->group(function () {
        //News Module
        Route::controller(NewsController::class)->group(function () {
            Route::get('/', 'index')->name('news.index');
            Route::get('/add', 'add')->name('news.add');
            Route::post('/create', 'store')->name('news.store');
            Route::get('/edit/{news:id}', 'edit')->name('news.edit');
            Route::get('/view/{news:id}', 'view')->name('news.view');
            Route::post('/update/{id}', 'update')->name('news.update');
            Route::get('/delete/{id}', 'destroy')->name('news.delete');
            Route::get('/status/update', 'statusUpdate')->name('news.statusUpdate');
            Route::get('/search/filter', 'serachNewsFilterList');
        });
        //News Category Module
        Route::prefix('/news-category')->controller(NewsCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('news.category.index');
            Route::post('/create', 'store')->name('news.category.store');
            Route::post('/update', 'update')->name('news.category.update');
            Route::get('/delete', 'destroy')->name('news.category.delete');
            Route::get('/status/update', 'statusUpdate')->name('news.category.statusUpdate');
            Route::get('/search/filter', 'serachNewsCategoryFilterList');
        });
    });


    //leave Credit Module
    Route::prefix('/leave-credit-management')->controller(LeaveCreditManagementController::class)->group(function () {
        Route::get('/', 'index')->name('leave.credit.index');
        Route::post('/create', 'store')->name('leave.credit.store');
        Route::post('/update', 'update')->name('leave.credit.update');
        Route::get('/delete', 'destroy')->name('leave.credit.delete');
        Route::get('/status/update', 'statusUpdate')->name('leave.credit.statusUpdate');
        Route::get('/search/filter', 'serachLeaveCreditFilterList');
    });

    //Employee Leave Available
    Route::get('get/allemployee/leave/available', [EmployeeLeaveAvailableController::class, 'getAllEmployeeLeaveAvailableList'])->name('getAllEmployeeLeaveAvailableList');
    Route::get('skill_data', [SkillController::class, 'skill_data'])->name('skill_data');

    Route::prefix('/policy')->group(function () {
        //Policy Module
        Route::controller(PolicyController::class)->group(function () {
            Route::get('/', 'index')->name('policy.index');
            Route::get('/add', 'add')->name('policy.add');
            Route::post('/create', 'store')->name('policy.store');
            Route::get('/edit/{policies:id}', 'edit')->name('policy.edit');
            Route::get('/view/{policies:id}', 'view')->name('policy.view');
            Route::post('/update/{id}', 'update')->name('policy.update');
            Route::get('/delete/{id}', 'destroy')->name('policy.delete');
            Route::get('/status/update', 'statusUpdate')->name('policy.statusUpdate');
            Route::get('/search/filter', 'serachPolicyFilterList');
        });
        //Policy Category Module
        Route::prefix('/policy-category')->controller(PolicyCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('policy.category.index');
            Route::post('/create', 'store')->name('policy.category.store');
            Route::post('/update', 'update')->name('policy.category.update');
            Route::get('/delete', 'destroy')->name('policy.category.delete');
            Route::get('/status/update', 'statusUpdate')->name('policy.category.statusUpdate');
            Route::get('/search/filter', 'serachPolicyCategoryFilterList');
        });
    });

    //Break Types Module
    Route::prefix('/break-type')->controller(BreakTypeController::class)->group(function () {
        Route::get('/', 'index')->name('break_type.index');
        Route::post('/create', 'store')->name('break_type.store');
        Route::post('/update', 'update')->name('break_type.update');
        Route::get('/delete/{id}', 'destroy')->name('break_type.delete');
        Route::get('/status/update', 'statusUpdate')->name('break_type.statusUpdate');
        Route::get('/search/filter', 'serachBreakTypeFilterList');
    });

    //Complain Status Module
    Route::prefix('/complain-status')->controller(ComplainStatusController::class)->group(function () {
        Route::get('/', 'index')->name('complain.status.index');
        Route::post('/create', 'store')->name('complain.status.store');
        Route::post('/update', 'update')->name('complain.status.update');
        Route::get('/delete/{id}', 'destroy')->name('complain.status.delete');
        Route::get('/status/update', 'statusUpdate')->name('complain.status.statusUpdate');
        Route::get('/search/filter', 'serachComplainStatusFilterList');
    });

    //Complain Category Module
    Route::prefix('/complain-category')->controller(ComplainCategoryController::class)->group(function () {
        Route::get('/', 'index')->name('complain.category.index');
        Route::post('/create', 'store')->name('complain.category.store');
        Route::post('/update', 'update')->name('complain.category.update');
        Route::get('/delete/{id}', 'destroy')->name('complain.category.delete');
        Route::get('/status/update', 'statusUpdate')->name('complain.category.statusUpdate');
        Route::get('/search/filter', 'serachComplainCategoryFilterList');
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

    Route::prefix('/attendance')->group(function () {
        //Employee Attendance Module
        Route::controller(AttendanceController::class)->group(function () {
            Route::get('/', 'index')->name('attendance.index');
            Route::get('/search/filter', 'searchFilter');
            Route::get('/view/{empId}', 'viewAttendanceDetails')->name('attendance.view.details');
            Route::get('/view/search/filter/{empId}', 'searchFilterByEmployeeId');
            Route::post('/edit', 'editAttendanceByEmployeeId');
            Route::get('/add/bulk/attendance', 'addBulkAttendance')->name('attendance.add.bulk');
            Route::post('/store/bulk/attendance', 'storeBulkAttendance')->name('store.bulk.attendance');
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
    //Weekend Module
    Route::prefix('/weekend')->controller(WeekendController::class)->group(function () {
        Route::get('/', 'index')->name('weekend.index');
        Route::post('/create', 'store')->name('weekend.store');
        Route::get('/delete', 'destroy')->name('weekend.delete');
        Route::get('/status/update', 'statusUpdate')->name('weekend.statusUpdate');
        Route::get('/get/weekend/details/companyId', 'getWeekEndDetailByCompanyId')->name('weekend.details.companybranchId');
    });
});
Route::prefix('/export')->controller(EmployeeAttendanceExportController::class)->group(function () {
    Route::get('/employee/attendance', 'employeeAttendanceExport')->name('export.employee.attendance');
});
/**---------------End Company Panel Route----------------*/
