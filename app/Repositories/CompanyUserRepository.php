<?php

namespace App\Repositories;

use App\Models\AssetStatus;
use App\Models\CompanyUser;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CompanyUserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CompanyUser::class;
    }
}
