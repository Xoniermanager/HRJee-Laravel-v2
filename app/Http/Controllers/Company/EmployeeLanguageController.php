<?php

namespace App\Http\Controllers\company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeLanguageServices;

class EmployeeLanguageController extends Controller
{
    private $employeeLanguageServices;
    public function __construct(
        EmployeeLanguageServices $employeeLanguageServices,
    ) {
        $this->employeeLanguageServices  = $employeeLanguageServices;
    }

    public function all_language()
    {
       return  $this->employeeLanguageServices->all_language();

    }


    public function destroy(Request $request)
    {
       $id = $request->id;
       $data = $this->employeeLanguageServices->deleteDetails($id);
       if ($data) {
        return response()->json(
            [
                'message' => 'language Deleted Successfully!',
                'data'   =>  view('company.employee.tabs.language_listing', [
                    'languages' => $this->employeeLanguageServices->all_language()
                ])->render()
            ]
        );
    }
    }
    public function store(Request $request)
    {
         try {
            $validateLanguage  = Validator::make($request->all(), [
                'name'                => ['required', 'string','unique:employee_language,name'],
                'languages'           => ['array']
            ]);
            if ($validateLanguage->fails()) {
                return response()->json(['error' => ['name'=> ["The Language Already Selected"]]], 400);
            }
            $data = $request->all();
            $createData = $this->employeeLanguageServices->create($data);
            if ($createData) {
            return response()->json(
                [
                    'message' => 'Employee Language Created Successfully!',
                    'data'   =>  view('company.employee.tabs.language_listing', [
                        'languages' => $this->employeeLanguageServices->all_language()
                    ])->render()
                ]
            );
        }
        } catch (\Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }

    }
}
