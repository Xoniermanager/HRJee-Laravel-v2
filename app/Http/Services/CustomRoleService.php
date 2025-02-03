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

  public function getDetails($id)
  {
    return $this->customRoleRepository->with(['users'])->find($id);
  }

  public function serachRoleFilterList($request, $companyID)
    {
        $roleDetails = $this->customRoleRepository->where('company_id', $companyID)->where('category', 'custom');
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $roleDetails = $roleDetails->where('name', 'Like', '%' . $request['search'] . '%');
        }
        /**List By Status or Filter */
        if (isset($request['status']) && $request['status'] != "") {
            $roleDetails = $roleDetails->where('status', $request['status']);
        }
        return $roleDetails->orderBy('id', 'DESC')->paginate(10);
    }

}
