<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeePRMService;
use App\Http\Services\PRMCategoryService;
use Illuminate\Support\Facades\Validator;

class PRMApiController extends Controller
{
    protected $prmCategoryService;
    protected $employeePRMService;

    public function __construct(PRMCategoryService $prmCategoryService, EmployeePRMService $employeePRMService)
    {
        $this->prmCategoryService = $prmCategoryService;
        $this->employeePRMService = $employeePRMService;
    }

    public function getAllPRMCategory()
    {
        $companyId = Auth()->guard('employee_api')->user()->company_id;
        try {
            $allPRMCategories = $this->prmCategoryService->getAllActiveCategoryByCompanyID([auth()->user()->company_id]);
            return response()->json([
                'status' => true,
                'message' => 'All PRM Category',
                'data' => $allPRMCategories,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getPRMRequestDetails($prmRequestId)
    {
        try {
            $prmRequestDetail = $this->employeePRMService->findById($prmRequestId);
            return response()->json([
                'status' => true,
                'message' => 'PRM Request details',
                'data' => $prmRequestDetail,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function addPRMRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:prm_categories,id',
            'bill_date' => 'required|date',
            'amount' => 'required|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'document' => 'nullable|sometimes|file|mimes:jpg,png,jpeg,pdf',
            'remark' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($this->employeePRMService->create($data)) {
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => "PRM Request Added Successfully"
                ], 201);
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => "Please try Again"
                ], 500);
            }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
    public function updatePRMRequest(Request $request, $prmRequestId)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:prm_categories,id',
            'bill_date' => 'required|date',
            'amount' => 'required|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'document' => 'nullable|sometimes|file|mimes:jpg,png,jpeg,pdf',
            'remark' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($this->employeePRMService->update($data, $prmRequestId)) {
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => "PRM Request Updated Successfully"
                ], 201);
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => "Please try Again"
                ], 500);
            }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function deletePRMRequest($prmRequestId)
    {
        try {
            $deletedDetails = $this->employeePRMService->delete($prmRequestId);
            if ($deletedDetails) {
                return response()->json([
                    'status' => true,
                    'message' => 'PRM Request deleted successfully.',
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to delete the PRM Request. Please try again.",
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
