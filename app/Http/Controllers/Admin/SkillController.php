<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\CompanySkill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\SkillsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\{OnlyString,UniqueForAdminOnly};

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
        return view('super_admin.skills.index', [
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
                'name' => ['required', 'string', new UniqueForAdminOnly('skills')],
                'description' => ['string']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->skillsService->create($data)) {
                return response()->json([
                    'message' => 'Skills Created Successfully!',
                    'data'   =>  view('super_admin.skills.skill_list', [
                        'allSkillDetails' => $this->skillsService->all()
                    ])->render()
                ]);
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
            return response()->json([
                'message' => 'Skills Updated Successfully!',
                'data'   =>  view('super_admin.skills.skill_list', [
                    'allSkillDetails' => $this->skillsService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->skillsService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Skills Deleted Successfully!',
                'data'   =>  view('super_admin.skills.skill_list', [
                    'allSkillDetails' => $this->skillsService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error', 'Something Went Wrong! Please try Again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->skillsService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'message' => 'Skill Status Updated Successfully!',
                'data'   =>  view('super_admin.skills.skill_list', [
                    'allSkillDetails' => $this->skillsService->all()
                ])->render()
            ]);
        }
    }

    public function search(Request $request)
    {   
        $searchedItems = $this->skillsService->searchInSkills($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view('super_admin.skills.skill_list', [
                    'allSkillDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function demo()
    {
        return view('demodropdown');
    }

    public function skill_data()
    {
       $data =  $this->skillsService->get_skill_ajax_call();
       return json_encode($data);
    }
    public function ajax_store_skills(Request $request)
    {
        try {
            $dataTest = $request->all()['models'];
            $data     = collect(json_decode($dataTest, true))->first();
            $data['company_id'] = isset(Auth::guard('admin')->user()->id)?Auth::guard('admin')->user()->id:'';
            $validateSkills  = Validator::make($data, [
                'name'        => ['required', 'string', new UniqueForAdminOnly('skills')],
                'description' => ['string']
            ]);

            if ($validateSkills->fails()) {
                return response()->json(['error' => $validateSkills->messages()], 400);
            }
        
            if ($this->skillsService->create($data)) {
                return  $this->skillsService->all();
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()()], 400);
        }
    }
}
