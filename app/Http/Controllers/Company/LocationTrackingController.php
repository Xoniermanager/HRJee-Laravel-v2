<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\AssignTaskService;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Repositories\UserDetailRepository;
use Illuminate\Support\Facades\Validator;

class LocationTrackingController extends Controller
{
    public $userService;
    public $userDetailRepository;
    public $employeeService;
    public $employeeAttendanceService;
    public $assignTaskService;

    public function __construct(AssignTaskService $assignTaskService, EmployeeAttendanceService $employeeAttendanceService, UserService $userService, UserDetailRepository $userDetailRepository, EmployeeServices $employeeService)
    {
        $this->userService = $userService;
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->userDetailRepository = $userDetailRepository;
        $this->employeeService = $employeeService;
        $this->assignTaskService = $assignTaskService;
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

            $assignedUserCount = $this->userDetailRepository->countOfAssignedTrackingUsers();
            $assignedLimit = auth()->user()->companyDetails->location_tracking_user_limit;

            if((count($request->user_id) + $assignedUserCount) > $assignedLimit) {
                return response()->json(['success' => false, 'message' => "Maximum user limit is $assignedLimit"], 200);
            }

            if ($this->userDetailRepository->assignedLocationTracking($request->user_id)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Assigned Location Tracking Successfully!',
                    'data' => view('company.location_tracking.list', [
                        'trackingEnabledEmployees' => $this->userService->getAllEmployeeAssignedLocationTracking(Auth()->user()->company_id)->paginate(10)
                    ])->render()
                ], 200);
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
        if($request->get('search') != "") {
            $allEmployees = $this->userService->getAllEmployeeUnAssignedLocationTracking(Auth()->user()->company_id)->where('name', 'like', '%'.$request->get('search').'%')->orWhere('email', 'like', '%'.$request->get('search').'%')->paginate(10);
        } else {
            $allEmployees = $this->userService->getAllEmployeeUnAssignedLocationTracking(Auth()->user()->company_id)->paginate(10);
        }

        return response()->json([
            'data' => view('company.location_tracking.list', [
                'trackingEnabledEmployees' => $allEmployees
            ])->render()
        ]);
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
            if ($th instanceof HttpResponseException) {
                return $th->getResponse();
            }

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function fetchCurrentLocationOfEmployees(Request $request)
    {
        try {
            $locations = $this->userService->fetchEmployeesCurrentLocation(auth()->user()->company_id);

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

    public function trackLocations(Request $request, $userID)
    {
        $date = $request->has('date') ? $request->get('date') : date("Y-m-d");
        $maxDaysUserLocation = 2;
        $user = $this->userService->getUserById($userID);
        $locationData = [];
        $attendanceDetails = $this->employeeAttendanceService->getAttendanceByDateByUserId($userID, $date)->first();
        $punchIn = null;
        $punchOut = null;
        $stayPoints = [];
        $punchOutData = [];
        $punchInData = [];
        if($attendanceDetails) {
            $punchIn = $attendanceDetails->punch_in;
            if($attendanceDetails->punch_in) {
                $punchInData[] = [
                    "latitude" => $attendanceDetails->punch_in_latitude,
                    "longitude" => $attendanceDetails->punch_in_longitude,
                    "created_at" => $attendanceDetails->created_at,
                ];
            }

            if($attendanceDetails->punch_out){
                $locations = $this->userService->fetchLocationsOfEmployee(
                    userId:$userID,
                    date: $date,
                    punchOutTime: $attendanceDetails->punch_out
                )->toArray();

                $punchOut = $attendanceDetails->punch_out;
                $punchOutData[] = [
                    "latitude" => $attendanceDetails->punch_out_latitude ?? $attendanceDetails->punch_in_latitude,
                    "longitude" => $attendanceDetails->punch_out_longitude  ?? $attendanceDetails->punch_in_longitude,
                    "created_at" => $punchOut,
                ];
            }else{
                $locations = $this->userService->fetchLocationsOfEmployee($userID, $date)->toArray();
            }

            $locationData = array_merge($punchInData, $locations, $punchOutData);
        }

        if($date == date("Y-m-d")) {
            $assignedTasks = $this->assignTaskService->getTaskByUserIdAndDateAndStatus($userID, $date, ['pending','processing', 'completed','rejected'])->get()->toArray();
        } else {
            $assignedTasks = $this->assignTaskService->getTaskByUserIdAndDateAndStatus($userID, $date, ['completed','rejected'])->get()->toArray();
        }


        foreach ($assignedTasks as $key => $value) {
			$assignedTasks[$key]["visit_coords"] = get_coordinates_from_address($value['visit_address']);
		}

        return view('company.location_tracking.user_locations', compact('punchIn', 'punchOut', 'user', 'userID', 'maxDaysUserLocation', 'locationData', 'assignedTasks', 'attendanceDetails'));
    }
}
