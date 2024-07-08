<?php

namespace App\Observers;

use App\Http\Services\CompanyUserService;
use App\Models\CompanyBranch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CompanyBranchObserver
{
    private $companyUserServices;

    public function __construct(
        CompanyUserService $companyUserServices
    ) {
        $this->companyUserServices  = $companyUserServices;
    }
    /**
     * Handle the CompanyBranch "created" event.
     */
    public function created(CompanyBranch $companyBranch): void
    {

        $data['branch_id'] = $companyBranch->id;
        $data['company_id'] = auth()->guard('admin')->user()->id;
        $data['name'] = $companyBranch->name;
        $data['email'] = $companyBranch->email;
        $data['password'] = Hash::make('password');
        $this->companyUserServices->create($data);
    }

    /**
     * Handle the CompanyBranch "updated" event.
     */
    public function updated(CompanyBranch $companyBranch): void
    {

        $match['branch_id'] = $companyBranch->id;
        $data['branch_id'] = $companyBranch->id;
        $data['name'] = $companyBranch->name;
        $data['email'] = $companyBranch->email;
        $data['password'] = Hash::make('password');
        $this->companyUserServices->updateOrCreate($match, $data);
    }

    /**
     * Handle the CompanyBranch "deleted" event.
     */
    public function deleted(CompanyBranch $companyBranch): void
    {
        $this->companyUserServices->softDelete($companyBranch->id);
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
    }
}
