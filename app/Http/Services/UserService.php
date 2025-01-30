<?php

namespace App\Http\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($data)
    {
        $data['password'] = Hash::make($data['password'] ?? 'password');
        return $this->userRepository->create($data);
    }

    public function updateDetail($data, $userId)
    {
        return $this->userRepository->find($userId)->update($data);
    }
    public function getCompanies()
    {
        return $this->userRepository->where('type', 'company');
    }

    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function updateStatus($userId, $statusValue)
    {
        $userDetail = $this->userRepository->find($userId);
        $userDetail->details()->update(['status' => $statusValue]);
        return $userDetail->update(['status' => $statusValue]);
    }

    public function deleteUserById($userId)
    {
        $userDeatil = $this->userRepository->find($userId);
        $userDeatil->details()->delete();
        return $userDeatil->delete();
    }
    public function searchFilterCompany($searchKey)
    {
        return $this->userRepository->where(function ($query) use ($searchKey) {
            if (!empty($searchKey['key'])) {
                $query->where('name', 'like', "%{$searchKey['key']}%")
                    ->orWhere('email', 'like', "%{$searchKey['key']}%");
                // ->orWhereHas('profile', function($q) use ($searchKey) {
                //     $q->where('username', 'like', "%{$searchKey['key']}%")
                //         ->orWhere('contact_no', 'like', "%{$searchKey['key']}%")
                //         ->orWhere('company_address', 'like', "%{$searchKey['key']}%");
                // });
            }
            if (isset($searchKey['status'])) {
                $query->where('status', $searchKey['status']);
            }
            if (isset($searchKey['deletedAt'])) {
                $query->onlyTrashed();
            }
            if (isset($searchKey['companyTypeId'])) {
                $query->whereHas('details', function ($query) use ($searchKey) {
                    if ($query->where('type' == 'company')) {
                        $query->where('company_details.company_type_id', $searchKey['companyTypeId']);
                    }
                });
            }
        })->paginate(10);
    }
    public function searchCompanyMenu($searchKey)
    {
        return $this->userRepository
            ->with('role.menus')
            ->where(function ($query) use ($searchKey) {
                if (!empty($searchKey)) {
                    $query->where('name', 'like', "%{$searchKey}%")
                        ->orWhereHas('role.menus', function ($menuQuery) use ($searchKey) {
                            // Search for 'title' in the 'menus' related to 'role'
                            $menuQuery->where('menus.title', 'like', "%{$searchKey}%");
                        });
                }
            })
            ->paginate(10);
    }
    public function searchFilterEmployee($request = null, $companyId)
    {
        $allEmployeeDetails = $this->userRepository->where('type', 'user')->where('company_id', $companyId);

        if (isset($request->search) && !empty($request->search)) {
            $searchKeyword = $request->search;
            $allEmployeeDetails->where('name', 'Like', '%' . $searchKeyword . '%')
                ->orWhere('email', 'Like', '%' . $searchKeyword . '%');
        }

        $allEmployeeDetails->whereHas('details', function ($query) use ($request) {
            if (isset($request->gender) && !empty($request->gender)) {
                $query->where('gender', $request->gender);
            }
            if (isset($request->emp_status_id) && !empty($request->emp_status_id)) {
                $query->where('employee_status_id', $request->emp_status_id);
            }
            // List Selected by Marrital Status
            if (isset($request->marital_status) && !empty($request->marital_status)) {
                $query->where('marital_status', $request->marital_status);
            }
            // List Selected by Employee Type
            if (isset($request->emp_type_id) && !empty($request->emp_type_id)) {
                $query->where('employee_type_id', '=', $request->emp_type_id);
            }
            // List Selected by Department
            if (isset($request->department_id) && !empty($request->department_id)) {
                $query->where('department_id', '=', $request->department_id);
            }
            // List Selected by Shift
            if (isset($request->shift_id) && !empty($request->shift_id)) {
                $query->where('shift_id', '=', $request->shift_id);
            }
            // List Selected by Branch
            if (isset($request->branch_id) && !empty($request->branch_id)) {
                $query->where('company_branch_id', '=', $request->branch_id);
            }
            // List Selected by Qualification
            if (isset($request->qualification_id) && !empty($request->qualification_id)) {
                $query->where('qualification_id', '=', $request->qualification_id);
            }

            // List Search Operation
            if (isset($request->search) && !empty($request->search)) {
                $searchKeyword = $request->search;
                $query->where('official_email_id', 'Like', '%' . $searchKeyword . '%')
                    ->orWhere('phone', 'Like', '%' . $searchKeyword . '%')
                    ->orWhere('emp_id', 'Like', '%' . $searchKeyword . '%')
                    ->orWhere('father_name', 'Like', '%' . $searchKeyword . '%')
                    ->orWhere('mother_name', 'Like', '%' . $searchKeyword . '%')
                    ->orWhere('offer_letter_id', 'Like', '%' . $searchKeyword . '%')
                    ->orWhere('official_mobile_no', 'Like', '%' . $searchKeyword . '%');
            }
        });
        // List Selected by Skill Id
        if (isset($request->skill_id) && !empty($request->skill_id)) {
            $skillId = $request->skill_id;
            $allEmployeeDetails->whereHas(
                'skill',
                function ($query) use ($skillId) {
                    $query->where('skill_id', '=', $skillId);
                }
            );
        }
        return $allEmployeeDetails->orderBy('id', 'DESC');
    }
}
