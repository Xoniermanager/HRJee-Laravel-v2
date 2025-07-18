<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Imports\TaskImport;
use Illuminate\Http\Request;
use App\Http\Services\FormService;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormStoreRequest;
use App\Http\Services\EmployeeServices;
use App\Http\Services\AssignTaskService;
use Illuminate\Support\Facades\Response;
use App\Exports\TaskImportTemplateExport;
use App\Http\Services\DispositionCodeService;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel; // ✅ this is the Facade, supports static download()


class LocationVisitController extends Controller
{
    public $formService;
    public $employeeService;
    public $assignTaskService;
    public $dispositionCodeService;
    public function __construct(FormService $formService, EmployeeServices $employeeService, AssignTaskService $assignTaskService, DispositionCodeService $dispositionCodeService)
    {
        $this->formService = $formService;
        $this->employeeService = $employeeService;
        $this->assignTaskService = $assignTaskService;
        $this->dispositionCodeService = $dispositionCodeService;
    }
    public function index()
    {
        $fieldDetails = $this->formService->getFormFieldsByCompanyId(Auth()->user()->company_id);
        return view('company.location_visit.add_form', compact('fieldDetails'));
    }

    public function store(FormStoreRequest $request)
    {
        try {
            $data = $request->all();
            $this->formService->create($data);
            return back()->with(['success' => 'Form Field Added Successfully']);

        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function assignTaskList()
    {
        $allTaskDetails = $this->assignTaskService->searchFilterTask('')->orderBy('id', "DESC")->paginate(10);
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->get();
        return view('company.location_visit.list', compact('allTaskDetails', 'allEmployeeDetails'));
    }
    public function addTask()
    {
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->get();
        $fieldDetails = $this->formService->getFormFieldsByCompanyId(Auth()->user()->company_id);
        return view('company.location_visit.add_task', compact('fieldDetails', 'allEmployeeDetails'));
    }

    public function storeTaskAssigned(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',  // Validates user_id is required and exists in users table
            'document' => 'nullable|mimes:pdf,docx,doc,pdf|max:10240',  // Optional document with specific types and max size 10MB
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',  // Optional image with specific types and max size 5MB
            'visit_address' => 'required|max:1024'
        ]);
        try {
            $data = $request->all();
            $this->assignTaskService->create($data);
            return redirect(route('location_visit.assign_task'))->with(['success' => 'Assined Task Successfully']);
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function editTaskAssigned($taskId)
    {
        $taskdetails = $this->assignTaskService->getTaskDetailsById($taskId);
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->get();
        $fieldDetails = $this->formService->getFormFieldsByCompanyId(Auth()->user()->company_id);
        $dispositionCodeDetails = $this->dispositionCodeService->getDispositionCodeByCompanyId(Auth()->user()->company_id);
        return view('company.location_visit.edit_task', compact('taskdetails', 'allEmployeeDetails', 'fieldDetails', 'dispositionCodeDetails'));
    }

    public function updateTaskAssigned(Request $request, $taskId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'document' => 'nullable|mimes:pdf,docx,doc,pdf|max:10240',  // Optional document with specific types and max size 10MB
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',  // Optional image with specific types and max size 5MB
            'visit_address' => 'required|max:1024'
        ]);
        try {
            $data = $request->all();
            $this->assignTaskService->updateTaskDetails($data, $taskId);
            return redirect(route('location_visit.assign_task'))->with(['success' => 'Assined Task Updated Successfully']);
        } catch (Exception $e) {
            return back()->with(['error' => 'Something Went Wrong!Please try Again']);
        }
    }

    public function deleteTaskAssigned($taskId)
    {
        $data = $this->assignTaskService->deleteTaskDetails($taskId);
        if ($data) {
            return response()->json([
                'success' => 'Task Deleted Successfully',
                'data' => view('company.location_visit.task_list', [
                    'allTaskDetails' => $this->assignTaskService->getTaskDetailsByCompanyId(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function viewTaskAssigned($taskId)
    {
        $taskdetails = $this->assignTaskService->getTaskDetailsById($taskId);
        return view('company.location_visit.view_task', compact('taskdetails'));
    }

    public function searchFilterTask(Request $request)
    {
        $allTaskDetails = $this->assignTaskService->searchFilterTask($request->all())->paginate(10);
        return response()->json([
            'data' => view('company.location_visit.task_list', compact('allTaskDetails'))->render()
        ]);
    }

    public function exportTasks(Request $request)
    {
        $allTaskDetails = $this->assignTaskService->searchFilterTask($request->all())->get();
        $dynamicFields = [];
        foreach ($allTaskDetails as $task) {
            $responseData = json_decode($task->response_data, true);
            if (is_array($responseData)) {
                foreach ($responseData as $key => $value) {
                    $dynamicFields[$key] = true;
                }
            }
        }
        $dynamicFields = array_keys($dynamicFields);

        // Render Blade view to HTML
        $html = view('company.location_visit.exports.tasks_html', compact('allTaskDetails', 'dynamicFields'))->render();

        $filename = 'tasks_export_' . now()->format('Ymd_His') . '.xls';

        return Response::make($html, 200, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function downloadTemplate()
    {
        $dynamicFields = collect(
            $this->formService
                ->getFormFieldsByCompanyId(Auth()->user()->company_id)
                ->formfield ?? []
        )->pluck('label')->toArray();

        return Excel::download(new TaskImportTemplateExport($dynamicFields), 'task_import_template.xlsx');
    }

    public function importTasks(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new TaskImport, $request->file('import_file'));
            return response()->json([
                'status' => 'success',
                'message' => 'Import completed successfully!'
            ]);
        } catch (ValidationException $e) {
            // single validation error we throw inside TaskImport
            return response()->json([
                'status' => 'error',
                'errors' => [$e->getMessage()]
            ], 422);
        } catch (\Throwable $e) {
            // fallback for unexpected errors
            return response()->json([
                'status' => 'error',
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }
}
