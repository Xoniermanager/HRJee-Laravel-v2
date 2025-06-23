<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\UserService;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\AssignTaskService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\DispositionCodeService;
use Log;

class LocationTrackingController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function sendLocations(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'locations' => 'required|array',
                'locations.*.latitude' => 'required|numeric',
                'locations.*.longitude' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 400);
            }

            $this->userService->saveCurrentLocationOfEmployee($request->get('locations'));

            return response()->json([
                'status' => true,
                'message' => 'Sent locations successfully!',
                'data' => [],
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
