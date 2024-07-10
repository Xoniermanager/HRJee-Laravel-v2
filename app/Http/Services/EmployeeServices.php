<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

use App\Mail\ResetPassword;
use App\Models\User;
use App\Models\UserCode;
use Illuminate\Support\Facades\Hash;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EmployeeServices
{
  private $employeeRepository;
  public function __construct(EmployeeRepository $employeeRepository)
  {
    $this->employeeRepository = $employeeRepository;
  }
  public function all($request = null)
  {
    $allEmployeeDetails = $this->employeeRepository->load('userDetails');

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
      );
    }

    //List Selected by Department
    if (isset($request->department_id) && !empty($request->department_id)) {
      $departmentId = $request->department_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($departmentId) {
          $query->where('department_id', '=', $departmentId);
        }
      );
    }
    //List Selected by Shift
    if (isset($request->shift_id) && !empty($request->shift_id)) {
      $shiftId = $request->shift_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($shiftId) {
          $query->where('shift_id', '=', $shiftId);
        }
      );
    }
    //List Selected by Branch
    if (isset($request->branch_id) && !empty($request->branch_id)) {
      $branchId = $request->branch_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($branchId) {
          $query->where('company_branch_id', '=', $branchId);
        }
      );
    }
    //List Selected by Qualification
    if (isset($request->qualification_id) && !empty($request->qualification_id)) {
      $qualificationId = $request->qualification_id;
      $allEmployeeDetails = User::whereHas(
        'userDetails',
        function ($query) use ($qualificationId) {
          $query->where('qualification_id', '=', $qualificationId);
        }
      );
    }
    //List Selected by Skill Id
    if (isset($request->skill_id) && !empty($request->skill_id)) {
      $skillId = $request->skill_id;
      $allEmployeeDetails = User::whereHas(
        'userSkills',
        function ($query) use ($skillId) {
          $query->where('skill_id', '=', $skillId);
        }
      );
    }
    //List Search Operation
    if (isset($request->search) && !empty($request->search)) {
      $searchKeyword = $request->search;
      $allEmployeeDetails = User::where('name', 'Like', '%' . $searchKeyword . '%')
        ->orWhere('official_email_id', 'Like', '%' . $searchKeyword . '%')
        ->orWhere('email', 'Like', '%' . $searchKeyword . '%')
        ->orWhere('phone', 'Like', '%' . $searchKeyword . '%')
        ->orWhere('emp_id', 'Like', '%' . $searchKeyword . '%')
        ->orWhere('father_name', 'Like', '%' . $searchKeyword . '%')
        ->orWhere('mother_name', 'Like', '%' . $searchKeyword . '%')
        ->orWhereHas(
          'userDetails',
          function ($query) use ($searchKeyword) {
            $query->where('offer_letter_id', 'Like', '%' . $searchKeyword . '%')
              ->orwhere('official_mobile_no', 'Like', '%' . $searchKeyword . '%');
          }
        );
    }
    return $allEmployeeDetails->orderBy('id', 'DESC')->paginate(10);
  }
  public function create($data)
  {
 
    $nameForImage = removingSpaceMakingName($data['name']);
    if (isset($data['profile_image']) && !empty($data['profile_image'])) {
      $upload_path = "/user_profile_picture";
      $filePath = uploadingImageorFile($data['profile_image'], $upload_path, $nameForImage);
      $data['profile_image'] = $filePath;
    }
    if (!isset($data['password']) && empty($data['password'])) {
      $data['password'] = Hash::make(($data['password'] ?? 'password'));
    }
    $data['company_id'] = Auth::guard('admin')->user()->company_id;
    $data['last_login_ip'] = request()->ip();
    if ($data['id'] != null) {
      $existingDetails = $this->employeeRepository->find($data['id']);
      if ($existingDetails->profile_image != null) {
        unlinkFileOrImage($existingDetails->profile_image);
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



  public function forgetPassword($request, $code)
  {
    try {

      UserCode::updateOrCreate(['email' => $request->email], [
        'type'  => 'user',
        'code'  => $code,
      ]);
      $mailData = [
        'email' => $request->email,
        'otp_code' => $code,
        'expire_at' => Carbon::now()->addMinutes(2)->format("H:i A")
      ];

      $checkValid = Mail::to($request->email)->send(new ResetPassword($mailData));
      if (!$checkValid)
        return false;
      else
        return true;
    } catch (Throwable $th) {
      return false;
    }
  }

  public function getAllEmployeeByCompanyId($id)
  {

    return $this->employeeRepository->where('company_id',$id)->get();
  }

 
}
