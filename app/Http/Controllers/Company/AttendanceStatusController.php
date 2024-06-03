<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceStatusService;
use Illuminate\Support\Facades\Validator;

class AttendanceStatusController extends Controller
{

    private $attendanceStatusService;
    public function __construct(AttendanceStatusService $attendanceStatusService)
    {
        $this->attendanceStatusService = $attendanceStatusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.attendance_status.index', [
            'allAttendanceStatusDetails' => $this->attendanceStatusService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:attendance_statuses,name'],
                'required_hours' => ['required'],
            ]);
            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            if ($this->attendanceStatusService->create($data)) {
                return response()->json([
                    'message' => 'Attendance Status Created Successfully!',
                    'data'   =>  view('company.attendance_status.attendance_status_list', [
                        'allAttendanceStatusDetails' => $this->attendanceStatusService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:attendance_statuses,name,' . $request->id],
            'required_hours' => ['required'],
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->attendanceStatusService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Attendance Status Updated Successfully!',
                    'data'   =>  view('company.attendance_status.attendance_status_list', [
                        'allAttendanceStatusDetails' => $this->attendanceStatusService->all()
                    ])->render()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->attendanceStatusService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Attendance Status Deleted Successfully',
                'data'   =>  view('company.attendance_status.attendance_status_list', [
                    'allAttendanceStatusDetails' => $this->attendanceStatusService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->attendanceStatusService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
