<?php

namespace App\Http\Services;

use App\Repositories\CompanyStatusRepository;

class CompanyStatusService
{
  private $companyStatusRepository;
  public function __construct(CompanyStatusRepository $companyStatusRepository)
  {
    $this->companyStatusRepository = $companyStatusRepository;
  }
  public function all()
  {
    return $this->companyStatusRepository->orderBy('id','DESC')->paginate(10);
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
}
