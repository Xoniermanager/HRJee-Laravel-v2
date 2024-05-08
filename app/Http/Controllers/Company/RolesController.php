<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Models\roles;
use App\Rules\OnlyString;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Services\rolesServices;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    private $roles_services; 
    public function __construct(RolesServices $roles_services)
    {
            $this->roles_services = $roles_services;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roles_services->get_roles();
        return view('company.roles_and_permission.roles-list')->with(['roles'=> $roles]);
    }

    public function role_form()
    {
        return view('company.roles_and_permission.create-roles-form');
    }
    public function add_roles(Request $request)
    {
        try
        {

        $validateroles  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, 'unique:roles,name'],
        ]);

        if ($validateroles->fails()) {
            return redirect('roles/create')->withErrors($validateroles)->withInput();
        }
       
        if(roles::create($request->all()))
        { 
            smilify('succes','roles Created Succesfully!');
            return redirect('/roles');
        }
    }
    catch (Exception $e) {
        return $e->getmessage();
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_roles($id)
    {
        try{
        $roles = $this->roles_services->get_roles_by_id($id)->first();

        if (!$roles) {
            smilify('error','Item Does Not Exists !');
            return redirect('/roles');
        }
         return view('company.roles_and_permission.create-roles-form', compact('roles'));
    }
        catch (Exception $e) {
            return $e->getmessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update_roles(Request $request, $id)
    {
        $validateroles  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, Rule::unique('roles')->ignore($id)],
        ]);
    
        if ($validateroles->fails()) {
            return redirect()->route('edit.role', $id)->withErrors($validateroles)->withInput();
        }

        // Find the roles by ID
        $roles = $this->roles_services->get_roles_by_id($id)->first();

        if (!$roles) {
            smilify('error','roles Not Found!');
            return redirect('/roles');
        }
    
        // Update the roles's name
        $roles->name = $request->input('name');
        $roles->save();
    
        smilify('succes','roles Updated Succesfully!');
        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_roles($id)
    {
        try {
        $validateroles = Validator::make(['id' => $id],
            ['id' => 'required|exists:roles,id']
        );
        if ($validateroles->fails()) {
            smilify('error','Item Does Not Exists !');
            return redirect('/roles');
        }
        $response  = $this->roles_services->delete_roles_by_id($id);
        if($response)
        {
            smilify('succes','roles Deleted Succesfully!');
            return redirect('/roles');
        }
    }
    catch (Exception $e) {
        return $e->getmessage();
    }
    }
}
