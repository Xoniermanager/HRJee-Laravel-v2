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


    public function fetchCoursesByCompanyID($companyIDs) {
        $allCourses = $this->courseRepository->whereIn('created_by', $companyIDs)->with('curriculums');

        return $allCourses;
    }

    public function updateDetail($data, $userId)
    {
        return $this->courseRepository->find($userId)->update($data);
    }

    public function getCompanies()
    {
        return $this->courseRepository->where('type', 'company');
    }

    public function getCourseById($id)
    {
        return $this->courseRepository->find($id);
    }

    public function updateStatus($userId, $statusValue)
    {
        $userDetails = $this->courseRepository->find($userId);
        $userDetails->type == 'company' ? $userDetails->companyDetails()->update(['status' => $statusValue]) : $userDetails->details()->update(['status' => $statusValue]);
        
        return $userDetails->update(['status' => $statusValue]);
    }

    public function updateFaceRecognitionStatus($userId, $statusValue)
    {
        $userDetails = $this->courseRepository->find($userId);
        $userDetails->details()->update(['allow_face_recognition' => $statusValue]);

        return true;
    }

    public function deleteUserById($userId)
    {
        $userDetails = $this->courseRepository->find($userId);
        $userDetails->type == 'company' ? $userDetails->companyDetails()->delete() : $userDetails->details()->delete();
        
        return $userDetails->delete();
    }
}
