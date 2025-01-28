<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ResignationRequest;
use App\Http\Services\ResignationService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\ResignationStatusService;

class ResignationController extends Controller
{
    protected $resignationService, $resignationStatusService;

    public function __construct(ResignationService $resignationService, ResignationStatusService $resignationStatusService)
    {
        $this->resignationService = $resignationService;
        $this->resignationStatusService = $resignationStatusService;
    }

    public function index()
    {
        try {
            $userId = Auth::guard('employee_api')->user()->id;

            $canApply = $userId
                ? !$this->resignationService->getResignationByResignationStatusIds(['pending', 'hold', 'approved'], $userId)->count()
                : false;

            $data = [
                'resignations' => $this->resignationService->all($userId),
                'canApply' => $canApply,
            ];

            return response()->json([
                'status' => true,
                'message' => 'Fetched',
                'data' => $data,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function view($id)
    {
        try {
            $resignation = $this->resignationService->getResignationDetails($id);

            return response()->json([
                'status' => true,
                'message' => 'Fetched!',
                'data' => $resignation,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function apply(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'remark' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }

            $data = $request->all();
            $userId = Auth::guard('employee_api')->user()->id;

            $canApply = $userId
                ? !$this->resignationService->getResignationByResignationStatusIds(['pending', 'hold', 'approved'], $userId)->count()
                : false;

            if (!$canApply)
                return response()->json([
                    'status' => false,
                    'message' => 'Your previous resignation is still pending.'
                ], 400);

            $resignation = $this->resignationService->resignation($data, $userId);

            if ($resignation) {
                return response()->json([
                    'status' => true,
                    'message' => 'Applied!',
                    'data' => null,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something Went Wrong!',
                    'data' => null,
                ], 500);
            }

        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'remark' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }

            $data = $request->all();
            $userId = Auth::guard('employee_api')->user()->id;

            $resignation = $this->resignationService->resignationUpdate($data, $id);

            if ($resignation) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Successfully!',
                    'data' => null,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something Went Wrong!',
                    'data' => null,
                ], 500);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function withdraw($id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'remark' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }

            $data = $request->all();
            $data['status'] = 'withdrawn';
            $user = Auth::guard('employee_api')->user();

            $resignation = $this->resignationStatusService->changeStatus(
                $id,
                $data,
                $user
            );

            if ($resignation) {
                return response()->json([
                    'status' => true,
                    'message' => 'Withdrawn!',
                    'data' => null,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something Went Wrong!',
                    'data' => null,
                ], 500);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }





    public function applyResignation(ResignationRequest $request)
    {
        try {
            $data = $request->all();
            $checkStatus = $this->resignationService->resignation($data, 'employee_api');
            if ($checkStatus)
                return apiResponse(transLang('resignation_sbmitted'));
            else
                return errorMessage('null', 'something went wrong');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    public function resignationDetails(Request $request)
    {

        $this->validate($request, [
            'id' => 'required|exists:resignations,id'
        ]);
        try {
            $resignation = $this->resignationService->getResignationDetails($request->id);
            $resignation->makeHidden('created_at', 'updated_at', 'resignation_status_id', 'user_id');
            return apiResponse('resignation', $resignation);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
