<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Services\AttendanceRequestService;

class AttendanceRequestController extends Controller
{
    protected $attendanceRequestService;
    public function __construct(AttendanceRequestService $attendanceRequestService)
    {
        $this->attendanceRequestService = $attendanceRequestService;
    }
    public function index()
    {
        $allAttendanceRequest = $this->attendanceRequestService->getAttendanceRequestByUserId(Auth()->user()->id)->paginate(10);
        return view('employee.attendance_request.index', compact('allAttendanceRequest'));
    }
    public function add()
    {
        return view('employee.attendance_request.add');
    }
    public function store(AttendanceRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth()->user()->id;
            $data['company_id'] = Auth()->user()->company_id;
            $data['created_by'] = Auth()->user()->id;
            $exists = $this->attendanceRequestService->getDetailsByUserIdByDate($data['user_id'],$data['date'])->exists();
            if ($exists) {
                return back()->with('error', 'A request already exists for this date.');
            }
            if ($this->attendanceRequestService->storeAttendanceRequest($data)) {
                return redirect(route('employee.attendance.request.index'))->with('success', 'Attendance Request Added successfully');
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function edit($requestId)
    {
        $editDetails = $this->attendanceRequestService->getRequestDetailsByRequestId($requestId);
        return view('employee.attendance_request.edit', compact('editDetails'));
    }

    public function update(AttendanceRequest $request, $requestId)
    {
        try {
            $data = $request->all();
            $exists = $this->attendanceRequestService->getDetailsByUserIdByDate( Auth()->user()->id,$data['date'])->exists();
            if ($exists) {
                return back()->with('error', 'A request already exists for this date.');
            }
            if ($this->attendanceRequestService->updateAttendanceRequest($data, $requestId)) {
                return redirect(route('employee.attendance.request.index'))->with('success', 'Attendance Request Updated successfully');
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        if ($this->attendanceRequestService->deleteAttendanceRequest($request->id)) {
            $allAttendanceRequest = $this->attendanceRequestService->getAttendanceRequestByUserId(Auth()->user()->id)->paginate(10);
            return response()->json([
                'success' => 'Attendance Request Deleted Successfully',
                'data' => view('employee.attendance_request.list',compact('allAttendanceRequest'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function serachFilterList(Request $request)
    {
        $allAttendanceRequest = $this->attendanceRequestService->getFilteredRequestDetails($request->all());
        if ($allAttendanceRequest) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('employee.attendance_request.list', compact('allAttendanceRequest'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
