<?php

namespace App\Repositories;
use App\Models\Curriculum;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CurriculumRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CurriculumRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Curriculum::class;
    }
}
