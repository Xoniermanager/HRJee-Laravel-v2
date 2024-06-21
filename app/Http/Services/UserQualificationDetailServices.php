<?php

namespace App\Http\Services;

use App\Repositories\UserQualificationDetailRepository;

class UserQualificationDetailServices
{
  private $userQualificationDetailRepository;
  public function __construct(UserQualificationDetailRepository $userQualificationDetailRepository)
  {
    $this->userQualificationDetailRepository = $userQualificationDetailRepository;
  }

  public function create(array $allQualifications)
  {
    $user_id = $allQualifications['user_id'];

    //getting payload for save details 
    foreach ($allQualifications['degree'] as $qualification) {
      $qualificationDetails[] = $this->userQualificationDetailRepository->updateOrCreate([
        'user_id'           =>  $user_id,
        'qualification_id'  =>  $qualification['qualification_id']
      ], $qualification);
    }
    return true;
  }
  public function delete($id)
  {
    return $this->userQualificationDetailRepository->where('qualification_id', $id)->delete();
  }
}
