<?php

namespace App\Http\Controllers;

use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Models\Designations;
use App\Rules\OnlyString;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class DesignationsController extends Controller
{
    private $designation_services; 
    private $departments_services;
    public function __construct(
        DesignationServices $designation_services,
        DepartmentServices $departments_services
        )
    {
            $this->departments_services = $departments_services;
            $this->designation_services = $designation_services;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = $this->designation_services->get_designations();
        return view('admin.designation.designation-list')->with(['designations'=> $designations]);
    }

    public function designation_form()
    {
        $departments = $this->departments_services->get_departments();
        return view('admin.designation.create-designation-form', compact('departments'));
    }

    public function add_designations(Request $request)
    {
        try
        {
        $validatedesignation  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, 'unique:designations,name'],
            'department_id' => 'required',
            'company_id'  => 'sometimes'
        ]);

        if ($validatedesignation->fails()) {
            return redirect()->route('create.designation.form')->withErrors($validatedesignation)->withInput();
        }
       
        if(Designations::create($request->all()))
        { 
            smilify('success','designation Created Successfully!');
            return redirect('/designations');
        }
    }
    catch (Exception $e) {
        return $e->getMessage();
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_designations($id)
    {
        try{
        $departments = $this->departments_services->get_departments();
        $designation = $this->designation_services->get_designations_by_id($id)->first();


        if (!$designation) {
            smilify('error','Item Does Not Exists !');
            return redirect('/designations');
        }
         return view('admin.designation.create-designation-form', compact('designation','departments'));
    }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update_designations(Request $request, $id)
    {
        $validatedesignation  = Validator::make($request->all(), [
            'name'  => ['required', 'string', new OnlyString, Rule::unique('designations')->ignore($id)],
            'department_id' => 'required',
            'company_id'  => 'sometimes'
        ]);
    
        if ($validatedesignation->fails()) {
            return redirect()->route('edit.designation', $id)->withErrors($validatedesignation)->withInput();
        }

        // Find the designation by ID
        $designation = $this->designation_services->get_designations_by_id($id)->first();

        if (!$designation) {
            smilify('error','Designation Not Found!');
            return redirect('/designations');
        }
    
        // Update the designation's name
        $designation->name = $request->input('name');
        $designation->department_id = $request->input('department_id');
        $designation->save();
    
        smilify('success','Designation Updated Successfully!');
        return redirect('/designations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_designations($id)
    {
        try {
        $validatedesignation = Validator::make(['id' => $id],
            ['id' => 'required|exists:designations,id']
        );
        if ($validatedesignation->fails()) {
            smilify('error','Item Does Not Exists !');
            return redirect('/designations');
        }
        $response  = $this->designation_services->delete_designations_by_id($id);
        if($response)
        {
            smilify('success','Designation Deleted Successfully!');
            return redirect('/designations');
        }
    }
    catch (Exception $e) {
        return $e->getMessage();
    }
    }
}
