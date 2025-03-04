<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\HolidayServices;

class HolidayController extends Controller
{
    public $holidayService;

    public function __construct(HolidayServices $holidayService)
    {
        $this->holidayService = $holidayService;
    }
    
    public function getHolidays(Request $request)
    {
        try {
            $companyIDs = [];
            $companyIDs[] = auth()->user()->company_id;
            if(auth()->user()->type == 'user') {
                $companyIDs[] = auth()->user()->id;
            }
            $month = $request->has('month') ? $request->get('month') : NULL;
            $date = $request->has('date') ? $request->get('date') : NULL;

            $getHolidayList = $this->holidayService->getListByCompanyId($companyIDs, date('Y'), $month, $date);

            return response()->json([
                'status' => true,
                'message' => NULL,
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
