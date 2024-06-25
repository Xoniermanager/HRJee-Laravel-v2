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


        return  $this->bankRepository->bankDetails(auth()->user()->id);
    }
}
