<?php

namespace App\Http\Services;

use App\Repositories\CurriculumRepository;

class CurriculumService
{
    private $curriculumRepository;
    public function __construct(CurriculumRepository $curriculumRepository)
    {
        $this->curriculumRepository = $curriculumRepository;
    }


    public function fetchCurriculumsByCourseID($companyIDs) {
        $allCurriculums = $this->curriculumRepository->whereIn('course_id', $companyIDs);

        return $allCurriculums;
    }

    public function create($data)
    {
        return $this->curriculumRepository->insert($data);
    }

    public function updateDetail($data, $curriculumId)
    {
        return $this->curriculumRepository->find($curriculumId)->update($data);
    }

    public function getCurriculumById($id)
    {
        return $this->curriculumRepository->find($id);
    }

    public function deleteByCourseId($courseId)
    {
        return $this->curriculumRepository->where('course_id', $courseId)->delete();
    }
}
