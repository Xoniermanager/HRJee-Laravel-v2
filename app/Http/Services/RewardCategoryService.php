<?php

namespace App\Http\Services;

use App\Repositories\RewardCategoryRepository;

class RewardCategoryService
{
    private $rewardCategoryRepository;
    public function __construct(RewardCategoryRepository $rewardCategoryRepository)
    {
        $this->rewardCategoryRepository = $rewardCategoryRepository;
    }

    public function getRewardCategoryByCompanyId($companyId)
    {
        return $this->rewardCategoryRepository->where('company_id', $companyId);
    }

    public function getActiveRewardCategoryDetailByComapnyId($companyId)
    {
        return $this->rewardCategoryRepository->where('company_id', $companyId)->where('status',true);
    }

    /**
     * create function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->rewardCategoryRepository->create($data);
    }

    /**
     * updateDetails function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
    public function updateDetails(array $data, $id)
    {
        return $this->rewardCategoryRepository->find($id)->update($data);
    }

    /**
     * deleteDetails function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->rewardCategoryRepository->find($id)->delete();
    }

    /**
     * serachFilterList function
     *
     * @param [type] $request
     * @return void
     */
    public function serachFilterList($request, $companyId)
    {
        $rewardCategoryDetails = $this->rewardCategoryRepository->where('company_id', $companyId);
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $rewardCategoryDetails->where('name', 'Like', '%' . $request['search'] . '%');
        }
        /**List By Status or Filter */
        if (isset($request['status'])) {
            $rewardCategoryDetails->where('status', $request['status']);
        }
        return $rewardCategoryDetails->orderBy('id', 'DESC')->paginate(10);
    }
}
