<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\PermissionsRepository;

class PermissionsServices
{
  private $permissionRepository;
  public function __construct(PermissionsRepository $permissionRepository)
  {
    $this->permissionRepository = $permissionRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->permissionRepository->orderBy('id', 'DESC')->all();
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->permissionRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->permissionRepository->getPermissionsById($id)->delete();
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
    return $this->permissionRepository->find($id)->update($data);
  }
}
