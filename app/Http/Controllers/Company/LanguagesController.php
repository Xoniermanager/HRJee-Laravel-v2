<?php

namespace App\Http\Controllers\company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\LanguagesServices;
use Illuminate\Support\Facades\Validator;


class LanguagesController extends Controller
{

    private $languageServices;
    public function __construct(
        LanguagesServices $languageServices,
    ) {
        $this->languageServices  = $languageServices;
    }

    public function store(Request $request)
    {
         try {
            $validateLanguage  = Validator::make($request->all(), [
                'name'                => ['required', 'string'],
                // 'languages'           => ['array']
            ]);
            if ($validateLanguage->fails()) {
                return response()->json(['error' => ['name'=> ["The Language Already Selected"]]], 400);
            }
            $data = $request->only('name');

            $newAddedLanguage = $this->languageServices->createOrUpdate($data);
            // $selectedLanguages = array_merge($request->languages,[$createData->id]);
            // $selectedLanguageDetails = $this->languageServices->getSelectedLanguage($selectedLanguages);
            return response()->json(
                [
                    'message' => 'Employee Language Created Successfully!',
                    'language_id'   =>  $newAddedLanguage->id,
                    'data'   =>  view('company.employee.tabs.language_listing', [
                        'language' => $newAddedLanguage
                    ])->render()
                ]
            );
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }

    }
}
