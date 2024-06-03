<?php

namespace App\Http\Services;

use App\Repositories\rolesRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class RolesServices 
{
  private $rolesRepository ;
  public function __construct(rolesRepository $rolesRepository)
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