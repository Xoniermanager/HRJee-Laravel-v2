<?php

namespace App\Observers;

use App\Http\Services\CompanyServices;
use App\Models\Company;

class CompanyObserver
{

    private $company_services;
    // private $branch_services;

    public function __construct(CompanyServices $company_services)
    // BranchServices $branch_services)

    {
        $this->company_services  = $company_services;
        // $this->branch_services = $branch_services;
    }
    /**
     * Handle the Company "created" event.
     */
    public function created(Company $company): void
    {
        // $data['company_id'] = $company->id;
        // $data['email'] = $company->email;
        // $data['name'] = $company->name;
        // $this->company_services->create($data);
    }

    /**
     * Handle the Company "updated" event.
     */
    public function updated(Company $company): void
    {
        // $match['company_id'] = $company->id ?? 1;
        // $data['company_id'] = $company->id ?? 1;
        // $data['email'] = $company->email ?? 'ashish"gmail.com';
        // $data['name'] = $company->name ?? 'ashish';

        // $this->company_services->updateOrCreate($match, $data);
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
