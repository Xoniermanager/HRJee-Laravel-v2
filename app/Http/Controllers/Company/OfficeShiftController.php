<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ShiftServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\OfficeTimeConfigService;

class OfficeShiftController extends Controller
{
    private $office_time_config_service;
    private $shift_service;

    public function __construct(OfficeTimeConfigService $office_time_config_service, ShiftServices $shift_service)
    {
        $this->office_time_config_service = $office_time_config_service;
        $this->shift_service = $shift_service;
    }


    public function index()
    {
        $allConfigTimes = $this->office_time_config_service->all();
        $allshifts = $this->shift_service->all();
        return view('company.shifts.index', ['allConfigTimes' => $allConfigTimes, 'allshifts' => $allshifts]);
    }

    public function store(Request $request)
    {
        try {
            $validateOfficeTimeConfig  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50', 'unique:shifts,name'],
                'start_time' => ['required', 'date_format:H:i'],  // Assuming the start time is in 24-hour format like "08:00"
                'end_time' => ['required', 'date_format:H:i'],  // Same assumption as start_time
                'check_in_buffer' => ['required', 'integer', 'min:0'],  // Assuming buffer time is a number (minutes)
                'check_out_buffer' => ['required', 'integer', 'min:0'],  // Same as check_in_buffer
                'login_before_shift_time' => ['required', 'integer', 'min:0'],  // Assuming it's also an integer (minutes)
                'auto_punch_out' => ['required', 'integer'],  // Assuming it's also an integer (minutes)
            ]);
            if ($validateOfficeTimeConfig->fails()) {
                return response()->json(['error' => $validateOfficeTimeConfig->messages()], 400);
            }
            $data = $request->all();
            if ($this->shift_service->create($data)) {
                return response()->json([
                    'message' => 'Shift Created Successfully!',
                    'data'   =>  view('company.shifts.shift_list', [
                        'allshifts' => $this->shift_service->all()
                    ])->render()
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->shift_service->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Office Time Deleted Successfully',
                'data'   =>  view('company.shifts.shift_list', [
                    'allshifts' => $this->shift_service->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function update(Request $request)
    {
        $validateShift  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', 'unique:shifts,name,' . $request->id],
            'start_time' => ['required', 'string'],
            'end_time'  => ['required', 'string'],
            'check_in_buffer'  => ['required', 'string'],
            'check_out_buffer' => ['required', 'string'],
            'login_before_shift_time' => ['required', 'string'],
            'auto_punch_out' => ['required', 'integer'],  // Assuming it's also an integer (minutes)
        ]);

        if ($validateShift->fails()) {
            return response()->json(['error' => $validateShift->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->shift_service->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Shift Updated Successfully!',
                    'data'    =>  view('company.shifts.shift_list', [
                        'allshifts' => $this->shift_service->all()
                    ])->render()
                ]
            );
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        if (isset($request->status)) {
            $data['status'] = $request->status;
        }
        if (isset($request->default)) {
            $data['is_default'] =  $request->default;
        }
        $statusDetails = $this->shift_service->updateDetails($data, $id);

        return response()->json($statusDetails);
    }

    public function searchShiftFilter(Request $request)
    {
        $allshifts = $this->shift_service->serachDepartmentFilterList($request);
        if ($allshifts) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view('company.shifts.shift_list', compact('allshifts'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
