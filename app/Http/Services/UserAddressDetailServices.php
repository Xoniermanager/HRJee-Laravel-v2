<?php

namespace App\Http\Services;

use App\Repositories\UserAddressDetailRepository;

class UserAddressDetailServices
{
  private $userAddressDetailRepository;
  public function __construct(UserAddressDetailRepository $userAddressDetailRepository)
  {
    $this->userAddressDetailRepository = $userAddressDetailRepository;
  }

  public function create(array $data)
  {
    return $this->userAddressDetailRepository->create($data);
  }
}
