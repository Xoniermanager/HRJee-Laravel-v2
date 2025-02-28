<?php

namespace App\Http\Services;

use App\Events\MessageSent;
use App\Repositories\EmployeeComplainLogRepository;

class EmployeeComplainLogService
{
  private $employeeComplainLogRepository;
  public function __construct(EmployeeComplainLogRepository $employeeComplainLogRepository)
  {
    $this->employeeComplainLogRepository = $employeeComplainLogRepository;
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function sendMessage(array $data)
  {
    $sentMessage = $this->employeeComplainLogRepository->create($data);
    broadcast(new MessageSent($sentMessage));
    return $sentMessage;
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function findDetailsByComplainId($id)
  {
    return $this->employeeComplainLogRepository->where('employee_complain_id', $id)->orderBy('created_at', 'ASC')->get();
  }
}
