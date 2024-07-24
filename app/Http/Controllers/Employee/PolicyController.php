<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\PolicyService;

class PolicyController extends Controller
{
    public $policyService;

    public function __construct(PolicyService $policyService)
    {
        $this->policyService = $policyService;
    }
    public function index()
    {
        $allAssignPolicyDetails = $this->policyService->getAllAssignedPolicyForEmployee();
        return view('employee.policy.index', compact('allAssignPolicyDetails'));
    }
    public function viewDetails($id)
    {
        $policyDetails = $this->policyService->findByPolicyId($id);
        $allAssignPolicyDetails = $this->policyService->getAllAssignedPolicyForEmployee();
        return view('employee.policy.details', compact('policyDetails','allAssignPolicyDetails'));
    }
}
