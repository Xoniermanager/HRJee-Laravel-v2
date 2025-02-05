<?php

namespace App\Repositories;

use App\Models\SalaryComponentAssignment;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class rolesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SalaryComponentAssignmentRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SalaryComponentAssignment::class;
    }
}
