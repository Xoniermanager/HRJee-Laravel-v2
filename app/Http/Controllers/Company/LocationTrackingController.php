<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Repositories\UserDetailRepository;
use Illuminate\Support\Facades\Validator;

class LocationTrackingController extends Controller
{
    public $userService;
    public $userDetailRepository;
    public $employeeService;

    public function __construct(UserService $userService, UserDetailRepository $userDetailRepository, EmployeeServices $employeeService)
    {
        $this->userService = $userService;
        $this->userDetailRepository = $userDetailRepository;
        $this->employeeService = $employeeService;
    }
    public function index()
    {
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->paginate(10);
        $employeeDetails = $this->userService->getAllEmployeeUnAssignedLocationTracking(Auth()->user()->company_id)->get();
        return view('company.location_tracking.index', compact('employeeDetails', 'allEmployeeDetails'));
    }

    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'user_id' => 'required|array',
                'user_id.*' => 'required|exists:users,id'
            ]);
            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            if ($this->userDetailRepository->assignedLocationTracking($request->user_id)) {
                return response()->json([
                    'message' => 'Assigned Location Tracking Successfully!',
                    'data' => view('company.location_tracking.list', [
                        'allEmployeeDetails' => $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->paginate(10)
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function updateLocationTrackingStatus(Request $request)
    {
        $statusDetails = $this->userDetailRepository->updateLocationTrackingStatus($request->status, $request->userId);
        if ($statusDetails) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function serachFilterList(Request $request)
    {
        dd($request->all());
    }
}
