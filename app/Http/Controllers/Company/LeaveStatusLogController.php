<?php

namespace App\Http\Controllers\Company;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use App\Http\Services\LeaveStatusLogService;
use App\Http\Services\LeaveStatusService;
use Illuminate\Validation\ValidationException;


class LeaveStatusLogController extends Controller
{
    private $leaveService;
    private $leaveStatusService;
    private $leaveStatusLogService;

    public function __construct(LeaveService $leaveService, LeaveStatusService $leaveStatusService, LeaveStatusLogService $leaveStatusLogService)
    {
        $this->leaveService = $leaveService;
        $this->leaveStatusService = $leaveStatusService;
        $this->leaveStatusLogService = $leaveStatusLogService;
    }
    public function index()
    {
        $leaveStatusLogDetails = $this->leaveStatusLogService->all();
        return view('company.leave_status_log.index',compact('leaveStatusLogDetails'));
    }
    public function add()
    {
        $allLeaveDetails = $this->leaveService->getLeaveDetailsOnlyUserId();
        $allLeaveStatusDetails = $this->leaveStatusService->getAllActiveLeaveStatus()->where('id', '!=', '1');
        return view('company.leave_status_log.add', compact('allLeaveDetails', 'allLeaveStatusDetails'));
    }
    public function getLeaveAppliedDetailsbyId(Request $request)
    {
        $appliedLeaveDetail = $this->leaveService->getAppliedLeaveDetailsUsingId($request->leaveID);

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

        return  $leaveDetailsHtml;
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'leave_id'             => ['required', 'exists:leaves,id'],
                'leave_status_id'      => ['required', 'exists:leave_statuses,id'],
                'remarks'               => ['required'],

            ]);
            $data = $request->all();
            if ($this->leaveStatusLogService->create($data)) {
                return redirect(route('leave.status.log.index'))->with('success', 'Updated successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
