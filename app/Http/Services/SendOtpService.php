<?php

namespace App\Http\Services;

use App\Repositories\SkillRepository;

class SendOtpService
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
  public function get_skill_ajax_call()
  {
    return $this->companySkillsRepository->orderBy('id','DESC')->get();
  }
 
}
