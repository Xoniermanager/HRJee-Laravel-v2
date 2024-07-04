<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\PolicyCategoryService;

class PolicyCategoryController extends Controller
{

    private $policyCategoryService;
    public function __construct(PolicyCategoryService $policyCategoryService)
    {
        $this->policyCategoryService = $policyCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.policy_category.index', [
            'allPolicyCategoryDetails' => $this->policyCategoryService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:policy_categories,name'],
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            if ($this->policyCategoryService->create($data)) {
                return response()->json([
                    'message' => 'Policy Category Created Successfully!',
                    'data'   =>  view('company.policy_category.policy_category_list', [
                        'allPolicyCategoryDetails' => $this->policyCategoryService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:policy_categories,name,' . $request->id]
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->policyCategoryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Policy Category Updated Successfully!',
                'data'   =>  view('company.policy_category.policy_category_list', [
                    'allPolicyCategoryDetails' => $this->policyCategoryService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->policyCategoryService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Policy Category Deleted Successfully!',
                'data'   =>  view('company.policy_category.policy_category_list', [
                    'allPolicyCategoryDetails' => $this->policyCategoryService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error', 'Something Went Wrong! Pleaase try Again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->policyCategoryService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function serachPolicyCategoryFilterList(Request $request)
    {
        $allPolicyCategoryDetails = $this->policyCategoryService->serachPolicyCategoryFilterList($request);
        if ($allPolicyCategoryDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.policy_category.policy_category_list", compact('allPolicyCategoryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
