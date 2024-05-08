<?php

use App\Models\Department;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\DesignationsController;
use App\Http\Controllers\CompanyBranchesController;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

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

Route::view('/demo', 'demo');

Route::middleware(['dashboard.access'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard.dashboard')->name('admin.dashboard');

    Route::get('company/profile',[CompanyController::class ,'company_profile'])->name('company.profile');
    Route::patch('company/update/{id}/', [CompanyController::class, 'update_company'])->name('update.company');
    Route::post('company/change/password',[CompanyController::class ,'company_change_password'])->name('company.change.password');

    Route::get('branch',[CompanyBranchesController::class ,'index'])->name('branch');
    Route::get('branch/create',[CompanyBranchesController::class ,'branch_form'])->name('create.branch.form');
    Route::post('add-branch',[CompanyBranchesController::class ,'add_branch'])->name('add.branch');

    Route::get('branch/{id}/edit', [CompanyBranchesController::class, 'edit_branch'])->name('edit.branch');
    Route::post('branch/{id}/', [CompanyBranchesController::class, 'update_branch'])->name('update.branch');
    Route::get('delete-branch/{id}', [CompanyBranchesController::class, 'delete_branch'])->name('delete.branch');
   
    Route::get('departments',[DepartmentController::class ,'index'])->name('department');
    Route::view('department/create', 'admin.department.create-department-form')->name('create.department.form');
    Route::post('add-departments',[DepartmentController::class ,'add_departments'])->name('add.departments');
    Route::get('departments/{id}/edit', [DepartmentController::class, 'edit_departments'])->name('edit.department');
    Route::patch('departments/{id}/', [DepartmentController::class, 'update_departments'])->name('update.departments');
    Route::get('delete-departments/{id}', [DepartmentController::class, 'delete_departments'])->name('delete.department');
    
    Route::get('designations',[DesignationsController::class ,'index'])->name('designation');
    Route::get('designations/create',[DesignationsController::class ,'designation_form'])->name('create.designation.form');
    Route::post('add-designations',[DesignationsController::class ,'add_designations'])->name('add.designations');
    Route::get('designations/{id}/edit', [DesignationsController::class, 'edit_designations'])->name('edit.designation');
    Route::patch('designations/{id}/', [DesignationsController::class, 'update_designations'])->name('update.designations');
    Route::get('delete-designations/{id}', [DesignationsController::class, 'delete_designations'])->name('delete.designation');

    Route::get('employee',[EmployeeController::class ,'index'])->name('employee');
    Route::get('employee/{id}/view', [EmployeeController::class, 'view_employee'])->name('view.employee');
    Route::get('employee/create',[EmployeeController::class ,'employee_form'])->name('create.employee');
    Route::post('add-employee',[EmployeeController::class ,'add_employee'])->name('add.employee');
    Route::get('employee/{id}/edit', [EmployeeController::class, 'edit_employee'])->name('edit.employee');
    Route::patch('employee/{id}/', [EmployeeController::class, 'update_employee'])->name('update.employee');
    Route::get('delete-employee/{id}', [EmployeeController::class, 'delete_employee'])->name('delete.employee');

    Route::get('roles',[RolesController::class ,'index'])->name('roles');
    Route::get('roles/create',[RolesController::class ,'role_form'])->name('create.role.form');
    Route::post('add-roles',[RolesController::class ,'add_roles'])->name('add.roles');
    Route::get('roles/{id}/edit', [RolesController::class, 'edit_roles'])->name('edit.role');
    Route::patch('roles/{id}/', [RolesController::class, 'update_roles'])->name('update.roles');
    Route::get('delete-roles/{id}', [RolesController::class, 'delete_roles'])->name('delete.roles');

    Route::get('permissions',[PermissionsController::class ,'index'])->name('permissions');
    Route::get('permissions/create',[PermissionsController::class ,'permissions_form'])->name('create.permissions.form');
    Route::post('add-permissions',[PermissionsController::class ,'add_permissions'])->name('add.permissions');
    Route::get('permissions/{id}/edit', [PermissionsController::class, 'edit_permissions'])->name('edit.permissions');
    Route::patch('permissions/{id}/', [PermissionsController::class, 'update_permissions'])->name('update.permissions');
    Route::get('delete-permissions/{id}', [PermissionsController::class, 'delete_permissions'])->name('delete.permissions');

    });

Route::view('/admin', 'login')->name('admin');
Route::post('/company_login',[AdminController::class ,'companyLogin'])->name('company_login');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');


Route::get('/signin',[AuthWebController::class ,'signin'])->name('signin');
Route::get('signup',[AuthWebController::class ,'signup'])->name('signup'); // not in working
Route::post('get-otp', [AuthWebController::class, 'getOtp'])->name('get.otp');
Route::post('verify-otp', [AuthWebController::class, 'verifyOtp'])->name('verify.otp');
Route::post('registration', [AuthWebController::class, 'registerCompany'])->name('add.company');
