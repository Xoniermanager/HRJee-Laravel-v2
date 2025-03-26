<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompOffRequest;
use App\Http\Services\CompOffService;

class CompOffController extends Controller
{
    protected $compOffService;
    public function __construct(CompOffService $compOffService)
    {
        $this->compOffService = $compOffService;
    }

    public function index()
    {
        $allCompOffs = $this->compOffService->getCompOffByUserId(Auth()->user()->id)->where('is_used', 1)->paginate(10);

        return view('employee.comp_off.index', compact('allCompOffs'));
    }

    public function add()
    {
        $balanceCompOff = $this->compOffService->getCompOffByUserId(Auth()->user()->id)->where('is_used', 0)->count();

        return view('employee.comp_off.add', compact('balanceCompOff'));
    }
    
    public function store(CompOffRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth()->user()->id;

            $date1 = Carbon::parse($data['start_date']);
            $date2 = Carbon::parse($data['end_date']);
            $daysDifference = $date1->diffInDays($date2);
            $getBalanceCompOff = $this->compOffService->getCompOffByUserId($data['user_id'])->where('is_used', 0)->count();
            
            if($daysDifference > $getBalanceCompOff) {

                return back()->with('error', 'Your balance comp off is '. $getBalanceCompOff);

            }

            $data['days_difference'] = $daysDifference + 1;
            $data['end_date'] = $data['end_date'] ? $data['end_date'] : $data['start_date'];
            
            if ($this->compOffService->useCompOff($data)) {
                return redirect(route('employee.comp.off.index'))->with('success', 'Comp off applied successfully');

            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        if ($this->compOffService->deleteAttendanceRequest($request->id)) {
            $allCompOffs = $this->compOffService->getCompOffByUserId(Auth()->user()->id)->where('is_used', 1)->paginate(10);
            return response()->json([
                'success' => 'Comp Off Deleted Successfully',
                'data' => view('employee.comp_off.list',compact('allCompOffs'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachFilterList(Request $request)
    {
        $allCompOffs = $this->compOffService->getFilteredRequestDetails($request->all());
        if ($allCompOffs) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('employee.comp_off.list', compact('allCompOffs'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
