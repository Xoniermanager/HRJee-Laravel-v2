<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storeotp_varificationRequest;
use App\Http\Requests\Updateotp_varificationRequest;
use App\Models\otp_varification;

class OtpVarificationController extends Controller
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
    public function store(Storeotp_varificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(otp_varification $otp_varification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(otp_varification $otp_varification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateotp_varificationRequest $request, otp_varification $otp_varification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(otp_varification $otp_varification)
    {
        //
    }
}
