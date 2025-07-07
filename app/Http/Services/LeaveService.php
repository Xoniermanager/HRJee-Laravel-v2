<?php

namespace App\Http\Services;

use App\Models\Leave;
use Carbon\Carbon;
use App\Models\LeaveStatus;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LeaveRepository;
use App\Repositories\LeaveManagerUpdateRepository;

class LeaveService
{
    private $leaveRepository;
    private $leaveManagerUpdateRepository;
    private $employeeLeaveAvailableService;
    public function __construct(LeaveRepository $leaveRepository, EmployeeLeaveAvailableService $employeeLeaveAvailableService, LeaveManagerUpdateRepository $leaveManagerUpdateRepository)
    {
        $this->leaveRepository = $leaveRepository;
        $this->leaveManagerUpdateRepository = $leaveManagerUpdateRepository;
        $this->employeeLeaveAvailableService = $employeeLeaveAvailableService;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->leaveRepository->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param [type] $userId
     * @return void
     */
    public function leavesByUserId($userId)
    {
        return $this->leaveRepository->where('user_id', $userId)->orderBy('id', 'DESC')->with(['leaveStatus', 'leaveType'])->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void/object/null
     */
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

        $leaveManagerPayload = [];
        $managers = auth()->user()->managers;
        foreach ($managers as $manager) {
            $leaveManagerPayload[] = [
                'manager_id' => $manager->manager_id,
                'leave_id' => $appliedLeaveDetails->id,
                'leave_status_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->leaveManagerUpdateRepository->insert($leaveManagerPayload);

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

    /**
     * Undocumented function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
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

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getLeaveDetailsOnlyUserId()
    {
        return $this->leaveRepository->select('id', 'user_id', 'from', 'to')->get();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getPendingLeavesByUserId()
    {
        return $this->leaveRepository->where('leave_status_id', 1)->select('id', 'user_id', 'from', 'to')->get();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllAppliedLeave()
    {
        return $this->leaveRepository->with(['leaveStatus:id,status,name', 'leaveType:id,name', 'leaveAppliedBy:id,name', 'leaveAction:id,leave_id,remarks,action_taken_by,leave_status_id', 'leaveAction.leaveStatus:id,name,status', 'leaveAction.actionTakenBy:id,name,email'])->where('user_id', auth()->guard('employee_api')->user()->id)->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function getAppliedLeaveDetailsUsingId($id)
    {
        return $this->leaveRepository->where('id', $id)->where('leave_status_id', '!=', 3)->where('leave_status_id', '!=', 4)->first();
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function getDetailsById($id)
    {
        return $this->leaveRepository->find($id);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param [type] $fromdate
     * @param [type] $toDate
     * @return void
     */
    public function getUserConfirmLeaveByDate($id, $fromdate, $toDate = NULL)
    {
        return $this->leaveRepository->where('user_id', $id)->where('from', '<=', $fromdate)
            ->where('to', '>=', ($toDate ? $toDate : $fromdate))
            ->where('leave_status_id', 2)
            ->first();
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
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

    /**
     * Undocumented function
     *
     * @param [type] $userId
     * @param [type] $month
     * @param [type] $year
     * @return void
     */
    public function getTotalLeaveByUserIdByMonth($userId, $month, $year, $returnLeaveDetails = 0)
    {
        return $this->leaveRepository->getTotalLeaveByUserIDByMonth($userId, $month, $year, $returnLeaveDetails);
    }

    /**
     * Undocumented function
     *
     * @param [type] $date
     * @param [type] $userID
     * @return void
     */
    public function getConfirmedLeaveByUserIDAndDate($date, $userID)
    {
        return $this->leaveRepository->where('user_id', $userID)->where('from', '<=', $date)
            ->where('to', '>=', $date)
            ->where('leave_status_id', 2)
            ->first();
    }

    public function getConfirmedLeaveByUserID($userID)
    {
        return $this->leaveRepository->where('user_id', $userID)
            ->where('leave_status_id', 2)->with('user');
    }

    public function getUserAppliedLeaveByDate($id, $fromdate, $toDate = NULL)
    {
        return $this->leaveRepository->where('user_id', $id)->where('from', '<=', $fromdate)
            ->where('to', '>=', ($toDate ? $toDate : $fromdate))
            // ->where('leave_status_id', 2)
            ->first();
    }
}
