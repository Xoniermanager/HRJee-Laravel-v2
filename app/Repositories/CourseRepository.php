<?php

namespace App\Repositories;
use App\Models\Course;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CourseRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CourseRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Course::class;
    }
}
