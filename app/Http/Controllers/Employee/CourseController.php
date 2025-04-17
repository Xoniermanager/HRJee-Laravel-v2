<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\CourseService;

class CourseController extends Controller
{
    public $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    public function index()
    {
        $departmentId = Auth()->user()->details->department_id;
        $desginationId = Auth()->user()->details->designation_id;
        $allCourseDetails = $this->courseService->getCourseByDepartmentIdAndDesignationId($departmentId,$desginationId)->get();
        return view('employee.course.index', compact('allCourseDetails'));
    }

    public function viewDetails($id)
    {
        $courseDetails = $this->courseService->getCourseById($id);
        $departmentId = Auth()->user()->details->department_id;
        $desginationId = Auth()->user()->details->designation_id;
        $allCourseDetails = $this->courseService->getCourseByDepartmentIdAndDesignationId($departmentId,$desginationId)->get();
        return view('employee.course.details', compact('courseDetails','allCourseDetails'));
    }
}
