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

  /**
   * Undocumented function
   *
   * @param [type] $data
   * @return void
   */
  public function create($data)
  {
    $user_id = $data['user_id'];
    $response = $this->userBankDetailRepository->updateOrCreate(['user_id' =>  $user_id],$data);
    return $response;
  }
  
  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function getDetailById($id)
  {
    return $this->userBankDetailRepository->where('user_id',$id)->first();
  }
 

}
