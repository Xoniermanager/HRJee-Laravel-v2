<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\CountryServices;
use App\Http\Services\StateServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class StateController extends Controller
{

    private $stateService;

    private $countryService;
    public function __construct(StateServices $stateService, CountryServices $countryService)
    {
        $this->stateService = $stateService;
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.state.index', [
            'allStateDetails' => $this->stateService->all(),
            'allcountryDetails' => $this->countryService->all()->where('status', '1')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateStateData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:states,name'],
            ]);
            if ($validateStateData->fails()) {
                return response()->json(['error' => $validateStateData->messages()], 400);
            }
            $data = $request->all();
            if ($this->stateService->create($data)) {
                return response()->json([
                    'message' => 'State Created Successfully!',
                    'data'   =>  view('company.state.state_list', [
                        'allStateDetails' => $this->stateService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateStateData  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:states,name,' . $request->id],
        ]);

        if ($validateStateData->fails()) {
            return response()->json(['error' => $validateStateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->stateService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'State Updated Successfully!',
                    'data'   =>  view('company.state.state_list', [
                        'allStateDetails' => $this->stateService->all()
                    ])->render()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->stateService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'State Deleted Successfully',
                'data'   =>  view('company.state.state_list', [
                    'allStateDetails' => $this->stateService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->stateService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function getAllStates(Request $request)
    {
        $country_id = $request->country_id;
        $allStateDetails = $this->stateService->getAllStateUsingCountryID($country_id);
        if (count($allStateDetails) > 0 && isset($allStateDetails)) 
        {
            $response = [
                'status'    =>  true,
                'data'      =>  $allStateDetails
            ];
            
        } else {
            $response = [
                'status'    =>  false,
                'error'     => 'No State Found for this Country'
            ];
        }
        return json_encode($response);
    }
}
