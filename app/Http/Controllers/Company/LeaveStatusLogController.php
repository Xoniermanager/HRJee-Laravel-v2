<?php

namespace App\Http\Controllers\Company;

use Carbon\Carbon;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use App\Http\Services\LeaveStatusLogService;
use App\Http\Services\LeaveStatusService;
use App\Http\Services\EmployeeLeaveAvailableService;
use Illuminate\Validation\ValidationException;


class LeaveStatusLogController extends Controller
{
    private $leaveService;
    private $leaveStatusService;
    private $leaveStatusLogService;
    private $employeeLeaveAvailableService;

    public function __construct(EmployeeLeaveAvailableService $employeeLeaveAvailableService, LeaveService $leaveService, LeaveStatusService $leaveStatusService, LeaveStatusLogService $leaveStatusLogService)
    {
        $this->leaveService = $leaveService;
        $this->leaveStatusService = $leaveStatusService;
        $this->leaveStatusLogService = $leaveStatusLogService;
        $this->employeeLeaveAvailableService = $employeeLeaveAvailableService;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $leaveStatusLogDetails = $this->leaveService->all();
        // dd($leaveStatusLogDetails);
        return view('company.leave_status_log.index', compact('leaveStatusLogDetails'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function add()
    {
        $allLeaveDetails = $this->leaveService->getPendingLeavesByUserId();
        return view('company.leave_status_log.add', compact('allLeaveDetails'));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getLeaveAppliedDetailsbyId(Request $request)
    {
        $appliedLeaveDetail = $this->leaveService->getAppliedLeaveDetailsUsingId($request->leaveID);
        if (isset($appliedLeaveDetail) && !empty($appliedLeaveDetail)) {
            $halfDayValue = '';
            $fromHalfDay = '';
            $toHalfDay = '';

            if ($appliedLeaveDetail->is_half_day == 1)
                $halfDayValue = 'Yes';
            elseif ($appliedLeaveDetail->is_half_day == 0)
                $halfDayValue = 'No';
            else
                $halfDayValue;

            if ($appliedLeaveDetail->from_half_day == 'first_half')
                $fromHalfDay = 'First Half';
            elseif ($appliedLeaveDetail->from_half_day == 'second_half')
                $fromHalfDay = 'Second Half';
            else
                $fromHalfDay;


            if ($appliedLeaveDetail->to_half_day == 'first_half')
                $toHalfDay = 'First Half';
            elseif ($appliedLeaveDetail->to_half_day == 'second_half')
                $toHalfDay = 'Second Half';
            else
                $toHalfDay;

            $leaveDetailsHtml = '';
            $leaveDetailsHtml = '<div class="panel panel-body table-responsive text-center border-radiusxl">';
            $leaveDetailsHtml .= '<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-2"><tbody>';
            $leaveDetailsHtml .= '<tr><th>Applied Date</th><td>' . date('F jS, Y  h:i:s a', strtotime($appliedLeaveDetail->created_at)) . '</td></tr>';
            $leaveDetailsHtml .= '<tr><th>Leave Type</th><td>' . $appliedLeaveDetail->LeaveTypeName . '</td></tr>';
            $leaveDetailsHtml .= '<tr><th>From</th><td>' . $appliedLeaveDetail->from . '</td></tr>';
            $leaveDetailsHtml .= '<tr><th>To</th><td>' . $appliedLeaveDetail->to . '</td></tr>';
            $leaveDetailsHtml .= '<tr><th>Half Day</th><td>' . $halfDayValue . '</td></tr>';
            $leaveDetailsHtml .= '<tr><th>From Half Day</th><td>' . $fromHalfDay . '</td></tr>';
            $leaveDetailsHtml .= '<tr><th>To Half Day</th><td>' . $toHalfDay . '</td></tr>';
            $leaveDetailsHtml .= '</tbody></table></div>';
        } else {
            $leaveDetailsHtml = '<div class="panel panel-body table-responsive text-center border-radiusxl">';
            $leaveDetailsHtml .= '<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-2"><tbody>';
            $leaveDetailsHtml .= '<p>No Leave Available for Approved or Reject</p>';
            $leaveDetailsHtml .= '</tbody></table></div>';
        }
        return  $leaveDetailsHtml;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'leave_id'         => ['required', 'exists:leaves,id'],
                'leave_status_id'  => ['required', 'exists:leave_statuses,id'],
                'remarks'          => ['required', 'string'],
            ]);
            // Create lave status log
            if ($this->leaveStatusLogService->create($validated)) {
                // If approved, debit leave days
                if ($validated['leave_status_id'] == 2) {
                    $leave = $this->leaveService->getDetailsById($validated['leave_id']);

                    $startDate = Carbon::parse($leave->from);
                    $endDate   = Carbon::parse($leave->to);
                    $days      = $startDate->diffInDays($endDate);
                    $this->employeeLeaveAvailableService->debitLeaveDetails(
                        $leave->user_id,
                        $leave->leave_type_id,
                        ($days <= 0 ? 1 : $days)
                    );
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Leave status updated successfully.'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Not authorized to update leave status.'
            ], 500);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors'  => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
