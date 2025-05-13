<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Company\NewsController;
use App\Http\Controllers\Company\LeaveController;
use App\Http\Controllers\Company\RolesController;
use App\Http\Controllers\Company\StateController;
use App\Http\Controllers\Company\CourseController;
use App\Http\Controllers\Company\PolicyController;
use App\Http\Controllers\Company\SalaryController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CompOffController;
use App\Http\Controllers\Company\CountryController;
use App\Http\Controllers\Company\HolidayController;
use App\Http\Controllers\Company\WeekendController;
use App\Http\Controllers\Company\EmployeeController;
use App\Http\Controllers\Admin\AssetStatusController;
use App\Http\Controllers\Admin\CompanySizeController;
use App\Http\Controllers\Admin\LeaveStatusController;
use App\Http\Controllers\Admin\LogActivityController;
use App\Http\Controllers\Company\BreakTypeController;
use App\Http\Controllers\Company\HierarchyController;
use App\Http\Controllers\Company\LanguagesController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Company\AttendanceController;
use App\Http\Controllers\Company\DepartmentController;
use App\Http\Controllers\Company\PRMRequestController;
use App\Http\Controllers\Company\UserRewardController;
use App\Http\Controllers\Admin\AssetCategoryController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\Company\OfficeShiftController;
use App\Http\Controllers\Company\PermissionsController;
use App\Http\Controllers\Company\PRMCategoryController;
use App\Http\Controllers\Company\TaxSlabRuleController;
use App\Http\Controllers\Admin\EmployeeStatusController;
use App\Http\Controllers\Company\AnnouncementController;
use App\Http\Controllers\Company\DesignationsController;
use App\Http\Controllers\Company\NewsCategoryController;
use App\Http\Controllers\Employee\ResignationController;
use App\Http\Controllers\Company\LocationVisitController;
use App\Http\Controllers\Company\AddressRequestController;
use App\Http\Controllers\Company\ComplainStatusController;
use App\Http\Controllers\Company\EmployeeSalaryController;
use App\Http\Controllers\Company\LeaveStatusLogController;
use App\Http\Controllers\Company\PolicyCategoryController;
use App\Http\Controllers\Company\RewardCategoryController;
use App\Http\Controllers\Company\UserCtcDetailsController;
use App\Http\Controllers\Admin\AssetManufacturerController;
use App\Http\Controllers\Company\CompanyBranchesController;
use App\Http\Controllers\Company\DispositionCodeController;
use App\Http\Controllers\Company\FaceRecognitionController;
use App\Http\Controllers\Company\PreviousCompanyController;
use App\Http\Controllers\Company\SalaryComponentController;
use App\Http\Controllers\Company\UserBankDetailsController;
use App\Http\Controllers\Company\AssignPermissionController;
use App\Http\Controllers\Company\AttendanceStatusController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\Company\ComplainCategoryController;
use App\Http\Controllers\Company\LocationTrackingController;
use App\Http\Controllers\Company\UserAssetDetailsController;
use App\Http\Controllers\Company\AttendanceRequestController;
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

// Route::get('/test',function()
// {
//     return \App\Jobs\EmployeeExportFileJob::dispatch('arjun@xoniertechnologies.com');
// });
//Common Route Used in Employee and Company Panel
Route::get('/company/state/get/all/state', [StateController::class, 'getAllStates'])->name('get.all.country.state');

