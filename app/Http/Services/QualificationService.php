<?php

namespace App\Http\Services;

use App\Repositories\QualificationRepository;

class QualificationService
{
  private $qualificationRepository;
  public function __construct(QualificationRepository $qualificationRepository)
  {
    $this->qualificationRepository = $qualificationRepository;
  }
  public function all()
  {
    return $this->qualificationRepository->orderBy('id','DESC')->paginate(10);
  }

  public function create(array $data)
  {
    return $this->qualificationRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->qualificationRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->qualificationRepository->find($id)->delete();
  }
}
