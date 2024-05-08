<?php

namespace App\Http\Controllers;

use Exception;
use App\Rules\OnlyString;
use App\Models\Designations;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\DesignationServices;

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
        $validateDesignation  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, 'unique:designations,name'],
            'department_id' => 'required',
        ]);
        $data = $request->all();
        if ($validateDesignation->fails()) {
            return redirect()->route('create.designation.form')->withErrors($validateDesignation)->withInput();
        }
        $data['company_id'] = isset(Auth::guard('admin')->user()->id)?Auth::guard('admin')->user()->id:'';
        if(Designations::create($data))
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
    public function demo_data(Request $request)
    {
        $departments = $this->departments_services->get_departments();

        // Get the callback function name from the request
        $callback = $request->get('callback');

        // Create a JSON response with the data
        $jsonResponse = Response::json($departments);

        // If a callback function name is provided, wrap the JSON response with it
        if ($callback) {
            $jsonpResponse = $jsonResponse->setCallback($callback);
            return $jsonpResponse;
        }

        // Otherwise, return the regular JSON response
        return $jsonResponse;
    }
}
