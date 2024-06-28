<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\AdminStateController;
use App\Http\Controllers\Admin\CompanySizeController;
use App\Http\Controllers\Admin\AdminCompanyController;
use App\Http\Controllers\Admin\AdminCountryController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Admin\CompanyStatusController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\Admin\AdminLanguagesController;
use App\Http\Controllers\Admin\EmployeeStatusController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminDesignationsController;
use App\Http\Controllers\Company\PreviousCompanyController;
use App\Http\Controllers\Admin\AdminCompanyBranchesController;


Route::prefix('/admin')->middleware('Check2FA')->group(function () {
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
});
/**----------------- End Super Admin Route ----------------------*/