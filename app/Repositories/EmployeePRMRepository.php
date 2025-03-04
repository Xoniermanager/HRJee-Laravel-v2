<?php

namespace App\Repositories;

use App\Models\PrmRequest;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class EmployeePRMRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmployeePRMRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PrmRequest::class;
    }
}
