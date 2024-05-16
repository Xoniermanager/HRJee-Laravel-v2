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
        return view('company.shifts.index',['allConfigTimes'=> $allConfigTimes,'allshifts' => $allshifts]);
    }

    public function store(Request $request)
    {
        try {
            $validateOfficeTimeConfig  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:shifts,name'],
                'start_time' => ['required', 'string'],
                'end_time'  => ['required', 'string'],
                'check_in_buffer'  => ['required', 'string'],
                'check_out_buffer' => ['required', 'string'],
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
                'data'   =>  view('company.shifts.shift_list',[
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
            'name' => ['required', 'string' ,'unique:shifts,name,'. $request->id],
            'start_time' => ['required', 'string'],
            'end_time'  => ['required', 'string'],
            'check_in_buffer'  => ['required', 'string'],
            'check_out_buffer' => ['required', 'string'],
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
        $data['status'] = $request->status;
        $statusDetails = $this->shift_service->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }


}
