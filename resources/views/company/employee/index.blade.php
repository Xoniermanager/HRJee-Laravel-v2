@extends('layouts.company.main')

@section('title', 'Employee Management')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <div class="card custom-table p-0">
                <div class="card-header d-block cursor-pointer border-0">
                    <div class="row align-items-center">
                        <div class="row align-items-center g-3">
                            <!-- 🔍 Search Input -->
                            <div class="col-md-2">
                                <div class="d-flex align-items-center position-relative">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <!--begin::Svg Icon-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="black"></path>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <input data-kt-patient-filter="search" class="form-control ps-14" placeholder="Search"
                                        type="text" id="search">
                                    <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                                </div>
                            </div>

                            <!-- 📤 Export Button -->


                            <!-- 📍 Add Punch-In Radius -->
                            <div class="col-md-2">
                                <a class="btn btn-sm btn-primary disabled"
                                    data-bs-toggle="modal" data-bs-target="#modal_radius" id="punch_in_radius">
                                    Add PunchIn Radius
                                </a>
                            </div>
                             <div class="col-md-2">
                                <a class="btn btn-sm btn-dark" id="export_button">Export</a>
                                </div>
                            @if ($activeUserCount < auth()->user()->companyDetails->company_size)
                                <div class="col-md-1">
                                    <a href="{{ asset('storage/test.csv') }}" class="btn btn-sm btn-primary" title="Download Template" download>
                                       Template
                                    </a>
                                </div>
                                <!-- ⬆️ Upload CSV -->
                                <div class="col-md-3">
                                    <form class="d-flex align-items-center" id="importForm" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file" id="file" class="form-control form-control-sm me-2">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-upload"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="col-md-2 text-end">
                                    <a href="{{ route('employee.add') }}" class="btn btn-sm btn-primary">
                                        Add Employee
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- ⚠️ Validation & Session Messages -->
                        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
                        <div id="validationErrors" class="alert alert-danger" style="display: none;"></div>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif (session('danger'))
                            <div class="alert alert-danger">{{ session('danger') }}</div>
                        @endif

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
                                        <option value="M"
                                            {{ request()->get('gender') == 'M' || old('gender') == 'M' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option value="F"
                                            {{ request()->get('gender') == 'F' || old('gender') == 'F' ? 'selected' : '' }}>
                                            Female</option>
                                        <option value="O"
                                            {{ request()->get('gender') == 'O' || old('gender') == 'O' ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="emp_status_id_div">
                                    <select class="form-control filter_form" name="emp_status_id" id="emp_status_id">
                                        <option value="">Employee Status</option>
                                        @foreach ($allEmployeeStatus as $employeeStatus)
                                            <option
                                                {{ request()->get('emp_status_id') == $employeeStatus->id || old('emp_status_id') == $employeeStatus->id ? 'selected' : '' }}
                                                value="{{ $employeeStatus->id }}">{{ $employeeStatus->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="marital_status_div">
                                    <select class="form-control filter_form" name="marital_status" id="marital_status">
                                        <option value="">Marital Status</option>
                                        <option value="S"
                                            {{ request()->get('marital_status') == 'S' || old('marital_status') == 'S' ? 'selected' : '' }}>
                                            Single
                                        </option>
                                        <option value="M"
                                            {{ request()->get('marital_status') == 'M' || old('marital_status') == 'M' ? 'selected' : '' }}>
                                            Married</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="emp_type_div_id">
                                    <select class="form-control filter_form" name="emp_type_id" id="emp_type_id">
                                        <option value="">All Employee Type</option>
                                        @foreach ($allEmployeeType as $employeeType)
                                            <option
                                                {{ request()->get('emp_type_id') == $employeeType->id || old('emp_type_id') == $employeeType->id ? 'selected' : '' }}
                                                value="{{ $employeeType->id }}">{{ $employeeType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="department_div_id">
                                    <select class="form-control filter_form" name="department_id" id="department_id">
                                        <option value="">All Department</option>
                                        @foreach ($alldepartmentDetails as $departmentDetails)
                                            <option
                                                {{ request()->get('department_id') == $departmentDetails->id || old('department_id') == $departmentDetails->id ? 'selected' : '' }}
                                                value="{{ $departmentDetails->id }}">{{ $departmentDetails->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="shift_div_id" style="display: none">
                                    <select class="form-control filter_form" name="shift_id">
                                        <option value="">Shift</option>
                                        @foreach ($allShifts as $shiftDetail)
                                            <option
                                                {{ request()->get('shift_id') == $shiftDetail->id || old('shift_id') == $shiftDetail->id ? 'selected' : '' }}
                                                value="{{ $shiftDetail->id }}">{{ $shiftDetail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="branch_div_id" style="display: none">
                                    <select class="form-control filter_form" name="branch_id">
                                        <option value="">Branch</option>
                                        @foreach ($allBranches as $branchDetails)
                                            <option
                                                {{ request()->get('branch_id') == $branchDetails->id || old('branch_id') == $branchDetails->id ? 'selected' : '' }}
                                                value="{{ $branchDetails->id }}">{{ $branchDetails->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="qualification_div_id" style="display: none">
                                    <select class="form-control filter_form" name="qualification_id">
                                        <option value="">Qualification</option>
                                        @foreach ($allQualification as $qualificationDetails)
                                            <option
                                                {{ request()->get('qualification_id') == $qualificationDetails->id || old('qualification_id') == $qualificationDetails->id ? 'selected' : '' }}
                                                value="{{ $qualificationDetails->id }}">{{ $qualificationDetails->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="skill_div_id" style="display: none">
                                    <select class="form-control filter_form" name="skill_id">
                                        <option value="">Skills</option>
                                        @foreach ($allSkills as $skillsDetails)
                                            <option
                                                {{ request()->get('skill_id') == $skillsDetails->id || old('skill_id') == $skillsDetails->id ? 'selected' : '' }}
                                                value="{{ $skillsDetails->id }}">{{ $skillsDetails->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#filter_popup">More Filter</a>
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
                                        <div id="employee_list">
                                            @include('company.employee.list', ['allUserDetails' => $allUserDetails])
                                        </div>
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
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                            rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
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
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            value="emp_type_div_id" checked>

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
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            value="branch_div_id">

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
        <!-- Modal -->
        <div class="modal fade" id="modal_radius" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-500px" role="document">
                <div class="modal-content">
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0">PunchIn Radius</h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body">
                        <form id="punchIn_radius_form">
                            @csrf
                            <!--begin::Wrapper-->
                            <div class="mw-lg-600px mx-auto p-4">
                                <div class="mt-3">
                                    <label class="required">Employee</label>
                                    <select class="form-control mb-5 mt-3" data-control="select2"
                                        data-close-on-select="false" data-placeholder="Select the Employee"
                                        data-allow-clear="true" multiple="multiple" name="user_id[]"
                                        id="hidden_user_ids">
                                        @foreach ($allEmployeeDetails as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label class="required">PunchIn Radius</label>
                                    <input class="form-control" name="punch_in_radius" type="number"
                                        value="{{ old('task_radius') ?? '0' }}">
                                </div>
                            </div>
                            <!--end::Wrapper-->
                            <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Submit</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let submit_handler = false;
            $(document).ready(function () {
    $(".filter").on("click", function () {
        let filter_id = $(this).val();
        $('#' + filter_id).toggle($(this).prop('checked'));
    });

    $('.filter_form').on('change', function () {
        applyFilters(1);
    });

    $("#search").on('input', function () {
        applyFilters(1);
    });

    $(document).on('click', '#employee_list .paginate a', function (e) {
        e.preventDefault();
        let page = new URL($(this).attr('href')).searchParams.get('page');
        applyFilters(page);
    });

    function applyFilters(page) {
        let filterData = $('.filter_form').serialize();
        let search = $('#search').val();

        $.ajax({
            method: 'GET',
            url: company_ajax_base_url + '/employee/get/filter/list',
            data: filterData + '&search=' + encodeURIComponent(search) + '&page=' + page,
            success: function (response) {
                $('#employee_list').html(response.data);
                gettoggleOnAfterFilter();
            },
            error: function (jqXHR, textStatus) {
                console.error('Error:', textStatus);
            }
        });
    }
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

            function handleFaceRecognition(id) {
                var isChecked = $('#checked_face_value_' + id).prop('checked');
                var status = isChecked ? 1 : 0;
                $.ajax({
                    url: "{{ route('employee.allow.facerecognition') }}",
                    type: 'GET',
                    data: {
                        id: id,
                        status: status,
                    },
                    success: function (res) {
                        if (res) {
                            if (res.status === 200) {
                                Swal.fire("Done!", res.success, "success");
                            } else {
                                Swal.fire("", res.error || 'Unexpected error', "error");
                            }
                        } else {
                            Swal.fire("Oops!", 'Empty response from server', "error");
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire("Oops!", 'Something went wrong', "error");
                    }
                });
            }

            jQuery('#export_button').on('click', function() {
    var $btn = $(this); // store button
    var filteredData = $('#filter_id').serialize();

    // Disable button & show SweetAlert loader
    $btn.prop('disabled', true);

    Swal.fire({
        title: 'Processing...',
        text: 'Please wait while we prepare your export.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });

        $.ajax({
            type: 'GET',
            url: "{{ route('employee.export') }}",
            data: filteredData,
            success: function(response) {
                Swal.close(); // close loader

                if (response.status) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.close();
                Swal.fire({
                    title: 'Error!',
                    text: 'Export failed. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            },
            complete: function() {
                $btn.prop('disabled', false); // always re-enable
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

                    // Show SweetAlert loader
                    Swal.fire({
                        title: 'Uploading...',
                        text: 'Please wait while we process the file.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '{{ route('upload.file.employee') }}',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            Swal.close(); // Close loader

                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                                $('#employee_list').replaceWith(response.data);
                            } else if (response.status === 'error') {
                                if (response.errors) {
                                    let errors = response.errors;

                                    let errorsHtml = `
                        <button id="downloadErrorsBtn" style="margin-bottom: 10px; padding: 6px 12px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            Download Full Error Details
                        </button>
                        <ul style="color: red; list-style-type: none; padding-left: 20px; margin: 0;">`;

                                    errors.forEach(function (error) {
                                        errorsHtml += `<li style="margin-bottom: 5px;">
                            Row ${error.row_number}: ${error.name} (${error.email}) - ${error.reason}
                        </li>`;
                                    });

                                    errorsHtml += '</ul>';

                                    Swal.fire({
                                        title: "Import Errors",
                                        html: errorsHtml,
                                        icon: "error",
                                        didRender: () => {
                                            document.getElementById('downloadErrorsBtn').addEventListener('click', function () {
                                                let csvContent = "data:text/csv;charset=utf-8,";
                                                csvContent += "Row Number,Employee ID,Name,Email,Branch,Reason\n";

                                                errors.forEach(function (e) {
                                                    let line = `"${e.row_number}","${e.emp_id}","${e.name}","${e.email}","${e.company_branch}","${e.reason}"`;
                                                    csvContent += line + "\n";
                                                });

                                                const encodedUri = encodeURI(csvContent);
                                                const link = document.createElement("a");
                                                link.setAttribute("href", encodedUri);
                                                link.setAttribute("download", "import_errors.csv");
                                                document.body.appendChild(link);
                                                link.click();
                                                document.body.removeChild(link);
                                            });
                                        },
                                        customClass: {
                                            popup: 'swal-popup-error',
                                            title: 'swal-title-error',
                                            content: 'swal-content-error'
                                        }
                                    });
                                } else {
                                    $('#errorMessage').text(response.message).show();
                                }
                            }
                        },
                        error: function (xhr) {
                            Swal.close(); // Close loader on error
                            var response = xhr.responseJSON;
                            $('#errorMessage').text(response?.message || 'An unexpected error occurred.').show();
                        }
                    });
                });


                $('#downloadAttendance').on('submit', function(e) {
                    e.preventDefault();
                    var payload  = {
                        range: $("#emp_filter").val(),
                        from: null,
                        to: null
                    };
                    $('#errorMessage').hide();
                    $('#validationErrors').hide();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('download.attendance') }}',
                        method: 'POST',
                        data: JSON.stringify(payload),
                        contentType: 'application/json', // sending JSON
                        processData: false,
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Sucess',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                                $('#employee_list').replaceWith(response.data);
                            } else if (response.status === 'error') {
                                if (response.errors) {
                                    let errorsHtml =
                                        '<ul style="color: red; list-style-type: none; padding-left: 20px; margin: 0;">';
                                    response.errors.forEach(function(error) {
                                        // Ensure you join multiple errors with commas if needed
                                        let errorMessages = Array.isArray(error.errors) ?
                                            error.errors.join(', ') : error.errors;
                                        errorsHtml +=
                                            '<li style="color: red; margin-bottom: 5px;">Row ' +
                                            error.row + ': ' + errorMessages + '</li>';
                                    });
                                    errorsHtml += '</ul>';

                                    Swal.fire({
                                        title: "The Error?",
                                        html: errorsHtml, // Use "html" for custom HTML content
                                        icon: "error", // "error" icon for SweetAlert
                                        customClass: {
                                            popup: 'swal-popup-error', // Custom class for the popup
                                            title: 'swal-title-error', // Optional: custom class for title
                                            content: 'swal-content-error' // Optional: custom class for content
                                        }
                                    });
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
            <script>
                document.addEventListener('click', function(event) {
                    // Check All checkbox clicked
                    if (event.target && event.target.id === 'check_all') {
                        const checkboxes = document.querySelectorAll('input[name="user_id[]"]');
                        const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                        checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
                        updateHiddenInput();
                        togglePunchInRadius();
                        updateCheckAllState();
                    }
                });

                document.addEventListener('change', function(event) {
                    if (event.target && event.target.name === 'user_id[]') {
                        updateHiddenInput();
                        togglePunchInRadius();
                        updateCheckAllState();
                    }
                });


                // Update hidden input with the checked values
                function updateHiddenInput() {
                    const checkedValues = Array.from(document.querySelectorAll('input[name="user_id[]"]:checked'))
                        .map(checkbox => checkbox.value);
                    $('#hidden_user_ids').val(checkedValues).trigger('change');
                }

                // Toggle the "disabled" class on #punch_in_radius based on checkbox state
                function togglePunchInRadius() {
                    const checkboxes = document.querySelectorAll('input[name="user_id[]"]');
                    const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                    const punchInRadiusElement = document.getElementById('punch_in_radius');

                    if (anyChecked) {
                        punchInRadiusElement.classList.remove('disabled');
                    } else {
                        punchInRadiusElement.classList.add('disabled');
                    }
                }

                // Update the "Check All" checkbox state
                function updateCheckAllState() {
                    const checkboxes = document.querySelectorAll('input[name="user_id[]"]');
                    const checkAllCheckbox = document.getElementById('check_all');
                    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                    const noneChecked = Array.from(checkboxes).every(checkbox => !checkbox.checked);
                    // If all checkboxes are checked, check the "Check All" checkbox
                    if (allChecked) {
                        checkAllCheckbox.checked = true;
                    }
                    // If none are checked, uncheck the "Check All" checkbox
                    else if (noneChecked) {
                        checkAllCheckbox.checked = false;
                    }
                    // If some are checked but not all, don't check the "Check All" checkbox
                    else {
                        checkAllCheckbox.checked = false;
                    }
                }
            </script>
        <script>
            $(document).ready(function() {
                jQuery("#punchIn_radius_form").validate({
                    rules: {
                        'user_id[]': {
                            required: true, // Make sure the employee field is selected
                        },
                        'punch_in_radius': {
                            required: true, // Task radius field is required
                            number: true, // Task radius must be a number
                            min: 500 // Task radius must be greater than or equal to 1
                        }
                    },
                    messages: {
                        'user_id[]': {
                            required: "Please select at least one employee."
                        },
                        'punch_in_radius': {
                            required: "Please enter the task radius.",
                            number: "Please enter a valid number.",
                            min: "The task radius must be greater than or equal to 500."
                        }
                    },
                    submitHandler: function(form) {
                        var radius_data = $(form).serialize();
                        $.ajax({
                            url: "<?= route('update.punhin.radius') ?>",
                            type: 'post',
                            data: radius_data,
                            success: function(response) {
                                if (response.status) {
                                    jQuery("#punchIn_radius_form")[0].reset();
                                    jQuery('#modal_radius').modal('hide');
                                    swal.fire("Done!", response.message, "success");
                                } else {
                                    jQuery('#modal_radius').modal('hide');
                                    swal.fire("Error!", response.message, "error");
                                }
                            },
                            error: function(error_messages) {
                                let errors = error_messages.responseJSON.error;
                                for (var error_key in errors) {
                                    $(document).find('[name=' + error_key + ']').after(
                                        '<span id="' + error_key +
                                        '_error" class="text text-danger">' + errors[
                                            error_key] + '</span>');
                                    setTimeout(function() {
                                        jQuery("#" + error_key + "_error").remove();
                                    }, 5000);
                                }
                            }
                        });
                    }
                });
            });
        </script>
        <script>
            function gettoggleOnAfterFilter()
            {
                if (typeof KTMenu !== 'undefined') {
                            KTMenu.createInstances();

                            // fallback: manually initialize
                            document.querySelectorAll('[data-kt-menu="true"]').forEach((el) => {
                                if (!el.KTMenuObject) {
                                    new KTMenu(el);
                                }
                            });
                        }
            }
        </script>
@endsection
