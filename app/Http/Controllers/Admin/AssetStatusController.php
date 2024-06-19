<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AssetStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class AssetStatusController extends Controller
{
    private $assetStatusService;
    public function __construct(AssetStatusService $assetStatusService)
    {
        $this->assetStatusService = $assetStatusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.asset_status.index', [
            'allAssetStatusDetails' => $this->assetStatusService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:asset_statuses,name'],
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->assetStatusService->create($data)) {
                return response()->json([
                    'message' => 'Asset Status Created Successfully!',
                    'data'   =>  view('company.asset_status.asset_status_list', [
                        'allAssetStatusDetails' => $this->assetStatusService->all()
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
        $validateCompanyStatus  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:asset_statuses,name,' . $request->id]
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->assetStatusService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Asset Status Updated Successfully!',
                'data'   =>  view('company.asset_status.asset_status_list', [
                    'allAssetStatusDetails' => $this->assetStatusService->all()
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
        $data = $this->assetStatusService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Asset Status Deleted Successfully!',
                'data'   =>  view('company.asset_status.asset_status_list', [
                    'allAssetStatusDetails' => $this->assetStatusService->all()
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
        $statusDetails = $this->assetStatusService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
