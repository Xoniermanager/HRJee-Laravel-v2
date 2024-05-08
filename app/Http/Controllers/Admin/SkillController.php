<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\SkillsService;
use App\Models\CompanySkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\OnlyString;
use Exception;

class SkillController extends Controller
{

    private $skillsService;
    public function __construct(SkillsService $skillsService)
    {
        $this->skillsService = $skillsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('super_admin.skill.index', [
            'allSkillDetails' => $this->skillsService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:skills,name'],
                'description' => ['string']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->skillsService->create($data)) {
                return response()->json(['message' => 'Company Skills Created Successfully!']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateCompanyStatus  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:skills,name,' . $request->id]
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->skillsService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(['message' => 'Company Skills Updated Successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->skillsService->deleteDetails($id);
        if ($data) {
            return back()->with('success', 'Deleted Successfully! ');
        } else {
            return back()->with('error', 'Something Went Wrong! Pleaase try Again');
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->skillsService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
