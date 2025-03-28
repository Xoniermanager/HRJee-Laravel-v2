<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeServices;
use App\Http\Services\UserRewardService;

class UserRewardController extends Controller
{
    public $employeeService;
    public $userRewardService;
    public function __construct(EmployeeServices $employeeService, UserRewardService $userRewardService)
    {
        $this->employeeService = $employeeService;
        $this->userRewardService = $userRewardService;
    }
    public function index()
    {
        $allRewardDetails = $this->userRewardService->getUserRewardDetailsByCompanyId(Auth()->user()->company_id)->orderBy('id', 'DESC')->paginate(10);
        return view('company.user_reward.index', compact('allRewardDetails'));
    }

    public function add()
    {
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->get();
        return view('company.user_reward.add', compact('allEmployeeDetails'));
    }

    public function edit($rewardId)
    {
        $rewardDetail = $this->userRewardService->getRewardDetailById($rewardId);
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->get();
        return view('company.user_reward.edit', compact('rewardDetail', 'allEmployeeDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensures the user exists in the users table
            'reward_name' => 'required|string|max:255',
            'date' => 'required|date|before_or_equal:today',
            'description' => 'required|string|max:1024',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Only image files allowed, max size 2MB
            'document' => 'nullable|file|mimes:pdf|max:5048', // Only PDF files, max size 5MB
        ]);
        try {
            $data = $request->all();
            $this->userRewardService->create($data);
            return redirect(route('reward.index'))->with('success', 'Reward Added Successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, $rewardId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensures the user exists in the users table
            'reward_name' => 'required|string|max:255',
            'date' => 'required|date|before_or_equal:today',
            'description' => 'required|string|max:1024',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Only image files allowed, max size 2MB
            'document' => 'nullable|file|mimes:pdf|max:5048', // Only PDF files, max size 5MB
        ]);
        try {
            $data = $request->all();
            $this->userRewardService->updateDetailsByRewardId($data, $rewardId);
            return redirect(route('reward.index'))->with('success', 'Reward Updated Successfully');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $data = $this->userRewardService->deleteDetails($request->id);
        if ($data) {
            return response()->json([
                'success' => 'Reward Deleted Successfully',
                'data' => view('company.user_reward.list', [
                    'allRewardDetails' => $this->userRewardService->getUserRewardDetailsByCompanyId(Auth()->user()->company_id)->orderBy('id', 'DESC')->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachFilterList(Request $request)
    {
        $allRewardDetails = $this->userRewardService->serachFilterList($request->all());
        if ($allRewardDetails) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.user_reward.list', compact('allRewardDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }


}
