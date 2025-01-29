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
        $data['password'] = Hash::make($data['password']);
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
}
