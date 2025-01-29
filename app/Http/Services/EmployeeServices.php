<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

use App\Mail\ResetPassword;
use App\Models\UserCode;
use Illuminate\Support\Facades\Hash;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EmployeeServices
{
    private $employeeRepository;

    private $companyBranchService;
    private $departmentService;
    private $designationService;

    public function __construct(EmployeeRepository $employeeRepository, BranchServices $companyBranchService, DepartmentServices $departmentService, DesignationServices $designationService)
    {
        $this->employeeRepository = $employeeRepository;
        $this->companyBranchService = $companyBranchService;
        $this->departmentService = $departmentService;
        $this->designationService = $designationService;
    }
    public function all($request = null, $companyId)
    {
        $allEmployeeDetails = $this->employeeRepository->where('company_id', $companyId);
        // //List Selected by Gender
        if (isset($request->gender) && !empty($request->gender)) {
            $allEmployeeDetails = $allEmployeeDetails->where('gender', $request->gender);
        }
        // //List Selected by Emp Status
        if (isset($request->emp_status_id) && !empty($request->emp_status_id)) {
            $allEmployeeDetails = $allEmployeeDetails->where('employee_status_id', $request->emp_status_id);
        }
        //List Selected by Marrital Status
        if (isset($request->marital_status) && !empty($request->marital_status)) {
            $allEmployeeDetails = $allEmployeeDetails->where('marital_status', $request->marital_status);
        }

        //List Selected by Employee Type
        if (isset($request->emp_type_id) && !empty($request->emp_type_id)) {
            $allEmployeeDetails = $allEmployeeDetails->where('employee_type_id', '=', $request->emp_type_id);
        }

        //List Selected by Department
        if (isset($request->department_id) && !empty($request->department_id)) {
            $allEmployeeDetails = $allEmployeeDetails->where('department_id', '=', $request->department_id);
        }
        //List Selected by Shift
        if (isset($request->shift_id) && !empty($request->shift_id)) {
            $allEmployeeDetails = $allEmployeeDetails->where('shift_id', '=', $request->shift_id);
        }
        //List Selected by Branch
        if (isset($request->branch_id) && !empty($request->branch_id)) {
            $allEmployeeDetails = $allEmployeeDetails->where('company_branch_id', '=', $request->branch_id);
        }
        //List Selected by Qualification
        if (isset($request->qualification_id) && !empty($request->qualification_id)) {
            $allEmployeeDetails = $allEmployeeDetails->where('qualification_id', '=', $request->qualification_id);
        }
        //List Selected by Skill Id
        if (isset($request->skill_id) && !empty($request->skill_id)) {
            $skillId = $request->skill_id;
            $allEmployeeDetails = $allEmployeeDetails->whereHas(
                'skill',
                function ($query) use ($skillId) {
                    $query->where('skill_id', '=', $skillId);
                }
            );
        }
        //List Search Operation
        if (isset($request->search) && !empty($request->search)) {
            $searchKeyword = $request->search;
            $allEmployeeDetails = $allEmployeeDetails->where('name', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('official_email_id', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('email', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('phone', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('emp_id', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('father_name', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('mother_name', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('offer_letter_id', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('official_mobile_no', 'Like', '%' . $searchKeyword . '%');
        }
        // added relationship data
        return $allEmployeeDetails->with(['addressDetails', 'addressDetails.country', 'addressDetails.state', 'bankDetails'])->orderBy('id', 'DESC');
    }
    public function create($data)
    {
        if (isset($data['profile_image']) && !empty($data['profile_image'])) {
            $data['profile_image'] = uploadingImageorFile($data['profile_image'], '/user_profile', removingSpaceMakingName($data['name']));
        }
        $data['last_login_ip'] = request()->ip();
        if ($data['id'] !== null) {
            $existingDetails = $this->employeeRepository->find($data['id']);
            if ($existingDetails->profile_image != null) {
                unlinkFileOrImage($existingDetails->profile_image);
            }
            if (isset($data['skill_id']) && !empty($data['skill_id'])) {
                $existingDetails->skill()->sync($data['skill_id']);
                $this->syncEmployeeLanguages($existingDetails, $data['language']);
            }
            $existingDetails->update($data);
        } else {
            $data['company_id'] = Auth()->user()->company_id;
            $data['password'] = Hash::make($data['password'] ?? 'password');
            $createData = $this->employeeRepository->create($data);
            $createData->skill()->sync($data['skill_id']);
            $this->syncEmployeeLanguages($createData, $data['language']);
        }
        if (isset($createData)) {
            $status = 'createData';
            $id = $createData->id;
        }
        $response =
            [
                'status' => $status ?? 'updateData',
                'id' => $id ?? ''
            ];
        return $response;
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
        return $this->employeeRepository->find($id);
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
        return $this->employeeRepository->where('company_id', $companyId);
    }
    public function getDetailsByCompanyBranchEmployeeType($companyBranchId, $employeeTypeId)
    {
        return $this->employeeRepository->where('company_branch_id', $companyBranchId)->where('employee_type_id', $employeeTypeId)->select('id', 'joining_date')->get();
    }
    public function getAllUserByCompanyBranchIdsAndDepartmentIdsAndDesignationIds($companyBranchIds, $departmentIds = null, $designationIds = null, $allCompanyBranches = null, $allDepartment = null, $allDesignation = null)
    {
        $allCompanyDepartment = $this->departmentService->getAllDepartmentsByCompanyId();
        $allDepartmentIds = $allCompanyDepartment->pluck('id');
        $selectedDepartments = $allDepartmentIds;
        $baseQuery = $this->employeeRepository;

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
        return $this->employeeRepository->where('company_id', $companyId)->where('name', 'Like', '%' . $searchKey . '%')->orWhere('emp_id', 'Like', '%' . $searchKey . '%');
    }
    public function getExitEmployeeList($companyId)
    {
        return $this->employeeRepository->where('company_id', $companyId)->onlyTrashed()->paginate(10);
    }

    public function searchFilterForExitEmployee($companyId, $searchKey)
    {
        $allEmployeeDetails = $this->employeeRepository
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
