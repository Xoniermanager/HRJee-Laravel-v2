@extends('layouts.company.main')

@section('title', 'Employee Management')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif (session('danger'))
<div class="alert alert-danger">
    {{ session('danger') }}
</div>
@endif
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <div class="card mb-4">
            <div class="card-header d-block cursor-pointer border-0">
                <div class="row align-items-center mt-4">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center position-relative">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="black">
                                    </rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input data-kt-patient-filter="search" class="form-control ps-14" placeholder="Search"
                                type="text" id="search">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>
                    </div>
                    <a class="col-md-1 btn btn-sm ms-3 btn-primary align-self-center wt-space"
                        id="export_button">Export</a>
                    <a href="{{ route('employee.add') }}"
                        class="col-md-1 btn btn-sm ms-3 btn-primary align-self-center wt-space">
                        Import</a>
                    <a href="{{ asset('storage/test.csv')}}"
                        class="col-md-2 btn btn-sm ms-3 btn-primary align-self-center wt-space" download>
                        Download Template</a>
                    <form id="importForm" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" id="file" class="form-control mt-4">
                        <button type="submit" class="btn btn-sm ms-3 btn-primary align-self-center wt-space">Upload
                            File</button>
                    </form>
                    <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
                    <div id="validationErrors" class="alert alert-danger" style="display: none;"></div>
                </div>
            </div>
        </div>
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer d-block p-0 mb-3">
                    <!--begin::Card title-->
                    <!--begin::Action-->
                    <div>
                        <form class="row" id="filter_id">
                            <div class="col-md-2 mb-1" id="gender_div">
                                <select class="form-control filter_form" name="gender" id="gender">
                                    <option value="">Gender</option>
                                    <option value="M" {{ request()->get('gender') == 'M' || old('gender') == 'M' ?
                                        'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="F" {{ request()->get('gender') == 'F' || old('gender') == 'F' ?
                                        'selected' : '' }}>
                                        Female</option>
                                    <option value="O" {{ request()->get('gender') == 'O' || old('gender') == 'O' ?
                                        'selected' : '' }}>
                                        Other</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" id="emp_status_id_div">
                                <select class="form-control filter_form" name="emp_status_id" id="emp_status_id">
                                    <option value="">Employee Status</option>
                                    @foreach ($allEmployeeStatus as $employeeStatus)
                                    <option {{ request()->get('emp_status_id') == $employeeStatus->id ||
                                        old('emp_status_id') == $employeeStatus->id
                                        ? 'selected'
                                        : '' }}
                                        value="{{ $employeeStatus->id }}">{{ $employeeStatus->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" id="marital_status_div">
                                <select class="form-control filter_form" name="marital_status" id="marital_status">
                                    <option value="">Marital Status</option>
                                    <option value="S" {{ request()->get('marital_status') == 'S' ||
                                        old('marital_status') == 'S' ? 'selected' : '' }}>
                                        Single
                                    </option>
                                    <option value="M" {{ request()->get('marital_status') == 'M' ||
                                        old('marital_status') == 'M' ? 'selected' : '' }}>
                                        Married</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" id="emp_type_div_id">
                                <select class="form-control filter_form" name="emp_type_id" id="emp_type_id">
                                    <option value="">All Employee Type</option>
                                    @foreach ($allEmployeeType as $employeeType)
                                    <option {{ request()->get('emp_type_id') == $employeeType->id || old('emp_type_id')
                                        == $employeeType->id
                                        ? 'selected'
                                        : '' }}
                                        value="{{ $employeeType->id }}">{{ $employeeType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" id="department_div_id">
                                <select class="form-control filter_form" name="department_id" id="department_id">
                                    <option value="">All Department</option>
                                    @foreach ($alldepartmentDetails as $departmentDetails)
                                    <option {{ request()->get('department_id') == $departmentDetails->id ||
                                        old('department_id') == $departmentDetails->id
                                        ? 'selected'
                                        : '' }}
                                        value="{{ $departmentDetails->id }}">{{ $departmentDetails->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" id="shift_div_id" style="display: none">
                                <select class="form-control filter_form" name="shift_id">
                                    <option value="">Shift</option>
                                    @foreach ($allShifts as $shiftDetail)
                                    <option {{ request()->get('shift_id') == $shiftDetail->id || old('shift_id') ==
                                        $shiftDetail->id ? 'selected' : '' }}
                                        value="{{ $shiftDetail->id }}">{{ $shiftDetail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" id="branch_div_id" style="display: none">
                                <select class="form-control filter_form" name="branch_id">
                                    <option value="">Branch</option>
                                    @foreach ($allBranches as $branchDetails)
                                    <option {{ request()->get('branch_id') == $branchDetails->id || old('branch_id') ==
                                        $branchDetails->id
                                        ? 'selected'
                                        : '' }}
                                        value="{{ $branchDetails->id }}">{{ $branchDetails->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" id="qualification_div_id" style="display: none">
                                <select class="form-control filter_form" name="qualification_id">
                                    <option value="">Qualification</option>
                                    @foreach ($allQualification as $qualificationDetails)
                                    <option {{ request()->get('qualification_id') == $qualificationDetails->id ||
                                        old('qualification_id') == $qualificationDetails->id
                                        ? 'selected'
                                        : '' }}
                                        value="{{ $qualificationDetails->id }}">{{ $qualificationDetails->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" id="skill_div_id" style="display: none">
                                <select class="form-control filter_form" name="skill_id">
                                    <option value="">Skills</option>
                                    @foreach ($allSkills as $skillsDetails)
                                    <option {{ request()->get('skill_id') == $skillsDetails->id || old('skill_id') ==
                                        $skillsDetails->id ? 'selected' : '' }}
                                        value="{{ $skillsDetails->id }}">{{ $skillsDetails->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" data-bs-toggle="modal" data-bs-target="#filter_popup">
                                <a href="#" class="btn btn-primary btn-sm">More Filter</a>
                            </div>
                        </form>

                    </div>

                </div>
                <!--end::Action-->

                <div class="mb-5 mb-xl-10">

                    <div class="">
                        <div class="">
                            <!--begin::Body-->
                            <div class="">
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    @include('company.employee.list')
                                    <!--end::Table container-->

                                </div>
                            </div>
                            <!--begin::Body-->

                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <div class="modal fade" id="personal_details" tabindex="-1" aria-hidden="true">
        @include('company.employee.popup_form.personal_detail')
    </div>
    <!--end::Modal - personal_details-->
    <!--begin::Modal - advance_details-->
    <div class="modal fade" id="advance_details" tabindex="-1" aria-hidden="true">
        @include('company.employee.popup_form.advance_detail')
    </div>
    <!--end::Modal - advance_details-->
    <!--begin::Modal - Address-->
    <div class="modal fade" id="address" tabindex="-1" aria-hidden="true">
        @include('company.employee.popup_form.address_detail')
    </div>
    <!--end::Modal - Address-->
    <!--begin::Modal - Bank Details-->
    <div class="modal fade" id="bank_details" tabindex="-1" aria-hidden="true">
        @include('company.employee.popup_form.bank_detail')
    </div>
    <!--end::Modal - Bank Details-->
    <div class="modal fade" id="filter_popup" tabindex="-1" aria-hidden="true">
        <div>
            <div class="modal-dialog mw-400px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0">Apply More Filters</h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y p-4">
                        <div class="row w-100">
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" value="gender_div"
                                        checked>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox"
                                        value="emp_status_id_div" checked>
                                    <label for="gender">Employee Status</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox"
                                        value="marital_status_div" checked>
                                    <label for="gender">Marital Status</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" value="emp_type_div_id"
                                        checked>

                                    <label for="gender">Employee Type</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox"
                                        value="department_div_id" checked>

                                    <label for="gender">Department</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" value="shift_div_id">

                                    <label for="gender">Sift</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" value="branch_div_id">

                                    <label for="gender">Branch</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox"
                                        value="qualification_div_id">

                                    <label for="gender">Qualification</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input me-3 filter" type="checkbox" value="skill_div_id">

                                    <label for="gender">Skills</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let submit_handler = false;
            $(".filter").on("click", function(event) {
                let filter_id = $(this).val();
                let selected_status = $(this).prop('checked');
                if (selected_status) {
                    jQuery('#' + filter_id).show();
                } else {
                    jQuery('#' + filter_id).hide();
                }
            });
            $('.filter_form').on('change', function() {
                var data = $('#filter_id').serialize();
                $.ajax({
                    method: 'GET',
                    url: company_ajax_base_url + '/employee/get/filter/list',
                    data: data,
                    success: function(response) {
                        $('#employee_list').replaceWith(response.data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
            });

            function exportData(submit_form_id) {
                let data = queryStringToJSON($('#filter_id').serialize());
                $('.export_emp_status').val(data.emp_status_id);
                $('.export_marital_status').val(data.marital_status);
                $('.export_gender').val(data.gender);
                $('.export_emp_type_id').val(data.emp_type_id);
                $('.export_depertment_id').val(data.department_id);
                $(`#${submit_form_id}`).submit();
            };

            function queryStringToJSON(queryString) {
                // Remove leading '?' if it exists
                if (queryString.startsWith('?')) {
                    queryString = queryString.substring(1);
                }

                // Split the query string into key-value pairs
                const pairs = queryString.split('&');
                const result = {};

                // Iterate over each pair
                pairs.forEach(pair => {
                    const [key, value] = pair.split('=');
                    result[key] = value || ''; // Use empty string if value is undefined
                });

                return result;
            }
            $("#search").blur(function() {
                $.ajax({
                    type: 'GET',
                    url: company_ajax_base_url + '/employee/get/filter/list',
                    data: {
                        'search': $(this).val()
                    },
                    success: function(response) {
                        $('#employee_list').replaceWith(response.data);
                    }
                });
            });

            function deleteFunction(id) {
                event.preventDefault();
                Swal.fire({
                    title: "Are you sure want to exit the employee?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirm!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: company_ajax_base_url + '/employee/delete/' + id,
                            type: "get",
                            success: function(res) {
                                Swal.fire("Done!", "It was succesfully Exit!", "success");
                                $('#employee_list').replaceWith(res.data);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error deleting!", "Please try again", "error");
                            }
                        });
                    }
                });
            }

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
                    url: company_ajax_base_url + '/employee/status/update/' + id,
                    type: 'get',
                    data: {
                        'status': status,
                    },
                    success: function(res) {
                        if (res.status == true) {
                            swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        } else {
                            swal.fire("Oops!", 'Something Went Wrong', "error");
                        }
                    }
                })
            }


            jQuery('#export_button').on('click', function() {
                var filteredData = $('#filter_id').serialize();
                $.ajax({
                    type: 'get',
                    url: "{{ route('employee.export') }}",
                    data: filteredData,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Sucess',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something Went Wrong! Please try Again!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        console.log("Export failed");
                    }
                });
            });
    </script>
    <script>
        $(document).ready(function() {
                // Handle the form submission via AJAX
                $('#importForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $('#errorMessage').hide();
                    $('#validationErrors').hide();

                    $.ajax({
                        url: '{{ route('upload.file') }}',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Sucess',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            } else if (response.status === 'error') {
                                if (response.errors) {
                                    let errorsHtml = '<ul>';
                                    response.errors.forEach(function(error) {
                                        errorsHtml += '<li>Row ' + error.row + ': ' + error
                                            .errors.join(', ') + '</li>';
                                    });
                                    errorsHtml += '</ul>';
                                    $('#validationErrors').html(errorsHtml).show();
                                } else {
                                    $('#errorMessage').text(response.message).show();
                                }
                            }
                        },
                        error: function(xhr) {
                            var response = xhr.responseJSON;
                            $('#errorMessage').text(response.message ||
                                'An unexpected error occurred.').show();
                        }
                    });
                });
            });
    </script>
    @endsection
