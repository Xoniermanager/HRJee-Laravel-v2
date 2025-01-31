<?php

namespace App\Repositories;

use Spatie\Permission\Contracts\Salary;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class rolesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SalaryRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Salary::class;
    }
}
