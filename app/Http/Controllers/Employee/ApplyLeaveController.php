<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Http\Services\LeaveTypeService;
use Illuminate\Validation\ValidationException;

class ApplyLeaveController extends Controller
{

    private $leaveTypeService;
    private $leaveService;

    public function __construct(LeaveTypeService $leaveTypeService, LeaveService $leaveService)
    {
        $this->leaveTypeService = $leaveTypeService;
        $this->leaveService     = $leaveService;
    }
    public function index()
    {
        $allLeavesDetails = $this->leaveService->all();
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
                'leave_type_id'      => ['required', 'exists:leave_types,id'],
                'from'               => ['required', 'date'],
                'to'                 => ['required', 'date'],
                'is_half_day'        => ['boolean'],
                'from_half_day'      => ['required_if:is_half_day,==,1', 'in:first_half,second_half'],
                'to_half_day'        => ['required_if:from,>,to', 'in:first_half,second_half'],
                'reason'             => ['required'],

            ]);
            $data = $request->all();
            if ($this->leaveService->create($data)) {
                return redirect(route('employee.leave'))->with('success', 'Added successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
