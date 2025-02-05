<?php

namespace App\Http\Services;

use App\Models\Leave;
use Carbon\Carbon;
use App\Models\LeaveStatus;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LeaveRepository;

class LeaveService
{
    private $leaveRepository;
    private $employeeLeaveAvailableService;
    public function __construct(LeaveRepository $leaveRepository, EmployeeLeaveAvailableService $employeeLeaveAvailableService)
    {
        $this->leaveRepository = $leaveRepository;
        $this->employeeLeaveAvailableService = $employeeLeaveAvailableService;
    }
    public function all()
    {
        return $this->leaveRepository->orderBy('id', 'DESC')->paginate(10);
    }

    public function leavesByUserId($userId)
    {
        return $this->leaveRepository->where('user_id', $userId)->orderBy('id', 'DESC')->with(['leaveStatus'])->paginate(10);
    }

    public function create(array $data)
    {
        $payload = array();
        $payload =
            [
                'leave_type_id' => $data['leave_type_id'],
                'from' => $data['from'],
                'to' => $data['to'],
                'reason' => $data['reason'],
                'leave_status_id' => LeaveStatus::PENDING
            ];

        if (isset($data['leave_applied_by']) && !empty($data['leave_applied_by'])) {
            $payload['user_id'] = $data['user_id'];
        } else {
            $payload['leave_applied_by'] = Auth()->user()->company_id ?? Auth::user()->id ?? Auth()->user()->id;
            //$payload['user_id'] = Auth()->user()->company_id ?? Auth::user()->id ?? Auth()->user()->id;
            $payload['user_id'] = Auth::user()->id;

        }
        if (isset($data['is_half_day']) && !empty($data['is_half_day'])) {
            $payload['is_half_day'] = $data['is_half_day'];
            $payload['from_half_day'] = $data['from_half_day'];
            $payload['to_half_day'] = $data['to_half_day'] ?? '';
        }
        $appliedLeaveDetails = $this->leaveRepository->create($payload);
        //dd($appliedLeaveDetails);
        $response = array('status' => true, 'message' => 'Leave Apply successfully', 'data' => []);
        if ($appliedLeaveDetails) {
            $startDate = Carbon::parse($data['from']);
            $endDate = Carbon::parse($data['to']);
            $days = $startDate->diffInDays($endDate);
            $days = $days == 0 ? 1 : $days; //if applied for only one day then days diff will show 0 so
            //$data = $this->employeeLeaveAvailableService->debitLeaveDetails($payload['user_id'], $data['leave_type_id'], $days); //leave should not debit till not approved
            $data = [];
            $response = array('status' => true, 'message' => 'Leave Apply successfully', 'data' => $data);
        }
        return $response;
    }
    public function updateDetails(array $data, $id)
    {
        $existingUpdateDetails = $this->leaveRepository->find($id);
        if ($existingUpdateDetails) {
            $response = $existingUpdateDetails->update($data);
            if ($existingUpdateDetails->leave_status_id == 3 || $existingUpdateDetails->leave_status_id == 4) {
                $startDate = Carbon::parse($existingUpdateDetails->from);
                $endDate = Carbon::parse($existingUpdateDetails->to);
                $days = $startDate->diffInDays($endDate);
                $mode = "Leave Cancelled Or Rejected Reverse Leave Credit Amount";
                $response = $this->employeeLeaveAvailableService->createDetails($existingUpdateDetails->user_id, $existingUpdateDetails->leave_type_id, $days, $mode);
            }
        }
        return $response;
    }
    public function getLeaveDetailsOnlyUserId()
    {
        return $this->leaveRepository->select('id', 'user_id', 'from', 'to')->get();
    }
    public function getPendingLeavesByUserId()
    {
        return $this->leaveRepository->where('leave_status_id', 1)->select('id', 'user_id', 'from', 'to')->get();
    }
    public function getAllAppliedLeave()
    {
        return $this->leaveRepository->with(['leaveStatus:id,status,name', 'leaveType:id,name', 'leaveAppliedBy:id,name', 'leaveAction:id,leave_id,remarks,action_taken_by,leave_status_id', 'leaveAction.leaveStatus:id,name,status', 'leaveAction.actionTakenBy:id,name,email'])->where('user_id', auth()->guard('employee_api')->user()->id)->get();
    }
    public function getAppliedLeaveDetailsUsingId($id)
    {
        return $this->leaveRepository->where('id', $id)->where('leave_status_id', '!=', 3)->where('leave_status_id', '!=', 4)->first();
    }
    public function getDetailsById($id)
    {
        return $this->leaveRepository->find($id);
    }
    public function getUserConfirmLeaveByDate($id, $fromdate, $toDate = NULL)
    {
        return $this->leaveRepository->where('user_id', $id)->where('from', '<=', $fromdate)
            ->where('to', '>=', ($toDate ? $toDate : $fromdate))
            ->where('leave_status_id', 2)
            ->first();
    }
    public function checkTodayLeaveData($data)
    {
        //dd($data);
        if ($data) {
            if ($data->from == $data->to) {
                if ($data->is_half_day == 1) {
                    //dd($data);
                    if ($data->from_half_day != '') {
                        return ['success' => true, 'message' => 'Today on half day', 'status' => '1 Half'];
                    } else if ($data->to_half_day != '') {
                        return ['success' => true, 'message' => 'Today on half day', 'status' => '2 Half'];
                    } else {
                        return ['success' => true, 'message' => 'Today on leave', 'status' => 'Full'];
                    }
                } else {
                    return ['success' => true, 'message' => 'Today on leave', 'status' => 'Full'];
                }
            } else {
                if ($data->is_half_day && date('Y-m-d') == $data->from) {
                    if ($data->from_half_day != '') {
                        return ['success' => true, 'message' => 'Today on half day', 'status' => '1 Half'];
                    } else if ($data->to_half_day != '') {
                        return ['success' => true, 'message' => 'Today on half day', 'status' => '2 Half'];
                    } else {
                        return ['success' => true, 'message' => 'Today on leave', 'status' => 'Full'];
                    }
                } else if ($data->is_half_day && date('Y-m-d') == $data->to) {
                    if ($data->from_half_day != '') {
                        return ['success' => true, 'message' => 'Today on half day', 'status' => '1 Half'];
                    } else if ($data->to_half_day != '') {
                        return ['success' => true, 'message' => 'Today on half day', 'status' => '2 Half'];
                    } else {
                        return ['success' => true, 'message' => 'Today on leave', 'status' => 'Full'];
                    }
                } else {
                    return ['success' => true, 'message' => 'Today on leave', 'status' => 'Full'];
                }
            }
        } else {
            return ['success' => false, 'message' => 'Leave not available'];
        }
    }
    public function getTotalLeaveByUserIdByMonth($userId, $month, $year)
    {
        return $this->leaveRepository->getTotalLeaveByUserIDByMonth($userId, $month, $year);
    }
}
