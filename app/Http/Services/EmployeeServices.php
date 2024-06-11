<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Hash;
use App\Http\Services\FileUploadService;
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
  public function all()
  {
    return $this->employeeRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create($data)
  {
    $nameForImage = removingSpaceMakingName($data['name']);
    if (isset($data['profile_image']) && !empty($data['profile_image'])) {
      $upload_path = "/user_profile_picture";
      $imagePath = $this->imageUploadService->imageUpload($data['profile_image'], $upload_path, $nameForImage);
      $data['profile_image'] = $imagePath;
    }
    $data['password'] = Hash::make(($data['password'] ?? 'password'));
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
    } 
    else {
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
}
