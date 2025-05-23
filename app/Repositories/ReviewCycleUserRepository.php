<?php

namespace App\Repositories;

use App\Models\ReviewCycleUser;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ReviewCycleUserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ReviewCycleUser::class;
    }
}
