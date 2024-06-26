<?php

namespace App\Http\Services;

use App\Repositories\EmployeeStatusRepository;

class EmployeeStatusService
{
  private $employeeStatusRepository;
  public function __construct(EmployeeStatusRepository $employeeStatusRepository)
  {
    $this->employeeStatusRepository = $employeeStatusRepository;
  }
  public function all()
  {
    return $this->employeeStatusRepository->orderBy('id','DESC')->paginate(10);
  }

  public function create(array $data)
  {
    return $this->employeeStatusRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->employeeStatusRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->employeeStatusRepository->find($id)->delete();
  }
  public function searchInEmployeeStatus($searchKey)
  {
    $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->employeeStatusRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%")
           ->orWhere('description', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();
  }

  public function getAllActiveEmployeeStatus()
  {
    return $this->employeeStatusRepository->where('status','1')->get();
  }
}
