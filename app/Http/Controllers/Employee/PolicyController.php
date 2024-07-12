<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\PolicyService;
use Illuminate\Http\Request;

class PolicyController extends Controller
{

    protected $policyService;
    public function __construct(PolicyService $policyService)
    {
        $this->policyService = $policyService;
    }
    public function index(Request $request)
    {
        $user = auth()->guard('employee')->user();
        $data = $this->policyService->getAllAssignedPolicies($user);
        return view('employee.policy.index', compact('data'));
    }
}
