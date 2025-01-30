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
  public function all()
  {
    return $this->employeeComplainRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['complain_status_id'] = ComplainStatus::PROCESSING;
    $data['user_id'] = Auth()->user()->id;
    return $this->employeeComplainRepository->create($data);
  }
  public function getAllComplainDetailsByUserId($userId)
  {
    return $this->employeeComplainRepository->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(10);
  }
  public function findById($Id)
  {
    return $this->employeeComplainRepository->where('id', $Id)->first();
  }
}
