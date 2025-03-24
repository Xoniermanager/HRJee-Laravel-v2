<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\Country;
use Illuminate\Support\Facades\Log;

class CompanyObserver
{

    public function __construct() {}
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
