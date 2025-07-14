<?php

namespace App\Http\Services;

use Carbon\Carbon;
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

    public function getTodaysShifts($userId, $shiftType)
    {
        if($shiftType == "single") {
            return $this->userShiftRepository->where('user_id', $userId);
        } else {
            $today = date('l');
            return $this->userShiftRepository->where('user_id', $userId)->where('shift_day', $today);
        }
    }

    public function isUserAllowedToPunchIn($shifts)
    {
        $now = Carbon::now();
        $message = null;

        foreach ($shifts as $shift) {
            $start = Carbon::parse($shift->start_time);
            $end = Carbon::parse($shift->end_time);

            // Night shift handling
            if ($end <= $start) {
                $end->addDay();
            }

            $earlyWindow = $start->copy()->subMinutes($shift->check_in_buffer); // minutes before shift

            if ($now->between($earlyWindow, $end)) {
                return [
                    'in_shift' => true,
                    'officeShift' => $shift,
                    'start' => $start,
                    'end' => $end,
                    'message' => $message
                ];
            }

            $message = "You can only punch in within $shift->check_in_buffer minutes before your shift start time.";
        }

        return ['in_shift' => false, 'message' => $message];
    }





}
