<?php

namespace App\Http\Services;

use App\Repositories\UserCtcDetailRepository;

class UserCtcDetailService
{
    private $userCtcDetailsRepository;
    public function __construct(UserCtcDetailRepository $userCtcDetailsRepository)
    {
        $this->userCtcDetailsRepository = $userCtcDetailsRepository;
    }

    public function create(array $data)
    {
        $user_id = $data['user_id'];
        $userCtcDetails = $this->userCtcDetailsRepository->where('user_id', $user_id)->first();
        if ($userCtcDetails) {
            if (!$userCtcDetails->isDirty('ctc_value')) {
                $userCtcDetails->createCtcHistory($data['ctc_value'], $data['effective_date'], $data['componentDetails']);
            }
            return $userCtcDetails->update($data);
        } else {
            $userCtcDetails = $this->userCtcDetailsRepository->create($data);
            $userCtcDetails->createCtcHistory($data['ctc_value'], $data['effective_date'], $data['componentDetails']);
            return $userCtcDetails;
        }
    }
    public function getDetailById($id)
    {
        return $this->userCtcDetailsRepository->where('user_id', $id)->first();
    }
}
