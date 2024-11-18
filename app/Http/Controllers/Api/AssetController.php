<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\UserAssetDetailService;
use Illuminate\Support\Facades\Request;
use Throwable;

class AssetController extends Controller
{
    private $userAssetDetailService;
    public function __construct(UserAssetDetailService $userAssetDetailService)
    {
        $this->userAssetDetailService = $userAssetDetailService;
    }

    public function assetDetails(Request $request)
    {
        try {
            $assets = $this->userAssetDetailService->getAllAssignedAsset();
            $assets->makeHidden(['user_id','asset_id','created_at','updated_at']);

            return apiResponse('success', $assets);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
