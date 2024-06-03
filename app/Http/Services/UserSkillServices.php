<?php

namespace App\Http\Services;

use App\Repositories\UserSkillRepository;

class UserSkillServices
{
  private $userSkillRepository;
  public function __construct(UserSkillRepository $userSkillRepository)
  {
    $this->userSkillRepository = $userSkillRepository;
  }

  public function create($data)
  {

    foreach ($data['skill_id'] as $skillID) 
    {
      $this->userSkillRepository->updateOrCreate([
        'user_id'           =>  $data['user_id'],
        'skill_id' => $skillID
      ]);
    }
    return true;
  }
}
