<?php

namespace App\Http\Services;

use App\Repositories\UserBankDetailRepository;

class UserBankDetailServices
{
  private $userBankDetailRepository;
  public function __construct(UserBankDetailRepository $userBankDetailRepository)
  {
    $this->userBankDetailRepository = $userBankDetailRepository;
  }

  public function create(array $data)
  {
    $user_id = $data['user_id'];
    $get_existing_details = $this->checkExistingDetails($user_id);
    if ($get_existing_details != null) {
      $response =  $this->userBankDetailRepository->find($get_existing_details->id)->update($data);
    } else {
      $response = $this->userBankDetailRepository->create($data);
    }
    return $response;
  }

  public function checkExistingDetails($user_id)
  {
    return $this->userBankDetailRepository->where('user_id', $user_id)->first();
  }
}
