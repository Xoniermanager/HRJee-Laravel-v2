<?php

namespace App\Http\Services;

use App\Repositories\EmployeeBreakHistoryRepository;
use Carbon\Carbon;

class EmployeeBreakHistoryService
{
    private $employeeBreakHistoryRepository;
    private $employeeAttendanceService;
    public function __construct(EmployeeBreakHistoryRepository $employeeBreakHistoryRepository,EmployeeAttendanceService $employeeAttendanceService)
    {
        $this->employeeBreakHistoryRepository = $employeeBreakHistoryRepository;
        $this->employeeAttendanceService = $employeeAttendanceService;
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function breakIn(array $data)
    {
        $data['start_time'] = date('H:i');
        return $this->employeeBreakHistoryRepository->create($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $attendanceId
     * @return void
     */
    public function getBreakHistoryByAttendanceId($attendanceId)
    {
        return $this->employeeBreakHistoryRepository->where('employee_attendance_id', $attendanceId)->whereNull('end_time')->orderBy('created_at', 'DESC')->first();
    }

    /**
     * Undocumented function
     *
     * @param [type] $breakId
     * @return void
     */
    public function breakOut($breakId)
    {
        $breakDetails = $this->employeeBreakHistoryRepository->find($breakId);
        if($breakDetails)
        {
            $this->employeeAttendanceService->updateAttendanceDetails($breakDetails,date('H:i:s'));
        }
        return $breakDetails->update(['end_time' => date('H:i')]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $attendanceId
     * @return void
     */
    public function getAllBreakHistory($attendanceId)
    {
        return $this->employeeBreakHistoryRepository->where('employee_attendance_id', $attendanceId)->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $attendanceId
     * @return void
     */
    public function getTotalBreakHour($attendanceId)
    {
        $totalSeconds = $this->employeeBreakHistoryRepository
        ->where('employee_attendance_id', $attendanceId)
        // ->whereNotNull('end_time')
        ->get()
        ->reduce(function ($carry, $break) {
            $startTime = Carbon::parse($break->created_at);
            $endTime = $break->end_time
                ? Carbon::parse($break->updated_at)
                : Carbon::now();
            $breakDuration = $startTime->diffInSeconds($endTime);
            return $carry + $breakDuration;
        }, 0);

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

}
