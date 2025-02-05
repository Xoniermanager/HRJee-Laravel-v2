<?php

namespace App\Repositories;

use App\Models\SalaryComponent;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class rolesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SalaryComponentRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SalaryComponent::class;
    }
}
