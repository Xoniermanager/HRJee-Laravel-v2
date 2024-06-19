<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetStoreRequest;
use App\Http\Services\AssetCategoryService;
use App\Http\Services\AssetManufacturerService;
use App\Http\Services\AssetService;
use App\Http\Services\AssetStatusService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AssetController extends Controller
{
    public $assetCategoryService;
    public $assetManufacturerService;
    public $assetService;

    public function __construct(AssetCategoryService $assetCategoryService, AssetManufacturerService $assetManufacturerService, AssetService $assetService)
    {
        $this->assetCategoryService = $assetCategoryService;
        $this->assetManufacturerService = $assetManufacturerService;
        $this->assetService = $assetService;
    }
    public function index()
    {
        $allAssetDetails = $this->assetService->all();
        return view('company.asset.index', compact('allAssetDetails'));
    }
    public function add()
    {
        $allAssetCategory = $this->assetCategoryService->getAllActiveAssetCategory();
        $allAssetManufacturer = $this->assetManufacturerService->getAllActiveAssetManufacturer();
        return view('company.asset.add', compact('allAssetCategory', 'allAssetManufacturer'));
    }

    public function store(AssetStoreRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->assetService->create($data)) {
                return redirect(route('asset.index'))->with('success', 'Added successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $editAssetDetails = $this->assetService->findDetailsById($id);
        $allAssetCategory = $this->assetCategoryService->getAllActiveAssetCategory();
        $allAssetManufacturer = $this->assetManufacturerService->getAllActiveAssetManufacturer();
        return view('company.asset.update', compact('editAssetDetails', 'allAssetCategory', 'allAssetManufacturer'));
    }

    public function update(AssetStoreRequest $request, $id)
    {
        try {
            $data = $request->all();
            if ($this->assetService->updateDetails($data, $id)) {
                return redirect(route('asset.index'))->with('success', 'Updated successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->assetService->deleteDetails($id);
        if ($data) {
            return response()->json(['success' => 'Asset Deleted Successfully!']);
        } else {
            return response()->json(['error', 'Something Went Wrong! Pleaase try Again']);
        }
    }
}
