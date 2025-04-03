<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeManager;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;

class HierarchyController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $companyDetail = User::where('company_id', Auth()->user()->company_id)->where('type', 'company')->first();
        $managers = User::where(['company_id' =>Auth()->user()->company_id, 'type' => 'user'])->whereNotIn('id', EmployeeManager::pluck('user_id'))->get();
        $allManagerDetails = $managers->map(function ($manager) {
            return $this->getHierarchy($manager);
        });
        $companyDetail->employees = $allManagerDetails;
        return view('company.hierarchy.index', compact('companyDetail'));
    }
    private function getHierarchy($user)
    {
        return [
            'id'  => $user->id,
            'name' => $user->name,
            'role_name' => $user->role->name ?? '',
            'designation_name' => $user->details->designation->name ?? '',
            'employees' => EmployeeManager::where('manager_id', $user->id)
                ->with('user')
                ->get()
                ->map(function ($relation) {
                    return $this->getHierarchy($relation->user);
                }),
        ];
    }
}
