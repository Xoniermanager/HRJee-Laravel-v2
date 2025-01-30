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
    return $this->customRoleRepository
      ->where('company_id', $companyId)
      ->where('category', 'custom')
      ->orderBy('id', 'DESC')
      ->get();
  }

  public function getRolesByCompanyID($id)
  {
    return $this->customRoleRepository
      ->where('company_id', $id)
      ->where('category', 'custom')
      ->orderBy('id', 'DESC')->get();
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
