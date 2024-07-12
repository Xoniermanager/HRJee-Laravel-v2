<?php

namespace App\Http\Services;

use App\Repositories\EmployeeBreakHistoryRepository;

class EmployeeBreakHistoryService
{
  private $employeeBreakHistoryRepository;
  public function __construct(EmployeeBreakHistoryRepository $employeeBreakHistoryRepository)
  {
    $this->employeeBreakHistoryRepository = $employeeBreakHistoryRepository;
  }
  public function create(array $data)
  {
    $data['start_time'] = date('h:i');
    return $this->employeeBreakHistoryRepository->create($data);
  }
}
