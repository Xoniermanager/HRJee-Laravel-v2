<?php

namespace App\Http\Services;

use App\Http\Services\UserService;
use App\Http\Services\ConnectorService;
use App\Repositories\ConnectorRepository;
use App\Repositories\LeadRepository;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Output\NullOutput;

use function PHPUnit\Framework\returnValue;

class ReportService
{
    private $userService;
    private $connectorService;
    private $connectorRepository;
    private $leadRepository;

    public function __construct(UserService $userService, ConnectorService $connectorService, ConnectorRepository $connectorRepository, LeadRepository $leadRepository)
    {
        $this->connectorService = $connectorService;
        $this->userService = $userService;
        $this->connectorRepository = $connectorRepository;
        $this->leadRepository = $leadRepository;
    }

    public function getConnectorByFromAndToDate($fromDate, $toDate, $companyId)
    {
        $fromDate = Carbon::parse($fromDate)->startOfDay();
        $toDate = Carbon::parse($toDate)->endOfDay();
        return $this->connectorRepository->with('user')->where('company_id', $companyId)->whereBetween('created_at', [$fromDate, $toDate]);
    }
    public function getLeadByFromAndToDate($fromDate, $toDate, $companyId)
    {
        $fromDate = Carbon::parse($fromDate)->startOfDay();
        $toDate = Carbon::parse($toDate)->endOfDay();
        return $this->leadRepository->where('company_id', $companyId)->with(['coApplicants', 'loan', 'incomeDetails', 'selectedLenders'])->whereBetween('created_at', [$fromDate, $toDate]);
    }

}
