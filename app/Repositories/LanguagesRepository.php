<?php

namespace App\Repositories;

use App\Models\Languages;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LanguagesRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Languages::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    // public function boot()
    // {
    //     $this->pushCriteria(app(RequestCriteria::class));
    // }
}
