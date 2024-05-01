<?php

use App\Http\Controllers\DesignationsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyBranchesController;
use App\Http\Controllers\DepartmentController;
use App\Models\Department;
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

Route::middleware(['dashboard.access'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard.dashboard')->name('admin.dashboard');

    Route::get('branch',[CompanyBranchesController::class ,'index'])->name('branch');
    Route::get('branch/create',[CompanyBranchesController::class ,'branch_form'])->name('create.branch.form');
    Route::post('add-branch',[CompanyBranchesController::class ,'add_branch'])->name('add.branch');

    Route::get('branch/{id}/edit', [CompanyBranchesController::class, 'edit_branch'])->name('edit.branch');
    Route::patch('branch/{id}/', [CompanyBranchesController::class, 'update_branch'])->name('update.branch');
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

Route::view('/admin', 'login')->name('admin')->middleware('guest');
Route::post('/login',[AdminController::class ,'userLogin'])->name('login')->middleware('guest');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

