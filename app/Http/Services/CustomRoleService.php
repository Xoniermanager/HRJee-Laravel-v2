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

  /**
   * Undocumented function
   *
   * @param [type] $companyId
   * @return void
   */
  public function all($companyId = null)
  {
    return $this->customRoleRepository
      ->where('company_id', $companyId)
      ->where('category', 'custom')
      ->orderBy('id', 'DESC')
      ->get();
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function getRolesByCompanyID($id)
  {
    return $this->customRoleRepository
      ->where('company_id', $id)
      ->where('category', 'custom')
      ->orderBy('id', 'DESC')->get();
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->customRoleRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->customRoleRepository->getRolesById($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->customRoleRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param int $id
   * @return void
   */
  public function getDetails($id)
  {
    return $this->customRoleRepository->with(['users'])->find($id);
  }

  /**
   * Undocumented function
   *
   * @param array $request
   * @param int $companyID
   * @return void
   */
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
