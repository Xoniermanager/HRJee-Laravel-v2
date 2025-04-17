<?php

namespace App\Repositories;

use App\Models\SubscriptionPlan;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SubscriptionPlanRepository.
 *
 * @package namespace App\Repositories;
 */
class SubscriptionPlanRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubscriptionPlan::class;
    }
}
