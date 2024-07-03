<?php

namespace App\Http\Services;

use App\Models\User;
use App\Repositories\UserDetailRepository;
use Illuminate\Support\Arr;

class UserDetailServices
{
  private $userDetailRepository;
  public function __construct(UserDetailRepository $userDetailRepository)
  {
    $this->userDetailRepository = $userDetailRepository;
  }

  public function create($data)
  {
    $finalPayload = Arr::except($data, ['_token']);
    $user_id = $data['user_id'];
    $dataCreated = $this->userDetailRepository->updateOrCreate([
      'user_id'           =>  $user_id,
    ], $finalPayload);
    if ($dataCreated) {
      $user = User::find($user_id);
      $user->languages()->detach();
      $user->skills()->detach();

      //Language Creation
      foreach ($data['language'] as $languages) {
        $user->languages()->attach(
          $languages['language_id'],
          [
            'read' => $languages['read'],
            'speak' => $languages['speak'],
            'write' => $languages['write'],
          ]
        );
      }

      //User Skills Created
      foreach ($data['skill_id'] as $skillId) {
        $user->skills()->attach($skillId);
      }
    }
    return true;
  }
  public function getDetailsByUserId($userId)
  {
    return $this->userDetailRepository->with('officeShift')->where('user_id', $userId)->first();
  }

  public function getAllUsersByBranchId($branchId)
  {
    return $this->userDetailRepository->with('user')->whereIn('company_branch_id', $branchId)->get();
  }
  public function getAllUsersByBranchAndDepartmentId($branch_id, $departmentId)
  {
    return $this->userDetailRepository->with('user')->whereIn('company_branch_id', $branch_id)->whereIn('department_id', $departmentId)->get();
  }
  public function getAllUsersByBranchDepartmentAndDesignationId($branch_id, $departmentId, $designationId)
  {
    return $this->userDetailRepository->with('user')->whereIn('company_branch_id', $branch_id)->whereIn('department_id' ,$departmentId)->whereIn('designation_id', $designationId)->get();
  }
}
