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
}
