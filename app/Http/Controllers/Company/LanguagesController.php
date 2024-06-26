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
            $newAddedLanguage = $this->languageServices->createOrUpdate($data);
            return response()->json(
                [
                    'message' => 'Employee Language Created Successfully!',
                    // 'language_id'   =>  $newAddedLanguage->id,
                    'data'   =>  view('company.employee.tabs.language_list', [
                        'language' => $newAddedLanguage
                    ])->render()
                ]
            );
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }

    }


}
