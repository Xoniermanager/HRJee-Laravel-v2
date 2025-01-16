<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveCreditManagementRequest;
use App\Http\Services\BranchServices;
use App\Http\Services\LeaveTypeService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeTypeService;
use App\Http\Services\LeaveCreditManagementServices;

class LeaveCreditManagementController extends Controller
{
    public $companyBranchesService;
    public $employeeTypeService;
    public $leaveTypeService;
    public $leaveCreditManagementService;
    public function __construct(BranchServices $companyBranchesService, EmployeeTypeService $employeeTypeService, LeaveTypeService $leaveTypeService, LeaveCreditManagementServices $leaveCreditManagementService)
    {
        $this->companyBranchesService = $companyBranchesService;
        $this->employeeTypeService    = $employeeTypeService;
        $this->leaveTypeService    = $leaveTypeService;
        $this->leaveCreditManagementService    = $leaveCreditManagementService;
    }

    public function index()
    {
        $allLeaveCreditDetails = $this->leaveCreditManagementService->all();
        $allCompanyBranches = $this->companyBranchesService->all(Auth()->guard('company')->user()->company_id);
        $allEmployeeType = $this->employeeTypeService->getAllActiveEmployeeType();
        $allLeaveType = $this->leaveTypeService->getAllActiveLeaveType();
        return view('company.leave_credit_management.index', compact('allCompanyBranches', 'allEmployeeType', 'allLeaveType', 'allLeaveCreditDetails'));
    }

    public function store(LeaveCreditManagementRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->leaveCreditManagementService->create($data)) {
                return response()->json([
                    'message' => 'Leave Credit Created Successfully!',
                    'data'   =>  view("company.leave_credit_management.leave_credit_list", [
                        'allLeaveCreditDetails' => $this->leaveCreditManagementService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
    public function update(LeaveCreditManagementRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->leaveCreditManagementService->updateDetails($data)) {
                return response()->json([
                    'message' => 'Leave Credit Updated Successfully!',
                    'data'   =>  view("company.leave_credit_management.leave_credit_list", [
                        'allLeaveCreditDetails' => $this->leaveCreditManagementService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->leaveCreditManagementService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Leave Credit Deleted Successfully',
                'data'   =>  view("company.leave_credit_management.leave_credit_list", [
                    'allLeaveCreditDetails' => $this->leaveCreditManagementService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $data['status'] = $request->status;
        $data['id'] = $request->id;
        $statusDetails = $this->leaveCreditManagementService->updateDetails($data);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function serachLeaveCreditFilterList(Request $request)
    {
        $allLeaveCreditDetails = $this->leaveCreditManagementService->serachLeaveCreditFilterList($request);
        if ($allLeaveCreditDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'    => view("company.leave_credit_management.leave_credit_list", compact('allLeaveCreditDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
