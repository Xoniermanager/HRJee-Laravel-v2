<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateConnector;
use App\Http\Services\ConnectorService;
use App\Http\Services\PayoutService;
use App\Http\Services\ConfigurePayoutService;
use App\Http\Services\EmployeeServices;
use App\Http\Services\ProductService;
use App\Http\Services\UserService;
use App\Http\Services\UserShiftService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\CustomRoleService;
use Carbon\Carbon;
use App\Mail\ConnectorCredentialMail;
use Illuminate\Support\Facades\Mail;

class CompanyConnectorController extends Controller
{
    private $connector_services;
    private $userService;
    private $payoutService;
    private $productService;
    private $configurePayoutService;
    private $employeeService;
    private $userShiftService;
    private $customRoleService;

    public function __construct(ConnectorService $connector_services, UserService $userService, PayoutService $payoutService, ProductService $productService, ConfigurePayoutService $configurePayoutService, EmployeeServices $employeeService, UserShiftService $userShiftService, CustomRoleService $customRoleService)
    {
        $this->connector_services = $connector_services;
        $this->userService = $userService;
        $this->payoutService = $payoutService;
        $this->productService = $productService;
        $this->configurePayoutService = $configurePayoutService;
        $this->employeeService = $employeeService;
        $this->userShiftService = $userShiftService;
        $this->customRoleService = $customRoleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();

        $connectors = $this->connector_services->all($companyIDs);
        $allConnectorCount = $this->connector_services->allConnectorCount($companyIDs);
        $pendingApprovalUnassignedConnectorCount = $this->connector_services->pendingApprovalUnassignedConnectorCount($companyIDs);
        $pendingApprovalAssignedConnectorCount = $this->connector_services->pendingApprovalAssignedConnectorCount($companyIDs);
        $approvedConnectorCount = $this->connector_services->approvedConnectorCount($companyIDs);
        $rejectedConnectorCount = $this->connector_services->rejectedConnectorCount($companyIDs);

        // dd($allConnectorCount);
        return view('company.connector.index', [
            'connectors' => $connectors,
            'allConnectorCount' => $allConnectorCount,
            'pendingApprovalUnassignedConnectorCount' => $pendingApprovalUnassignedConnectorCount,
            'pendingApprovalAssignedConnectorCount' => $pendingApprovalAssignedConnectorCount,
            'approvedConnectorCount' => $approvedConnectorCount,
            'rejectedConnectorCount' => $rejectedConnectorCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function add(Request $request)
    {
        return view('company.connector.add');
    }
    public function store(ValidateConnector $request)
    {
        try {
            $companyIDs = getCompanyIDs();
            $activeUserCount = $this->userService->getActiveEmployees($companyIDs)->count();

            if ($activeUserCount >= auth()->user()->companyDetails->company_size) {
                DB::rollBack();
                return redirect(route('connector.add'))->with('error', 'Company size limit has been exceeded!');
            }
            // $allRoles = $this->customRoleService->all(auth()->user()->company_id);

            $payload['company_id'] = Auth()->user()->company_id;
            $payload['name'] = $request->connector_name;
            $nameParts = explode(' ', $payload['name']);
            if (count($nameParts) > 1) {
                $firstPart = $nameParts[0];
            } else {
                $firstPart = $payload['name'];
            }
            $payload['password'] = $firstPart . '@' . rand(111, 999);
            $payload['email'] = $request->email;
            $payload['role_id'] = 4;
            $payload['created_by'] = Auth()->user()->id;
            $userCreated = $this->userService->create($payload);
            $empDetail['user_id'] = $userCreated->id;
            $empDetail['official_email_id'] = $request->email;
            $empDetail['gender'] = $request->gender;
            if ($empDetail['gender'] == 'Male') {
                $empDetail['gender'] = 'M';
            } elseif ($empDetail['gender'] == 'Female') {
                $empDetail['gender'] = 'F';
            } else {
                $empDetail['gender'] = 'O';
            }
            $empDetail['employee_status_id'] = 1;
            $empDetail['date_of_birth'] = Carbon::now()->format('y-m-d');
            $empDetail['joining_date'] = Carbon::now()->format('y-m-d');
            $empDetail['phone'] = $request->msisdn;
            $empDetail['employee_type_id'] = 1;
            $empDetail['department_id'] = 4;
            $empDetail['designation_id'] = 6;
            $empDetail['company_branch_id'] = 1;
            $empDetail['qualification_id'] = 4;
            $empDetail['offer_letter_id'] = '#' . rand(1111111111, 9999999999);
            $empDetail['emp_id'] = 'XT' . rand(1111111111, 9999999999);
            $empDetail['user_details_id'] = null;
            $empDetail['skill_id'] = 4;
            $empDetail['language'] = [
                '1' => [
                    'language_id' => '1',
                    'read' => 'b',
                    'write' => 'i',
                    'speak' => 'e',
                ],
                '2' => ['language_id' => '2', 'read' => 'e', 'write' => 'b', 'speak' => 'i',],
            ];


            if ($userCreated) {
                $this->employeeService->create($empDetail);
                $this->employeeService->addManagers($empDetail['user_id'], $request->get('manager_id'));
                $randConnector = rand(1111111111, 9999999999);
                $randBusiness = rand(1111111111, 9999999999);

                $request['connector_id'] = 'CONN' . $randConnector;
                $request['bussiness_id'] = 'BI' . $randBusiness;
                $request['company_id'] = Auth()->user()->company_id;
                $request['created_by'] = Auth()->user()->id;
                $connectorData = $request->all();
                $companyConnectors = $this->connector_services->create($connectorData);
                if ($companyConnectors) {
                    Mail::to($request->email)->send(new ConnectorCredentialMail($request->connector_name, $request->email, $payload['password']));
                    return redirect(route('connectors'))->with('success', 'Added Successfully');
                }
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    // public function store(ValidateConnector $request)
    // {
    //     $companyIDs = getCompanyIDs();
    //     try {
    //         $payload = $request->all();
    //         $randConnector = rand(1111111111, 9999999999);
    //         $randBusiness = rand(1111111111, 9999999999);
    //         if (!isset($payload['company_id'])) {
    //             $payload['company_id'] = auth()->user()->company_id;
    //             $payload['created_by'] = auth()->user()->id;
    //             $payload['connector_id'] = 'CONN' . $randConnector;
    //             $payload['bussiness_id'] = 'BI' . $randBusiness;
    //             if (empty($payload['email'])) {
    //                 $payload['email'] = $payload['msisdn'] . "@xyz.com";
    //             }
    //         }
    //         $companyConnectors = $this->connector_services->create($payload);
    //         if ($companyConnectors) {
    //             return redirect(route('connectors'))->with('success', 'Added Successfully');
    //         }
    //     } catch (Exception $e) {

    //         return $e->getMessage();
    //     }
    // }

    public function edit($id)
    {
        $companyId = auth()->user()->company_id;
        // $allUserDetails = $this->userService->getActiveEmployeeList(Auth()->user()->company_id);
        $editConnectorDetails = $this->connector_services->findByConnectorId($id);
        $editPayoutDetails = $this->payoutService->findByConnectorId($id);
        $productDetails = $this->productService->getAllProductsList($companyId);
        $configurePayoutData = $this->configurePayoutService->findByConnectorId($id);
        return view('company.connector.edit', compact('editConnectorDetails', 'editPayoutDetails', 'productDetails', 'configurePayoutData'));
    }
    public function view($id)
    {
        $viewConnectorDetails = $this->connector_services->findByConnectorId($id);
        $viewPayoutDetails = $this->payoutService->findByConnectorId($id);
        $viewConfigurePayoutDetails = $this->configurePayoutService->findByConnectorId($id);
        return view('company.connector.view', compact('viewConnectorDetails', 'viewPayoutDetails', 'viewConfigurePayoutDetails'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(ValidateConnector $request, $id)
    {
        $companyIDs = getCompanyIds();
        try {
            $updateData = $request->except(['_token', 'id']);
            $companyConnectors = $this->connector_services->updateDetails($updateData, $id);
            if ($companyConnectors) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Connector updated successfully'
                    ]);
                }
                return redirect(route('connectors'))->with('success', 'Updated Successfully');
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function updateKyc(Request $request, $id)
    {
        $companyIDs = getCompanyIds();
        try {
            $updateData = $request->except(['_token', 'id']);
            $companyConnectors = $this->connector_services->updateKyc($updateData, $id);
            if ($companyConnectors) {
                return redirect()->back()->with('success', 'kyc updated');
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function payout(Request $request)
    {
        try {
            $payload = $request->all();
            $payload['company_id'] = auth()->user()->company_id;
            $payload['created_by'] = auth()->user()->id;
            $payoutData = $this->payoutService->updateDetails($payload);
            if ($payoutData) {
                return response()->json([
                    'message' => 'payout updated successfully'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $companyIDs = getCompanyIDs();
        $deletedData = $this->connector_services->deleteDetails($id);
        $connectors = $this->connector_services->all($companyIDs);
        $allConnectorCount = $this->connector_services->allConnectorCount($companyIDs);
        $pendingApprovalUnassignedConnectorCount = $this->connector_services->pendingApprovalUnassignedConnectorCount($companyIDs);
        $pendingApprovalAssignedConnectorCount = $this->connector_services->pendingApprovalAssignedConnectorCount($companyIDs);
        $approvedConnectorCount = $this->connector_services->approvedConnectorCount($companyIDs);
        $rejectedConnectorCount = $this->connector_services->rejectedConnectorCount($companyIDs);
        if ($deletedData) {
            return response()->json([
                'success' => 'Connector Deleted Successfully',
                'data' => view('company.connector.connectors-list', compact('connectors', 'allConnectorCount', 'pendingApprovalUnassignedConnectorCount', 'pendingApprovalAssignedConnectorCount', 'approvedConnectorCount', 'rejectedConnectorCount'))->render()

            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function searchConnectorFilter(Request $request)
    {
        $companyIDs = Auth()->user()->company_id;
        if (!empty($request)) {
            $connectors = $this->connector_services->searchInCompanyConnector($request);
        } else {
            $connectors = $this->connector_services->all($companyIDs);
        }
        $connectors = $connectors ?? [];

        $allConnectorCount = $this->connector_services->allConnectorCount($companyIDs);
        $pendingApprovalUnassignedConnectorCount = $this->connector_services->pendingApprovalUnassignedConnectorCount($companyIDs);
        $pendingApprovalAssignedConnectorCount = $this->connector_services->pendingApprovalAssignedConnectorCount($companyIDs);
        $approvedConnectorCount = $this->connector_services->approvedConnectorCount($companyIDs);
        $rejectedConnectorCount = $this->connector_services->rejectedConnectorCount($companyIDs);

        return response()->json([
            'success' => 'Search complete',
            'data' => view('company.connector.connectors-list', compact(
                'connectors',
                'allConnectorCount',
                'pendingApprovalUnassignedConnectorCount',
                'pendingApprovalAssignedConnectorCount',
                'approvedConnectorCount',
                'rejectedConnectorCount'
            ))->render()
        ]);
    }
    public function searchAssignTo(Request $request)
    {

        $allUserDetails = $this->userService->getSerachEmployees(Auth()->user()->company_id, $request);
        return response()->json([
            'success' => 'Search complete',
            'data' => $allUserDetails,
        ]);
    }
    public function searchConnectors(Request $request)
    {
        $connectors = $this->connector_services->searchConnector($request);
        return response()->json([
            'success' => 'Search complete',
            'data' => $connectors,
        ]);
    }

    public function storeConfigurePayout(Request $request)
    {
        try {
            $payload = $request->all();
            $payload['company_id'] = auth()->user()->company_id;
            $payload['created_by'] = auth()->user()->id;
            $configurePayoutData = $this->configurePayoutService->create($payload);
            if ($configurePayoutData) {
                $configurePayoutData = $this->configurePayoutService->findByConnectorId($configurePayoutData->connector_id);
                return view('company.connector.configure-payouts', compact('configurePayoutData'));
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function filter(Request $request)
    {
        $status = $request->get('status');
        $companyIDs = getCompanyIDs();

        $query = $this->connector_services->byStatus($companyIDs, $status);

        $connectors = $query->get();

        $html = view('company.connector.connector-table-rows', compact('connectors'))->render();

        return response()->json(['html' => $html]);
    }
}
