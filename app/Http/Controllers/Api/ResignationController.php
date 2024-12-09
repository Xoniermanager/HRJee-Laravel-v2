<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResignationRequest;
use App\Http\Services\ResignationService;
use Illuminate\Http\Request;
use Throwable;

class ResignationController extends Controller
{
    protected $resignationService;
    public function __construct(ResignationService $resignationService)
    {
        $this->resignationService = $resignationService;
    }


    public function applyResignation(ResignationRequest $request)
    {
        try {
            $data = $request->all();
            $checkStatus =  $this->resignationService->resignation($data,'employee_api');
            if ($checkStatus)
                return apiResponse(transLang('resignation_sbmitted'));
            else
                return errorMessage('null',  'something went wrong');
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
            $resignation =  $this->resignationService->getResignationDetails($request->id);
           $resignation->makeHidden('created_at','updated_at','resignation_status_id','user_id');
            return apiResponse('resignation', $resignation);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
