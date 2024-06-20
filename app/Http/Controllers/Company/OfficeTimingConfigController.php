<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\OfficeTimeConfigService;

class OfficeTimingConfigController extends Controller
{
    private $branch_services;
    private $office_time_config_service;

    public function __construct(BranchServices $branch_services, OfficeTimeConfigService $office_time_config_service)
    {
        $this->branch_services = $branch_services;
        $this->office_time_config_service = $office_time_config_service;
    }

    public function index()
    {
        $branches = $this->branch_services->all();
        $allOfficeTimeDetails = $this->office_time_config_service->all();

        return view('company.office_time_config.index', [
            'allBranch' => $branches,
            'allOfficeTimeDetails' => $allOfficeTimeDetails
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validateOfficeTimeConfig  = Validator::make($request->all(), [
                'name'            => ['required', 'string', 'unique:office_timing_configs,name'],
                'company_branch_id'         => ['required', 'exists:company_branches,id'],
                'shift_hours'     => ['required', 'string'],
                'half_day_hours'  => ['required', 'string'],
                'min_shift_Hours' => ['required', 'string'],
                'min_half_day_hours' => ['required', 'string'],
            ]);
            if ($validateOfficeTimeConfig->fails()) {
                return response()->json(['error' => $validateOfficeTimeConfig->messages()], 400);
            }
            $data = $request->all();
            if ($this->office_time_config_service->create($data)) {
                return response()->json([
                    'message' => 'Office Time Created Successfully!',
                    'data'   =>  view('company.office_time_config.office_time_list', [
                        'allOfficeTimeDetails' => $this->office_time_config_service->all()
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
        $data = $this->office_time_config_service->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Office Time Deleted Successfully',
                'data'   =>  view('company.office_time_config.office_time_list', [
                    'allOfficeTimeDetails' => $this->office_time_config_service->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function update(Request $request)
    {
        $validateOfficeTimeConfig  = Validator::make($request->all(), [
            'name'            => ['required', 'string', 'unique:office_timing_configs,name,' . $request->id],
            'company_branch_id'         => ['required', 'exists:company_branches,id'],
            'shift_hours'     => ['required', 'string'],
            'half_day_hours'  => ['required', 'string'],
            'min_shift_Hours' => ['required', 'string'],
            'min_half_day_hours' => ['required', 'string'],
        ]);

        if ($validateOfficeTimeConfig->fails()) {
            return response()->json(['error' => $validateOfficeTimeConfig->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->office_time_config_service->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Office Time Updated Successfully!',
                    'data'    =>  view('company.office_time_config.office_time_list', [
                        'allOfficeTimeDetails' => $this->office_time_config_service->all()
                    ])->render()
                ]
            );
        }
    }
    public function searchOfficeTimeFilter(Request $request)
    {
        $allOfficeTimeDetails = $this->office_time_config_service->searchOfficeTimeFilter($request);
        if ($allOfficeTimeDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view('company.office_time_config.office_time_list', compact('allOfficeTimeDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
