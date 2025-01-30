<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Employee;
use App\Models\User;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmployeeRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    // public function deleteDepartmentById($id)
    // {
    //    return $this->where('id',$id);
    // }
    public function getEmployeeById($id)
    {
        return $this->where('id', $id);
    }

    public function getEmployeeDetailsById($id)
    {
        $user = User::with('user_details', 'bankDetail', 'address')->find($id);
        return $userDetails = [
            'user' => $user,
            'user_details' => $user->user_details,
            'bankDetail' => $user->bankDetail,
            'address' => $user->address,
        ];
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
