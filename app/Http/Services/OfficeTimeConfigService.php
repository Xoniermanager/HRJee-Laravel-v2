<?php

namespace App\Http\Services;

use App\Repositories\officeTimeConfigRepository;

class OfficeTimeConfigService
{
  private $officeTimeConfigRepository;
  public function __construct(officeTimeConfigRepository $officeTimeConfigRepository)
  {
    $this->officeTimeConfigRepository = $officeTimeConfigRepository;
  }
  public function all()
  {
    return $this->officeTimeConfigRepository->orderBy('id','DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->officeTimeConfigRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->officeTimeConfigRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->officeTimeConfigRepository->find($id)->delete();
  }
}
