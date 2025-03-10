<?php

namespace App\Http\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    private $courseRepository;
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    public function fetchCoursesByCompanyID($companyId)
    {
        return $this->courseRepository->where('company_id', $companyId);
    }

    public function updateDetail($data, $userId)
    {
        return $this->courseRepository->find($userId)->update($data);
    }
    public function getCourseById($id)
    {
        return $this->courseRepository->find($id);
    }
    public function deleteCourseDetailsById($courseId)
    {
        $courseDetails = $this->courseRepository->find($courseId);
        $courseDetails->curriculums()->delete();
        return $courseDetails->delete();
    }

    public function updateStatus($statusValue, $courseId)
    {
        return $this->courseRepository->find($courseId)->update(['status' => $statusValue]);
    }
}
