<?php

namespace App\Http\Services;
use App\Models\User;
use App\Repositories\UserRewardRepository;

class UserRewardService
{
    private $userRewardRepository;
    public function __construct(UserRewardRepository $userRewardRepository)
    {
        $this->userRewardRepository = $userRewardRepository;
    }
    public function getUserRewardDetailsByCompanyId($companyId)
    {
        return $this->userRewardRepository->where('company_id', $companyId);
    }
    public function getUserRewardDetailsByUserId($userId)
    {
        return $this->userRewardRepository->where('user_id', $userId);
    }
    public function create($data)
    {
        $data['company_id'] = Auth()->user()->company_id;
        $data['created_by'] = Auth()->user()->id;
        $userDetails = User::find($data['user_id']);
        if (isset($data['image']) && !empty($data['image'])) {
            $data['image'] = uploadingImageorFile($data['image'], '/reward_image', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        if (isset($data['document']) && !empty($data['document'])) {
            $data['document'] = uploadingImageorFile($data['document'], '/reward_document', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        return $this->userRewardRepository->create($data);
    }

    public function getRewardDetailById($rewardId)
    {
        return $this->userRewardRepository->find($rewardId);
    }

    public function updateDetailsByRewardId($data, $rewardId)
    {
        $rewardDetails = $this->userRewardRepository->find($rewardId);
        $userDetails = User::find($data['user_id']);
        if (isset($data['image']) && !empty($data['image'])) {
            if (!empty($rewardDetails->getRawOriginal('image'))) {
                unlinkFileOrImage($rewardDetails->getRawOriginal('image'));
            }
            $data['image'] = uploadingImageorFile($data['image'], '/task_image', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        if (isset($data['document']) && !empty($data['document'])) {
            if (!empty($rewardDetails->getRawOriginal('document'))) {
                unlinkFileOrImage($rewardDetails->getRawOriginal('document'));
            }
            $data['document'] = uploadingImageorFile($data['document'], '/task_document', removingSpaceMakingName($userDetails->name) . '-' . $userDetails->id);
        }
        return $rewardDetails->update($data);
    }

    public function deleteDetails($rewardId)
    {
        $rewardDetail = $this->userRewardRepository->find($rewardId);
        if (!empty($rewardDetail->getRawOriginal('document'))) {
            unlinkFileOrImage($rewardDetail->getRawOriginal('document'));
        }
        if (!empty($rewardDetail->getRawOriginal('image'))) {
            unlinkFileOrImage($rewardDetail->getRawOriginal('image'));
        }
        return $rewardDetail->delete();
    }

    public function serachFilterList($request)
    {
        $rewardDetail = $this->userRewardRepository->where('company_id', Auth()->user()->company_id);
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $searchKey = $request['search'];
            // Searching by name or email in the related user
            $rewardDetail->whereHas('user', function ($query) use ($searchKey) {
                $query->where('name', 'like', '%' . $searchKey . '%')
                    ->orWhere('email', 'like', '%' . $searchKey . '%');
            });
        }
        /**List By Date or Filter */
        if (isset($request['date'])) {
            $rewardDetail->where('date', $request['date']);
        }
        return $rewardDetail->orderBy('id', 'DESC')->paginate(10);
    }
}
