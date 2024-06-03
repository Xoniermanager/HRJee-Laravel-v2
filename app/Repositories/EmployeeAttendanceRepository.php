<?php

namespace App\Repositories;

use App\Models\EmployeeAttendance;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmployeeAttendanceRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmployeeAttendance::class;
    }
}
