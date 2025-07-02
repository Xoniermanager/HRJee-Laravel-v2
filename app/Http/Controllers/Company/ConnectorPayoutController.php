<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Services\ConfigurePayoutService;

class ConnectorPayoutController extends Controller
{
    private $configurePayoutService;

    public function __construct(ConfigurePayoutService $configurePayoutService)
    {
        $this->configurePayoutService = $configurePayoutService;
    }

    public function index()
    {

        $caseDisbursedLists = $this->configurePayoutService->getAllDisbursedPayout();
        return view('company.connector_payout.index', compact('caseDisbursedLists'));
    }
}
