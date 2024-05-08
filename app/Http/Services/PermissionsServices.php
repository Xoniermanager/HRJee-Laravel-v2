<?php

namespace App\Http\Services;

use App\Models\permissions;
use App\Models\User;
use App\Repositories\permissionsRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class permissionsServices 
{
  private $permissions_repository ;
  public function __construct(permissionsRepository $permissions_repository)
  {
    $this->permissions_repository = $permissions_repository;
  }
    public function get_permissions()
    { 
     return $this->permissions_repository->all();
    }
    public function delete_permissions_by_id($id)
    {    
    return $this->permissions_repository->getPermissionsById($id)->delete();
    }
    public function get_permissions_by_id($id)
    {    
    return $this->permissions_repository->getPermissionsById($id)->get();
    }
    

}