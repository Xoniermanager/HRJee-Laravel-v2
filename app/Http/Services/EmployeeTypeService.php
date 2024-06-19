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
  public function all()
  {
    return $this->employeeTypeRepository->orderBy('id','DESC')->paginate(10);
  }

  public function create(array $data)
  {
    return $this->employeeTypeRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->employeeTypeRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->employeeTypeRepository->find($id)->delete();
  }
  public function searchInEmployeeType($searchKey)
  {
    $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->employeeTypeRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%")
           ->orWhere('description', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();
  }
  
}
