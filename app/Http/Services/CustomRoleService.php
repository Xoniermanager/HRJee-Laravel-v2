<?php

namespace App\Http\Services;

use App\Repositories\CustomRoleRepository;

class CustomRoleService
{
  private $customRoleRepository;

  public function __construct(CustomRoleRepository $customRoleRepository)
  {
    $this->customRoleRepository = $customRoleRepository;
  }

  public function all($companyId = null)
  {
    if ($companyId) {
      $otherRoles = $this->customRoleRepository->where('company_id', $companyId)->get();
      $userRole = $this->customRoleRepository->where('name', 'User')->get();
      return $otherRoles->merge($userRole);
    }

    return $this->customRoleRepository->orderBy('id', 'DESC')->all();
  }

  public function getRolesByCompanyID($id)
  {
    return $this->customRoleRepository->where('company_id', $id)->orderBy('id', 'DESC')->get();
  }

  public function create(array $data)
  {
    // dd($data);
    return $this->customRoleRepository->create($data);
  }

  public function deleteDetails($id)
  {
    return $this->customRoleRepository->getRolesById($id)->delete();
  }

  public function updateDetails(array $data, $id)
  {
    return $this->customRoleRepository->find($id)->update($data);
  }

}
