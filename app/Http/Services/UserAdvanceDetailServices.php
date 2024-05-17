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
    $get_existing_details = $this->checkExistingDetails($user_id);
    if ($get_existing_details != null) {
      $response =  $this->userAdvanceDetailRepository->find($get_existing_details->id)->update($data);
    } else {
      $response = $this->userAdvanceDetailRepository->create($data);
    }
    return $response;
  }

  public function checkExistingDetails($user_id)
  {
    return $this->userAdvanceDetailRepository->where('user_id', $user_id)->first();
  }
}
