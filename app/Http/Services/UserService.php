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
        $userDetails = $this->userRepository->find($userId);
        $userDetails->type == 'company' ? $userDetails->companyDetails()->delete() : $userDetails->details()->delete();
        return $userDetails->delete();
    }
    public function searchFilterCompany($searchKey)
    {
        $allCompanyDetails = $this->userRepository->where('type', 'company');

        // Apply company type filtering
        $allCompanyDetails->when(isset($searchKey['companyTypeId']), function ($query) use ($searchKey) {
            $query->whereHas('companyDetails', function ($query) use ($searchKey) {
                $query->where('company_type_id', $searchKey['companyTypeId']);
            });
        });

        // Apply search key filtering for 'name', 'email', and fields in 'companyDetails'
        $allCompanyDetails->when(isset($searchKey['key']), function ($query) use ($searchKey) {
            $query->where(function ($query) use ($searchKey) {
                // Search in 'name' and 'email' fields on the User model
                $query->where('name', 'like', '%' . $searchKey['key'] . '%')
                    ->orWhere('email', 'like', '%' . $searchKey['key'] . '%')
                    // Search in 'companyDetails' fields
                    ->orWhereHas('companyDetails', function ($query) use ($searchKey) {
                        $query->where('username', 'like', '%' . $searchKey['key'] . '%')
                            ->orWhere('contact_no', 'like', '%' . $searchKey['key'] . '%')
                            ->orWhere('company_address', 'like', '%' . $searchKey['key'] . '%');
                    });
            });
        });

        // Apply 'status' filtering
        if (isset($searchKey['status'])) {
            $allCompanyDetails->where('status', $searchKey['status']);
        }

        // Apply 'deletedAt' filtering for soft deletes
        if (isset($searchKey['deletedAt'])) {
            $allCompanyDetails->onlyTrashed();
        }

        return $allCompanyDetails->paginate(10);
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
        $allEmployeeDetails = $this->userRepository
        ->where('type', 'user')
        ->where('company_id', $companyId)
        ->whereHas('details', function ($query) use ($request) {
            $query->whereNull('exit_date');
            // Filtering by details-related fields
            if (isset($request->gender) && !empty($request->gender)) {
                $query->where('gender', $request->gender);
            }
            if (isset($request->emp_status_id) && !empty($request->emp_status_id)) {
                $query->where('employee_status_id', $request->emp_status_id);
            }
            if (isset($request->marital_status) && !empty($request->marital_status)) {
                $query->where('marital_status', $request->marital_status);
            }
            if (isset($request->emp_type_id) && !empty($request->emp_type_id)) {
                $query->where('employee_type_id', $request->emp_type_id);
            }
            if (isset($request->department_id) && !empty($request->department_id)) {
                $query->where('department_id', $request->department_id);
            }
            if (isset($request->shift_id) && !empty($request->shift_id)) {
                $query->where('shift_id', $request->shift_id);
            }
            if (isset($request->branch_id) && !empty($request->branch_id)) {
                $query->where('company_branch_id', $request->branch_id);
            }
            if (isset($request->qualification_id) && !empty($request->qualification_id)) {
                $query->where('qualification_id', $request->qualification_id);
            }

            // Search operation inside the details relation
            if (isset($request->search) && !empty($request->search)) {
                $searchKeyword = $request->search;
                $query->where(function ($query) use ($searchKeyword) {
                    $query->where('official_email_id', 'LIKE', '%' . $searchKeyword . '%')
                          ->orWhere('phone', 'LIKE', '%' . $searchKeyword . '%')
                          ->orWhere('emp_id', 'LIKE', '%' . $searchKeyword . '%')
                          ->orWhere('father_name', 'LIKE', '%' . $searchKeyword . '%')
                          ->orWhere('mother_name', 'LIKE', '%' . $searchKeyword . '%')
                          ->orWhere('offer_letter_id', 'LIKE', '%' . $searchKeyword . '%')
                          ->orWhere('official_mobile_no', 'LIKE', '%' . $searchKeyword . '%');
                });
            }
        });

    if (isset($request->search) && !empty($request->search)) {
        $searchKeyword = $request->search;
        // Main search filter for the users table
        $allEmployeeDetails->where(function ($query) use ($searchKeyword) {
            $query->where('name', 'LIKE', '%' . $searchKeyword . '%')
                  ->orWhere('email', 'LIKE', '%' . $searchKeyword . '%');
        });
    }

    // Filtering by skill_id
    if (isset($request->skill_id) && !empty($request->skill_id)) {
        $skillId = $request->skill_id;
        $allEmployeeDetails->whereHas('skill', function ($query) use ($skillId) {
            $query->where('skill_id', $skillId);
        });
    }

    return $allEmployeeDetails->orderBy('id', 'DESC');
    }
}
