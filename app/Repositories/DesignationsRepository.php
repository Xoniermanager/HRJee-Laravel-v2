<?php

namespace App\Repositories;

use App\Models\Designations;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DesignationsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Designations::class;
    }
    
}
