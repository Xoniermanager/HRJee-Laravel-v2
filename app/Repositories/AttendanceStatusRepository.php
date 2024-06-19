<?php

namespace App\Repositories;

use App\Models\AttendanceStatus;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AttendanceStatusRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AttendanceStatus::class;
    }
}
