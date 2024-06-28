<?php

namespace App\Repositories;

use App\Models\EmployeeLeaveManagement;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmployeeLeaveManagementRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmployeeLeaveManagement::class;
    }
    
}
