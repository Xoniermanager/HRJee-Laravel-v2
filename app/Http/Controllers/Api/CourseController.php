<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function courseList()
    {
        try {
            $departmentId = Auth()->guard('employee_api')->user()->details->department->id;
            $desginationId = Auth()->guard('employee_api')->user()->details->designation->id;
            $allCourseDetails = $this->courseService->getCourseByDepartmentIdAndDesignationId($departmentId, $desginationId)->paginate(10);
            return response()->json([
                'status' => true,
                'data' => $allCourseDetails,
                'message' => "Retrieved Course Details"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function courseDetails($courseId)
    {
        try {
            $courseDetails = $this->courseService->getCourseById($courseId);
            return response()->json([
                'status' => true,
                'data' => $courseDetails,
                'message' => "Retrieved Course Details"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
