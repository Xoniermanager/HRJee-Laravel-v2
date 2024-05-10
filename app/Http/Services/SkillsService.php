<?php

namespace App\Http\Services;

use App\Repositories\SkillRepository;

class SkillsService
{
  private $companySkillsRepository;
  public function __construct(SkillRepository $companySkillsRepository)
  {
    $this->companySkillsRepository = $companySkillsRepository;
  }
  public function all()
  {
    return $this->companySkillsRepository->orderBy('id','DESC')->paginate(10);
  }

  public function create(array $data)
  {
    return $this->companySkillsRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->companySkillsRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->companySkillsRepository->find($id)->delete();
  }
}
