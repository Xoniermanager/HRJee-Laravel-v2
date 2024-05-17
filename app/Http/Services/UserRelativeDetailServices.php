<?php

namespace App\Http\Services;

use App\Repositories\UserRelativeDetailRepository;

use function PHPSTORM_META\type;

class UserRelativeDetailServices
{
  private $userRelativeDetailRepository;
  public function __construct(UserRelativeDetailRepository $userRelativeDetailRepository)
  {
    $this->userRelativeDetailRepository = $userRelativeDetailRepository;
  }

  public function create(array $allfamilyDetails)
  {
    $user_id = $allfamilyDetails['user_id'] ?? '2';
    
    foreach ($allfamilyDetails['family_details'] as $familyDetails) {
      $familyDetails[] = $this->userRelativeDetailRepository->updateOrCreate([
        'user_id'           =>  $user_id,
      ], $familyDetails);
    }
    return true;
  }
}
