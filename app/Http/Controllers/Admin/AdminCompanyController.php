<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateCompany;
use App\Http\Services\CompanyServices;

class AdminCompanyController extends Controller
{

    private $companyServices;
    public function __construct(CompanyServices $companyServices)
    {
        $this->companyServices = $companyServices;
    }
    public function index()
    {
        return view('super_admin.company.index', [
            'allCompaniesDetails' => $this->companyServices->all()
        ]);
    }

    public function add_company()
    {
        return view('super_admin.company.add_company');
    }

    public function edit_company(Request $request)
    {
        $companyDetails = $this->companyServices->get_company_by_id($request->query('id'));
        return view('super_admin.company.edit_company', ['companyDetails' => $companyDetails]);
    }

    public function store(ValidateCompany $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $nameForImage = removingSpaceMakingName($request->name);
            $upload_path = "/company_profile";
            $filePath = uploadingImageorFile($request->logo, $upload_path, $nameForImage);
            $request->merge(['logo' => $filePath]);
        }
        $request->merge([
            'joining_date' => Carbon::today()->toDateString(),
        ]);

        if (isset($request->company_id)) {
            $this->companyServices->updateDetails($request->all(), $request->company_id);
            return response()->json([
                'success' => 'Company Updated Successfully',
                'id'     =>  $request->company_id,
            ]);
        } else {
            $createdCompany = $this->companyServices->create($request->all());
            return response()->json([
                'success' => 'Company Created Successfully',
                'id'     =>  $createdCompany->id,
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->companyServices->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Company Deleted Successfully',
                'data'   =>  view("super_admin.company.company_list", [
                    'allCompaniesDetails' => $this->companyServices->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->companyServices->searchInCompany($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("super_admin.company.company_list", [
                    'allCompaniesDetails' =>  $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->companyServices->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Company Status Updated Successfully',
                'data'   =>  view("super_admin.company.company_list", [
                    'allCompaniesDetails' => $this->companyServices->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
