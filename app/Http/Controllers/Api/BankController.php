<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\BankService;
use Illuminate\Http\Request;

class BankController extends Controller
{
    private $bankService;
    public function __construct(BankService $bankService)
    {
        $this->bankService = $bankService;
    }

    
    public function bankDetails(Request $request)
    {
        return $this->bankService->bankDetails();
    }
    
}
