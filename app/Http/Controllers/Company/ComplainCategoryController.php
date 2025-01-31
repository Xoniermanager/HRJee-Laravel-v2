<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\ComplainCategoryService;

class ComplainCategoryController extends Controller
{
    private $complainCategoryService;
    public function __construct(ComplainCategoryService $complainCategoryService)
    {
        $this->complainCategoryService = $complainCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.complain_category.index', [
            'allComplainCategoryDetails' => $this->complainCategoryService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'description' => ['nullable','string']
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            if ($this->complainCategoryService->create($data)) {
                return response()->json([
                    'message' => 'Complain Category Created Successfully!',
                    'data'   =>  view('company.complain_category.complain_category_list', [
                        'allComplainCategoryDetails' => $this->complainCategoryService->all()
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
            'name' => ['required', 'string'],
            'description' => ['string']
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->complainCategoryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Complain Category Updated Successfully!',
                'data'   =>  view('company.complain_category.complain_category_list', [
                    'allComplainCategoryDetails' => $this->complainCategoryService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = $this->complainCategoryService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Complain Category Deleted Successfully!',
                'data'   =>  view('company.complain_category.complain_category_list', [
                    'allComplainCategoryDetails' => $this->complainCategoryService->all()
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
        $statusDetails = $this->complainCategoryService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function serachComplainCategoryFilterList(Request $request)
    {
        $allComplainCategoryDetails = $this->complainCategoryService->serachComplainCategoryFilterList($request);
        if ($allComplainCategoryDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.complain_category.complain_category_list", compact('allComplainCategoryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