Route::prefix('company')->middleware(['checkAccountStatus', 'Check2FA', 'checkUrlAcess','log.route', 'auth.company'])->group(function ()
{
    Route::controller(CompanyController::class)->group(function () {
        Route::get('profile', 'company_profile')->name('company.profile');
        Route::get('configuration', 'companyConfiguartion')->name('company.configuration');
        Route::post('profile/update', 'update_company')->name('company.profile.update');
        Route::post('change/password', 'company_change_password')->name('company.change.password');
        Route::post('configuration/update', 'updateCompanyConfiguration')->name('company.configuration.update');
    });
    Route::controller(CompanyDashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('company.dashboard');
        Route::get('/employee-search-filter', 'filterEmployees')->name('company.employee_search.filter');
    });

    Route::controller(CompanyBranchesController::class)->group(function () {
        Route::get('branch', 'index')->name('branch');
        Route::post('create', 'store')->name('company.branch.store');
        Route::post('/update', 'update')->name('company.branch.update');
        Route::get('/delete/{id?}', 'destroy')->name('company.branch.delete');
        Route::get('/status/update', 'statusUpdate')->name('company.branch.statusUpdate');
        Route::get('/get-managers-by-branch', 'getAllManagers')->name('get.all.managers');
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

    // Resignation Management
    Route::prefix('resignation')->name('resignation.')->controller(ResignationController::class)->group(function () {
        Route::get('/', 'index')->name('rindex');
        Route::get('/{id}', 'view')->name('rview');
        Route::post('/{id}/status', 'changeStatus')->name('rchange-status');
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

    //Face Recognition Module
    Route::prefix('/face-recognitions')->controller(FaceRecognitionController::class)->group(function () {
        Route::get('/', 'index')->name('face-recognition.index');
        Route::get('/delete', 'delete')->name('face-recognition.delete');
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
        Route::get('/delete/{user:id}', 'deleteEmployee')->name('employee.delete');
        Route::get('/status/update/{user:id}', 'statusUpdate')->name('employee.status_update');
        Route::get('/exit/list', 'exitEmployeeList')->name('employee.exit.employeelist');
        Route::get('/exit/filter/search', 'searchFilterForExitEmployee')->name('remployee.exit.employeelist');
        Route::get('/export', 'exportEmployee')->name('employee.export');
        Route::post('/export-file', 'uploadImport')->name('upload.file');
        Route::post('/download-attendance', 'downloadA')->name('upload.file');
        Route::post('/punchIn/radius','updatePunchInRadius')->name('update.punhin.radius');
        Route::get('/get-manager-by-departments', 'getAllManager')->name('get.all.manager');

    });

    Route::controller(UserAdvanceDetailsController::class)->group(function () {
        Route::post('/employee/advance/details', 'store')->name('employee.advance.details');
        Route::get('/get/advance/details/{id}', 'getAdvanceDetails');
    });

    Route::controller(UserCtcDetailsController::class)->group(function () {
        Route::post('/employee/ctc/details', 'store')->name('employee.ctc.details');
        Route::get('/salary/component/details', 'getComponentsDetail');
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
    });

    //Holiday Module
    Route::prefix('/holiday')->controller(HolidayController::class)->group(function () {
        Route::get('/', 'index')->name('holiday.index');
        Route::post('/create', 'store')->name('holiday.store');
        Route::post('/update', 'update')->name('holiday.update');
        Route::get('/delete', 'destroy')->name('holiday.delete');
        Route::get('/status/update', 'statusUpdate')->name('holiday.statusUpdate');
        Route::get('/search/filter', 'searchFilterData');
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
            Route::get('/search/filter', 'serachRoleFilterList');
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
            Route::post('/export/byFilter', 'exportAssetDetails')->name('export.asset_details');
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
            Route::post('/download/attendance', 'downloadAttendance')->name('download.attendance');

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

    // prm Management


    Route::prefix('/prm')->group(function () {
        //PRM Request
        Route::controller(PRMRequestController::class)->group(function () {
            Route::get('/request', 'index')->name('prm.request.index');

            // Route::get('/add', 'add')->name('news.add');
            // Route::post('/create', 'store')->name('news.store');
            // Route::get('/edit/{news:id}', 'edit')->name('news.edit');
            // Route::get('/view/{news:id}', 'view')->name('news.view');
            // Route::post('/update/{id}', 'update')->name('news.update');
            // Route::get('/delete/{id}', 'destroy')->name('news.delete');
            Route::get('/status/update', 'statusUpdate')->name('prm.request.statusUpdate');
            Route::get('/prm-request/search/filter', 'searchPrmRequestFilterList');
        });
        //News Category Module
        Route::prefix('/category')->controller(PRMCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('prm.category.index');
            Route::post('/create', 'store')->name('prm.category.store');
            Route::post('/update', 'update')->name('prm.category.update');
            Route::get('/delete', 'destroy')->name('prm.category.delete');
            Route::get('/status/update', 'statusUpdate')->name('prm.category.statusUpdate');
            Route::get('/search/filter', 'serachPrmCategoryFilterList');
        });
    });
    // prm Management

    // Salary Management
    Route::prefix('/salary')->controller(SalaryController::class)->group(function () {
        Route::get('/', 'index')->name('salary.index');
        Route::get('/add', 'add')->name('salary.add');
        Route::get('/view/{id}', 'view')->name('salary.view');
        Route::post('/create', 'store')->name('salary.store');
        Route::get('/edit/{id}', 'edit')->name('salary.edit');
        Route::post('/update/{id}', 'update')->name('salary.update');
        Route::get('/delete', 'destroy')->name('salary.delete');
        Route::get('/status/update', 'statusUpdate')->name('salary.statusUpdate');
        Route::get('/search/filter', 'serachSalaryFilterList');
    });

    // Salary Component Management



    Route::prefix('/salary-component')->controller(SalaryComponentController::class)->group(function () {
        Route::get('/', 'index')->name('salary.component.index');
        Route::get('/add', 'add')->name('salary.component.add');
        Route::post('/create', 'store')->name('salary.component.store');
        Route::get('/edit/{id}', 'edit')->name('salary.component.edit');
        Route::post('/update/{id}', 'update')->name('salary.component.update');
        Route::get('/delete', 'destroy')->name('salary.component.delete');
        Route::get('/search/filter', 'serachSalaryComponentFilterList');
    });

    // Tax Slab Module
    Route::prefix('/tax-slab')->controller(TaxSlabRuleController::class)->group(function () {
        Route::get('/', 'index')->name('taxslab.index');
        Route::get('/add', 'add')->name('taxslab.add');
        Route::post('/create', 'store')->name('taxslab.store');
        Route::get('/edit/{news:id}', 'edit')->name('taxslab.edit');
        Route::get('/view/{news:id}', 'view')->name('taxslab.view');
        Route::post('/update', 'update')->name('taxslab.update');
        Route::get('/delete', 'destroy')->name('taxslab.delete');
        Route::get('/status/update', 'statusUpdate')->name('taxslab.statusUpdate');
        Route::get('/search/filter', 'serachTaxSlabFilterList');
    });

    // Employee Salary
    Route::prefix('/employee-salary')->controller(EmployeeSalaryController::class)->group(function () {
        Route::get('/', 'index')->name('employee_salary.index');
        Route::get('/view/{id}', 'viewSalary')->name('employee_salary.viewSalary');
        Route::get('/search/filter', 'serachEmployeeSalaryFilterList');
        Route::get('/show/payslip', 'showEmployeePayslip');
        Route::get('/generate/previous/month/payslip', 'generatePayslipPreviousMonth');
    });

    //Courses
    Route::prefix('/courses')->controller(CourseController::class)->group(function () {
        Route::get('/', 'index')->name('course.list');
        Route::get('/add', 'add')->name('course.add');
        Route::get('/edit/{id}', 'edit')->name('course.edit');
        Route::get('/delete', 'delete')->name('course.delete');
        Route::post('/store', 'store')->name('course.store');
        Route::get('/view/{id}', 'view')->name('course.view');
        Route::get('/status/update', 'statusUpdate')->name('course.statusUpdate');
    });
    Route::prefix('/curriculum')->controller(CourseController::class)->group(function () {
        Route::post('/store', 'curriculumStore')->name('curriculum.store');
    });

    // Location Visit
    Route::prefix('/location-visit')->controller(LocationVisitController::class)->group(function () {
        Route::get('/', 'index')->name('location_visit.index');
        Route::post('/store', 'store')->name('location_visit.store');
        Route::get('/assign_task', 'assignTaskList')->name('location_visit.assign_task');
        Route::get('/add_task', 'addTask')->name('location_visit.add_task');
        Route::post('/store_task_assign', 'storeTaskAssigned')->name('location_visit.store_task_assign');
        Route::get('/task/{id}', 'editTaskAssigned')->name('location_visit.edit_task_assign');
        Route::post('/update_task_assign/{id}', 'updateTaskAssigned')->name('location_visit.update_task_assign');
        Route::get('/task/delete/{id}', 'deleteTaskAssigned')->name('location_visit.delete_task_assign');
        Route::get('/view/task/{id}', 'viewTaskAssigned')->name('location_visit.view_task_assign');
        Route::get('/search/task', 'searchFilterTask');
    });

    //Dispostion Code Module
    Route::prefix('/disposition-code')->controller(DispositionCodeController::class)->group(function () {
        Route::get('/', 'index')->name('disposition_code.index');
        Route::post('/create', 'store')->name('disposition_code.store');
        Route::post('/update', 'update')->name('disposition_code.update');
        Route::get('/delete', 'destroy')->name('disposition_code.delete');
        Route::get('/status/update', 'statusUpdate')->name('disposition_code.statusUpdate');
        Route::get('/search/filter', 'serachFilterList');
    });

    //Live location tracking
    Route::prefix('/location-tracking')->controller(LocationTrackingController::class)->group(function () {
        Route::get('/', 'index')->name('location.tracking.index');
        Route::post('/create', 'store')->name('location.tracking.store');
        Route::get('/update/status', 'updateLocationTrackingStatus')->name('location.tracking.statusUpdate');
        Route::get('/search/filter', 'serachFilterList');
        Route::get('/current-locations', 'fetchCurrentLocationOfEmployees')->name('location.tracking.currentLocations');
        Route::get('/location-tracking/get-locations', 'getLocations')->name('getLocations');
        Route::get('/user/{userID}', 'trackLocations')->name('track-location');
    });
    //Attendance Request Module
    Route::prefix('/attendance-request')->controller(AttendanceRequestController::class)->group(function () {
        Route::get('/', 'index')->name('attendance.request.index');
        Route::get('/status/update', 'statusUpdateAttendanceRequest')->name('attendance.request.statusUpdate');
        Route::get('/search/filter', 'serachFilterList');
    });

     //Comp Off Module
     Route::prefix('/comp-offs')->controller(CompOffController::class)->group(function () {
        Route::get('/', 'index')->name('comp-off.index');
        Route::get('/status/update', 'statusUpdateAttendanceRequest')->name('comp-off.statusUpdate');
        Route::get('/search/filter', 'serachFilterList');
    });

    //Address Request Module
    Route::prefix('/address-request')->controller(AddressRequestController::class)->group(function () {
        Route::get('/', 'index')->name('address.request.index');
        Route::get('/status/update', 'statusUpdate')->name('address.request.statusUpdate');
        Route::get('/search/filter', 'serachFilterList');
    });

      //Address Request Module
      Route::prefix('/reward')->controller(UserRewardController::class)->group(function () {
        Route::get('/', 'index')->name('reward.index');
        Route::get('/add', 'add')->name('reward.add');
        Route::post('/store', 'store')->name('reward.store');
        Route::get('/edit/{id}', 'edit')->name('reward.edit');
        Route::post('/update/{id}', 'update')->name('reward.update');
        Route::get('/delete', 'destroy')->name('reward.delete');
        Route::get('/search/filter', 'serachFilterList');

    });

    //Reward Category Module
    Route::prefix('/reward-category')->controller(RewardCategoryController::class)->group(function () {
        Route::get('/', 'index')->name('reward_category.index');
        Route::post('/create', 'store')->name('reward_category.store');
        Route::post('/update', 'update')->name('reward_category.update');
        Route::get('/delete', 'destroy')->name('reward_category.delete');
        Route::get('/status/update', 'statusUpdate')->name('reward_category.statusUpdate');
        Route::get('/search/filter', 'serachFilterList');
    });
    //Hierarchy Module
    Route::prefix('/hierarchy')->controller(HierarchyController::class)->group(function () {
        Route::get('/', 'index')->name('hierarchy.index');
    });

    //log Activity
    Route::prefix('/log-activity')->controller(LogActivityController::class)->group(function () {
        Route::get('/company/list', 'companyList')->name('company.log_activity');
    });

});
Route::prefix('/export')->controller(EmployeeAttendanceExportController::class)->group(function () {
    Route::get('/employee/attendance', 'employeeAttendanceExport')->name('export.employee.attendance');
});
/**---------------End Company Panel Route----------------*/
