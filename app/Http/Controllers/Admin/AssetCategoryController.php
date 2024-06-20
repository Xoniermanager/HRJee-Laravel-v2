<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AssetCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class AssetCategoryController extends Controller
{
    private $assetCategoryService;
    public function __construct(AssetCategoryService $assetCategoryService)
    {
        $this->assetCategoryService = $assetCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.asset_category.index', [
            'allAssetCategoryDetails' => $this->assetCategoryService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:asset_categories,name'],
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            if ($this->assetCategoryService->create($data)) {
                return response()->json([
                    'message' => 'Asset Category Created Successfully!',
                    'data'   =>  view('company.asset_category.asset_category_list', [
                        'allAssetCategoryDetails' => $this->assetCategoryService->all()
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
            'name' => ['required', 'string', 'unique:asset_categories,name,' . $request->id]
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->assetCategoryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Asset Category Updated Successfully!',
                'data'   =>  view('company.asset_category.asset_category_list', [
                    'allAssetCategoryDetails' => $this->assetCategoryService->all()
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
        $data = $this->assetCategoryService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Asset Category Deleted Successfully!',
                'data'   =>  view('company.asset_category.asset_category_list', [
                    'allAssetCategoryDetails' => $this->assetCategoryService->all()
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
        $statusDetails = $this->assetCategoryService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function serachAssetCategoryFilterList(Request $request)
    {
        $allAssetCategoryDetails = $this->assetCategoryService->serachAssetCategoryFilterList($request);
        if ($allAssetCategoryDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.asset_category.asset_category_list", compact('allAssetCategoryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
