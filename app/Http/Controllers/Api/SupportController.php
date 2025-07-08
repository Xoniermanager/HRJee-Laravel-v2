<?php

namespace App\Http\Controllers\Api;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\SupportService;

class SupportController extends Controller
{
    protected $supportService;

    public function __construct(SupportService $supportService)
    {
        $this->supportService = $supportService;
    }

    public function index()
    {
        try {
            $userId = Auth::guard('employee_api')->user()->id;

            $canApply = $userId
                ? !$this->supportService->getSupportStatusIds(['pending', 'approved'], $userId)->count()
                : false;

            $data = [
                'supports' => $this->supportService->all($userId),
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
            $support = $this->supportService->getSupportDetails($id);

            return response()->json([
                'status' => true,
                'message' => 'Fetched!',
                'data' => $support,
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
            $data = $request->all();
            $userId = Auth::guard('employee_api')->user()->id;

            $canApply = $userId
                ? !$this->supportService->getSupportStatusIds(['pending', 'approved'], $userId)->count()
                : false;

            if (!$canApply)
                return response()->json([
                    'status' => false,
                    'message' => 'Your previous support is still pending.'
                ], 400);

            $support = $this->supportService->support($data, $userId);

            if ($support) {
                return response()->json([
                    'status' => true,
                    'message' => 'Support applied successfully!',
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
            $data = $request->all();
            $support = $this->supportService->supportUpdate($data, $id);

            if ($support) {
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

    public function delete($id, Request $request)
    {
        try {
            $user = Auth::guard('employee_api')->user();
            $support = $this->supportService->deleteDetails($id);

            if ($support) {
                return response()->json([
                    'status' => true,
                    'message' => 'Support deleted!',
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

}
