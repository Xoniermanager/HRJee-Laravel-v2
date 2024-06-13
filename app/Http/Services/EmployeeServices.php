<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Hash;
use App\Http\Services\FileUploadService;
use App\Models\User;
use App\Repositories\EmployeeRepository;

class EmployeeServices
{
  private $employeeRepository;
  private $imageUploadService;
  public function __construct(EmployeeRepository $employeeRepository, FileUploadService $imageUploadService)
  {
    $this->employeeRepository = $employeeRepository;
    $this->imageUploadService = $imageUploadService;
  }
  public function all($request)
  {
    $allEmployeeDetails = $this->employeeRepository->load('userDetails')->orderBy('id', 'DESC')->paginate(10);

    //List Selected by Gender
    if (isset($request->gender) && !empty($request->gender)) {
      $allEmployeeDetails = $allEmployeeDetails->where('gender', $request->gender);
    }

    //List Selected by Emp Status
    if (isset($request->emp_status_id) && !empty($request->emp_status_id)) {
      $allEmployeeDetails = $allEmployeeDetails->where('employee_status_id', $request->emp_status_id);
    }

    //List Selected by Marrital Status
    if (isset($request->marital_status) && !empty($request->marital_status)) {
      $allEmployeeDetails = $allEmployeeDetails->where('marital_status', $request->marital_status);
    }

    //List Selected by Employee Type
    if (isset($request->emp_type_id) && !empty($request->emp_type_id)) {
      $empTypeId = $request->emp_type_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($empTypeId) {
          $query->where('employee_type_id', '=', $empTypeId);
        }
      )->get();
    }

    //List Selected by Department
    if (isset($request->department_id) && !empty($request->department_id)) {
      $departmentId = $request->department_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($departmentId) {
          $query->where('department_id', '=', $departmentId);
        }
      )->get();
    }
    //List Selected by Shift
    if (isset($request->shift_id) && !empty($request->shift_id)) {
      $shiftId = $request->shift_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($shiftId) {
          $query->where('shift_id', '=', $shiftId);
        }
      )->get();
    }
    //List Selected by Branch
    if (isset($request->branch_id) && !empty($request->branch_id)) {
      $branchId = $request->branch_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($branchId) {
          $query->where('company_branch_id', '=', $branchId);
        }
      )->get();
    }
    //List Selected by Qualification
    if (isset($request->qualification_id) && !empty($request->qualification_id)) {
      $qualificationId = $request->qualification_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($qualificationId) {
          $query->where('qualification_id', '=', $qualificationId);
        }
      )->get();
    }
    //List Selected by Skill Id
    if (isset($request->skill_id) && !empty($request->skill_id)) {
      $skillId = $request->skill_id;
      $allEmployeeDetails = User::whereHas(
        'userSkills',
        function ($query) use ($skillId) {
          $query->where('skill_id', '=', $skillId);
        }
      )->get();
    }

    return $allEmployeeDetails;
  }
  public function create($data)
  {
    $nameForImage = removingSpaceMakingName($data['name']);
    if (isset($data['profile_image']) && !empty($data['profile_image'])) {
      $upload_path = "/user_profile_picture";
      $imagePath = $this->imageUploadService->imageUpload($data['profile_image'], $upload_path, $nameForImage);
      $data['profile_image'] = $imagePath;
    }
    if (!isset($data['password']) && empty($data['password'])) {
      $data['password'] = Hash::make(($data['password'] ?? 'password'));
    } else {
    }
    $data['company_id'] = Auth::guard('admin')->user()->id;
    $data['last_login_ip'] = request()->ip();
    if ($data['id'] != null) {
      $existingDetails = $this->employeeRepository->find($data['id']);
      if ($existingDetails->profile_image != null) {
        if (file_exists(storage_path('app/public') . $existingDetails->profile_image)) {
          unlink(storage_path('app/public') . $existingDetails->profile_image);
        }
      }
      $existingDetails->update($data);
    } else {
      $createData = $this->employeeRepository->create($data);
    }
    if (isset($createData)) {
      $status = 'createData';
      $id = $createData->id;
    }
    $response =
      [
        'status' => $status ?? 'updateData',
        'id'     => $id ?? ''
      ];
    return $response;
  }

  public function getUserDetailById($id)
  {
    return $this->employeeRepository->find($id);
  }
}
