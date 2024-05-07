<?php

namespace App\Http\Services;

use App\Repositories\SkillRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class SkillsService
{
  private $companySkillsRepository;
  public function __construct(SkillRepository $companySkillsRepository)
  {
    $this->companySkillsRepository = $companySkillsRepository;
  }
  public function all()
  {
    return $this->companySkillsRepository->paginate(10);
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

  public function updateStatusDetails($id, $data)
  {
    return $this->companySkillsRepository->find($id)->update($data);
  }
}
