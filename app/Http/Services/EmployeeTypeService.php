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
    return $this->employeeTypeRepository->paginate(10);
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
}
