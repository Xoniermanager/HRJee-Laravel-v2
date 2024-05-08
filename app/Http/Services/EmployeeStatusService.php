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
    return $this->employeeStatusRepository->paginate(10);
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
}
