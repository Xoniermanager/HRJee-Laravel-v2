<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CourseService;
use App\Http\Services\CurriculumService;
use App\Http\Services\DepartmentServices;

class CurriculumController extends Controller
{

    private $courseService;
    private $departmentService;
    private $curriculumService;

    public function __construct(CourseService $courseService, CurriculumService $curriculumService, DepartmentServices $departmentService) {
        $this->courseService = $courseService;
        $this->curriculumService = $curriculumService;
        $this->departmentService = $departmentService;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $requestedData = $request->get('curriculums');
        $payload = [];
        $courseID = $request->get('course_id');

        foreach($requestedData as $data) {
            // if ($data['content_type'] === 'pdf' && $request->hasFile('url')) {
            //     $nameForImage = removingSpaceMakingName($request->title);
            //     $upload_path = "/training_materials";
            //     $filePath = uploadingImageorFile($request->pdf_file, $upload_path, $nameForImage);
            //     $request->merge(['url' => $filePath]);
            // }
            $payload[] = $data;
        }

        if(isset($data['id'])) {
            $this->curriculumService->deleteByCourseId($courseID);
        }

        $this->curriculumService->create($payload);
        
        return response()->json(['message' => 'Curriculum saved successfully', 'status' => 'success']);
    }
}
