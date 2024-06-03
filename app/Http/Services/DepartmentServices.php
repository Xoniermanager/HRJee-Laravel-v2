<?php

namespace App\Http\Services;

use App\Repositories\DepartmentRepository;

class DepartmentServices
{
  private $departmentRepository;
  public function __construct(DepartmentRepository $departmentRepository)
  {
    $this->departmentRepository = $departmentRepository;
  }
  public function all()
  {
    return $this->departmentRepository->orderBy('id','DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->departmentRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->departmentRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->departmentRepository->find($id)->delete();
  }

  public function searchInDepartment($searchKey)
  {
    $data['key']    = array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status'] = array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->departmentRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();

  }


}
