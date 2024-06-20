<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AssetManufacturerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class AssetManufacturerController extends Controller
{
    private $assetManufacturerService;
    public function __construct(AssetManufacturerService $assetManufacturerService)
    {
        $this->assetManufacturerService = $assetManufacturerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.asset_manufacturer.index', [
            'allAssetManufacturerDetails' => $this->assetManufacturerService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:asset_manufacturers,name'],
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            if ($this->assetManufacturerService->create($data)) {
                return response()->json([
                    'message' => 'Asset Manufacturer Created Successfully!',
                    'data'   =>  view('company.asset_manufacturer.asset_manufacturer_list', [
                        'allAssetManufacturerDetails' => $this->assetManufacturerService->all()
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
            'name' => ['required', 'string', 'unique:asset_manufacturers,name,' . $request->id]
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->assetManufacturerService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Asset Manufacturer Updated Successfully!',
                'data'   =>  view('company.asset_manufacturer.asset_manufacturer_list', [
                    'allAssetManufacturerDetails' => $this->assetManufacturerService->all()
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
        $data = $this->assetManufacturerService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Asset Manufacturer Deleted Successfully!',
                'data'   =>  view('company.asset_manufacturer.asset_manufacturer_list', [
                    'allAssetManufacturerDetails' => $this->assetManufacturerService->all()
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
        $statusDetails = $this->assetManufacturerService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function serachAssetManufacturerFilterList(Request $request)
    {
        $allAssetManufacturerDetails = $this->assetManufacturerService->serachAssetManufacturerFilterList($request);
        if ($allAssetManufacturerDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.asset_manufacturer.asset_manufacturer_list", compact('allAssetManufacturerDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
