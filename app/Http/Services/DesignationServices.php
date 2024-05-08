<?php

namespace App\Http\Services;

use App\Repositories\DesignationsRepository;

class DesignationServices
{
  private $designationRepository;
  public function __construct(DesignationsRepository $designationRepository)
  {
    $this->designationRepository = $designationRepository;
  }
  public function all()
  {
    return $this->designationRepository->with('departments')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->designationRepository->create($data);
  }
  
  public function updateDetails(array $data, $id)
  {
    return $this->designationRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->designationRepository->find($id)->delete();
  }
}
