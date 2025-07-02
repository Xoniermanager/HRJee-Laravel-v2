<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\DefaultLenderService;
use App\Http\Services\LenderService;
use App\Http\Services\PayoutSettingService;
use App\Http\Services\ProductService;

class PayoutSettingController extends Controller
{
    private $productService;
    private $payoutSettingService;
    private $lenderService;
    private $defaultLenderService;

    public function __construct(ProductService $productService, PayoutSettingService $payoutSettingService, LenderService $lenderService, DefaultLenderService $defaultLenderService)
    {
        $this->productService = $productService;
        $this->payoutSettingService = $payoutSettingService;
        $this->lenderService = $lenderService;
        $this->defaultLenderService = $defaultLenderService;
    }

   public function index(){
    
    $companyId = auth()->user()->company_id;
        $productDetails = $this->productService->getAllProductsList($companyId);
        $lenderDetails = $this->defaultLenderService->lenderByCompanyId($companyId);
        $payoutSettingData = $this->payoutSettingService->all($companyId);
        return view('company.payout_setting.index', compact('productDetails', 'lenderDetails', 'payoutSettingData'));
   }

    public function store(Request $request)
    {
        try {
            $payload = $request->all();
            $payload['company_id'] = auth()->user()->company_id;
            $payload['created_by'] = auth()->user()->id;
            $payoutSettingData = $this->payoutSettingService->create($payload);
            if ($payoutSettingData) {
                $payoutSettingData = $this->payoutSettingService->all($payoutSettingData->company_id);
                return view('company.payout_setting.payout_list', compact('payoutSettingData'));
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
