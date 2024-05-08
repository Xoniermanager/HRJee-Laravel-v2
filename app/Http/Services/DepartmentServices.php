<?php

namespace App\Http\Services;

use App\Models\Department;
use App\Models\User;
use App\Repositories\DepartmentRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class DepartmentServices 
{
  private $department_repository ;
  public function __construct(DepartmentRepository $department_repository)
  {
    $this->department_repository = $department_repository;
  }
    public function get_departments()
    { 
     $company =  Auth::guard('admin')->user();
     return $this->department_repository->getDepartmentByCompany($company->id)->get();
    }
    public function delete_department_by_id($id)
    {    
    return $this->department_repository->getDepartmentById($id)->delete();
    }
    public function get_department_by_id($id)
    {    
    return $this->department_repository->getDepartmentById($id)->get();
    }
    

}