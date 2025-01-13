<?php

namespace App\Repositories;

use App\Models\companyMenuPermission;
use App\Models\Menu;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MenuPermissionRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return companyMenuPermission::class;
    }
}
