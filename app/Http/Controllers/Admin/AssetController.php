<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Services\AssetService;
use App\Http\Controllers\Controller;
use App\Jobs\EmployeeAssetExportJob;
use App\Http\Requests\AssetStoreRequest;
use App\Http\Services\AssetCategoryService;
use Illuminate\Validation\ValidationException;
use App\Http\Services\AssetManufacturerService;


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
        // $allAssetDetails = $this->assetService->all();
        $allAssetDetails = $this->assetService->allAssetWithUser();
        $allAssetCategory = $this->assetCategoryService->getAllActiveAssetCategory();
        $allAssetManufacturer = $this->assetManufacturerService->getAllActiveAssetManufacturer();
        return view('company.asset.index', compact('allAssetDetails', 'allAssetCategory', 'allAssetManufacturer'));
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
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view('company.asset.list', [
                    'allAssetDetails' => $this->assetService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachAssetFilterList(Request $request)
    {
        $allAssetDetails = $this->assetService->serachAssetFilterList($request)->paginate(10);
        if ($allAssetDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.asset.list", compact('allAssetDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function getAllAssetByCategory($id)
    {
        $allAssetDetails = $this->assetService->getAllAssetByCategoryId($id);
        if (count($allAssetDetails) > 0 && isset($allAssetDetails)) {
            $response = [
                'status'    =>  true,
                'data'      =>  $allAssetDetails
            ];
        } else {
            $response = [
                'status'    =>  false,
                'error'     => 'No Asset Found For this Category'
            ];
        }
        return json_encode($response);
    }


    public function getDashboard()
    {

        $data =    $this->assetService->all('all');
        $collectData = collect($data);
        $finalData['total_asset'] = count($data);
        $finalData['total_availble'] = $collectData->where('allocation_status', 'available')->count();
        $finalData['total_allocated'] = $collectData->where('allocation_status', 'allocated')->count();
        $finalData['total_owned'] = $collectData->where('ownership', 'owned')->count();
        $finalData['total_rented'] = $collectData->where('ownership', 'rented')->count();

        $allAssetCategory = $this->assetCategoryService->getAllActiveAssetCategoryWithAsset();
        // dd($allAssetCategory->toArray());

        $assetCategoryData = ['labels' => [], 'available' => [], 'allocated' => [], 'total' => []];
        foreach ($allAssetCategory as $key => $assetCategory) {
            $allocated = $assetCategory->assets->where('allocation_status', 'allocated')->count();
            $total = $assetCategory->assets->count();
            $available =  $assetCategory->assets->where('allocation_status', 'available')->count();
            array_push($assetCategoryData['labels'], $assetCategory->name);
            array_push($assetCategoryData['available'], $available);
            array_push($assetCategoryData['allocated'], $allocated);
            array_push($assetCategoryData['total'], $total);
        }


        return view('company.asset.dashboard', compact('finalData', 'assetCategoryData'));
    }

    public function exportAssetDetails(Request $request)
    {
        try {
            $allAssetDetails = $this->assetService->serachAssetFilterList($request)->get();
            $userEmail = "arjun@xoniertechnologies.com";
            $userName = "Xonier";
            EmployeeAssetExportJob::dispatch($userEmail, $userName, $allAssetDetails);
                return response()->json([
                    'status' => true,
                    'message' => 'The file is being processed and will be sent to your email shortly.'
                ],200);
        } catch (Exception $e) {
            Log::error('Error exporting asset details: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while processing your request. Please try again later.'
            ], 500);
        }
    }
}
