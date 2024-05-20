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
    $response = $this->userBankDetailRepository->updateOrCreate([
      'user_id'           =>  $user_id,
    ], $data);
    return $response;
  }
}
