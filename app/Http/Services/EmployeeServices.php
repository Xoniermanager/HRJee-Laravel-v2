<?php

namespace App\Http\Services;

use App\Models\UserDetail;
use App\Repositories\UserRepository;
use Throwable;

use Carbon\Carbon;
use App\Models\UserCode;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

            if (isset($data['profile_image']) && !empty($data['profile_image'])) {
                $data['profile_image'] = uploadingImageorFile($data['profile_image'], '/user_profile', removingSpaceMakingName($data['name']));
            }

            $data['last_login_ip'] = request()->ip();

            if ($data['id'] !== null) {
                $existingDetails = $this->userDetailRepository->find($data['id']);
                if ($existingDetails->profile_image != null) {
                    unlinkFileOrImage($existingDetails->profile_image);
                }
                if (isset($data['skill_id']) && !empty($data['skill_id'])) {
                    $existingDetails->user->skill()->sync($data['skill_id']);
                    $this->syncEmployeeLanguages($existingDetails->user, $data['language']);
                }
                $existingDetails->update($data);
            } else {
                $createdEmployee = $this->userDetailRepository->create($data);
                $createdEmployee->user->skill()->sync($data['skill_id']);
                $this->syncEmployeeLanguages($createdEmployee->user, $data['language']);
            }

            if (isset($createdEmployee)) {
                $status = 'createdEmployee';
                $id = $createdEmployee->id;
            }

            $response = [
                'status' => $status ?? 'updateData',
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
        return $this->userRepository->where('type', 'user')->where('company_id', $companyId);
    }

    public function getDetailsByCompanyBranchEmployeeType($companyBranchId, $employeeTypeId)
    {
        return $this->userDetailRepository->where('company_branch_id', $companyBranchId)->where('employee_type_id', $employeeTypeId)->select('id', 'joining_date')->get();
    }

    public function getAllUserByCompanyBranchIdsAndDepartmentIdsAndDesignationIds($companyBranchIds, $departmentIds = null, $designationIds = null, $allCompanyBranches = null, $allDepartment = null, $allDesignation = null)
    {
        $allCompanyDepartment = $this->departmentService->getAllDepartmentsByCompanyId();
        $allDepartmentIds = $allCompanyDepartment->pluck('id');
        $selectedDepartments = $allDepartmentIds;
        $baseQuery = $this->userDetailRepository;

        /** Filter by Company Branch */
        if (isset($companyBranchIds) && count($companyBranchIds) > 0) {
            $baseQuery->whereIn('company_branch_id', $companyBranchIds);
        } else {
            $allCompanyBranchDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId(Auth()->user()->id);
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

    public function getExitEmployeeList($companyId)
    {
        return $this->userDetailRepository->where('company_id', $companyId)->onlyTrashed()->paginate(10);
    }

    public function searchFilterForExitEmployee($companyId, $searchKey)
    {
        $allEmployeeDetails = $this->userDetailRepository
            ->where('company_id', $companyId)
            ->onlyTrashed();
        if (!empty($searchKey['search'])) {
            $searchTerm = '%' . $searchKey['search'] . '%';
            $allEmployeeDetails = $allEmployeeDetails->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', $searchTerm)
                    ->orWhere('official_email_id', 'LIKE', $searchTerm)
                    ->orWhere('email', 'LIKE', $searchTerm)
                    ->orWhere('phone', 'LIKE', $searchTerm)
                    ->orWhere('emp_id', 'LIKE', $searchTerm);
            });
        }
        return $allEmployeeDetails->paginate(10);
    }
}
