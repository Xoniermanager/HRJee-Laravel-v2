<?php

namespace App\Http\Controllers\Company;

use App\Models\Leave;
use App\Models\LeaveStatus;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\EmployeeServices;
use App\Http\Services\LeaveTypeService;
use Illuminate\Validation\ValidationException;

class LeaveController extends Controller
{
    private $leaveTypeService;
    private $employeeService;
    private $leaveService;

    public function __construct(LeaveTypeService $leaveTypeService, EmployeeServices $employeeService, LeaveService $leaveService)
    {
        $this->leaveTypeService = $leaveTypeService;
        $this->employeeService = $employeeService;
        $this->leaveService = $leaveService;
    }
    public function index()
    {
        $allLeavesDetails = $this->leaveService->all();
        return view('company.leave.index', compact('allLeavesDetails'));
    }

    public function applyLeave()
    {
        $leaveTypes = $this->leaveTypeService->getAllActiveLeaveType();

        // $allEmployeeDetails = $this->employeeService->all('', Auth()->user()->company_id)->paginate(10);
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->get();
        return view('company.leave.apply_leave', compact('leaveTypes', 'allEmployeeDetails'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'leave_type_id' => ['required', 'exists:leave_types,id'],
                'leave_applied_by' => ['boolean'],
                'user_id' => ['required_if:leave_applied_by,1', 'exists:users,id'],
                'from' => ['required', 'date'],
                'to' => ['required', 'date', 'after_or_equal:from'],
                'is_half_day' => ['boolean'],
                'from_half_day' => ['required_if:is_half_day,1', 'in:first_half,second_half'],
                'to_half_day' => ['required_if:is_half_day,1', 'in:first_half,second_half'],
                'reason' => ['required'],
            ]);

            $userId = $request->user_id ?? auth()->id();
            $from = $request->from; // YYYY-MM-DD
            $to = $request->to;     // YYYY-MM-DD

            // ✅ Check for existing overlapping leaves
            $overlappingLeaveExists = Leave::where('user_id', $userId)
                ->where('leave_status_id', '!=', LeaveStatus::CANCELLED)
                ->where('leave_type_id', $request->leave_type_id)
                ->where(function ($query) use ($from, $to) {
                    $query->whereBetween('from', [$from, $to])
                          ->orWhereBetween('to', [$from, $to])
                          ->orWhere(function ($q) use ($from, $to) {
                              $q->where('from', '<=', $from)->where('to', '>=', $to);
                          });
                })
                ->exists();

            if ($overlappingLeaveExists) {
                return back()->with('error', 'This user already has leave applied in the selected date range.');
            }

            // ✅ Check attendance: if user already has attendance marked (by punch_in date)
            $attendanceExists = EmployeeAttendance::where('user_id', $userId)
                ->whereBetween(DB::raw('DATE(punch_in)'), [$from, $to])
                ->exists();

            if ($attendanceExists) {
                return back()->with('error', 'Leave cannot be applied: Attendance already exists on one or more selected dates.');
            }

            // ✅ Proceed to create leave
            $data = $request->all();
            $data['user_id'] = $userId; // force set user_id in case of self leave

            if ($this->leaveService->create($data)) {
                return redirect(route('leave.index'))->with('success', 'Leave applied successfully.');
            }

            return back()->with('error', 'Failed to apply for leave.')->withInput();

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

    }
}
