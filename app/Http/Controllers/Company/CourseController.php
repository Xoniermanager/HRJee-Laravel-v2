<?php

namespace App\Http\Controllers\Company;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CourseService;
use App\Http\Services\DepartmentServices;

class CourseController extends Controller
{

    private $courseService;
    private $departmentService;
    public function __construct(CourseService $courseService, DepartmentServices $departmentService) {
        $this->courseService = $courseService;
        $this->departmentService = $departmentService;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $courses = $this->courseService->fetchCoursesByCompanyID($companyIDs)->paginate(10);
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->company_id);
        
        return view('company.courses.index', compact('courses', 'alldepartmentDetails'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function add()
    {
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->company_id);

        return view('company.courses.add', compact('alldepartmentDetails'));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['created_by'] = auth()->user()->id;
        $data['company_id'] = auth()->user()->company_id;
        if ($request->video_type === 'pdf' && $request->hasFile('pdf_file')) {
            $nameForImage = removingSpaceMakingName($request->title);
            $upload_path = "/training_materials";
            $filePath = uploadingImageorFile($request->pdf_file, $upload_path, $nameForImage);
            $data['pdf_file'] = $filePath;
            $request->merge(['pdf_file' => $filePath]);
        } else {
            $data['video_url'] = $request->video_url;
        }

        if(isset($data['id'])) {
            $course = Course::where('id', $data['id'])->update($data);
        } else {
            $course = Course::create($data);
        }
        
        return response()->json(['message' => 'Course created successfully', 'course' => $course]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->company_id);
        $course = $this->courseService->getCourseById($id);

        return view('company.courses.add', compact('alldepartmentDetails', 'course'));
    }
}
