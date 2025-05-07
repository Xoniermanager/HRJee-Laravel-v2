<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PerformanceCategoryService;
use Illuminate\Support\Facades\Validator;


class PerformanceCategoryController extends Controller
{

    private $performanceCategoryService;
    public function __construct(PerformanceCategoryService $performanceCategoryService)
    {
        $this->performanceCategoryService = $performanceCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('company.performance-category.index', [
            'performanceCategories' => $this->performanceCategoryService->all([auth()->user()->id])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCountryData  = Validator::make($request->all(), [
                'name' => 'required|string|unique:countries,name',
            ]);
            if ($validateCountryData->fails()) {

                return response()->json(['error' => $validateCountryData->messages()], 400);
            }
            $data = $request->all();
            $data['company_id'] = auth()->user()->id;
            if ($this->performanceCategoryService->create($data)) {

                return response()->json([
                    'message' => 'Category Created Successfully!',
                    'data'   =>  view('company.performance-category.list', [
                        'performanceCategories' => $this->performanceCategoryService->all([auth()->user()->id])
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateCountryData  = Validator::make($request->all(), [
            'name' => 'required|string|unique:performance_categories,name,' . $request->company_id,
        ]);

        if ($validateCountryData->fails()) {

            return response()->json(['error' => $validateCountryData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->performanceCategoryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {

            return response()->json(
                [
                    'message' => 'Category Updated Successfully!',
                    'data'   =>  view('company.performance-category.list', [
                        'performanceCategories' => $this->performanceCategoryService->all([auth()->user()->id])
                    ])->render()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->performanceCategoryService->deleteDetails($id);
        if ($data) {

            return response()->json([
                'success' => 'Category Deleted Successfully',
                'data'   =>  view('company.performance-category.list', [
                    'performanceCategories' => $this->performanceCategoryService->all([auth()->user()->id])
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->performanceCategoryService->updateDetails($data, $id);
        if ($statusDetails) {

            return response()->json([
                'success' => 'Status Updated Successfully',
                'data'   =>  view("company.performance-category.list", [
                    'performanceCategories' => $this->performanceCategoryService->all([auth()->user()->id])
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->performanceCategoryService->serachFilterList($request);
        if ($searchedItems) {

            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view("company.performance-category.list", [
                    'performanceCategories' => $searchedItems
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
