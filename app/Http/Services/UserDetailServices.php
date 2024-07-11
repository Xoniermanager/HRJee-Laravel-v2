<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\UserDetail;
use App\Repositories\UserDetailRepository;
use Illuminate\Support\Arr;

class UserDetailServices
{
  private $userDetailRepository;
  private $companyBranchService;
  private $departmentService;
  private $designationService;
  public function __construct(UserDetailRepository $userDetailRepository, BranchServices $companyBranchService, DepartmentServices $departmentService, DesignationServices $designationService)
  {
    $this->userDetailRepository = $userDetailRepository;
    $this->companyBranchService = $companyBranchService;
    $this->departmentService = $departmentService;
    $this->designationService = $designationService;
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

  public function getAllUserByCompanyBranchIdsAndDepartmentIdsAndDesignationIds($companyBranchIds, $departmentIds = null, $designationIds = null, $allCompanyBranches = null, $allDepartment = null, $allDesignation = null)
  {
    $allCompanyDepartment = $this->departmentService->getAllDepartmentsByCompanyId();
    $allDepartmentIds = $allCompanyDepartment->pluck('id');
    $selectedDepartments = $allDepartmentIds;

    $baseQuery =  UserDetail::with('user:id,name,profile_image,official_email_id');

    /** Filter by Company Branch */
    if (isset($companyBranchIds) && count($companyBranchIds) > 0) {
      $baseQuery->whereIn('company_branch_id', $companyBranchIds);
    } else {
      $allCompanyBranchDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId(Auth()->guard('admin')->user()->company_id);
      $allCompanyBranchIds = $allCompanyBranchDetails->pluck('id');
      $baseQuery->whereIn('company_branch_id', $allCompanyBranchIds);
    }

    /** Filter by Departments */
    if (isset($departmentIds) && count($departmentIds) > 0) {
      $baseQuery = $baseQuery->whereIn('department_id', $departmentIds);
      $selectedDepartments = $departmentIds;
    } else if (isset($allDepartment) && $allDepartment == true) {
      $baseQuery->whereIn('department_id', $allDepartmentIds);
    }

    /** Filter by Designations */
    if (isset($designationIds) && count($designationIds) > 0) {
      $baseQuery = $baseQuery->whereIn('designation_id', $designationIds);
    } else if (isset($allDesignation) && $allDesignation == true) {
      $allCompanyDesignation = $this->designationService->getAllDesignationByDepartmentIds($selectedDepartments);
      $allDesignationIds = $allCompanyDesignation->pluck('id');
      $baseQuery->whereIn('designation_id', $allDesignationIds);
    } else {
      $baseQuery->whereIn('company_branch_id', $allCompanyBranchIds);
    }
    $usersDetails = $baseQuery->get()->toArray();
    return $usersDetails;
  }
  public function getDetailsByCompanyBranchEmployeeType($companyBranchId, $employeeTypeId)
  {
    return $this->userDetailRepository->with('user')->where('company_branch_id', $companyBranchId)->where('employee_type_id', $employeeTypeId)->select('user_id')->get();
  }
}
