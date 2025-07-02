<?php

namespace App\Http\Services;

use Illuminate\Support\Arr;
use App\Repositories\PayoutSettingRepository;
use Throwable;

class PayoutSettingService
{
    private $payoutSettingRepository;
    public function __construct(PayoutSettingRepository $payoutSettingRepository)
    {
        $this->payoutSettingRepository = $payoutSettingRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function all($companyId)
    {
        return $this->payoutSettingRepository->where('company_id', $companyId)->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */

   public function create(array $data)
    {
        $finalPayload = Arr::except($data, ['_token']);
        return $this->payoutSettingRepository->create($finalPayload);
    }
    
}
