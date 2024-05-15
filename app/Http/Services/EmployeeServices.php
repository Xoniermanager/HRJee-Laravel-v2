<?php

namespace App\Http\Services;

use App\Repositories\EmployeeRepository;

class EmployeeServices
{
  private $employeeRepository;
  public function __construct(EmployeeRepository $employeeRepository)
  {
    $this->employeeRepository = $employeeRepository;
  }
  public function all()
  {
    return $this->employeeRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data = $this->employeeRepository->create($data);
    return $data->id;
  }

  public function updateDetails(array $data, $id)
  {
    return $this->employeeRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->employeeRepository->find($id)->delete();
  }
}
