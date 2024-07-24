<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Services\PolicyService;

class PolicyController extends Controller
{
    private $policyService;
    public function __construct(PolicyService $policyService)
    {
        $this->policyService = $policyService;
    }
    public function allAssignedPolicy()
    {
        try {
            $allAssignedPolicy = $this->policyService->getAllAssignedPolicyForEmployee();
            $assinedPolicyPayload = [];
            foreach ($allAssignedPolicy as $assignedpolicy) {
                $assinedPolicyPayload[] =
                    [
                        'id' => $assignedpolicy->id,
                        'date' =>  date('j F,Y', strtotime($assignedpolicy->start_date)),
                        'title' => $assignedpolicy->title,
                        'image' => $assignedpolicy->image,
                        'policy_Category' => $assignedpolicy->policyCategories->name
                    ];
            }
            return response()->json([
                'status' => true,
                'message' => 'Retried Policy List Successfully',
                'data' => $assinedPolicyPayload,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function viewPolicyDetails($id)
    {
        try {
            $policyDetails = $this->policyService->findByPolicyId($id);
            $viewPolicyDetails =
                [
                    'date' =>  date('j F,Y', strtotime($policyDetails->start_date)),
                    'title' => $policyDetails->title,
                    'image' => $policyDetails->image,
                    'policy_Category' => $policyDetails->policyCategories->name,
                    'description' => $policyDetails->description,
                    'file' => $policyDetails->file
                ];
            return response()->json([
                'status' => true,
                'message' => 'Retried Policy Details Successfully',
                'data' => $viewPolicyDetails,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
