<?php

namespace App\Http\Services;

use App\Repositories\CompOffRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class CompOffService
{
    private $compOffRepository;
    private $userRepository;

    public function __construct(UserRepository $userRepository, CompOffRepository $compOffRepository)
    {
        $this->compOffRepository = $compOffRepository;
        $this->userRepository = $userRepository;
    }

    public function getCompOffsByCompanyId($companyId)
    {
        $userIDs = $this->userRepository->where('company_id', $companyId)->pluck('id')->toArray();

        return $this->compOffRepository->whereIn('user_id', $userIDs)->with('user');
    }

    public function getCompOffByUserId($userId)
    {
        return $this->compOffRepository->where('user_id', $userId);
    }

    public function store($data)
    {
        return $this->compOffRepository->create($data);
    }

    public function useCompOff($data) {

        $compOffs = $this->compOffRepository->where('user_id', $data['user_id'])->where('is_used', 0)->orderBy('id', 'ASC')->limit($data['days_difference'])->get();
        
        $date = Carbon::parse($data['start_date']);
        
        foreach ($compOffs as $compOff) {
            // Update record with the next date
            $compOff->update([
                'is_used' => 1,
                'used_date' => $date->format('Y-m-d'),
                'status'   => 'pending',
                'user_remark'   => $data['user_remark'],
            ]);

            // Increment date for the next record
            $date->modify('+1 day');
        }

        return true;
    }

    public function updateStatus($data)
    {
        $attendanceRequest = $this->compOffRepository->find($data['requestId']);
        
        return $attendanceRequest->update(['status' => $data['status']]);
    }

    public function getFilteredRequestDetails($request)
    {
        $userIDs = $this->userRepository->where('company_id', Auth()->user()->company_id)->pluck('id')->toArray();

        $assetCategoryDetails = $this->compOffRepository->whereIn('user_id', $userIDs)->where('is_used', 1);
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $searchKey = $request['search'];
            // Searching by name or email in the related user
            $assetCategoryDetails->whereHas('user', function ($query) use ($searchKey) {
                $query->where('name', 'like', '%' . $searchKey . '%')
                    ->orWhere('email', 'like', '%' . $searchKey . '%');
            });
        }
        /**List By Status or Filter */
        if (isset($request['status'])) {
            $assetCategoryDetails = $assetCategoryDetails->where('status', $request['status']);
        }
        return $assetCategoryDetails->orderBy('id', 'DESC')->paginate(10);
    }

    public function getRequestDetailsByRequestId($requestId)
    {
        return $this->compOffRepository->find($requestId);
    }

    public function deleteCompOff($requestId)
    {
        return $this->compOffRepository->where('id', $requestId)->update([
            'is_used' => 0,
            'used_date' => NULL,
            'status'   => NULL,
            'user_remark'   => NULL,
            'admin_remark' => NULL
        ]);
    }
}
