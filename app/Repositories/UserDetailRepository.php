<?php

namespace App\Repositories;

use App\Models\UserDetail;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserDetailRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserDetail::class;
    }
}
