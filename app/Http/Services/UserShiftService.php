<?php

namespace App\Http\Services;

use App\Repositories\UserShiftRepository;

class UserShiftService
{
    private $userShiftRepository;
    public function __construct(UserShiftRepository $userShiftRepository)
    {
        $this->userShiftRepository = $userShiftRepository;
    }

    public function getByUserId($userIDs)
    {
        return $this->userShiftRepository->whereIn('user_id', $userIDs);
    }

    public function add(array $data, $userID)
    {
        try {

            $this->deleteByUserId($userID);

            $payload = [];
            if(isAssociative($data) == true) {
                foreach($data as $day => $shifts) {
                    foreach($shifts as $shift) {
                        $payload[] = [
                            'user_id' => $userID,
                            'shift_id' => $shift,
                            'shift_day' => $day,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                    }
                }
            } else {
                foreach($data as $shift) {
                    $payload[] = [
                        'user_id' => $userID,
                        'shift_id' => $shift,
                        'shift_day' => NULL,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
            }

            $response = $this->userShiftRepository->insert($payload);
            
            return $response;
        } catch (\Exception $e) {
           
            return response()->json(['error' => 'An error occurred, please try again later.'], 400);
        }
    }

    public function deleteByUserId($userID)
    {
        $deletedData = $this->userShiftRepository->where('user_id', $userID)->delete();
        
        return $deletedData;
    }
    
}
