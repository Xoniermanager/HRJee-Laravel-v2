<?php

namespace App\Http\Controllers;

use App\Http\Requests\Updatecompany_branchesRequest;
use App\Http\Requests\ValidateBranch;
use App\Http\Services\BranchServices;
use App\Models\CompanyBranch;
use App\Rules\OnlyString;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CompanyBranchesController extends Controller
{
    private $branch_services;
    public function __construct(
        BranchServices $branch_services,
        )
    {
            $this->branch_services = $branch_services;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = $this->branch_services->get_branches();
        return view('admin.branch.branches-list')->with(['branches'=> $branches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function branch_form()
    {
        $states = DB::table('states')->get();
        return view('admin.branch.create-branch-form')->with(['states'=>$states]);
    }
    public function add_branch(ValidateBranch $request)
    {
    try {
        if(CompanyBranch::create($request->all()))
        { 
            smilify('success','Branch Created Successfully!');
            return redirect('/branch');
        }
    }
    catch (Exception $e) {
        return $e->getMessage();
    }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit_branch($id)
    {
        try{
        $states = DB::table('states')->get();
        $branch = $this->branch_services->get_branch_by_id($id)->first();
        if (!$branch) {
            smilify('error','Item Does Not Exists !');
            return redirect('/branch');
        }
         return view('admin.branch.create-branch-form', compact('branch','states'));
    }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update_branch(Request $request, $id)
    {

        // Find the branch by ID
        $branch = $this->branch_services->get_branch_by_id($id)->first();

        if (!$branch) {
            smilify('error','branch Not Found!');
            return redirect('/branch');
        }
    
        // Update the branch's name
        $branch->name = $request->input('name');
        $branch->save();
    
        smilify('success','branch Updated Successfully!');
        return redirect('/branch');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_branch($id)
    {
        try {
        $validatebranch = Validator::make(['id' => $id],
            ['id' => 'required|exists:company_branches,id']
        );
        if ($validatebranch->fails()) {
            smilify('error','Item Does Not Exists !');
            return redirect('/branch');
        }
        $response  = $this->branch_services->delete_branch_by_id($id);
        if($response)
        {
            smilify('success','branch Deleted Successfully!');
            return redirect('/branch');
        }
    }
    catch (Exception $e) {
        return $e->getMessage();
    }
    }
}