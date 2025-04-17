<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\UserRewardService;

class UserRewardController extends Controller
{
    public $userRewardService;

    public function __construct(UserRewardService $userRewardService)
    {
        $this->userRewardService = $userRewardService;
    }
    public function index()
    {
        $allRewardDetails = $this->userRewardService->getUserRewardDetailsByUserId(Auth()->user()->id)->get();
        return view('employee.user_reward.index', compact('allRewardDetails'));
    }

    public function viewDetails($id)
    {
        $rewardDetail = $this->userRewardService->getRewardDetailById($id);
        return view('employee.user_reward.details', compact('rewardDetail'));
    }
}
