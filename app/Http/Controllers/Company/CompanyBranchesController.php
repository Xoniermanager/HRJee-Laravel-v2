<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Models\CompanyBranch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidateBranch;
use App\Http\Services\BranchServices;
use Illuminate\Support\Facades\Validator;

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
        return view('company.branch.branches-list')->with(['branches'=> $branches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function branch_form()
    {
        $states = DB::table('states')->get();
        $countries = DB::table('countries')->get();
        return view('company.branch.create-branch-form',compact('states','countries'));
    }
    public function add_branch(ValidateBranch $request)
    {

    try {
        $data = $request->all();


            $data['company_id'] = isset(Auth::guard('admin')->user()->id)?Auth::guard('admin')->user()->id:'';
            if(CompanyBranch::create($data))
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
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();
        $branch = $this->branch_services->get_branch_by_id($id)->first();
        if (!$branch) {
            smilify('error','Item Does Not Exists !');
            return redirect('/branch');
        }
         return view('company.branch.create-branch-form', compact('branch','states','countries'));
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
         try {
             $data =  $request->except(['_token']);
             $branchUpdated = $this->branch_services->update_branch($data,$id);
             if(   $branchUpdated )
             {
                smilify('success','Branch Updated Successfully!');
                return redirect('/branch');
             }
             
         } catch (Exception $e) {
             return $e->getMessage();
         }
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