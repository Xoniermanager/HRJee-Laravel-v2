<?php

namespace App\Http\Services;

use App\Models\ConfigurePayout;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ConfigurePayoutRepository;
use Throwable;

class ConfigurePayoutService
{
    private $configurePayoutRepository;
    public function __construct(ConfigurePayoutRepository $configurePayoutRepository)
    {
        $this->configurePayoutRepository = $configurePayoutRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function findByConnectorId($id)
    {
        return $this->configurePayoutRepository->where('connector_id', $id)->with(['product'])->orderBy('id', 'DESC')->paginate(10);
    }
    public function getAllDisbursedPayout()
    {
        return $this->configurePayoutRepository->with(['lead', 'loan'])->orderBy('id', 'DESC')->paginate(10);
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
        return $this->configurePayoutRepository->create($finalPayload);
    }
    
}
