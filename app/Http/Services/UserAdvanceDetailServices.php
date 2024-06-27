<?php

namespace App\Http\Services;

use App\Repositories\UserAdvanceDetailRepository;

class UserAdvanceDetailServices
{
  private $userAdvanceDetailRepository;
  public function __construct(UserAdvanceDetailRepository $userAdvanceDetailRepository)
  {
    $this->userAdvanceDetailRepository = $userAdvanceDetailRepository;
  }

  public function create(array $data)
  {
    $user_id = $data['user_id'];
    $response = $this->userAdvanceDetailRepository->updateOrCreate([
      'user_id'           =>  $user_id,
    ], $data);
    return $response;
  }


  public function getDetailById($id)
  {
    return $this->userAdvanceDetailRepository->where('user_id',$id)->first();
  }
}
