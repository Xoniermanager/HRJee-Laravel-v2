<?php

namespace App\Http\Services\Api;
 
use App\Repositories\UserBankDetailRepository; 
use Throwable;

class BankService
{

    private $bankRepository;
    public function __construct(UserBankDetailRepository $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }
    public function bankDetails()
    {
        try {
            $details = $this->bankRepository->bankDetails();
            return apiResponse('bank_details', $details);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
