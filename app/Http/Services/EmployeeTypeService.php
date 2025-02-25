<?php

namespace App\Http\Services;

use App\Repositories\EmployeeTypeRepository;

class EmployeeTypeService
{
  private $employeeTypeRepository;
  public function __construct(EmployeeTypeRepository $employeeTypeRepository)
  {
    $this->employeeTypeRepository = $employeeTypeRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->employeeTypeRepository->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->employeeTypeRepository->create($data);
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
    return $this->employeeTypeRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->employeeTypeRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param [type] $searchKey
   * @return void
   */
  public function searchInEmployeeType($searchKey)
  {
    $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->employeeTypeRepository->where(function ($query) use ($data) {
      if (!empty($data['key'])) {
        $query->where('name', 'like', "%{$data['key']}%")
          ->orWhere('description', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
        $query->where('status', $data['status']);
      }
    })->get();
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getAllActiveEmployeeType()
  {
    return $this->employeeTypeRepository->where('status', '1')->get();
  }
}
