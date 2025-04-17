<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\CompOffService;
use Illuminate\Http\Request;

class CompOffController extends Controller
{
    protected $compOffService;

    public function __construct(CompOffService $compOffService)
    {
        $this->compOffService = $compOffService;
    }
    public function index()
    {
        $allCompOffsDetails = $this->compOffService->getCompOffsByCompanyId(Auth()->user()->company_id)->where('is_used', 1)->where('is_used', 1)->orderBy('id')->paginate(10);

        return view('company.comp_off.index', compact('allCompOffsDetails'));
    }

    public function statusUpdateAttendanceRequest(Request $request)
    {
        $allCompOffsDetails = $this->compOffService->updateStatus($request->all());
        if ($allCompOffsDetails) {
            return response()->json([
                'status' => true,
                'message' => "Comp Off Status Updated Successfully",
                'data' => view('company.comp_off.list', [
                    'allCompOffsDetails' => $this->compOffService->getCompOffsByCompanyId(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachFilterList(Request $request)
    {
        $allCompOffsDetails = $this->compOffService->getFilteredRequestDetails($request->all());
        if ($allCompOffsDetails) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.comp_off.list', compact('allCompOffsDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
