<?php

namespace App\Http\Controllers;

use App\Rules\OnlyString;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    private $department_services; 
    public function __construct(DepartmentServices $department_services)
    {
            $this->department_services = $department_services;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = $this->department_services->get_departments();
        return view('admin.department.department-list')->with(['departments'=> $departments]);
    }

    public function add_departments(Request $request)
    {
        try
        {

        $validateDepartment  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, 'unique:departments,name'],
        ]);

        if ($validateDepartment->fails()) {
            return redirect('department/create')->withErrors($validateDepartment)->withInput();
        }
        $data = $request->all();

        $data['company_id'] = isset(Auth::guard('admin')->user()->id)?Auth::guard('admin')->user()->id:'';
        if(Department::create($data))
        { 
            smilify('success','Department Created Successfully!');
            return redirect('/departments');
        }
    }
    catch (\Exception $e) {
        return $e->getMessage();
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_departments($id)
    {
        try{
        $department = $this->department_services->get_department_by_id($id)->first();

        if (!$department) {
            smilify('error','Item Does Not Exists !');
            return redirect('/departments');
        }
         return view('admin.department.create-department-form', compact('department'));
    }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update_departments(Request $request, $id)
    {
        $validateDepartment  = Validator::make($request->all(), [
            'name' => ['required', 'string', new OnlyString, Rule::unique('departments')->ignore($id)],
        ]);
    
        if ($validateDepartment->fails()) {
            return redirect()->route('edit.department', $id)->withErrors($validateDepartment)->withInput();
        }

        // Find the department by ID
        $department = $this->department_services->get_department_by_id($id)->first();

        if (!$department) {
            smilify('error','Department Not Found!');
            return redirect('/departments');
        }
    
        // Update the department's name
        $department->name = $request->input('name');
        $department->save();
    
        smilify('success','Department Updated Successfully!');
        return redirect('/departments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_departments($id)
    {
        try {
        $validateDepartment = Validator::make(['id' => $id],
            ['id' => 'required|exists:departments,id']
        );
        if ($validateDepartment->fails()) {
            smilify('error','Item Does Not Exists !');
            return redirect('/departments');
        }
        $response  = $this->department_services->delete_department_by_id($id);
        if($response)
        {
            smilify('success','Department Deleted Successfully!');
            return redirect('/departments');
        }
    }
    catch (Exception $e) {
        return $e->getMessage();
    }
    }
}
