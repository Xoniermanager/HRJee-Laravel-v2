<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Rules\OnlyString;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\permissionsServices;

class PermissionsController extends Controller
{
    private $permissions_services; 
    public function __construct(PermissionsServices $permissions_services)
    {
            $this->permissions_services = $permissions_services;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->permissions_services->get_permissions();
        return view('company.roles_and_permission.permissions-list')->with(['permissions'=> $permissions]);
    }

    public function permissions_form()
    {
        return view('company.roles_and_permission.create-permissions-form');
    }
    public function add_permissions(Request $request)
    {
        try
        {

        $validatepermissions  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, 'unique:permissions,name'],
        ]);

        if ($validatepermissions->fails()) {
            return redirect('permissions/create')->withErrors($validatepermissions)->withInput();
        }
       
        if(Permissions::create($request->all()))
        { 
            smilify('succes','permissions Created Succesfully!');
            return redirect('/permissions');
        }
    }
    catch (Exception $e) {
        return $e->getmessage();
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_permissions($id)
    {
        try{
        $permissions = $this->permissions_services->get_permissions_by_id($id)->first();

        if (!$permissions) {
            smilify('error','Item Does Not Exists !');
            return redirect('/permissions');
        }
         return view('company.roles_and_permission.create-permissions-form', compact('permissions'));
    }
        catch (Exception $e) {
            return $e->getmessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update_permissions(Request $request, $id)
    {
        $validatepermissions  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, Rule::unique('permissions')->ignore($id)],
        ]);
    
        if ($validatepermissions->fails()) {
            return redirect()->route('edit.role', $id)->withErrors($validatepermissions)->withInput();
        }

        // Find the permissions by ID
        $permissions = $this->permissions_services->get_permissions_by_id($id)->first();

        if (!$permissions) {
            smilify('error','permissions Not Found!');
            return redirect('/permissions');
        }
    
        // Update the permissions's name
        $permissions->name = $request->input('name');
        $permissions->save();
    
        smilify('succes','permissions Updated Succesfully!');
        return redirect('/permissions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_permissions($id)
    {
        try {
        $validatepermissions = Validator::make(['id' => $id],
            ['id' => 'required|exists:permissions,id']
        );
        if ($validatepermissions->fails()) {
            smilify('error','Item Does Not Exists !');
            return redirect('/permissions');
        }
        $response  = $this->permissions_services->delete_permissions_by_id($id);
        if($response)
        {
            smilify('succes','permissions Deleted Succesfully!');
            return redirect('/permissions');
        }
    }
    catch (Exception $e) {
        return $e->getmessage();
    }
    }
}
