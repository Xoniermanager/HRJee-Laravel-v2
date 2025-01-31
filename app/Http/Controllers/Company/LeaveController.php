<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
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
       
        $allEmployeeDetails = $this->employeeService->all('', Auth()->user()->company_id)->paginate(10);
        dd($allEmployeeDetails);
        return view('company.leave.apply_leave', compact('leaveTypes', 'allEmployeeDetails'));
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'leave_type_id' => ['required', 'exists:leave_types,id'],
                'leave_applied_by' => ['boolean'],
                'user_id' => ['required_if:leave_applied_by,==,1', 'exists:users,id'],
                'from' => ['required', 'date'],
                'to' => ['required', 'date'],
                'is_half_day' => ['boolean'],
                'from_half_day' => ['required_if:is_half_day,==,1', 'in:first_half,second_half'],
                'to_half_day' => ['required_if:from,>,to', 'in:first_half,second_half'],
                'reason' => ['required'],

            ]);
            $data = $request->all();

            if ($this->leaveService->create($data)) {
                return redirect(route('leave.index'))->with('success', 'Added successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
