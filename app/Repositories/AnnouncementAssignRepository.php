<?php

namespace App\Repositories;

use App\Models\AnnouncementAssign;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AnnouncementAssignRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AnnouncementAssign::class;
    }
    
}
