<?php

namespace App\Http\Services;

use App\Repositories\AttendanceRequestRepository;

class AttendanceRequestService
{
    private $attendanceRequestRepository;
    private $employeeAttendanceService;
    public function __construct(AttendanceRequestRepository $attendanceRequestRepository, EmployeeAttendanceService $employeeAttendanceService)
    {
        $this->attendanceRequestRepository = $attendanceRequestRepository;
        $this->employeeAttendanceService = $employeeAttendanceService;
    }

    public function getAttendanceRequestByCompanyId($companyId)
    {
        return $this->attendanceRequestRepository->where('company_id', $companyId);
    }
    public function getAttendanceRequestByUserId($userId)
    {
        return $this->attendanceRequestRepository->where('user_id', $userId);
    }

    public function storeAttendanceRequest($data)
    {
        $data['punch_in'] = date('Y-m-d H:i:s', strtotime($data['date'] . ' ' . $data['punch_in']));
        $data['punch_out'] = date('Y-m-d H:i:s', strtotime($data['date'] . ' ' . $data['punch_out']));
        return $this->attendanceRequestRepository->create($data);
    }
    public function updateAttendanceRequest($data, $requestId)
    {
        $data['punch_in'] = date('Y-m-d H:i:s', strtotime($data['date'] . ' ' . $data['punch_in']));
        $data['punch_out'] = date('Y-m-d H:i:s', strtotime($data['date'] . ' ' . $data['punch_out']));
        return $this->attendanceRequestRepository->find($requestId)->update($data);
    }

    public function updateStatus($data)
    {
        $attendanceRequest = $this->attendanceRequestRepository->find($data['requestId']);
        if ($data['status'] == 'approved') {
            $checkAttendance = $this->employeeAttendanceService->getAttendanceByDateByUserId($attendanceRequest->user_id, $attendanceRequest->date)->first();
            if ($checkAttendance) {
                $checkAttendance->update(['punch_in' => $attendanceRequest->punch_in, 'punch_out' => $attendanceRequest->punch_out]);
            } else {
                $payload = [
                    'user_id' => $attendanceRequest->user_id,
                    'punch_in_using' => "Web",
                    'punch_in_by' => "Company",
                    "remark" => "Created By Attendance Request",
                    'punch_in' => $attendanceRequest->punch_in,
                    'punch_out' => $attendanceRequest->punch_out
                ];
                $this->employeeAttendanceService->createAttendanceByAttendanceRequest($payload);
            }
        }
        return $attendanceRequest->update(['status' => $data['status']]);
    }

    public function getFilteredRequestDetails($request)
    {
        $assetCategoryDetails = $this->attendanceRequestRepository->where('company_id', Auth()->user()->company_id);
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
        return $this->attendanceRequestRepository->find($requestId);
    }
    public function deleteAttendanceRequest($requestId)
    {
        return $this->attendanceRequestRepository->find($requestId)->delete();
    }

    public function getDetailsByUserIdByDate($userId,$date)
    {
        return $this->attendanceRequestRepository->where('company_id', Auth()->user()->company_id)->where('user_id',$userId)->where('date',$date);
    }
}
