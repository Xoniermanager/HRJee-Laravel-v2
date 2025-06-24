<?php

namespace App\Http\Services;

use App\Repositories\EmployeeAttendanceRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserDetailRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\EmployeeManager;

class UserService
{
    private $userRepository;
    private $userDetailRepository;
    private $employeeAttendanceRepository;
    public function __construct(UserRepository $userRepository, UserDetailRepository $userDetailRepository, EmployeeAttendanceRepository $employeeAttendanceRepository)
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;
        $this->employeeAttendanceRepository = $employeeAttendanceRepository;
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
        $userDetails = $this->userRepository->find($userId);
        $userDetails->type == 'company' ? $userDetails->companyDetails()->update(['status' => $statusValue]) : $userDetails->details()->update(['status' => $statusValue]);

        return $userDetails->update(['status' => $statusValue]);
    }

    public function updateFaceRecognitionStatus($userId, $statusValue)
    {
        $userDetails = $this->userRepository->find($userId);
        $userDetails->details()->update(['allow_face_recognition' => $statusValue]);

        return true;
    }

    public function updateFaceRecognitionKYC($userId, $kyc)
    {
        $userDetails = $this->userRepository->find($userId);
        $userDetails->details()->update(['face_kyc' => $kyc]);

        return true;
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

        // Apply 'deletedAt' filtering for soft deletes
        if (isset($searchKey['deletedAt']) && $searchKey['deletedAt']) {
            $allCompanyDetails = $allCompanyDetails->onlyTrashed();
        }

        // Apply company type filtering
        $allCompanyDetails = $allCompanyDetails->when(isset($searchKey['companyTypeId']), function ($query) use ($searchKey) {
            $query->whereHas('companyDetails', function ($query) use ($searchKey) {
                $query->where('company_type_id', $searchKey['companyTypeId']);
            });
        });

        // Apply search key filtering for 'name', 'email', and fields in 'companyDetails'
        $allCompanyDetails = $allCompanyDetails->when(isset($searchKey['key']), function ($query) use ($searchKey) {
            $query->where(function ($query) use ($searchKey) {
                $query->where('name', 'like', '%' . $searchKey['key'] . '%')
                    ->orWhere('email', 'like', '%' . $searchKey['key'] . '%')
                    ->orWhere('id', $searchKey['key'])
                    ->orWhereHas('companyDetails', function ($query) use ($searchKey) {
                        $query->where('username', 'like', '%' . $searchKey['key'] . '%')
                            ->orWhere('contact_no', 'like', '%' . $searchKey['key'] . '%')
                            ->orWhere('company_address', 'like', '%' . $searchKey['key'] . '%');
                    });
            });
        });

        // Apply 'status' filtering
        if (isset($searchKey['status'])) {
            $allCompanyDetails = $allCompanyDetails->where('status', $searchKey['status']);
        }

        // Eager load 'companyDetails' including soft-deleted records
        $allCompanyDetails = $allCompanyDetails->with([
            'companyDetails' => function ($query) {
                $query->withTrashed();
            }
        ]);
        return $allCompanyDetails->paginate(10);
    }

    public function searchCompanyMenu($searchKey)
    {
        return $this->userRepository->where('type', 'company')
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
            $allEmployeeDetails->orWhere(function ($query) use ($searchKeyword) {
                $query->where('name', 'LIKE', '%' . $searchKeyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchKeyword . '%');
            });
        }
        // Filtering by skill_id
        if (isset($request->skill_id) && !empty($request->skill_id)) {
            $skillId = $request->skill_id;
            $allEmployeeDetails->orWhereHas('skill', function ($query) use ($skillId) {
                $query->where('skill_id', $skillId);
            });
        }

        return $allEmployeeDetails->orderBy('id', 'DESC');

    }

    public function getManagersByBranchId($branchIDs)
    {
        $allManagers = $this->userRepository->where('company_id', auth()->user()->company_id)->where('role_id', '!=', null)->where('type', 'user')->with([
            'details' => function ($query) use ($branchIDs) {
                $query->whereIn('company_branch_id', $branchIDs);
            }
        ])->get();

        return $allManagers;
    }

    public function getAllManagedUsers($managerId, &$users = [])
    {
        $directReports = EmployeeManager::where('manager_id', $managerId)->pluck('user_id');

        foreach ($directReports as $userId) {
            $users[] = $userId;
            $this->getAllManagedUsers($userId, $users);
        }

        return $users;
    }

    public function getManagedUsers($request = null, $userId)
    {
        $userIds = $this->getAllManagedUsers($userId);

        $allEmployeeDetails = $this->userRepository
            ->where('type', 'user')
            ->whereIn('id', $userIds)
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

    public function getFaceRecognitionUsers($companyId)
    {
        if (Auth()->user()->type == "user") {
            $managerID = Auth()->user()->id;
            $allEmployeeDetails = $this->userRepository
                ->where('type', 'user')
                ->where('company_id', $companyId)
                ->whereHas('details', function ($query) {
                    $query->where('face_recognition', 1)->where('face_kyc', '!=', NULL);
                })
                ->whereHas('managerEmployees', function ($query) use ($managerID) {
                    $query->where('manager_id', $managerID);
                });
        } else {
            $allEmployeeDetails = $this->userRepository
                ->where('type', 'user')
                ->where('company_id', $companyId)
                ->whereHas('details', function ($query) {
                    $query->where('face_recognition', 1)->where('face_kyc', '!=', NULL);
                });
        }

        return $allEmployeeDetails->orderBy('id', 'DESC');
    }

    public function getCompanyEmployeeIDs($companyId)
    {
        return $this->userRepository->where('company_id', $companyId)->pluck('id')->toArray();
    }

    public function getAllEmployeeUnAssignedLocationTracking($companyId)
    {
        return $this->userRepository->where('company_id', $companyId)->where('type', 'user')->whereHas('details', function ($query) {
            $query->where('location_tracking', false);
        });
    }


    public function getAllEmployeeAssignedLocationTracking($companyId)
    {
        return $this->userRepository->where('company_id', $companyId)->where('type', 'user')->whereHas('details', function ($query) {
            $query->where('location_tracking', true);
        });
    }

    public function fetchEmployeesCurrentLocation($companyId, $managerId = null)
    {
        $response = [];
        $query = $this->userRepository->where('company_id', $companyId)->where('type', 'user');
        if ($managerId)
            $query->where('manager_id', $managerId);
        $userIds = $query->pluck('id')->toArray();

        $liveLocationUserID = $this->userRepository->currentLocations($userIds)->pluck('user_id')->toArray();
        $currentLocations = $this->userRepository->currentLocations($userIds)->get();
        foreach ($currentLocations as $location) {
            $response[] = [
                "name" => $location->user->name,
                "userid" => $location->user_id,
                "longitude" => $location->longitude,
                "latitude" => $location->latitude,
                "last_updated" => $location->updated_at,
                "is_location_tracking_active" => $location->user->details->live_location_active
            ];
        }

        $punchInUserIDs = array_diff($userIds, $liveLocationUserID);
        $punchInLocations = $this->userRepository->currentPunchInLocations($punchInUserIDs)->get();
        foreach ($punchInLocations as $location) {
            $response[] = [
                "name" => $location->user->name,
                "userid" => $location->user_id,
                "longitude" => $location->punch_in_longitude,
                "latitude" => $location->punch_in_latitude,
                "last_updated" => $location->updated_at,
                "is_location_tracking_active" => $location->user->details->live_location_active
            ];
        }

        return $response;
    }

    public function saveCurrentLocationOfEmployee($locations)
    {
        $user = auth()->user();

        // Throw error if admin or user has not enabled location tracking
        if (!$user->details->location_tracking || !$user->details->live_location_active) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'User does not have permission for location tracking',
                ], Response::HTTP_FORBIDDEN)
            );
        }

        // Throw error if user doesn't have marked as present
        $attendance = $this->employeeAttendanceRepository
            ->where('user_id', auth()->id())
            ->where('punch_out', NULL)
            ->latest('id')
            ->first();

        if (!$attendance) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'User has not marked as present',
                ], Response::HTTP_FORBIDDEN)
            );
        }

        // Save locations
        $this->userRepository->saveCurrentLocationsOfEmployee($locations);
    }

    public function fetchLocationsOfEmployee(
        string $userId,
        ?string $date,
        ?int $onlyStayPoints = 0,
        ?int $onlyNewPoints = 0,
        $punchOutTime = null
    ) {
        return $this->userRepository->fetchLocationsOfEmployee($userId, $date, $onlyStayPoints, $onlyNewPoints, $punchOutTime);
    }

    public function getActiveEmployees($companyIds)
    {
        return $this->userRepository->whereIn('company_id', $companyIds)->where('type', 'user')->where('status', 1);
    }


    public function getUserSkillsByUserId($id)
    {
        return $this->userRepository->where('id', $id);
    }

    public function getAllManagerByCompanyId($companyId)
    {
        return $this->userRepository->whereIn('company_id', $companyId)->where('type', 'user')->whereNotNull('role_id')->with(['managerEmployees.user.details', 'role:name,id']);
    }

    public function getAllManagerByDepartmentId($companyId, $deptId)
    {
        return $this->userRepository->whereIn('company_id', $companyId)
            ->where('type', 'user')
            ->whereNotNull('role_id')
            ->whereHas('details', function ($query) use ($deptId) {
                $query->where('department_id', $deptId);
            })
            ->with([
                'managerEmployees.user.details',
                'role:id,name'
            ])
            ->get();

    }

    /**
     * Undocumented function
     *
     * @param [array] $companyId
     * @param [array] $deptId
     * @return void/object/null
     */
    public function getAllEmployeesByDepartmentId($companyId, $deptId)
    {
        return $this->userRepository->whereIn('company_id', $companyId)
            ->where('type', 'user')
            ->whereHas('details', function ($query) use ($deptId) {
                $query->whereIn('department_id', $deptId);
            })
            ->get();
    }

    public function toggleUserLocationTracking($userId)
    {
        $user = $this->userDetailRepository->where('user_id', $userId)->first();

        if (!$user)
            throw new \Exception("Invalid user Id", 400);

        if (!$user->location_tracking)
            throw new \Exception("No permission to toggle location tracking", 400);

        $status = $user->live_location_active == 1 ? 0 : 1;
        $user->live_location_active = $status;
        $user->save();

        return $status;
    }
}
