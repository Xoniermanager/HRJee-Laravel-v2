<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceRequestService;
use Illuminate\Http\Request;

class AttendanceRequestController extends Controller
{
    protected $attendanceRequestService;

    public function __construct(AttendanceRequestService $attendanceRequestService)
    {
        $this->attendanceRequestService = $attendanceRequestService;
    }
    public function index()
    {
        $allAttendanceDetails = $this->attendanceRequestService->getAttendanceRequestByCompanyId(Auth()->user()->company_id)->orderBy('id')->paginate(10);
        return view('company.attendance_request.index', compact('allAttendanceDetails'));
    }

    public function statusUpdateAttendanceRequest(Request $request)
    {
        $allAttendanceDetails = $this->attendanceRequestService->updateStatus($request->all());
        if ($allAttendanceDetails) {
            return response()->json([
                'status' => true,
                'message' => "Attendance Request Status Updated Successfully",
                'data' => view('company.attendance_request.list', [
                    'allAttendanceDetails' => $this->attendanceRequestService->getAttendanceRequestByCompanyId(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachFilterList(Request $request)
    {
        $allAttendanceDetails = $this->attendanceRequestService->getFilteredRequestDetails($request->all());
        if ($allAttendanceDetails) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.attendance_request.list', compact('allAttendanceDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
