<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\SalaryComponentService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserCtcDetailService;
use App\Models\SalaryComponentAssignment;
use App\Models\UserCtcHistory;
use Illuminate\Http\Request;
use Exception;


class UserCtcDetailsController extends Controller
{
    private $userCtcDetailsService;
    private $salaryComponentService;
    public function __construct(UserCtcDetailService $userCtcDetailsService, SalaryComponentService $salaryComponentService)
    {
        $this->userCtcDetailsService = $userCtcDetailsService;
        $this->salaryComponentService = $salaryComponentService;
    }

    public function store(Request $request)
    {
        try {
            $validateDetails = Validator::make($request->all(), [
                'ctc_value' => 'required',
                'salary_id' => 'required|exists:salaries,id',
                'effective_date' => 'required',
                'componentDetails' => 'required|array',
                'componentDetails.*.salary_component_id' => 'required|numeric|exists:salary_components,id',
                'componentDetails.*.value' => 'required|numeric',
                'componentDetails.*.earning_or_deduction' => 'required|in:earning,deduction',
                'componentDetails.*.value_type' => 'required|in:fixed,percentage',
                'componentDetails.*.parent_component' => ['nullable', 'sometimes', 'exists:salary_components,id'],
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            if ($this->userCtcDetailsService->create($data)) {
                return response()->json([
                    'message' => 'CTC Details Added Successfully! Please Continue',
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function getComponentsDetail(Request $request)
    {
        $allComponentDetails = SalaryComponentAssignment::where('salary_id', $request->salary_id)->get();
        $userCtcHistorydetails = UserCtcHistory::where('salary_id', $request->salary_id)
            ->with('userCtcComponentHistory')
            ->orderBy('effective_date', 'DESC')
            ->limit(1)
            ->first();
        if ($userCtcHistorydetails) {
            $assignedComponentIds = $userCtcHistorydetails->userCtcComponentHistory->pluck('salary_component_id')->toArray();
            $allComponentDetails = $userCtcHistorydetails->userCtcComponentHistory->merge(
                $allComponentDetails->filter(function ($component) use ($assignedComponentIds) {
                    if (!in_array($component->salary_component_id, $assignedComponentIds)) {
                        return $assignedComponentIds;
                    };
                })->values()
            );
        }
        $basicDetails = $this->salaryComponentService->getBasicPayDetails(Auth()->user()->company_id);
        return response()->json([
            'data' => view('company.employee.component_list', [
                'allSalaryComponentDetails' => $allComponentDetails,
                'basicDetails' => $basicDetails,
            ])->render()
        ]);
    }
}
