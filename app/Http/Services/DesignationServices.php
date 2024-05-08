<?php

namespace App\Http\Services;

use App\Models\Department;
use App\Models\Designations;
use App\Models\User;
use App\Repositories\DepartmentRepository;
use App\Repositories\DesignationsRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class DesignationServices 
{
  private $designations_repository ;
  public function __construct(DesignationsRepository $designations_repository)
  {
    $this->designations_repository = $designations_repository;
  }
    public function get_designations()
    { 
     return  Designations::with('departments')->get();
    }
    public function delete_designations_by_id($id)
    {    
    return $this->designations_repository->getDesignationsById($id)->delete();
    }
    public function get_designations_by_id($id)
    {    
    return $this->designations_repository->getDesignationsById($id)->get();
    }
    

}