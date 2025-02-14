<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\LeaveManagerUpdate;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class LeaveManagerUpdateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeaveManagerUpdateRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LeaveManagerUpdate::class;
    }
}
