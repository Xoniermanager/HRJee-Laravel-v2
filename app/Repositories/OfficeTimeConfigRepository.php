<?php

namespace App\Repositories;

use App\Models\OfficeTimingConfig;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OfficeTimeConfigRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OfficeTimingConfig::class;
    }    
}
