<?php

namespace App\Http\Services;

use App\Repositories\RolesRepository;

class RolesServices 
{
  private $roles_repository ;
  public function __construct(RolesRepository $roles_repository)
  {
    $this->rolesRepository = $rolesRepository;
  }
    public function all()
    { 
     return $this->rolesRepository->orderBy('id','DESC')->all();
    }
    public function create(array $data)
    {
      return $this->rolesRepository->create($data);
    }
    public function deleteDetails($id)
    {    
    return $this->rolesRepository->getRolesById($id)->delete();
    }
    public function updateDetails(array $data, $id)
    {
      return $this->rolesRepository->find($id)->update($data);
    }
    

}