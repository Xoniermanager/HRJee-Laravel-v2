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
    return $this->userAdvanceDetailRepository->create($data);
  }
}
