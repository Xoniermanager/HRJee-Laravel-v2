<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\LeaveStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class LeaveStatusController extends Controller
{
    private $leaveStatusService;
    public function __construct(LeaveStatusService $leaveStatusService)
    {
        $this->leaveStatusService = $leaveStatusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('super_admin.leave_status.index', [
            'allLeaveStatusDetails' => $this->leaveStatusService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateDetails  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:leave_statuses,name'],
            ]);

            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            if ($this->leaveStatusService->create($data)) {
                return response()->json([
                    'message' => 'Leave Type Created Successfully!',
                    'data'   =>  view('super_admin.leave_status.leave_status_list', [
                        'allLeaveStatusDetails' => $this->leaveStatusService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateDetails  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:leave_statuses,name,' . $request->id],
        ]);

        if ($validateDetails->fails()) {
            return response()->json(['error' => $validateDetails->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $leaveStatusDetails = $this->leaveStatusService->updateDetails($updateData, $request->id);
        if ($leaveStatusDetails) {
            return response()->json([
                'message' => 'Leave Type Updated Successfully!',
                'data'   =>  view('super_admin.leave_status.leave_status_list', [
                    'allLeaveStatusDetails' => $this->leaveStatusService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->leaveStatusService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Leave Type Deleted Successfully!',
                'data'   =>  view('super_admin.leave_status.leave_status_list', [
                    'allLeaveStatusDetails' => $this->leaveStatusService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error', 'Something Went Wrong! Pleaase try Again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->leaveStatusService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
