<?php

namespace App\Repositories;

use App\Models\EmployeeStatus;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmployeeStatusRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmployeeStatus::class;
    }
}
