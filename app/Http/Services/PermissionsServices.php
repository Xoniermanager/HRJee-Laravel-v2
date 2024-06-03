<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PermissionsRepository;

class permissionsServices 
{
  private $permissionRepository ;
  public function __construct(PermissionsRepository $permissionRepository)
  {
    $this->permissionRepository = $permissionRepository;
  }
    public function all()
    { 
     return $this->permissionRepository->orderBy('id','DESC')->all();
    }
    public function create(array $data)
    {
      return $this->permissionRepository->create($data);
    }
    public function deleteDetails($id)
    {    
    return $this->permissionRepository->getPermissionsById($id)->delete();
    }
    public function updateDetails(array $data, $id)
    {
      return $this->permissionRepository->find($id)->update($data);
    }
    
    

}