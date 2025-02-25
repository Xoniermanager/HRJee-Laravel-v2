<?php

namespace App\Http\Services;

use App\Repositories\UserPastWorkDetailRepository;

class UserPastWorkDetailServices
{
  private $userPastWorkDetailRepository;
  public function __construct(UserPastWorkDetailRepository $userPastWorkDetailRepository)
  {
    $this->userPastWorkDetailRepository = $userPastWorkDetailRepository;
  }

  /**
   * Undocumented function
   *
   * @param array $allPastWorks
   * @return void
   */
  public function create(array $allPastWorks)
  {
    $user_id = $allPastWorks['user_id'];

    foreach ($allPastWorks['previous_company'] as $pastWork) {
      $pastWork[] = $this->userPastWorkDetailRepository->updateOrCreate([
        'user_id'           =>  $user_id,
        'previous_company_id'  =>  $pastWork['previous_company_id']
      ], $pastWork);
    }
    return true;
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function delete($id)
  {
    return $this->userPastWorkDetailRepository->where('previous_company_id', $id)->delete();
  }
}
