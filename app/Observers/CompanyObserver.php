<?php

namespace App\Observers;

use App\Http\Services\CompanyUserService;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Support\Facades\Log;

class CompanyObserver
{
    private $companyUserServices;

    public function __construct(
        CompanyUserService $companyUserServices
    ) {
        $this->companyUserServices  = $companyUserServices;
    }
    /**
     * Handle the Company "created" event.
     */
    public function created(Company $company): void
    {
        Log::error('Created');
    }
    public function creating(Company $company): void
    {
        Log::error('Creating');
    }

    /**
     * Handle the Company "updated" event.
     */

    public function updated(Company $company): void
    {

        $match['company_id'] = $company->id;
        $data['company_id'] = $company->id;
        $data['name'] = $company->name;
        $data['email'] = $company->email;

        $this->companyUserServices->updateOrCreate($match, $data);
    }
    /**
     * Handle the Company "deleted" event.
     */
    public function deleted(Company $company): void
    {
        //
    }

    /**
     * Handle the Company "restored" event.
     */
    public function restored(Company $company): void
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     */
    public function forceDeleted(Company $company): void
    {
        //
    }
}
