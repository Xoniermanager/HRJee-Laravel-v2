<?php

namespace App\Http\Services;

use App\Repositories\UserDetailRepository;
use Illuminate\Support\Arr;

class UserDetailServices
{
  private $userDetailRepository;
  private $userSkillService;
  public function __construct(UserDetailRepository $userDetailRepository, UserSkillServices $userSkillService)
  {
    $this->userDetailRepository = $userDetailRepository;
    $this->userSkillService = $userSkillService;
  }

  public function create($data)
  {
    $finalPayload = Arr::except($data, ['_token', 'skill_id']);
    $user_id = $data['user_id'];
    $dataCreated = $this->userDetailRepository->updateOrCreate([
      'user_id'           =>  $user_id,
    ],$finalPayload);
    if ($dataCreated) {
      $this->userSkillService->create($data);
    }
    return true;
  }
}
