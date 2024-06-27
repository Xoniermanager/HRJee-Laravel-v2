<?php

namespace App\Repositories;

use App\Models\AssetManufacturer;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AssetManufacturerRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AssetManufacturer::class;
    }
}
