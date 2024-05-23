<?php

namespace App\Http\Services;
use App\Repositories\EmployeeLanguageRepository;

class EmployeeLanguageServices
{
  private $employeeLanguageRepository;
  public function __construct(EmployeeLanguageRepository $employeeLanguageRepository)
  {
    $this->employeeLanguageRepository = $employeeLanguageRepository;
  }
  public function all()
  {
    return $this->employeeLanguageRepository->orderBy('id','DESC')->paginate(10);
  }
  public function all_language()
  {
    return $this->employeeLanguageRepository->orderBy('id','ASC')->get();
  }

  public function create(array $data)
  {
    return $this->employeeLanguageRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->employeeLanguageRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->employeeLanguageRepository->find($id)->delete();
  }
}
