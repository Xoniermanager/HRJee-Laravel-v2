<?php

namespace App\Http\Services;

use App\Repositories\UserRelativeDetailRepository;

class UserRelativeDetailServices
{
  private $userRelativeDetailRepository;
  public function __construct(UserRelativeDetailRepository $userRelativeDetailRepository)
  {
    $this->userRelativeDetailRepository = $userRelativeDetailRepository;
  }

  /**
   * Undocumented function
   *
   * @param array $allfamilyDetails
   * @return void
   */
  public function create(array $allfamilyDetails)
  {
    $user_id = $allfamilyDetails['user_id'];
    foreach ($allfamilyDetails['family_details'] as $singleFamilyDetails) {
      $response[] = $this->userRelativeDetailRepository->updateOrCreate([
        'user_id'           =>  $user_id,
        'relation_name'     => $singleFamilyDetails['relation_name'],
      ], $singleFamilyDetails);
    }
    return $response;
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function delete($id)
  {
    return $this->userRelativeDetailRepository->find($id)->delete();
  }
}
