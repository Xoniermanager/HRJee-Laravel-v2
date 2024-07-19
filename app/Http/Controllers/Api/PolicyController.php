<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\PolicyService;
use Illuminate\Http\Request;
use Throwable;

class PolicyController extends Controller
{
    private $policyService;
    public function __construct(PolicyService $policyService)
    {
        $this->policyService = $policyService;
    }

    public function getAllAssignedPolicy(Request $request)
    {
        try {
            $data = $this->policyService->getAllAssignedPolicies($request);
            return apiResponse('policies', $data);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
