<?php

namespace App\Http\Controllers;

use App\Models\CompanyStatus;
use App\Http\Requests\StoreCompanyStatusRequest;
use App\Http\Requests\UpdateCompanyStatusRequest;

class CompanyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyStatus $companyStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyStatus $companyStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyStatusRequest $request, CompanyStatus $companyStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyStatus $companyStatus)
    {
        //
    }
}
