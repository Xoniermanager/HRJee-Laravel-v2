<?php

namespace App\Repositories;

use App\Models\UserDetail;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserDetailRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserDetail::class;
    }

    public function assignedLocationTracking($userIds)
    {
        return $this->model->whereIn('user_id', $userIds)->update(['location_tracking' => true]);
    }

    public function updateLocationTrackingStatus($statusValue, $userId)
    {
        return $this->model->where('user_id', $userId)->update(['location_tracking' => $statusValue]);
    }
}
