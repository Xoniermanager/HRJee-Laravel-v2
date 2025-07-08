<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\KpiCategoryService;
use Illuminate\Support\Facades\Validator;


class KpiCategoryController extends Controller
{

    private $kpiCategoryService;
    public function __construct(KpiCategoryService $kpiCategoryService)
    {
        $this->kpiCategoryService = $kpiCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('company.kpi-category.index', [
            'kpiCategories' => $this->kpiCategoryService->all([auth()->user()->id])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCountryData = Validator::make($request->all(), [
                'name' => 'required|string|unique:kpi_categories,name',
            ]);
            if ($validateCountryData->fails()) {

                return response()->json(['error' => $validateCountryData->messages()], 400);
            }
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            if ($this->kpiCategoryService->create($data)) {

                return response()->json([
                    'message' => 'KPI Category Created Successfully!',
                    'data' => view('company.kpi-category.list', [
                        'kpiCategories' => $this->kpiCategoryService->all([auth()->user()->id])
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateCountryData = Validator::make($request->all(), [
            'name' => 'required|string|unique:kpi_categories,name,' . $request->company_id,
        ]);

        if ($validateCountryData->fails()) {

            return response()->json(['error' => $validateCountryData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->kpiCategoryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {

            return response()->json(
                [
                    'message' => 'KPI Category Updated Successfully!',
                    'data' => view('company.kpi-category.list', [
                        'kpiCategories' => $this->kpiCategoryService->all([auth()->user()->id])
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
        $data = $this->kpiCategoryService->deleteDetails($id);
        if ($data) {

            return response()->json([
                'success' => 'KPI Category Deleted Successfully',
                'data' => view('company.kpi-category.list', [
                    'kpiCategories' => $this->kpiCategoryService->all([auth()->user()->id])
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
        $statusDetails = $this->kpiCategoryService->updateDetails($data, $id);
        if ($statusDetails) {

            return response()->json([
                'success' => 'Status Updated Successfully',
                'data' => view("company.kpi-category.list", [
                    'kpiCategories' => $this->kpiCategoryService->all([auth()->user()->id])
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->kpiCategoryService->serachFilterList($request);
        if ($searchedItems) {

            return response()->json([
                'success' => 'Searching...',
                'data' => view("company.kpi-category.list", [
                    'kpiCategories' => $searchedItems
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
