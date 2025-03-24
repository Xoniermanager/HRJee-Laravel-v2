<?php

namespace App\Repositories;
use App\Models\TaxSlabRule;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class rolesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TaxSlabRuleRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TaxSlabRule::class;
    }
}
