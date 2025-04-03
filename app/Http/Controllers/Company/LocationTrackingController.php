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
        $allEmployees = $this->userService->getAllEmployeeUnAssignedLocationTracking(Auth()->user()->company_id)->get();
        $trackingEnabledEmployees = $this->userService->getAllEmployeeAssignedLocationTracking(Auth()->user()->company_id)->paginate(10);
        return view('company.location_tracking.index', compact('allEmployees', 'trackingEnabledEmployees'));
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
                        'trackingEnabledEmployees' => $this->userService->getAllEmployeeAssignedLocationTracking(Auth()->user()->company_id)->paginate(10)
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
            return response()->json([
                'data' => view('company.location_tracking.list', [
                    'trackingEnabledEmployees' => $this->userService->getAllEmployeeAssignedLocationTracking(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(false);
        }
    }

    public function serachFilterList(Request $request)
    {
        dd($request->all());
    }

    public function getLocations(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'date' => 'nullable|date_format:Y-m-d',
                'only_stay_point' => 'nullable|integer|in:1,0',
                'only_new_locations' => 'required|integer|in:1,0',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 400);
            }

            $locations = $this->userService->fetchLocationsOfEmployee(
                $request->get('user_id'),
                $request->get('date'),
                $request->get('only_stay_point'),
                $request->get('only_new_locations'),
            );

            return response()->json([
                'status' => true,
                'message' => 'Locations retrieved successfully!',
                'data' => $locations,
            ], 200);
        } catch (\Throwable $th) {
            // dd($th);
            if ($th instanceof HttpResponseException) {
                return $th->getResponse();
            }

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
