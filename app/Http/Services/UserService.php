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
                    ->orWhere('email', 'like', "%{$searchKey['key']}%")
                    ->orWhereHas('details', function($q) use ($searchKey) {
                        $q->where('details.username', 'like', "%{$searchKey['key']}%")
                            ->orWhere('details.contact_no', 'like', "%{$searchKey['key']}%")
                            ->orWhere('details.company_address', 'like', "%{$searchKey['key']}%");
                    });
            }
            if (isset($searchKey['status'])) {
                $query->where('status', $searchKey['status']);
            }
            if (isset($searchKey['deletedAt'])) {
                $query->onlyTrashed();
            }
            if (isset($searchKey['companyTypeId'])) {
                $query->where('details.company_type_id', $searchKey['companyTypeId']);
            }
        })->paginate(10);
    }
}
