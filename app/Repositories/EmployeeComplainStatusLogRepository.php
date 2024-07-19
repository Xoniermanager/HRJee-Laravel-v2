<?php

namespace App\Repositories;

use App\Models\EmployeeComplainStatusLog;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmployeeComplainStatusLogRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmployeeComplainStatusLog::class;
    }
}
