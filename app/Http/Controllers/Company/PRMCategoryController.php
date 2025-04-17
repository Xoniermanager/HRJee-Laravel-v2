<?php

namespace App\Http\Controllers\Company;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Services\PRMCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PRMCategoryController extends Controller
{
    //
    private $prmCategoryService;
    public function __construct(PRMCategoryService $prmCategoryService)
    {
        $this->prmCategoryService = $prmCategoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.prm_category.index', [
            'allPRMCategoryDetails' => $this->prmCategoryService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:prm_categories,name,NULL,id,company_id,' . auth()->user()->company_id],
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            $payload = $request->except(['_token']);
            if ($this->prmCategoryService->create($payload)) {
                return response()->json([
                    'message' => 'PRM Category Created Successfully!',
                    'data'   =>  view('company.prm_category.prm_category_list', [
                        'allPRMCategoryDetails' => $this->prmCategoryService->all()
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
            'name' => ['required', 'string', 'unique:prm_categories,name,' . $request->id . ',id,company_id,' . auth()->user()->company_id]
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->prmCategoryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'PRM Category Updated Successfully!',
                'data'   =>  view('company.prm_category.prm_category_list', [
                    'allPRMCategoryDetails' => $this->prmCategoryService->all()
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
        $data = $this->prmCategoryService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'PRM Category Deleted Successfully!',
                'data'   =>  view('company.prm_category.prm_category_list', [
                    'allPRMCategoryDetails' => $this->prmCategoryService->all()
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
        $statusDetails = $this->prmCategoryService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function searchPRMCategoryFilterList(Request $request)
    {
        $allNewsCategoryDetails = $this->prmCategoryService->searchPRMCategoryFilterList($request);
        if ($allNewsCategoryDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.prm_category.prm_category_list", compact('allPRMCategoryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
