<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CancelResignationRequest;
use App\Http\Requests\ChangeResignationStatusRequest;
use App\Http\Services\ResignationService;
use App\Http\Services\ResignationStatusService;
use Illuminate\Http\Request;
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
        $resignationStatus =  $this->resignationStatusService->all('all');
        $userType = auth()->guard('employee')->user()->role->name;
        $userId = $userType == 'Employee' ? auth()->guard('employee')->user()->id : '';
        $resignations =   $this->resignationService->all($userId);
        $checkResignations =   $this->resignationService->getResignationByResigtionStatusIds([1, 3, 5], $userId);

        $applyStatus = count($checkResignations) > 0 ? 1 : 0;
        return view('employee.resignation.index', compact('resignations', 'applyStatus', 'userType', 'resignationStatus'));
    }



    public function destroy(Request $request)
    {
        $userType = auth()->guard('employee')->user()->userDetails->roles->name;
        $id = $request->id;
        $data = $this->resignationService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Resignation Deleted Successfully',
                'data'    =>  view('employee.resignation.resignation-list', [
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
            $userType = auth()->guard('employee')->user()->userDetails->roles->name;

            if ($userType == 'Employee')
                $data['resignation_status_id'] = 4;

            if ($userType != 'Employee' && $data['resignation_status_id'] == 4) {
                return errorMessage('', 'you have not permission to cancel resignation');
            }

            $data['action_taken_by'] = auth()->guard('employee')->user()->id;
            $resignationStatus =  $this->resignationStatusService->changeStatus($data, $userType);
            if ($resignationStatus['status'] == true) {
                $data =  view('employee.resignation.resignation-list', [
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


    public function applyResignation(Request $request)
    {
        try {
            $userType = auth()->guard('employee')->user()->userDetails->roles->name;
            $userId = $userType == 'Employee' ? auth()->guard('employee')->user()->id : '';
            $data = $request->all();
            $checkStatus =  $this->resignationService->resignation($data, 'employee');
            if ($checkStatus) {
                $data =  view('employee.resignation.resignation-list', [
                    'resignations' => $this->resignationService->all($userId),
                    'userType' => $userType
                ])->render();
                return apiResponse('resignation_sbmitted', $data);
            } else
                return errorMessage('null',  'something went wrong');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function editResignation(Request $request)
    {
        try {
            $userType = auth()->guard('employee')->user()->userDetails->roles->name;
            $userId = $userType == 'Employee' ? auth()->guard('employee')->user()->id : '';
            $data = $request->except('_token', 'id');
            $checkStatus =  $this->resignationService->resignationUpdate($data, $request->id);
            if ($checkStatus) {
                $data =  view('employee.resignation.resignation-list', [
                    'resignations' => $this->resignationService->all($userId)
                ])->render();
                return apiResponse('resignation_updated', $data);
            } else
                return errorMessage('null',  'something went wrong');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }


    public function view(Request $request)
    {
        try {
            $resignationId = $request->id;
            $resignation =  $this->resignationService->getResignationDetails($resignationId);
            $resignation->makeHidden('created_at', 'updated_at', 'resignation_status_id', 'user_id');
            return view('employee.resignation.view', compact('resignation'));
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
