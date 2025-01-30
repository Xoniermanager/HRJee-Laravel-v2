<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
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
            $request->validate([
                'leave_type_id' => ['required', 'exists:leave_types,id'],
                'from' => ['required', 'date'],
                'to' => ['required', 'date'],
                'is_half_day' => ['boolean'],
                'from_half_day' => ['required_if:is_half_day,==,1', 'in:first_half,second_half'],
                'to_half_day' => ['required_if:from,>,to', 'in:first_half,second_half'],
                'reason' => ['required'],

            ]);
            $data = $request->all();
            $userID = Auth()->user()->id;
            $availableLeaves = $this->employeeLeaveAvailableService->getAvailableLeaveByUserIdTypeId($userID, $data['leave_type_id']);

            if ($availableLeaves == NULL || $availableLeaves->available < 0) {
                return redirect()->back()->with('error', 'Leaves not available');
            }

            $alreadyAppliedLeave = $this->leaveService->getUserConfirmLeaveByDate($userID, $data['from'], $data['to']);
            if ($alreadyAppliedLeave) {
                return redirect()->back()->with('error', 'You have already applied leave for this date');
            }

            if ($this->leaveService->create($data)) {
                return redirect(route('employee.leave'))->with('success', 'Added successfully');
            } else {
                return redirect()->back()->with('error', 'Server error! Please try after some time.');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
