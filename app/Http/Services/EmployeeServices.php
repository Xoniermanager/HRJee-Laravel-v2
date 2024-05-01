<?php

namespace App\Http\Services;

use App\Models\Employee;
use App\Models\User;
use App\Repositories\EmployeeRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class EmployeeServices 
{
  private $employee_repository ;
  public function __construct(EmployeeRepository $employee_repository)
  {
    $this->employee_repository = $employee_repository;
  }
    public function get_employee()
    { 
      return  User::with('user_details')->get();
    //  return $this->employee_repository->all();
    }
    public function delete_employee_by_id($id)
    {    
    return $this->employee_repository->getEmployeeById($id)->delete();
    }
    public function get_employee_by_id($id)
    {    
      return $this->employee_repository->getEmployeeById($id);
    }

    public function get_employee_all_details_by_id($id)
    {    
      return $this->employee_repository->getEmployeeDetailsById($id);
    }

    
    

}