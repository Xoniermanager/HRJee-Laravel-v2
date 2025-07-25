<?php

namespace App\Http\Services;
use App\Http\Services\SendNotification;
use App\Repositories\LeaveStatusLogRepository;
use App\Repositories\LeaveManagerUpdateRepository;

class LeaveStatusLogService
{
    private $leaveStatusLogRepository;
    private $leaveManagerUpdateRepository;
    private $leaveService;

    public function __construct(LeaveStatusLogRepository $leaveStatusLogRepository, LeaveManagerUpdateRepository $leaveManagerUpdateRepository, LeaveService $leaveService)
    {
        $this->leaveStatusLogRepository = $leaveStatusLogRepository;
        $this->leaveManagerUpdateRepository = $leaveManagerUpdateRepository;
        $this->leaveService = $leaveService;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all()
    {
        return $this->leaveStatusLogRepository->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $user = auth()->user();
        $data['action_taken_by'] = $user->id;

        // Create leave status log
        $record = $this->leaveStatusLogRepository->create($data);

        if ($record)
        {
            // Find the leave and user who requested it
            $leave = $record->leave;
            $targetUser = $leave?->user;
            if ($targetUser && $targetUser->fcm_token) {
                $statusTitle = match ($data['leave_status_id']) {
                    '2' => 'Approved',
                    '3' => 'Rejected',
                    '4' => 'Cancelled',
                    default => 'Updated',
                };

                $title = "Leave Status {$statusTitle}";
                $body  = "Your leave request ({$leave->start_date} to {$leave->end_date}) has been {$statusTitle} by {$user->name}.";

                SendNotification::send(
                    $targetUser->fcm_token,
                    $title,
                    $body,
                    [],
                    $targetUser->id
                );
            }
            $payload = ['leave_status_id' => $data['leave_status_id']];

            if ($user->userRole->name === 'HR') {
                // HR directly updates final leave status
                return $this->leaveService->updateDetails($payload, $data['leave_id']);

            } elseif ($user->userRole->category == 'custom') {
                // Manager updates
                $update = $this->leaveManagerUpdateRepository
                    ->where('leave_id', $data['leave_id'])
                    ->where('manager_id', $user->id)
                    ->update([
                        'leave_status_id' => $data['leave_status_id'],
                        'remark' => $data['remarks'],
                    ]);

                if ($data['leave_status_id'] == '2') { // Approved
                    return $update;
                } else {
                    $this->leaveService->updateDetails($payload, $data['leave_id']);
                    return $update;
                }
            }
        }
        return false;
    }


    /**
     * Get log details by leave id
     *
     * @param [type] $id
     * @return collection
     */
    public function getDetailsByLeaveId($id)
    {
        return $this->leaveStatusLogRepository->where('leave_id', $id)->get();
    }

    /**
     * Get manager details by leave id
     *
     * @param [type] $id
     * @return collection
     */
    public function getManagerDetailsByLeaveId($id)
    {
        return $this->leaveManagerUpdateRepository->where('leave_id', $id)->get();
    }
}
