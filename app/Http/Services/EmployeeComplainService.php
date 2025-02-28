<?php

namespace App\Http\Services;

use App\Models\ComplainStatus;
use App\Repositories\EmployeeComplainRepository;

class EmployeeComplainService
{
  private $employeeComplainRepository;
  public function __construct(EmployeeComplainRepository $employeeComplainRepository)
  {
    $this->employeeComplainRepository = $employeeComplainRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->employeeComplainRepository->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    $data['complain_status_id'] = ComplainStatus::PROCESSING;
    $data['user_id'] = Auth()->user()->id;
    return $this->employeeComplainRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $userId
   * @return void
   */
  public function getAllComplainDetailsByUserId($userId)
  {
    return $this->employeeComplainRepository->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param [type] $Id
   * @return void
   */
  public function findById($Id)
  {
    return $this->employeeComplainRepository->where('id', $Id)->first();
  }
}
