@extends('layouts.company.main')
@section('content')
@section('title')
    Policy
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card custom-table p-0">
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input class="form-control form-control-solid ps-14 min-w-150px me-2" placeholder="Search "
                                type="text" id="search">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>
                        <select class="form-control ml-2" id="status">
                            <option value="">Status</option>
                            <option {{ old('status') == '1' || request()->get('status') == '1' ? 'selected' : '' }}
                                value="1">Active</option>
                            <option {{ old('status') == '0' || request()->get('status') == '0' ? 'selected' : '' }}
                                value="2">Inactive</option>
                        </select>
                        <select class="form-control ml-2 min-w-150px" id="policy_category">
                            <option value="">Policy Category</option>
                            @foreach ($allPolicyCategoryDetails as $policyCategoryDetails)
                                <option value="{{ $policyCategoryDetails->id }}">
                                    {{ $policyCategoryDetails->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control ml-2 min-w-150px" id="company_branch">
                            <option value="">Company Branches</option>
                            @foreach ($allCompanyBranchesDetails as $compayBranches)
                                <option value="{{ $compayBranches->id }}">{{ $compayBranches->name }}
                                </option>
                            @endforeach
                        </select>
                        <select class="form-control ml-2 min-w-150px" id="department">
                            <option value="">Department</option>
                            @foreach ($allDepartmentsDetails as $departmentsDetails)
                                <option value="{{ $departmentsDetails->id }}">
                                    {{ $departmentsDetails->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="{{ route('policy.add') }}" class="btn btn-sm btn-primary align-self-center">
                        Add Policy</a>
                    <!--end::Action-->
                </div>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mb-5 mb-xl-10">
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        @include('company.policy.list')
                        <!--end::Table container-->
                    </div>
                </div>
                <!--begin::Body-->

            </div>
            <!--begin::Body-->
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
</div>
<script>
    function handleStatus(id) {
        var checked_value = $('#checked_value_' + id).prop('checked');
        let status;
        let status_name;
        if (checked_value == true) {
            status = 1;
            status_name = 'Active';
        } else {
            status = 0;
            status_name = 'Inactive';
        }
        $.ajax({
            url: "{{ route('policy.statusUpdate') }}",
            type: 'get',
            data: {
                'id': id,
                'status': status,
            },
            success: function(res) {
                if (res) {
                    swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                } else {
                    swal.fire("Oops!", 'Something Went Wrong', "error");
                }
            }
        })
    }

    function deleteFunction(id) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: company_ajax_base_url + '/policy/delete/' + id,
                    type: "get",
                    success: function(res) {
                        Swal.fire("Done!", "It was succesfully deleted!", "success");
                        $('#policy_list').replaceWith(res.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
        });
    }
    jQuery("#search").on('blur', function() {
        search_filter_results();
    });
    jQuery("#status").on('change', function() {
        search_filter_results();
    });
    jQuery("#policy_category").on('change', function() {
        search_filter_results();
    });
    jQuery("#company_branch").on('change', function() {
        search_filter_results();
    });
    jQuery("#department").on('change', function() {
        search_filter_results();
    });

    function search_filter_results() {
        $.ajax({
            type: 'GET',
            url: company_ajax_base_url + '/policy/search/filter',
            data: {
                'status': $('#status').val(),
                'search': $('#search').val(),
                'policy_category_id': $('#policy_category').val(),
                'company_branch_id': $('#company_branch').val(),
                'department_id': $('#department').val()
            },
            success: function(response) {
                $('#policy_list').replaceWith(response.data);
            }
        });
    }
</script>
@endsection
