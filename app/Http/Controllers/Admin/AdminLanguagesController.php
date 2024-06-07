<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\LanguagesServices;
use Illuminate\Support\Facades\Validator;


class AdminLanguagesController extends Controller
{

    private $languageServices;
    private $view;
    public function __construct(
        LanguagesServices $languageServices,
    ) {
        $this->languageServices  = $languageServices;
    }
    
    public function index()
    {
        return view('super_admin.languages.index', [
            'allLanguagesDetails' => $this->languageServices->all()
        ]);
    }


    public function store(Request $request)
    {
         try {
            $validateLanguage  = Validator::make($request->all(), [
                'name'                => ['required', 'string'],
            ]);
            if ($validateLanguage->fails()) {
                return response()->json(['error' => ['name'=> ["The Language Already Exist"]]], 400);
            }
            $data = $request->only('name');
            if($this->languageServices->createOrUpdate($data))
            {
                return response()->json(
                    [
                        'message' => 'Language Created Successfully!',
                        'data'   =>  view('super_admin.languages.language_list', [
                            'allLanguagesDetails' => $this->languageServices->all()
                        ])->render()
                    ]
                );
            }

        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        $validateCountryData  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:countries,name,' . $request->id],
        ]);

        if ($validateCountryData->fails()) {
            return response()->json(['error' => $validateCountryData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->languageServices->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Updated Successfully!',
                    'data'   =>  view('super_admin.languages.language_list', [
                        'allLanguagesDetails' => $this->languageServices->all()
                    ])->render()
                ]
            );
        }
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->languageServices->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Deleted Successfully',
                'data'   =>  view('super_admin.languages.language_list', [
                    'allLanguagesDetails' => $this->languageServices->all()
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
        $statusDetails = $this->languageServices->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Country Status Updated Successfully',
                'data'   =>  view('super_admin.languages.language_list', [
                    'allLanguagesDetails' => $this->languageServices->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {   
        $searchedItems = $this->languageServices->searchInLanguages($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view('super_admin.languages.language_list', [
                    'allLanguagesDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }



}
