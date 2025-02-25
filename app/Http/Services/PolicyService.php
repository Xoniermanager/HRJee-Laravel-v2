<?php

namespace App\Http\Services;

use App\Models\Policy;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PolicyRepository;
use Throwable;

class PolicyService
{
    private $policyRepository;
    private $departmentServices;
    private $companyBranchServices;
    private $designationServices;
    public function __construct(DesignationServices $designationServices, BranchServices $companyBranchServices, DepartmentServices $departmentServices, PolicyRepository $policyRepository)
    {
        $this->policyRepository = $policyRepository;
        $this->departmentServices = $departmentServices;
        $this->companyBranchServices = $companyBranchServices;
        $this->designationServices = $designationServices;
    }
    public function all()
    {
        return $this->policyRepository->orderBy('id', 'DESC')->paginate(10);
    }
    public function create(array $data)
    {
        /** for file or file Upload */
        $nameForImage = removingSpaceMakingName($data['title']);
        if ((isset($data['file']) && !empty($data['file'])) || (isset($data['image']) && !empty($data['image']))) {
            $upload_path = "/policy";
            if ($data['image']) {
                $filePath = uploadingImageorFile($data['image'], $upload_path, $nameForImage);
                $data['image'] = $filePath;
            }
            if (isset($data['file'])) {
                $filePath = uploadingImageorFile($data['file'], $upload_path, $nameForImage);
                $data['file'] = $filePath;
            }
        }
        $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
        $finalPayload['company_id'] = Auth()->user()->company_id;
        $finalPayload['created_by'] = Auth()->user()->id;
        $policyCreatedDetails = $this->policyRepository->create($finalPayload);
        if ($policyCreatedDetails) {
            $policyDetails = Policy::find($policyCreatedDetails->id);
            if ($policyCreatedDetails->all_company_branch == 0) {
                $policyDetails->companyBranches()->sync($data['company_branch_id']);
            }
            if ($policyCreatedDetails->all_department == 0) {
                $policyDetails->departments()->sync($data['department_id']);
            }
            if ($policyCreatedDetails->all_designation == 0) {
                $policyDetails->designations()->sync($data['designation_id']);
            }
        }
        return true;
    }

    public function findByPolicyId($id)
    {
        return $this->policyRepository->find($id);
    }

    public function updateDetails(array $data, $id)
    {
        $editDetails = $this->policyRepository->find($id);
        /** for file or file Upload */
        $nameForImage = removingSpaceMakingName($data['title']);
        if ((isset($data['file']) && !empty($data['file'])) || (isset($data['image']) && !empty($data['image']))) {
            $upload_path = "/policy";
            if ($data['image']) {
                if ($editDetails->image != null) {
                    unlinkFileOrImage($editDetails->image);
                }
                $filePath = uploadingImageorFile($data['image'], $upload_path, $nameForImage);
                $data['image'] = $filePath;
            }
            if (isset($data['file'])) {
                if ($editDetails->file != null) {
                    unlinkFileOrImage($editDetails->file);
                }
                $filePath = uploadingImageorFile($data['file'], $upload_path, $nameForImage);
                $data['file'] = $filePath;
            }
        }
        $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
        $policyUdatesDetails = $editDetails->update($finalPayload);
        if ($policyUdatesDetails) {
            $policyDetails = Policy::find($id);
            if ($policyDetails->all_company_branch == 0) {
                $policyDetails->companyBranches()->sync($data['company_branch_id']);
            }
            if ($policyDetails->all_department == 0) {
                $policyDetails->departments()->sync($data['department_id']);
            }
            if ($policyDetails->all_designation == 0) {
                $policyDetails->designations()->sync($data['designation_id']);
            }
            if ($policyDetails->all_company_branch == 1) {
                $policyDetails->companyBranches()->detach();
            }
            if ($policyDetails->all_department == 1) {
                $policyDetails->departments()->detach();
            }
            if ($policyDetails->all_designation == 1) {
                $policyDetails->designations()->detach();
            }
        }
        return true;
    }
    public function deleteDetails($id)
    {
        $deletedData = Policy::find($id);
        if ($deletedData->image != null || $deletedData->file != null) {
            if (isset($deletedData->file)) {
                unlinkFileOrImage($deletedData->file);
            }
            if (isset($deletedData->image)) {
                unlinkFileOrImage($deletedData->image);
            }
        }
        $deletedData->companyBranches()->detach();
        $deletedData->departments()->detach();
        $deletedData->designations()->detach();
        $deletedData->delete();
        return true;
    }
    public function updateStatus($id, $statusValue)
    {
        return $this->policyRepository->find($id)->update(['status' => $statusValue]);
    }
    public function serachPolicyFilterList($request)
    {
        $policyDetails = $this->policyRepository;
        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $policyDetails = $policyDetails->where('title', 'Like', '%' . $request->search . '%');
        }
        /**List By Status or Filter */
        if (isset($request->status)) {
            $policyDetails = $policyDetails->where('status', $request->status);
        }
        /**List By Status or Filter */
        if (isset($request->policy_category_id)) {
            $policyDetails = $policyDetails->where('policy_category_id', $request->policy_category_id);
        }
        /**List By Company Branch or Filter */
        if (isset($request->company_branch_id)) {
            $companyID = $request->company_branch_id;
            $policyDetails = Policy::wherehas(
                'companyBranches',
                function ($query) use ($companyID) {
                    $query->where('company_branch_id', $companyID);
                }
            );
        }
        /**List By Department or Filter */
        if (isset($request->department_id)) {
            $departmentId = $request->department_id;
            $policyDetails = Policy::wherehas(
                'departments',
                function ($query) use ($departmentId) {
                    $query->where('department_id', $departmentId);
                }
            );
        }
        return $policyDetails->orderBy('id', 'DESC')->paginate(10);
    }
    public function getAllAssignedPolicyForEmployee()
    {
        $userDetails = Auth()->user() ?? auth()->guard('employee_api')->user();
        $allPolicyDetails = $this->policyRepository->where('company_id', $userDetails->company_id)->where('status', 1)->where('start_date', '<=', date('Y-m-d'))
            ->where('end_date', '>=', date('Y-m-d'))->get();
        $allAssignedPolicy = [];
        foreach ($allPolicyDetails as $policyDetails) {
            $assignedCompanyBranchesIds = $this->companyBranchServices->getAllAssignedCompanyBranches($policyDetails);
            $assignedDepartmentIds = $this->departmentServices->getAllAssignedDepartment($policyDetails);
            $assignedDesignationIds = $this->designationServices->getAllAssignedDesignation($policyDetails);

            if (in_array($userDetails->details->company_branch_id, $assignedCompanyBranchesIds) && in_array($userDetails->details->department_id, $assignedDepartmentIds) && in_array($userDetails->details->designation_id, $assignedDesignationIds)) {
                $allAssignedPolicy[] = $policyDetails;
            }
        }
        return $allAssignedPolicy;
    }
}
