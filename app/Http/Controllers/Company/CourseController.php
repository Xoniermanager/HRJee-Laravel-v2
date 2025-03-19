<?php

namespace App\Http\Controllers\Company;

use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CourseService;
use App\Models\CurriculamAssignment;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    private $courseService;
    private $departmentService;
    public function __construct(CourseService $courseService, DepartmentServices $departmentService)
    {
        $this->courseService = $courseService;
        $this->departmentService = $departmentService;
    }
    public function index(Request $request)
    {
        $allCourses = $this->courseService->fetchCoursesByCompanyID(Auth()->user()->company_id)->paginate(10);
        return view('company.courses.index', compact('allCourses'));
    }
    public function add()
    {
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->company_id);
        return view('company.courses.add', compact('alldepartmentDetails'));
    }
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
        if (isset($data['id'])) {
            $course = Course::where('id', $data['id'])->update($data);
            $courseId = $data['id'];
        } else {
            $course = Course::create($data);
            $courseId = $course->id;
        }
        return response()->json(['message' => 'Course created successfully', 'courseId' => $courseId]);
    }
    public function edit($id)
    {
        $alldepartmentDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->company_id);
        $course = $this->courseService->getCourseById($id);
        return view('company.courses.add', compact('alldepartmentDetails', 'course'));
    }
    public function curriculumStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'curriculum_details' => 'required|array',
            'curriculum_details.*.title' => 'required|string',
            'curriculum_details.*.instructor' => 'required|string',
            'curriculum_details.*.short_description' => 'required|string',
            'curriculum_details.*.content_type' => 'required|in:youtube,pdf',
            'curriculum_details.*.has_assignment' => 'required|boolean',
            'curriculum_details.*.video_url' => 'nullable|required_if:content_type,youtube|url',
            'curriculum_details.*.pdf_file' => 'nullable|required_if:content_type,pdf|mimes:pdf|max:10240', // Ensure it's a pdf and the file size doesn't exceed 10MB
            'curriculum_details.*.assignment' => 'required|array',
            'curriculum_details.*.assignment.*.question' => 'nullable|required_if:has_assignment,1',
            'curriculum_details.*.assignment.*.option1' => 'nullable|required_if:has_assignment,1',
            'curriculum_details.*.assignment.*.option2' => 'nullable|required_if:has_assignment,1',
            'curriculum_details.*.assignment.*.option3' => 'nullable|required_if:has_assignment,1',
            'curriculum_details.*.assignment.*.option4' => 'nullable|required_if:has_assignment,1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $checkExistingDetails = Curriculum::where('course_id', $request->course_id)->get();
        if ($checkExistingDetails->isNotEmpty()) {
            foreach ($checkExistingDetails as $curriculum) {
                $curriculum->curriculamAssignment()->delete();
                $curriculum->delete();
            }
        }
        foreach ($request->curriculum_details as $item) {
            $item['course_id'] = $request->course_id;
            $item['company_id'] = Auth()->user()->company_id;
            $item['created_by'] = Auth()->user()->id;
            if ($item['content_type'] == 'pdf' && !empty($item['pdf_file'])) {
                $item['pdf_file'] = uploadingImageorFile($item['pdf_file'], '/curriculam_pdf', removingSpaceMakingName($item['title']) . '-' . $item['course_id']);
            }
            $payload = Arr::except($item, 'assignment');
            $createdCurriculamDetail = Curriculum::create($payload);
            if ($createdCurriculamDetail->has_assignment == 1) {
                if (!empty($item['assignment'])) {
                    foreach ($item['assignment'] as $assignmentDetails) {
                        $assignmentDetails['curriculam_id'] = $createdCurriculamDetail->id;
                        if (!empty($assignmentDetails['file'])) {
                            $assignmentDetails['file'] = uploadingImageorFile($assignmentDetails['file'], '/curriculam_assignment_pdf', removingSpaceMakingName($item['title']) . '-' . $createdCurriculamDetail->id);
                        }
                        CurriculamAssignment::create($assignmentDetails);
                    }
                }
            }
        }
        return redirect(route('course.list'))->with(['success' => 'Curriculum Added Successfully']);
    }

    public function delete(Request $request)
    {
        $deleteCourseDetails = $this->courseService->deleteCourseDetailsById($request->courseId);
        if ($deleteCourseDetails) {
            return response()->json([
                'success' => 'Course Deleted Successfully',
                'data' => view('company.courses.list', [
                    'allCourses' => $this->courseService->fetchCoursesByCompanyID(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function view($courseId)
    {
        $courseDetail = $this->courseService->getCourseById($courseId);
        return view('company.courses.view', compact('courseDetail'));
    }

    public function statusUpdate(Request $request)
    {
        $statusDetails = $this->courseService->updateStatus($request->status, $request->id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}

