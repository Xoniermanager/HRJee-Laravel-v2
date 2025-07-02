<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoApplicantStoreRequest;
use App\Http\Requests\LeadStoreRequest;
use App\Http\Requests\LoanStoreRequest;
use App\Http\Services\LeadService;
use App\Http\Services\IncomeDetailService;
use App\Http\Services\CoApplicantService;
use App\Http\Services\LoanService;
use App\Http\Services\ProductService;
use App\Http\Services\ConnectorService;
use App\Http\Services\UserService;
use App\Http\Services\LenderService;
use App\Http\Services\LeadStatusManageService;
use Illuminate\Http\Request;
use App\Imports\LeadImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\UpdateLeadProductRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class LeadController extends Controller
{
    public $leadService;
    public $incomeDetailService;
    public $coApplicantService;
    public $loanService;
    public $connector_service;
    public $userService;
    public $productService;
    public $leadStatusManageService;
    public $lenderService;

    public function __construct(LeadService $leadService, IncomeDetailService $incomeDetailService, CoApplicantService $coApplicantService, LoanService $loanService, ConnectorService $connector_service, UserService $userService, ProductService $productService, LeadStatusManageService $leadStatusManageService, LenderService $lenderService)
    {
        $this->leadService = $leadService;
        $this->incomeDetailService = $incomeDetailService;
        $this->coApplicantService = $coApplicantService;
        $this->loanService = $loanService;
        $this->connector_service = $connector_service;
        $this->userService = $userService;
        $this->productService = $productService;
        $this->leadStatusManageService = $leadStatusManageService;
        $this->lenderService = $lenderService;
    }
    public function index()
    {
        $companyIDs = getCompanyIDs();
        $allLeadDetails = $this->leadService->all($companyIDs);
        $leadStatusDetails = $this->leadService->lead($companyIDs);
        $prospectStatusDetails = $this->leadService->prospect($companyIDs);
        $visitStatusDetails = $this->leadService->visit($companyIDs);
        $documentationStatusDetails = $this->leadService->documentation($companyIDs);
        $lenderSelectionStatusDetails = $this->leadService->lenderSelection($companyIDs);
        $loggedStatusDetails = $this->leadService->login($companyIDs);
        $sanctionedStatusDetails = $this->leadService->sanctioned($companyIDs);
        $rejectedStatusDetails = $this->leadService->rejected($companyIDs);
        $withdrawnStatusDetails = $this->leadService->withdrawn($companyIDs);
        $pendencyStatusDetails = $this->leadService->pendency($companyIDs);
        $disbursedStatusDetails = $this->leadService->disbursed($companyIDs);
        $disbursementAllDetails = $this->leadService->disbursementAll($companyIDs);
        $completedStatusDetails = $this->leadService->completed($companyIDs);
        $incompletedStatusDetails = $this->leadService->incompleted($companyIDs);
        return view('company.leads.index', compact('allLeadDetails', 'leadStatusDetails', 'prospectStatusDetails', 'visitStatusDetails', 'documentationStatusDetails', 'lenderSelectionStatusDetails', 'loggedStatusDetails', 'sanctionedStatusDetails', 'rejectedStatusDetails', 'withdrawnStatusDetails', 'pendencyStatusDetails', 'disbursedStatusDetails', 'disbursementAllDetails', 'completedStatusDetails', 'incompletedStatusDetails'));
    }

    public function add()
    {
        $allSales = $this->userService->getActiveEmployeeList(Auth()->user()->company_id);
        $allConnectors = $this->connector_service->connectorList(Auth()->user()->company_id);
        $allProducts = $this->productService->getAllProductsList(Auth()->user()->company_id);
        return view('company.leads.add', compact('allSales', 'allConnectors', 'allProducts'));
        // return view('company.leads.add');
    }
    public function store(LeadStoreRequest $request)
    {
        try {
            $payload = $request->all();
            $randnum = rand(1111111111, 9999999999);

            if (!isset($payload['company_id'])) {
                $payload['company_id'] = auth()->user()->company_id;
                $payload['case_id'] = 'DC' . $randnum;
            }

            $leadDetails = $this->leadService->create($payload);
            $payload['lead_id'] = $leadDetails['id'];
            $payload['lead_state'] = 'LEAD';
            $payload['lead_sub_state'] = 'LEAD';
            $this->leadStatusManageService->create($payload);
            return response()->json([
                'success' => true,
                'message' => 'Lead added successfully.',
                'lead_id' => $leadDetails['id'],
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $companyIDs = getCompanyIDs();
        $editLeadDetails = $this->leadService->findByLeadId($id);

        return view('company.leads.edit', compact('editLeadDetails'));
    }
    public function product($id)
    {
        $editProductDetails = $this->leadService->findByLeadId($id);

        return view('company.leads.product', compact('editProductDetails'));
    }

    public function view($id)
    {
        $companyID = auth()->user()->company_id;
        $viewLeadDetails = $this->leadService->findByLeadCaseId($id);
        $viewLoanDetails = $this->loanService->findByLeadId($viewLeadDetails->id);
        $viewIncomeDetails = $this->incomeDetailService->findByLeadId($viewLeadDetails->id);
        $coApplicantDetails = $this->coApplicantService->findByLeadId($viewLeadDetails->id);
        $leadStatusManageDetails = $this->leadStatusManageService->findByLeadId($viewLeadDetails->id, $companyID);
        $lenderDetails = $this->lenderService->lenderList($viewLoanDetails->product);
        $selectedLenderIds = $this->leadService->selectedLender($viewLeadDetails->id, $companyID);
        $selectedLenderNames = $this->leadService->selectedLenderName($viewLeadDetails->id, $companyID);
        $leadDocuments = $this->leadService->leadDocuments($viewLeadDetails->id, $companyID);
        return view('company.leads.view', compact('viewLeadDetails', 'viewLoanDetails', 'viewIncomeDetails', 'coApplicantDetails', 'leadStatusManageDetails', 'lenderDetails', 'selectedLenderIds', 'selectedLenderNames', 'leadDocuments'));
    }

    public function updateProduct(UpdateLeadProductRequest $request)
    {
        try {
            $id = $request->lead_id;
            $payload = $request->all();
            $this->loanService->updateProduct($id, $payload);
            $leadData = $this->leadService->find($id);
            return response()->json([
                'success' => true,
                'message' => 'Product selection updated successfully',
                'redirect_url' => route('lead.view', $leadData->case_id)
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function loanUpdate(LoanStoreRequest $request, $id)
    {
        try {
            // $id = $request->lead_id;
            $payload = $request->all();
            $this->loanService->updateProduct($id, $payload);
            $payload['lead_id'] = $id;
            $payload['lead_sub_state'] = 'Prospect';
            $payload['lead_state'] = 'Pre Lender';
            $this->leadService->updateState($payload, $id);
            $payload['lead_state'] = 'Prospect';
            $payload['lead_next_sub_state'] = 'Prospect / Loan Details';
            $this->leadStatusManageService->create($payload);
            $leadData = $this->leadService->find($id);
            return redirect()->route('lead.view', $leadData->case_id)
                ->with(['tab_value' => 'tab_1']);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput()->with('tab_value', 'tab_1');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $payload = $request->all();
            $payload['lead_sub_state'] = 'Prospect';
            $this->leadService->updateDetails($payload, $id);
            $payload['lead_id'] = $id;
            $payload['lead_state'] = 'Prospect';
            $payload['lead_sub_state'] = 'Prospect / Loan Details';
            $payload['lead_next_sub_state'] = 'Prospect / Applicant Details';
            $this->leadStatusManageService->create($payload);
            $leadData = $this->leadService->find($id);
            return redirect()->route('lead.view', $leadData->case_id)
                ->with(['tab_value' => 'tab_2']);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput()->with('tab_value', 'tab_2');
        }
    }
    public function updateAssignedTo(Request $request, $id)
    {
        try {
            $this->leadService->updateDetails($request->all(), $id);
            return response()->json(['message' => 'All cases are updated'], 200);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }
    public function incomeUpdate(Request $request, $id)
    {
        try {
            $payload = $request->all();
            $this->incomeDetailService->updateIncome($id, $payload);
            $payload['lead_id'] = $id;
            $payload['lead_state'] = 'Prospect';
            $payload['lead_sub_state'] = 'Prospect / Applicant Details';
            $payload['lead_next_sub_state'] = 'Prospect / Income Details';
            $this->leadStatusManageService->create($payload);
            $leadData = $this->leadService->find($id);
            return redirect()->route('lead.view', $leadData->case_id)
                ->with(['tab_value' => 'tab_3']);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput()->with('tab_value', 'tab_3');
        }
    }

    public function coApplicantUpdate(CoApplicantStoreRequest $request, $id)
    {
        try {
            $payload = $request->all();
            $this->coApplicantService->updateCoApplicant($id, $payload);
            $payload['lead_id'] = $id;
            $payload['lead_state'] = 'Prospect';
            $payload['lead_sub_state'] = 'Prospect / Nominee Details';
            $payload['lead_next_sub_state'] = 'Documents';
            $this->leadStatusManageService->create($payload);
            $leadData = $this->leadService->find($id);
            return redirect()->route('lead.view', $leadData->case_id)
                ->with(['tab_value' => 'tab_4']);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput()->with('tab_value', 'tab_4');
        }
    }

    public function documents(Request $request)
    {
        try {
            $payload = $request->all();
            $id = $payload['lead_id'];
            $payload['lead_state'] = 'LENDER_SELECTION';
            $payload['lead_sub_state'] = 'LENDER_SELECTION';
            $this->leadService->updateState($payload, $id);
            $payload['lead_state'] = 'LENDER_SELECTION';
            $payload['lead_sub_state'] = 'DOCUMENT';
            $payload['lead_next_sub_state'] = 'Login';
            $this->leadStatusManageService->create($payload);
            $filename = $this->leadService->uploadLoanDocument($payload);
            return response()->json([
                'success' => true,
                'filename' => basename($filename),
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput()->with('tab_value', 'tab_4');
        }
    }
    public function assignLender(Request $request)
    {
        try {
            $payload = $request->all();
            $id = $payload['lead_id'];
            $payload['lead_state'] = 'LOGGED';
            $payload['lead_sub_state'] = 'LOGGED';
            $this->leadService->updateState($payload, $id);
            $this->leadService->addLeadLender($payload);
            $payload['lead_state'] = 'LOGGED';
            $payload['lead_sub_state'] = 'LENDER_SELECTION';
            $payload['lead_next_sub_state'] = 'Disbursed';
            $this->leadStatusManageService->create($payload);
            return response()->json(['message' => 'Lender assigned successfully']);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput()->with('tab_value', 'tab_4');
        }
    }
    public function lenderDecision(Request $request)
    {
        try {
            $payload = $request->all();
            $id = $payload['lead_id'];
            $payload['lead_state'] = $payload['status'];
            $payload['lead_sub_state'] = $payload['status'];
            $finalPayload = Arr::except($payload, ['status']);
            $this->leadService->updateState($finalPayload, $id);
            $this->leadService->updateLoan($payload);
            if ($payload['status'] == 'Rejected') {
                $payload['lead_state'] = 'LENDER_DECISION_REJECTED';
                $payload['lead_sub_state'] = 'LENDER_DECISION_REJECTED';
                $payload['lead_next_sub_state'] = 'Disbursed';
            } else if ($payload['status'] == 'Withdrawn') {
                $payload['lead_state'] = 'LENDER_DECISION_WITHDRAWN';
                $payload['lead_sub_state'] = 'LENDER_DECISION_WITHDRAWN';
                $payload['lead_next_sub_state'] = 'Disbursed';
            } else if ($payload['status'] == 'Pendency') {
                $payload['lead_state'] = 'LENDER_DECISION_PENDENCY';
                $payload['lead_sub_state'] = 'LENDER_DECISION_PENDENCY';
                $payload['lead_next_sub_state'] = 'Disbursed';
            } else {
                $payload['lead_state'] = 'LENDER_DECISION_SANCTIONED';
                $payload['lead_sub_state'] = 'LENDER_DECISION_SANCTIONED';
                $payload['lead_next_sub_state'] = 'Disbursed';
            }
            $leadStatusPayload = Arr::except($payload, ['status']);
            $this->leadStatusManageService->create($leadStatusPayload);
            return response()->json(['message' => 'Lender descision successfully']);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput()->with('tab_value', 'tab_4');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $companyIDs = getCompanyIDs();
        $data = $this->leadService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Leads Deleted Successfully',
                'data' => view('company.leads.list', [
                    'allLeadDetails' => $this->leadService->all($companyIDs),
                    'leadStatusDetails' => $this->leadService->lead($companyIDs),
                    'prospectStatusDetails' => $this->leadService->prospect($companyIDs),
                    'visitStatusDetails' => $this->leadService->visit($companyIDs),
                    'documentationStatusDetails' => $this->leadService->documentation($companyIDs),
                    'lenderSelectionStatusDetails' => $this->leadService->lenderSelection($companyIDs),
                    'loggedStatusDetails' => $this->leadService->login($companyIDs),
                    'sanctionedStatusDetails' => $this->leadService->sanctioned($companyIDs),
                    'rejectedStatusDetails' => $this->leadService->rejected($companyIDs),
                    'withdrawnStatusDetails' => $this->leadService->withdrawn($companyIDs),
                    'pendencyStatusDetails' => $this->leadService->pendency($companyIDs),
                    'disbursedStatusDetails' => $this->leadService->disbursed($companyIDs),
                    'disbursementAllDetails' => $this->leadService->disbursementAll($companyIDs),
                    'completedStatusDetails' => $this->leadService->completed($companyIDs),
                    'incompletedStatusDetails' => $this->leadService->incompleted($companyIDs),
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $statusDetails = $this->leadService->updateStatus($id, $request->status);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Lead Updated Successfully',
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function search(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $allLeadDetails = $this->leadService->serachLead($request);
        if ($allLeadDetails) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.leads.list', [
                    'allLeadDetails' => $allLeadDetails,
                    'leadStatusDetails' => $this->leadService->lead($companyIDs),
                    'prospectStatusDetails' => $this->leadService->prospect($companyIDs),
                    'visitStatusDetails' => $this->leadService->visit($companyIDs),
                    'documentationStatusDetails' => $this->leadService->documentation($companyIDs),
                    'lenderSelectionStatusDetails' => $this->leadService->lenderSelection($companyIDs),
                    'loggedStatusDetails' => $this->leadService->login($companyIDs),
                    'sanctionedStatusDetails' => $this->leadService->sanctioned($companyIDs),
                    'rejectedStatusDetails' => $this->leadService->rejected($companyIDs),
                    'withdrawnStatusDetails' => $this->leadService->withdrawn($companyIDs),
                    'pendencyStatusDetails' => $this->leadService->pendency($companyIDs),
                    'disbursedStatusDetails' => $this->leadService->disbursed($companyIDs),
                    'disbursementAllDetails' => $this->leadService->disbursementAll($companyIDs),
                    'completedStatusDetails' => $this->leadService->completed($companyIDs),
                    'incompletedStatusDetails' => $this->leadService->incompleted($companyIDs),
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function uploadImport(Request $request)
    {
        // Validate that the file is uploaded
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'The file is required and must be an Excel or CSV file.'
            ], 400);
        }
        $import = new LeadImport();

        try {
            $companyIDs = getCompanyIDs();
            $importedData = Excel::import($import, $request->file('file'));

            // $activeUserCount = $this->userService->getActiveEmployees($companyIDs)->count();

            // if (($activeUserCount + $import->count) > auth()->user()->companyDetails->company_size) {

            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Company size limit has been exceeded!',
            //     ], 500);
            // }

            $failures = $import->getFailures();
            if (count($failures) > 0) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $failures,
                ]);
            }
            $allUserDetails = $this->userService->searchFilterEmployee('', Auth()->user()->company_id)->paginate(10);
            return response()->json([
                'status' => 'success',
                'message' => 'Employee imported successfully!',
                'data' => view('company.employee.list', compact('allUserDetails'))->render()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while importing the file.',
            ], 500);
        }
    }
}
