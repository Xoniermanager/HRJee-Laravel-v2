<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\HolidayServices;

class HolidayApiController extends Controller
{
    public $holidayService;

    public function __construct(HolidayServices $holidayService)
    {
        $this->holidayService = $holidayService;
    }
    public function list()
    {
        try {
            $companyID = auth()->guard('employee_api')->user()->company_id;
            $getHolidayList = $this->holidayService->getListByCompanyId($companyID);
            return response()->json([
                'status' => true,
                'message' => 'Retried Holiday List Successfully',
                'data' => $getHolidayList,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
