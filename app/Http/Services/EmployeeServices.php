<?php

namespace App\Http\Services;

use Throwable;
use Carbon\Carbon;
use App\Models\UserCode;

use App\Models\UserDetail;
use App\Mail\ResetPassword;
use Illuminate\Support\Arr;
use App\Models\CompanyBranch;
use App\Models\EmployeeManager;
use App\Models\UserActiveLocation;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Repositories\UserDetailRepository;

class EmployeeServices
{
    private $userDetailRepository, $userRepository;

    private $companyBranchService;
    private $departmentService;
    private $designationService;

    public function __construct(UserDetailRepository $userDetailRepository, BranchServices $companyBranchService, DepartmentServices $departmentService, DesignationServices $designationService, UserRepository $userRepository)
    {
        $this->userDetailRepository = $userDetailRepository;
        $this->companyBranchService = $companyBranchService;
        $this->departmentService = $departmentService;
        $this->designationService = $designationService;
        $this->userRepository = $userRepository;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            if (!empty($data['profile_image'])) {
                $data['profile_image'] = uploadingImageorFile(
                    $data['profile_image'],
                    '/user_profile',
                    removingSpaceMakingName($data['name'])
                );
            }
            $data['last_login_ip'] = request()->ip();
            if ($data['user_details_id'] !== null) {
                $existingDetails = $this->userDetailRepository->find($data['user_details_id']);
                if ($existingDetails->profile_image) {
                    unlinkFileOrImage($existingDetails->profile_image);
                }
                if (!empty($data['skill_id'])) {
                    $existingDetails->user->skill()->sync($data['skill_id']);
                    $this->syncEmployeeLanguages($existingDetails->user, $data['language']);
                }
                if ($data['company_branch_id'] != $existingDetails->company_branch_id) {
                    $this->updateActiveLocationByUserId($data['company_branch_id'], $existingDetails->user_id, 'updated');
                }
                
                $existingDetails->update($data);
                $status = 'updatedData';
                $id = $existingDetails->user_id;
            } else {
                $createdEmployee = $this->userDetailRepository->create($data);
                
                $createdEmployee->user->skill()->sync($data['skill_id']);
                $this->syncEmployeeLanguages($createdEmployee->user, $data['language']);
                $this->updateActiveLocationByUserId($data['company_branch_id'], $createdEmployee->user_id);
                $status = 'createdEmployee';
                $id = $createdEmployee->user_id;
            }
            $response = [
                'status' => $status,
                'id' => $id ?? ''
            ];
            DB::commit();
            return $response;
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function syncEmployeeLanguages($employee, $languages)
    {
        $languageData = [];
        // Prepare data for syncing with the pivot table
        foreach ($languages as $language) {
            $languageData[$language['language_id']] = [
                'read' => $language['read'],
                'speak' => $language['speak'],
                'write' => $language['write'],
            ];
        }
        $employee->language()->sync($languageData);
    }

    public function getUserDetailById($id)
    {
        return $this->userRepository->find($id);
    }

    public function forgetPassword($request, $code)
    {
        try {

            UserCode::updateOrCreate(['email' => $request->email], [
                'type' => 'user',
                'code' => $code,
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

    public function getAllEmployeeByCompanyId($companyId)
    {
        return $this->userRepository->where('type', 'user')
            ->where('company_id', $companyId)
            ->whereHas('details', function ($query) {
                $query->whereNull('exit_date');
            });
        ;
    }

    public function getDetailsByCompanyBranchEmployeeType($companyBranchId, $employeeTypeId)
    {
        return $this->userDetailRepository->where('company_branch_id', $companyBranchId)->where('employee_type_id', $employeeTypeId)->select('user_id', 'joining_date')->get();
    }

    public function getAllUserByCompanyBranchIdsAndDepartmentIdsAndDesignationIds($companyBranchIds, $departmentIds = null, $designationIds = null, $allCompanyBranches = null, $allDepartment = null, $allDesignation = null)
    {
        $companyIDs = getCompanyIDs();

        $allCompanyDepartment = $this->departmentService->getAllDepartmentsByCompanyId($companyIDs);
        $allDepartmentIds = $allCompanyDepartment->pluck('id');
        $selectedDepartments = $allDepartmentIds;
        $baseQuery = $this->userDetailRepository;

        /** Filter by Company Branch */
        if (isset($companyBranchIds) && count($companyBranchIds) > 0) {
            $baseQuery->whereIn('company_branch_id', $companyBranchIds);
        } else {
            $allCompanyBranchDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId($companyIDs);
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
        $usersDetails = $baseQuery->with('user')->get()->toArray();
        return $usersDetails;
    }

    public function getEmployeeByNameByEmpIdFilter($companyId, $searchKey)
    {
        return $this->userRepository
            ->where('type', 'user')
            ->where('company_id', $companyId)
            ->whereHas('details', function ($query) use ($searchKey) {
                $query->where('name', 'Like', '%' . $searchKey . '%');
                $query->orWhere('emp_id', 'Like', '%' . $searchKey . '%');
            });
    }

    public function getEmployeeQueryByCompanyId($companyId)
    {
        return $this->userRepository->query()
            ->where('company_id', $companyId)
            ->where('type', 'user') // or whatever your employee type is
            // ->whereNotNull('role_id') // assuming role_id is mandatory for employees
            ->with(['details', 'managers']);
    }

    public function addManagers($userId, $managerIDs)
    {
        EmployeeManager::where('user_id', $userId)->delete();
        if ($managerIDs) {
            $payload = [];

            foreach ($managerIDs as $manager) {
                $payload[] = [
                    'manager_id' => $manager,
                    'user_id' => $userId,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            EmployeeManager::insert($payload);
        }

        return true;
    }

    public function getExitEmployeeList($companyId)
    {
        return $this->userRepository->where('type', 'user')->where('company_id', $companyId)->whereHas('details', function ($query) {
            $query->whereNotNull('exit_date');
        })->paginate(10);
    }

    public function searchFilterForExitEmployee($companyId, $searchKey)
    {
        $allEmployeeDetails = $this->userRepository->where('type', 'user')
            ->where('company_id', $companyId)
            ->whereHas('details', function ($query) {
                $query->whereNotNull('exit_date');
            });

        if (isset($searchKey) && !empty($searchKey['search'])) {
            $searchTerm = '%' . $searchKey['search'] . '%';

            $allEmployeeDetails = $allEmployeeDetails->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', $searchTerm)
                    ->orWhere('email', 'LIKE', $searchTerm)
                    ->orWhereHas('details', function ($q) use ($searchTerm) {
                        $q->where('official_email_id', 'LIKE', $searchTerm)
                            ->orWhere('phone', 'LIKE', $searchTerm)
                            ->orWhere('emp_id', 'LIKE', $searchTerm)
                            ->orWhere('official_mobile_no', 'LIKE', $searchTerm);
                    });
            });
        }
        return $allEmployeeDetails->paginate(10);
    }

    public function updateActiveLocationByUserId($branchId, $userId, $type = "created")
    {
        $branchDetails = CompanyBranch::find($branchId);
        $address = $branchDetails->address;
        $result = app('geocoder')->geocode($address)->get();
        $coordinates = $result[0]->getCoordinates();
        $lat = $coordinates->getLatitude();
        $long = $coordinates->getLongitude();
        $payload =
            [
                'user_id' => $userId,
                'address' => $address,
                'latitude' => $lat,
                'longitude' => $long
            ];
        if ($type == 'updated') {
            $checkExistingDetails = UserActiveLocation::where('user_id', $userId)->where('status', true)->first();
            if ($checkExistingDetails) {
                $checkExistingDetails->update(Arr::except($payload, 'user_id'));
            } else {
                UserActiveLocation::create($payload);
            }
        } else {
            UserActiveLocation::create($payload);
        }
        return true;
    }
}
