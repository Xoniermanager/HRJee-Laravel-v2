@extends('layouts.company.main')
@section('content')
@section('title')
    Add Policy
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        <form action="{{ route('policy.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="all_company_branch" value="0">
                            <input type="hidden" name="all_department" value="0">
                            <input type="hidden" name="all_designation" value="0">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Title *</label>
                                        <input class="form-control" name="title" type="text"
                                            value="{{ old('title') }}" max="50">
                                        @if ($errors->has('title'))
                                            <div class="text-danger">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Start Date *</label>
                                        <input class="form-control" name="start_date" type="date"
                                            min="{{ date('Y-m-d') }}" value="{{old('start_date')}}">
                                        @if ($errors->has('start_date'))
                                            <div class="text-danger">{{ $errors->first('start_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">End Date *</label>
                                        <input class="form-control" name="end_date" type="date"
                                            min="{{ date('Y-m-d') }}" value="{{old('end_date')}}">
                                        @if ($errors->has('end_date'))
                                            <div class="text-danger">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Policy Category *</label>
                                        <select class="form-control" name="policy_category_id">
                                            <option value="">Select the News Category</option>
                                            @foreach ($allPolicyCategoryDetails as $policyCategoryDetails)
                                                <option value="{{ $policyCategoryDetails->id }}"
                                                       {{ old('policy_category_id') == $policyCategoryDetails->name ? 'selected' : ''}}>{{ $policyCategoryDetails->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('policy_category_id'))
                                            <div class="text-danger">{{ $errors->first('policy_category_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Image *</label>
                                        <div class="image-input image-input-outline" data-kt-image-input="true">
                                            <!--begin::Col-->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" name="image"
                                                        accept=".png, .jpg, .jpeg" required>
                                                    @if ($errors->has('image'))
                                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                                    @endif
                                                    <!--end::Col-->
                                                </div>
                                                <div class="col-md-4">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-125px h-125px"></div>
                                                    <!--end::Preview existing avatar-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-6 form-group">
                                        <label for="">Attachment File </label>
                                        <input class="form-control" name="file" type="file" accept=".pdf" value="{{old('file')}}">
                                        @if ($errors->has('file'))
                                            <div class="text-danger">{{ $errors->first('file') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Description </label>
                                        <textarea class="form-control" name="description" value="{{old('description')}}"></textarea>
                                        @if ($errors->has('description'))
                                            <div class="text-danger">{{ $errors->first('description') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="row">
                                            <div class="col-md-2 form-group mt-3">
                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid">
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        All
                                                    </span>
                                                    <input class="form-check-input m-4" type="checkbox"
                                                        name="all_company_branch"
                                                        onchange="get_checked_value('company_branch')"
                                                        id="company_branches_checkbox" value="0"  {{ old('all_company_branch') == '1' ? 'checked' : '' }}>
                                                </label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <label for="">Company Branches *</label>
                                                <select class="bg-white form-select form-select-solid"
                                                    data-control="select2" data-close-on-select="false"
                                                    data-placeholder="Select the Company Branch" data-allow-clear="true"
                                                    multiple="multiple" name="company_branch_id[]" id="company_branch">
                                                    <option value=""></option>
                                                    @foreach ($allCompanyBranchesDetails as $compayBranches)
                                                        <option value="{{ $compayBranches->id }}" @if (old("company_branch_id")){{ (in_array($compayBranches->id, old("company_branch_id")) ? "selected":"") }}@endif>
                                                            {{ $compayBranches->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('company_branch_id'))
                                                    <div class="text-danger">{{ $errors->first('company_branch_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="row">
                                            <div class="col-md-2 form-group mt-3">
                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid">
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        All
                                                    </span>
                                                    <input class="form-check-input m-4" type="checkbox"
                                                        name="all_department" onchange="get_checked_value('department')"
                                                        id="department_checkbox"  value="0"  {{ old('all_department') == '1' ? 'checked' : '' }}>
                                                </label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <label for="">Department *</label>
                                                <select class="bg-white form-select form-select-solid"
                                                    data-control="select2" data-close-on-select="false"
                                                    data-placeholder="Select the Department" data-allow-clear="true"
                                                    multiple="multiple" id="department_id"
                                                    onchange="get_designation_by_department_id()"
                                                    name="department_id[]">
                                                    @foreach ($allDepartmentsDetails as $departmentsDetails)
                                                        <option value="{{ $departmentsDetails->id }}" @if (old("department_id")){{ (in_array($departmentsDetails->id, old("department_id")) ? "selected":"") }}@endif>
                                                            {{ $departmentsDetails->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('department_id'))
                                                    <div class="text-danger">{{ $errors->first('department_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="row">
                                            <div class="col-md-2 form-group mt-3">
                                                <label
                                                    class="form-check form-check-custom form-check-inline form-check-solid">
                                                    <span class="fw-semibold ps-2 fs-6">
                                                        All
                                                    </span>
                                                    <input class="form-check-input m-4" type="checkbox"
                                                        name="all_designation"
                                                        onchange="get_checked_value('designation')"
                                                        id="designation_checkbox"  value="0"  {{ old('all_designation') == '1' ? 'checked' : '' }}>
                                                </label>
                                            </div>
                                            <div class="col-md-10 form-group">
                                                <label for="">Designation *</label>
                                                <select class="bg-white form-select form-select-solid"
                                                    data-control="select2" data-close-on-select="false"
                                                    data-placeholder="Select an option" data-allow-clear="true"
                                                    multiple="multiple" id="designation_id" name="designation_id[]">

                                                </select>
                                                @if ($errors->has('designation_id'))
                                                    <div class="text-danger">{{ $errors->first('designation_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
