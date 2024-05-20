<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;


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
  public function create(array $data)
  {
    $nameForImage = removingSpaceMakingName($data['name']);
    $data['password'] = Hash::make($data['password']);
    $data['company_id'] = Auth()->user()->id;
    $data['last_login_ip'] = request()->ip();
    if ($data['profile_image']) {
      $upload_path = "/user_profile_picture";
      $imagePath = $this->imageUploadService->imageUpload($data['profile_image'], $upload_path, $nameForImage);
      if ($imagePath) {
        $data['profile_image'] = $imagePath;
      }
    }
    $data = $this->employeeRepository->create($data);
    return $data->id;
  }

  public function updateDetails(array $data, $id)
  {
    return $this->employeeRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->employeeRepository->find($id)->delete();
  }
}
