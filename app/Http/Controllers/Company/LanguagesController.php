<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\LanguagesServices;
use App\Models\Languages;
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
        return view('admin.languages.index', [
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
                return response()->json(['error' => ['name' => ["The Language Already Exist"]]], 400);
            }
            $data = $request->only('name');
            $newAddedLanguage = $this->languageServices->createOrUpdate($data);
            return response()->json([
                'message' => 'Employee Language Created Successfully!',
                'language_id' => $newAddedLanguage->id,
                'data' => view('company.employee.languages.create_language', [
                    'languages' => $this->languageServices->getSelectedLanguage(array($newAddedLanguage->id))
                ])->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }
}
