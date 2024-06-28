<?php

namespace App\Repositories;

use App\Models\LeaveCreditHistroy;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeaveCreditHistoryRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LeaveCreditHistroy::class;
    }
}
