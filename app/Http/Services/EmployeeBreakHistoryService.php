<?php

namespace App\Http\Services;

use App\Repositories\EmployeeBreakHistoryRepository;

class EmployeeBreakHistoryService
{
    private $employeeBreakHistoryRepository;
    public function __construct(EmployeeBreakHistoryRepository $employeeBreakHistoryRepository)
    {
        $this->employeeBreakHistoryRepository = $employeeBreakHistoryRepository;
    }
    public function breakIn(array $data)
    {
        $data['start_time'] = date('h:i');
        return $this->employeeBreakHistoryRepository->create($data);
    }
    public function getBreakHistoryByAttendanceId($attendanceId)
    {
        return $this->employeeBreakHistoryRepository->where('employee_attendance_id', $attendanceId)->whereNull('end_time')->orderBy('created_at', 'DESC')->first();
    }
    public function breakOut($breakId)
    {
        return $this->employeeBreakHistoryRepository->find($breakId)->update(['end_time' => date('h:i')]);
    }
    public function getAllBreakHistory($attendanceId)
    {
        return $this->employeeBreakHistoryRepository->where('employee_attendance_id', $attendanceId)->orderBy('created_at', 'DESC')->get();
    }
}
