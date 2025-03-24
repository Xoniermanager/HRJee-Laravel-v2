<?php

namespace App\Http\Services;

use App\Repositories\RolesRepository;

class RolesServices
{
  private $rolesRepository;
  public function __construct(RolesRepository $rolesRepository)
  {
    $this->rolesRepository = $rolesRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->rolesRepository->orderBy('id', 'DESC')->all();
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function getRolesByCompanyID($id)
  {
    return $this->rolesRepository->where('company_id', $id)->orderBy('id', 'DESC')->get();
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->rolesRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->rolesRepository->getRolesById($id)->delete();
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
    return $this->rolesRepository->find($id)->update($data);
  }
}
