<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\PolicyStoreRequest;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Http\Services\PolicyCategoryService;
use App\Http\Services\PolicyService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PolicyController extends Controller
{
    public $companyBranchService;
    public $designationService;
    public $departmentService;
    public $policyCategoryService;
    public $policyService;
    public function __construct(BranchServices $companyBranchService, DesignationServices $designationService, DepartmentServices $departmentService, PolicyCategoryService $policyCategoryService, PolicyService $policyService)
    {
        $this->companyBranchService = $companyBranchService;
        $this->designationService = $designationService;
        $this->departmentService = $departmentService;
        $this->policyCategoryService = $policyCategoryService;
        $this->policyService = $policyService;
    }
    public function index()
    {
        $companyIDs = getCompanyIDs();
        $allPolicyDetails = $this->policyService->all();
        $allPolicyCategoryDetails = $this->policyCategoryService->getAllActivePolicyCategoryUsingByCompanyID(Auth()->user()->id);
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId($companyIDs);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        return view('company.policy.index', compact('allPolicyDetails', 'allPolicyCategoryDetails', 'allCompanyBranchesDetails', 'allDepartmentsDetails'));
    }

    public function add()
    {
        $companyIDs = getCompanyIDs();
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId($companyIDs);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        $allPolicyCategoryDetails = $this->policyCategoryService->getAllActivePolicyCategoryUsingByCompanyID(Auth()->user()->id);
        return view('company.policy.add', compact('allCompanyBranchesDetails', 'allDepartmentsDetails', 'allPolicyCategoryDetails'));
    }
    public function store(PolicyStoreRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->policyService->create($data)) {
                return redirect(route('policy.index'))->with('success', 'Added successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function edit($id)
    {
        $companyIDs = getCompanyIDs();
        $editPolicyDetails = $this->policyService->findByPolicyId($id);
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId($companyIDs);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        $allPolicyCategoryDetails = $this->policyCategoryService->getAllActivePolicyCategoryUsingByCompanyID(Auth()->user()->id);
        return view('company.policy.edit', compact('editPolicyDetails', 'allCompanyBranchesDetails', 'allDepartmentsDetails', 'allPolicyCategoryDetails'));
    }
    public function view($id)
    {
        $viewPolicyDetails = $this->policyService->findByPolicyId($id);
        return view('company.policy.view', compact('viewPolicyDetails'));
    }
    public function update(PolicyStoreRequest $request, $id)
    {
        try {
            if ($this->policyService->updateDetails($request->all(), $id)) {
                return redirect(route('policy.index'))->with('success', 'Updated successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = $this->policyService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'News Deleted Successfully',
                'data' => view('company.policy.list', [
                    'allPolicyDetails' => $this->policyService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $statusDetails = $this->policyService->updateStatus($id, $request->status);
        if ($statusDetails) {
            return response()->json([
                'success' => 'News Updated Successfully',
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function serachPolicyFilterList(Request $request)
    {
        $allPolicyDetails = $this->policyService->serachPolicyFilterList($request);
        if ($allPolicyDetails) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.policy.list', [
                    'allPolicyDetails' => $allPolicyDetails
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
