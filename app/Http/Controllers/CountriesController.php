<?php

namespace App\Http\Controllers;

use App\Models\countries;
use App\Http\Requests\StorecountriesRequest;
use App\Http\Requests\UpdatecountriesRequest;

class CountriesController extends Controller
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
    public function store(StorecountriesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(countries $countries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(countries $countries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecountriesRequest $request, countries $countries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(countries $countries)
    {
        //
    }
}
