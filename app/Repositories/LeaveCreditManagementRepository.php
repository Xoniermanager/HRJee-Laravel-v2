<?php

namespace App\Repositories;

use App\Models\Announcement;
use App\Models\LeaveCreditManagement;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeaveCreditManagementRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LeaveCreditManagement::class;
    }
}
