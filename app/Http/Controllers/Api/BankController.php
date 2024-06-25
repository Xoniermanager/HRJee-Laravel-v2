<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\BankService;
use Illuminate\Http\Request;
use Throwable;

class BankController extends Controller
{
    private $bankService;
    public function __construct(BankService $bankService)
    {
        $this->bankService = $bankService;
    }

    
    public function bankDetails(Request $request)
    {

        try {
            $bankDetails= $this->bankService->bankDetails();
            if ($bankDetails)
                return apiResponse('address', $bankDetails);
            else
                return errorMessage('null', 'Address not found!');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
       
    }
    
}
