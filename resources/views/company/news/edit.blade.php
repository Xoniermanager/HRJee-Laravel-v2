@extends('layouts.company.main')
@section('content')
@section('title')
    Edit News
@endsection
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif
@php
    $selectedDepartmentId = $editNewsDetails->departments->pluck('id');
    $selectedCompanyBranchId = $editNewsDetails->companyBranches->pluck('id');
    $selectedDesignationId = $editNewsDetails->designations->pluck('id');
@endphp
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
                        <form action="{{ route('news.update',$editNewsDetails->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="">Title *</label>
                                        <input class="form-control" name="title" type="text"
                                            value="{{ $editNewsDetails->title }}">
                                        @if ($errors->has('title'))
                                            <div class="text-danger">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Company Branches *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple="multiple" name="company_branch_id[]">
                                            @foreach ($allCompanyBranchesDetails as $compayBranches)
                                                <option value="{{ $compayBranches->id }}"
                                                    {{ $selectedCompanyBranchId->contains($compayBranches->id) ? 'selected' : null }}>
                                                    {{ $compayBranches->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company_branch_id'))
                                            <div class="text-danger">{{ $errors->first('company_branch_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Department *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Department"
                                            data-allow-clear="true" multiple="multiple" id="department_id"
                                            onchange="get_designation_by_department_id()" name="department_id[]">
                                            @foreach ($allDepartmentsDetails as $departmentsDetails)
                                                <option value="{{ $departmentsDetails->id }}"
                                                    {{ $selectedDepartmentId->contains($departmentsDetails->id) ? 'selected' : null }}>
                                                    {{ $departmentsDetails->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('department_id'))
                                            <div class="text-danger">{{ $errors->first('department_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Designation *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select an option"
                                            data-allow-clear="true" multiple="multiple" id="designation_id"
                                            name="designation_id[]">

                                        </select>
                                        @if ($errors->has('designation_id'))
                                            <div class="text-danger">{{ $errors->first('designation_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">News Category *</label>
                                        <select class="form-control" name="news_category_id">
                                            <option value="">Select the News Category</option>
                                            @foreach ($allNewsCategoryDetails as $newsCategoryDetails)
                                                <option value="{{ $newsCategoryDetails->id }}"
                                                    {{ $editNewsDetails->news_category_id == $newsCategoryDetails->id ? 'selected' : '' }}>
                                                    {{ $newsCategoryDetails->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('news_category_id'))
                                            <div class="text-danger">{{ $errors->first('news_category_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Start Date *</label>
                                        <input class="form-control" name="start_date" type="date"
                                            min="{{ date('Y-m-d') }}" value="{{ $editNewsDetails->start_date }}">
                                        @if ($errors->has('start_date'))
                                            <div class="text-danger">{{ $errors->first('start_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">End Date *</label>
                                        <input class="form-control" name="end_date" type="date"
                                            min="{{ date('Y-m-d') }}" value="{{ $editNewsDetails->end_date }}">
                                        @if ($errors->has('end_date'))
                                            <div class="text-danger">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Image *</label>
                                        <div class="image-input image-input-outline" data-kt-image-input="true">
                                            <!--begin::Col-->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" name="image"
                                                        accept=".png, .jpg, .jpeg">
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
                                        <input class="form-control" name="file" type="file" accept="pdf">
                                        @if ($errors->has('file'))
                                            <div class="text-danger">{{ $errors->first('file') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="">Description </label>
                                        <textarea id="mytextarea" name="description">{{ $editNewsDetails->description }}</textarea>
                                        @if ($errors->has('description'))
                                            <div class="text-danger">{{ $errors->first('description') }}</div>
                                        @endif
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
<script>
    $(document).ready(function() {
        var selectedDesignationId = {{ $selectedDesignationId }};
        get_designation_by_department_id(selectedDesignationId);
    });

    function get_designation_by_department_id(selectedDesignationId) {
        var selectedValues = $('#department_id').val();
        $.ajax({
            type: 'GET',
            url: company_ajax_base_url + '/designation/get/all/designation',
            dataType: "json",
            data: {
                'department_id': selectedValues,
            },
            success: function(response) {
                var select = $('#designation_id');
                select.empty()
                if (response.status == true) {
                    $.each(response.data, function(key, value) {
                        select.append('<option value=' +
                            value.id + '>' + value.name + '</option>');
                    });
                    $('#designation_id').val(selectedDesignationId);
                } else {
                    return false;
                }
            },
            error: function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something Went Wrong!! Please try Again"
                });
            }
        });
    };
</script>
@endsection
