<?php

namespace App\Http\Services;

use App\Repositories\CompanyStatusRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class CompanyStatusService
{
  private $companyStatusRepository;
  public function __construct(CompanyStatusRepository $companyStatusRepository)
  {
    $this->companyStatusRepository = $companyStatusRepository;
  }
  public function all()
  {
    return $this->companyStatusRepository->paginate(10);
  }

  public function create(array $data)
  {
    return $this->companyStatusRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->companyStatusRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->companyStatusRepository->find($id)->delete();
  }

  public function updateStatusDetails($id, $data)
  {
    return $this->companyStatusRepository->find($id)->update($data);
  }
}
