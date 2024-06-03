<?php

namespace App\Http\Services;

use App\Repositories\RolesRepository;

class RolesServices 
{
  private $roles_repository ;
  public function __construct(RolesRepository $roles_repository)
  {
    $this->roles_repository = $roles_repository;
  }
    public function get_roles()
    { 
     return $this->roles_repository->orderBy('id','DESC')->all();
    }
    public function delete_roles_by_id($id)
    {    
    return $this->roles_repository->getRolesById($id)->delete();
    }
    public function get_roles_by_id($id)
    {    
    return $this->roles_repository->getRolesById($id)->get();
    }
    

}