<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\CountryServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class CountryController extends Controller
{

    private $countryService;
    private $view;
    public function __construct(CountryServices $countryService)
    {
        $this->countryService = $countryService;
        $role = 'super_admin';
        if($role == 'super_admin') 
        {
            $this->view  = 'super_admin.country';
        }
        else
        {
            $this->view = 'company.country';
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view($this->view.'.index', [
            'allCountryDetails' => $this->countryService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCountryData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:countries,name'],
            ]);
            if ($validateCountryData->fails()) {
                return response()->json(['error' => $validateCountryData->messages()], 400);
            }
            $data = $request->all();
            if ($this->countryService->create($data)) {
                return response()->json([
                    'message' => 'Country Created Successfully!',
                    'data'   =>  view($this->view.'.country_list', [
                        'allCountryDetails' => $this->countryService->all()
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
        $validateCountryData  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:countries,name,' . $request->id],
        ]);

        if ($validateCountryData->fails()) {
            return response()->json(['error' => $validateCountryData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->countryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Country Updated Successfully!',
                    'data'   =>  view($this->view.'.country_list', [
                        'allCountryDetails' => $this->countryService->all()
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
        $data = $this->countryService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Country Deleted Successfully',
                'data'   =>  view($this->view.'.country_list', [
                    'allCountryDetails' => $this->countryService->all()
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
        $statusDetails = $this->countryService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Country Status Updated Successfully',
                'data'   =>  view($this->view.".country_list", [
                    'allCountryDetails' => $this->countryService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {   
        $searchedItems = $this->countryService->searchInCountry($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view($this->view.".country_list", [
                    'allCountryDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
