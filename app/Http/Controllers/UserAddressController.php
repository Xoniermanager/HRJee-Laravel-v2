<?php

namespace App\Http\Controllers;

use App\Models\user_address;
use App\Http\Requests\Storeuser_addressRequest;
use App\Http\Requests\Updateuser_addressRequest;

class UserAddressController extends Controller
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
    public function store(Storeuser_addressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(user_address $user_address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_address $user_address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateuser_addressRequest $request, user_address $user_address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_address $user_address)
    {
        //
    }
}
