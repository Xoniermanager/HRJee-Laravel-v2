<?php

namespace App\Observers;

use App\Models\CompanyBranch;

class CompanyBranchObserver
{
    /**
     * Handle the CompanyBranch "created" event.
     */
    public function created(CompanyBranch $companyBranch): void
    {
        //
    }

    /**
     * Handle the CompanyBranch "updated" event.
     */
    public function updated(CompanyBranch $companyBranch): void
    {
        //
    }

    /**
     * Handle the CompanyBranch "deleted" event.
     */
    public function deleted(CompanyBranch $companyBranch): void
    {
        //
    }

    /**
     * Handle the CompanyBranch "restored" event.
     */
    public function restored(CompanyBranch $companyBranch): void
    {
        //
    }

    /**
     * Handle the CompanyBranch "force deleted" event.
     */
    public function forceDeleted(CompanyBranch $companyBranch): void
    {
        //
    }
}
