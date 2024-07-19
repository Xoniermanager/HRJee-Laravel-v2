<?php

namespace App\Http\Services;

use App\Repositories\EmployeeComplainLogRepository;

class EmployeeComplainLogService
{
  private $employeeComplainLogRepository;
  public function __construct(EmployeeComplainLogRepository $employeeComplainLogRepository)
  {
    $this->employeeComplainLogRepository = $employeeComplainLogRepository;
  }
  public function sendMessage(array $data)
  {
    return $this->employeeComplainLogRepository->create($data);
  }

  public function findDetailsByComplainId($id)
  {
    return $this->employeeComplainLogRepository->where('employee_complain_id', $id)->orderBy('created_at', 'ASC')->get();
  }
}
