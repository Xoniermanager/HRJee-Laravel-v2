<?php

namespace App\Repositories;

use App\Models\EmployeeType;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmployeeTypeRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmployeeType::class;
    }
}
