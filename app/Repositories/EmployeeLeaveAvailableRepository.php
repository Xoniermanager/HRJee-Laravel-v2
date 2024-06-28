<?php

namespace App\Repositories;

use App\Models\EmployeeLeaveAvailable;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmployeeLeaveAvailableRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmployeeLeaveAvailable::class;
    }
}
