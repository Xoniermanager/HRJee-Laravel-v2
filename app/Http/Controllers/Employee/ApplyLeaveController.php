<?php

namespace App\Http\Controllers\Employee;

use App\Models\Leave;
use App\Models\LeaveStatus;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Http\Services\LeaveTypeService;
use Illuminate\Validation\ValidationException;
use App\Http\Services\EmployeeLeaveAvailableService;

class ApplyLeaveController extends Controller
{

    private $leaveTypeService;
    private $leaveService;
    private $employeeLeaveAvailableService;

    public function __construct(EmployeeLeaveAvailableService $employeeLeaveAvailableService, LeaveTypeService $leaveTypeService, LeaveService $leaveService)
    {
        $this->leaveTypeService = $leaveTypeService;
        $this->leaveService = $leaveService;
        $this->employeeLeaveAvailableService = $employeeLeaveAvailableService;
    }
    public function index()
    {
        $allLeavesDetails = $this->leaveService->leavesByUserId(Auth()->user()->id);
        return view('employee.leave.index', compact('allLeavesDetails'));
    }

    public function applyLeave()
    {
        $leaveTypes = $this->leaveTypeService->getAllActiveLeaveType();
        return view('employee.leave.apply_leave', compact('leaveTypes'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'leave_type_id' => ['required', 'exists:leave_types,id'],
                'from'          => ['required', 'date'],
                'to'            => ['required', 'date'],
                'is_half_day'   => ['nullable', 'boolean'],
                'from_half_day' => ['required_if:is_half_day,1', 'in:first_half,second_half'],
                'to_half_day'   => ['nullable', 'in:first_half,second_half'],
                'reason'        => ['required', 'string'],
            ]);

            $userId = auth()->id(); // or Auth::id();
            $from = $data['from'];
            $to   = $data['to'];

            // ✅ Check for overlapping leaves
            $overlappingLeaveExists = Leave::where('user_id', $userId)
                ->where('leave_status_id', '!=', LeaveStatus::CANCELLED)
                ->where('leave_type_id', $data['leave_type_id'])
                ->where(function ($query) use ($from, $to) {
                    $query->whereBetween('from', [$from, $to])
                          ->orWhereBetween('to', [$from, $to])
                          ->orWhere(function ($q) use ($from, $to) {
                              $q->where('from', '<=', $from)->where('to', '>=', $to);
                          });
                })
                ->exists();

            if ($overlappingLeaveExists) {
                return back()->with('error', 'You already have leave applied in the selected date range.');
            }

            // ✅ Check if attendance already exists
            $attendanceExists = EmployeeAttendance::where('user_id', $userId)
                ->whereBetween(DB::raw('DATE(punch_in)'), [$from, $to])
                ->exists();

            if ($attendanceExists) {
                return back()->with('error', 'Leave cannot be applied: attendance already exists on selected dates.');
            }

            // ✅ Check leave balance
            $availableLeaves = $this->employeeLeaveAvailableService->getAvailableLeaveByUserIdTypeId($userId, $data['leave_type_id']);
            if (!$availableLeaves || $availableLeaves->available <= 0) {
                return back()->with('error', 'No available leaves left.');
            }

            // ✅ Check if already applied for the same date
            $alreadyApplied = $this->leaveService->getUserConfirmLeaveByDate($userId, $from, $to);
            if ($alreadyApplied) {
                return back()->with('error', 'You have already applied leave for this date.');
            }

            // ✅ Create leave
            if ($this->leaveService->create($data)) {
                return redirect()->route('employee.leave')->with('success', 'Leave applied successfully.');
            } else {
                return back()->with('error', 'Server error! Please try again later.');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log error (optional)
            return back()->with('error', 'Unexpected error: ' . $e->getMessage())->withInput();
        }

    }
}
