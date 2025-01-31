<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\LeaveTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class LeaveTypeController extends Controller
{
    private $leaveTypeService;
    public function __construct(LeaveTypeService $leaveTypeService)
    {
        $this->leaveTypeService = $leaveTypeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.leave_type.index', [
            'allLeaveTypeDetails' => $this->leaveTypeService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateDetails  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:leave_types,name'],
            ]);

            if ($validateDetails->fails()) {
                return response()->json(['error' => $validateDetails->messages()], 400);
            }
            $data = $request->all();
            if ($this->leaveTypeService->create($data)) {
                return response()->json([
                    'message' => 'Leave Type Created Successfully!',
                    'data'   =>  view('admin.leave_type.leave_type_list', [
                        'allLeaveTypeDetails' => $this->leaveTypeService->all()
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
            'name' => ['required', 'string', 'unique:leave_types,name,'.$request->id],
        ]);

        if ($validateDetails->fails()) {
            return response()->json(['error' => $validateDetails->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $updatedDetails = $this->leaveTypeService->updateDetails($updateData, $request->id);
        if ($updatedDetails) {
            return response()->json([
                'message' => 'Leave Type Updated Successfully!',
                'data'   =>  view('admin.leave_type.leave_type_list', [
                    'allLeaveTypeDetails' => $this->leaveTypeService->all()
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
        $data = $this->leaveTypeService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Leave Type Deleted Successfully!',
                'data'   =>  view('admin.leave_type.leave_type_list', [
                    'allLeaveTypeDetails' => $this->leaveTypeService->all()
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
        $statusDetails = $this->leaveTypeService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
