<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConnectorExport;
use App\Exports\LeadExport;
use App\Http\Services\ReportService;
use App\Http\Services\ConnectorService;
use Illuminate\Database\Connectors\Connector;

class ReportController extends Controller
{

    public $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        // $userType = Auth()->user();
        // dd($userType);
        return view('company.reports.index');
    }
    public function reportExport(Request $request)
    {
        $companyId = auth()->user()->company_id;
        if ($request->type == 'Connector') {
            $filename = '-Connector-' . $request->from_date . '-' . $request->to_date . '.xlsx';
            $connectorDetails = $this->reportService->getConnectorByFromAndToDate($request->from_date, $request->to_date, $companyId)->get();
            return Excel::download(new ConnectorExport($connectorDetails), $filename);
        }
        elseif ($request->type == 'Lead') {
            $filename = '-Lead-' . $request->from_date . '-' . $request->to_date . '.xlsx';
            $leadDetails = $this->reportService->getLeadByFromAndToDate($request->from_date, $request->to_date, $companyId)->get();
            return Excel::download(new LeadExport($leadDetails), $filename);
        } else {
            return back()->with('error', "Oop's This module is not developed yet!");
            
        }
    }
}
