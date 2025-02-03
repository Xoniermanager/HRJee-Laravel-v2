<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CancelResignationRequest;
use App\Http\Requests\ChangeResignationStatusRequest;
use App\Http\Services\ResignationService;
use App\Http\Services\ResignationStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ResignationController extends Controller
{
    protected $resignationStatusService;
    protected $resignationService;
    public function __construct(ResignationService $resignationService, ResignationStatusService $resignationStatusService)
    {
        $this->resignationService = $resignationService;
        $this->resignationStatusService = $resignationStatusService;
    }

    public function index()
    {
        $resignationStatus = $this->resignationStatusService->all('all');
        $userId = auth()->user()->type == 'user' ? auth()->user()->id : '';
        $resignations = $this->resignationService->all($userId);
        $canApply = $userId
            ? !$this->resignationService->getResignationByResignationStatusIds(['pending', 'hold', 'approved'], $userId)->count()
            : false;

        return view('employee.resignation.index', compact('resignations', 'resignationStatus', 'canApply'));
    }

    public function applyResignation(Request $request)
    {
        try {
            DB::beginTransaction();
            $userId = Auth()->user()->id;
            $data = $request->all();

            $canApply = $userId
                ? !$this->resignationService->getResignationByResignationStatusIds(['pending', 'hold', 'approved'], $userId)->count()
                : false;

            if (!$canApply)
                return errorMessage('null', 'Your previous resignation is still pending.');

            $checkStatus = $this->resignationService->resignation($data, $userId);
            if ($checkStatus) {
                $resignations = $this->resignationService->all($userId);
                $data = view('employee.resignation.resignation-list', compact('resignations'))->render();
                DB::commit();
                return apiResponse('resignation_sbmitted', $data);
            } else {
                DB::rollBack();
                return errorMessage('null', 'something went wrong');
            }
        } catch (Throwable $th) {
            DB::rollBack();
            return exceptionErrorMessage($th);
        }
    }

    public function editResignation($id, Request $request)
    {
        try {
            $authUser = Auth()->user();
            $userType = $authUser?->role?->name;
            $userId = $authUser?->id;
            $data = $request->all();

            $checkStatus = $this->resignationService->resignationUpdate($data, $id);
            if ($checkStatus) {
                $data = view('employee.resignation.resignation-list', [
                    'resignations' => $this->resignationService->all($userId)
                ])->render();
                return apiResponse('resignation_updated', $data);
            } else
                return errorMessage('null', 'something went wrong');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    public function view($id, Request $request)
    {
        try {
            $id = $request->id;
            $resignation = $this->resignationService->getResignationDetails($id);
            $resignation->makeHidden('created_at', 'updated_at', 'resignation_status_id', 'user_id');
            return view('employee.resignation.view', compact('resignation'));
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    public function changeStatus($id, ChangeResignationStatusRequest $request)
    {
        try {
            $data = $request->validated();
            $action_taken_by = Auth()->user();

            $resignationStatus = $this->resignationStatusService->changeStatus(
                $id,
                $data,
                $action_taken_by
            );

            if ($resignationStatus) {
                $data = view('employee.resignation.resignation-list', [
                    'resignations' => $this->resignationService->all(),
                ])->render();
                return apiResponse('Status Changed', $data);
            } else {
                return errorMessage('null', 'Failed to change status');
            }
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }





    public function destroy(Request $request)
    {
        $userType = Auth()->user()->userDetails->roles->name;
        $id = $request->id;
        $data = $this->resignationService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Resignation Deleted Successfully',
                'data' => view('employee.resignation.resignation-list', [
                    'resignations' => $this->resignationService->all(),
                    'userType' => $userType
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function actionResignation(ChangeResignationStatusRequest $request)
    {
        try {

            $data = $request->validated();
            $userType = Auth()->user()->userDetails->roles->name;

            if ($userType == 'Employee')
                $data['resignation_status_id'] = 4;

            if ($userType != 'Employee' && $data['resignation_status_id'] == 4) {
                return errorMessage('', 'you have not permission to cancel resignation');
            }

            $data['action_taken_by'] = Auth()->user()->id;
            $resignationStatus = $this->resignationStatusService->changeStatus($data, $userType);
            if ($resignationStatus['status'] == true) {
                $data = view('employee.resignation.resignation-list', [
                    'resignations' => $this->resignationService->all(),
                    'userType' => $userType
                ])->render();
                return apiResponse($resignationStatus['msg'], $data);
            } elseif ($resignationStatus['status'] == false) {
                return errorMessage('null', $resignationStatus['msg']);
            }
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
