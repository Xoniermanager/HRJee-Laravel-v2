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
use App\Http\Controllers\Admin\AdminCompanyBranchesController;
use App\Http\Controllers\Admin\AdminPreviousCompanyController;


Route::prefix('/admin')->middleware('Check2FA')->group(function ()
{
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

    Route::prefix('/department')->controller(AdminDepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('admin.departments');
        Route::post('/create', 'store')->name('admin.department.store');
        Route::post('/update', 'update')->name('admin.department.update');
        Route::get('/delete', 'destroy')->name('admin.department.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.department.statusUpdate');
        Route::get('/search', 'search')->name('admin.department.search');
    });

    Route::prefix('/designation')->controller(AdminDesignationsController::class)->group(function () {
        Route::get('/', 'index')->name('admin.designations');
        Route::post('/create', 'store')->name('admin.designation.store');
        Route::post('/update', 'update')->name('admin.designation.update');
        Route::get('/delete', 'destroy')->name('admin.designation.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.designation.statusUpdate');
        Route::get('/search', 'search')->name('admin.designation.search');
    });

    Route::prefix('/state')->controller(AdminStateController::class)->group(function () {
        Route::get('/', 'index')->name('admin.state');
        Route::post('/create', 'store')->name('admin.state.store');
        Route::post('/update', 'update')->name('admin.state.update');
        Route::get('/delete', 'destroy')->name('admin.state.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.state.statusUpdate');
        Route::get('/search', 'search')->name('admin.state.search');
        Route::get('/get/all/state', 'getAllStates')->name('admin.get.all.country.state');
    });

    Route::prefix('/country')->controller(AdminCountryController::class)->group(function () {
        Route::get('/', 'index')->name('admin.country');
        Route::post('/create', 'store')->name('admin.country.store');
        Route::post('/update', 'update')->name('admin.country.update');
        Route::get('/delete', 'destroy')->name('admin.country.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.country.statusUpdate');
        Route::get('/search', 'search')->name('admin.country.search');
    });

    Route::prefix('/qualifications')->controller(QualificationController::class)->group(function () {
        Route::get('/', 'index')->name('admin.qualification');
        Route::post('/create', 'store')->name('admin.qualification.store');
        Route::post('/update', 'update')->name('admin.qualification.update');
        Route::get('/delete', 'destroy')->name('admin.qualification.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.qualification.statusUpdate');
        Route::get('/search', 'search')->name('admin.qualification.search');
    });

    Route::prefix('/previous-company')->controller(AdminPreviousCompanyController::class)->group(function () {
        Route::get('/', 'index')->name('admin.previous_company');
        Route::post('/create', 'store')->name('admin.previous_company.store');
        Route::post('/update', 'update')->name('admin.previous_company.update');
        Route::get('/delete', 'destroy')->name('admin.previous_company.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.previous_company.statusUpdate');
        Route::get('/search', 'search')->name('admin.previous_company.search');
    });

    Route::prefix('/skills')->controller(SkillController::class)->group(function () {
        Route::get('/', 'index')->name('admin.skill');
        Route::post('/create', 'store')->name('admin.skill.store');
        Route::post('/update', 'update')->name('admin.skill.update');
        Route::get('/delete', 'destroy')->name('admin.skill.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.skill.statusUpdate');
        Route::get('/search', 'search')->name('admin.skill.search');
    });

    Route::prefix('/document-type')->controller(DocumentTypeController::class)->group(function () {
        Route::get('/', 'index')->name('admin.document.type');
        Route::post('/create', 'store')->name('admin.document.type.store');
        Route::post('/update', 'update')->name('admin.document.type.update');
        Route::get('/delete', 'destroy')->name('admin.document.type.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.document.type.statusUpdate');
        Route::get('/search', 'search')->name('admin.document.type.search');
    });

    Route::prefix('/employee-status')->controller(EmployeeStatusController::class)->group(function () {
        Route::get('/', 'index')->name('admin.employee_status');
        Route::post('/create', 'store')->name('admin.employee_status.store');
        Route::post('/update', 'update')->name('admin.employee_status.update');
        Route::get('/delete', 'destroy')->name('admin.employee_status.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.employee_status.statusUpdate');
        Route::get('/search', 'search')->name('admin.document.employee_status.search');
    });

    Route::prefix('/employee-type')->controller(EmployeeTypeController::class)->group(function () {
        Route::get('/', 'index')->name('admin.employee_type');
        Route::post('/create', 'store')->name('admin.employee_type.store');
        Route::post('/update', 'update')->name('admin.employee_type.update');
        Route::get('/delete', 'destroy')->name('admin.employee_type.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.employee_type.statusUpdate');
        Route::get('/search', 'search')->name('admin.employee_type.search');
    });

    Route::prefix('/languages')->controller(AdminLanguagesController::class)->group(function () {
        Route::get('/', 'index')->name('admin.languages');
        Route::post('/create', 'store')->name('admin.languages.store');
        Route::post('/update', 'update')->name('admin.languages.update');
        Route::get('/delete', 'destroy')->name('admin.languages.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.languages.statusUpdate');
        Route::get('/search', 'search')->name('admin.languages.search');
    });

    Route::prefix('/company')->controller(AdminCompanyController::class)->group(function () {
        Route::get('/', 'index')->name('admin.company');
        Route::get('/add-company', 'add_company')->name('admin.add_company');
        Route::get('/edit-company', 'edit_company')->name('admin.edit_company');
        Route::post('/create-or-update', 'store')->name('admin.company.store');
        Route::get('/delete', 'destroy')->name('admin.company.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.company.statusUpdate');
        Route::get('/search', 'search')->name('admin.company.search');
    });
    Route::prefix('/company-branch')->controller(AdminCompanyBranchesController::class)->group(function () {
        Route::get('/', 'index')->name('admin.branch');
        Route::post('/create', 'store')->name('admin.company.branch.store');
        Route::post('/update', 'update')->name('admin.company.branch.update');
        Route::get('/delete', 'destroy')->name('admin.company.branch.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.company.branch.statusUpdate');
        Route::get('/search', 'search')->name('admin.company.branch.search');
    });

    //Company Size Module
    Route::prefix('/company-size')->controller(CompanySizeController::class)->group(function () {
        Route::get('/', 'index')->name('admin.company.size');
        Route::post('/create', 'store')->name('admin.company.size.store');
        Route::post('/update', 'update')->name('admin.company.size.update');
        Route::get('/delete', 'destroy')->name('admin.company.size.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.company.size.statusUpdate');
        Route::get('/search', 'search')->name('admin.company.size.search');
    });

    Route::prefix('/company-status')->controller(CompanyStatusController::class)->group(function () {
        Route::get('/', 'index')->name('admin.company.status');
        Route::post('/create', 'store')->name('admin.company.status.store');
        Route::post('/update', 'update')->name('admin.company.status.update');
        Route::get('/delete', 'destroy')->name('admin.company.status.delete');
        Route::get('/status/update', 'statusUpdate')->name('admin.company.status.statusUpdate');
        Route::get('/search', 'search')->name('admin.company.status.search');
    });
});
/**----------------- End Super Admin Route ----------------------*/
