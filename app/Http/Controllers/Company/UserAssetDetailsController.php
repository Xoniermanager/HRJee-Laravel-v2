<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\AssetService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserAssetDetailService;
use Throwable;
use App\Http\Services\EmployeeServices;
use Illuminate\Support\Facades\Storage;

class UserAssetDetailsController extends Controller
{

    private $userAssetService;
    private $userAssetDetailService;
    private $assetService;
    public function __construct(AssetService $assetService, UserAssetDetailService $userAssetService,UserAssetDetailService $userAssetDetailService)
    {
        $this->userAssetService = $userAssetService;
        $this->assetService = $assetService;
        $this->userAssetDetailService = $userAssetDetailService;
    }

    public function store(Request $request)
    {
        try {
            $validateDetails  = Validator::make($request->all(), [
                'asset_category_id'  => ['required', 'exists:asset_categories,id'],
                'asset_id'           => ['required', 'exists:assets,id'],
                'assigned_date'      => ['required', 'date']
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->except('asset_category_id', '_token');
            if ($this->userAssetService->create($data)) {
                $userAssetsDetails = User::find($request->user_id)->load('assetDetails');
                return response()->json([
                    'message' => 'Asset Details Added Successfully! Please Continue',
                    'data'   =>  view("company.employee.asset_management.list", [
                        'userAssetsDetails' =>  $userAssetsDetails['assetDetails'],
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
    public function updateDetails(Request $request)
    {
        try {
            $validateDetails  = Validator::make($request->all(), [
                'returned_date'      => ['required', 'date'],
                'comment'            => ['nullable']
            ]);
            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            if ($this->userAssetService->updateDetails($request->all())) {
                $userAssetsDetails = User::find($request->user_id)->load('assetDetails');
                return response()->json([
                    'message' => 'Updated Successfully',
                    'data'   =>  view("company.employee.asset_management.list", [
                        'userAssetsDetails' =>  $userAssetsDetails['assetDetails'],
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
