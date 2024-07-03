@extends('layouts.company.main')
@section('content')
@section('title')
    Add News
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
                        <form action="{{ route('leave.status.log.create') }}" method="post" id="leave_management">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="">Company Branches *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple="multiple">
                                            @foreach ($allCompanyBranchesDetails as $compayBranches)
                                                <option value="{{ $compayBranches->id }}">{{ $compayBranches->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Department *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Department"
                                            data-allow-clear="true" multiple="multiple" id="department_id"
                                            onchange="get_designation_by_department_id()">
                                            @foreach ($allDepartmentsDetails as $departmentsDetails)
                                                <option value="{{ $departmentsDetails->id }}">
                                                    {{ $departmentsDetails->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Designation *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select an option"
                                            data-allow-clear="true" multiple="multiple" id="designation_id">

                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">News Category *</label>
                                        <select class="bg-white form-select" data-placeholder="Select a state">
                                            <option value="">Select the News Category</option>
                                            @foreach ($allNewsCategoryDetails as $newsCategoryDetails)
                                                <option value="{{ $newsCategoryDetails->id }}">
                                                    {{ $newsCategoryDetails->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Title *</label>
                                        <input class="form-control" name="" type="text">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Publish Date *</label>
                                        <input class="form-control" name="" type="date">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Attachment *</label>
                                        <input class="form-control" name="" type="file">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="">Description </label>
                                        <textarea id="mytextarea">Hello, World!</textarea>

                                    </div>


                                    <div class="col-md-12 form-group">
                                        <label for="">Image *</label>
                                        <div class="image-input image-input-outline" data-kt-image-input="true">
                                            <!--begin::Col-->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" name="avatar"
                                                        accept=".png, .jpg, .jpeg">
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
                                </div>

                                <a href="#" class="btn btn-primary">Save</a>

                        </form>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function get_designation_by_department_id() {
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
                select.empty();
                if (response.status == true) {
                    $.each(response.data, function(key, value) {
                        console.log(key, value);
                        select.append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
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
