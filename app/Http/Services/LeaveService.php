<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\LeaveStatus;
use App\Models\EmployeeManager;
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
        // 1️⃣ Build initial payload
        $payload = [
            'leave_type_id' => $data['leave_type_id'],
            'from' => $data['from'],
            'to' => $data['to'],
            'reason' => $data['reason'],
            'leave_status_id' => LeaveStatus::PENDING
        ];

        // handle who applied
        if (!empty($data['leave_applied_by'])) {
            $payload['user_id'] = $data['user_id'];
        } else {
            $payload['leave_applied_by'] = auth()->id();
            $payload['user_id'] = auth()->id();
        }

        // handle half day leave
        if (!empty($data['is_half_day'])) {
            $payload['is_half_day'] = $data['is_half_day'];
            $payload['from_half_day'] = $data['from_half_day'];
            $payload['to_half_day'] = $data['to_half_day'] ?? '';
        }

        // 2️⃣ Create leave entry
        $appliedLeaveDetails = $this->leaveRepository->create($payload);

        // 3️⃣ Prepare manager updates
        $leaveManagerPayload = [];
        $managers = EmployeeManager::with('user')->where('user_id', $payload['user_id'])->get();

        if ($managers->isNotEmpty()) {
            foreach ($managers as $manager) {
                $leaveManagerPayload[] = [
                    'manager_id' => $manager->manager_id,
                    'leave_id' => $appliedLeaveDetails->id,
                    'leave_status_id' => LeaveStatus::PENDING,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            $this->leaveManagerUpdateRepository->insert($leaveManagerPayload);
        }

        // 4️⃣ Build & send notifications to managers and HR
        $startDate = Carbon::parse($payload['from'])->format('d M Y');
        $endDate = Carbon::parse($payload['to'])->format('d M Y');
        $applicantName = auth()->user()->name ?? 'An employee';

        $title = "New Leave Request Applied";
        $body = "{$applicantName} applied for leave from {$startDate} to {$endDate}.";

        // send to managers if exist
        if ($managers->isNotEmpty()) {
            foreach ($managers as $manager) {
                $managerUser = $manager->manager; // get manager's user via relation
                if ($managerUser) {
                    SendNotification::send(
                        '$managerUser->fcm_token',
                        $title,
                        $body,
                        [
                            'leave_id' => $appliedLeaveDetails->id,
                            'user_id' => $payload['user_id'],
                        ],
                        $managerUser->id
                    );
                }
            }
        }

        // send to HR users if any
        $companyId = auth()->user()->company_id;

        $hrUsers = User::where('company_id', $companyId)
            ->whereHas('userRole', fn($q) => $q->where('name', 'HR'))
            ->get();

        if ($hrUsers->isNotEmpty()) {
            foreach ($hrUsers as $hr) {
                // if ($hr->fcm_token) {
                    SendNotification::send(
                        '$hr->fcm_token',
                        $title,
                        $body,
                        [
                            'leave_id' => $appliedLeaveDetails->id,
                            'user_id' => $payload['user_id'],
                        ],
                        $hr->id
                    );
                // }
            }
        }

        // 5️⃣ Calculate leave days & debit leave
        $response = ['status' => true, 'message' => 'Leave applied successfully', 'data' => []];

        if ($appliedLeaveDetails) {
            $start = Carbon::parse($data['from']);
            $end = Carbon::parse($data['to']);
            $days = $start->diffInDays($end);
            $days = ($days == 0) ? 1 : $days;

            // Debit leave balance
            $leaveDebit = $this->employeeLeaveAvailableService
                ->debitLeaveDetails($payload['user_id'], $data['leave_type_id'], $days);

            $response = ['status' => true, 'message' => 'Leave applied successfully', 'data' => $leaveDebit];
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
            // ->where('leave_type_id', $leaveTypeId)
            ->first();
    }
}
