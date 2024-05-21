<?php

namespace App\Repositories;

use App\Models\UserPastWorkDetail;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserPastWorkDetailRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserPastWorkDetail::class;
    }    
}
