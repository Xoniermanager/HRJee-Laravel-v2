<?php

namespace App\Http\Services;

use App\Repositories\UserAssetRepository;

class UserAssetDetailService
{
    private $userAssetDetailRepository;
    private $userAssetService;
    public function __construct(UserAssetRepository $userAssetDetailRepository, AssetService $userAssetService)
    {
        $this->userAssetDetailRepository = $userAssetDetailRepository;
        $this->userAssetService = $userAssetService;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->userAssetService->all();
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $allocatedDetails = $this->userAssetDetailRepository->create($data);
        if ($allocatedDetails) {
            $updateData['allocation_status'] = "allocated";
            $this->userAssetService->updateDetails($updateData, $data['asset_id']);
        }
        return true;
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function updateDetails(array $data)
    {
        $updatedDetails =  $this->userAssetDetailRepository->find($data['id']);
        if ($updatedDetails) {
            $updateData['allocation_status'] = "available";
            $this->userAssetService->updateDetails($updateData, $updatedDetails->asset_id);
            $updatedDetails->update($data);
        }
        return true;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllAssignedAsset()
    {
        return  $this->userAssetDetailRepository->with('asset:id,name')->where('user_id', auth()->user()->id)->get();
    }
}
