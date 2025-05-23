@extends('layouts.company.main')

@section('title', 'Dashboard')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-md-12">
                    <div class="mb-5 mb-xl-10">
                        @if ($daysLeft && $daysLeft <= 7)
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <p class="font-bold">⚠️ Subscription Expiring Soon! Your subscription will expire in
                                    <strong>{{ $daysLeft }} day(s) <button class="btn btn-primary mx-auto mt-3" type="button"
                                            data-bs-toggle="modal" data-bs-target="#contactUsModal">Contact
                                            Us</button></strong>.
                                </p>
                            </div>
                        @endif
                        <div class="row g-5 g-xl-10 mb-3">
                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-globe-asia text-white fs-2qx lh-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                        <div class="fw-bold text-white py-2">
                                            <span
                                                class="fs-1 d-block">{{ $dashboardData['allCompanyBranch']->count() }}</span>
                                            <span class="opacity-50">Total Offices</span>
                                        </div>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card widget 3-->
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-calendar-times text-white fs-2qx lh-0"></i>
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                        <div class="fw-bold text-white py-2">
                                            <span class="fs-1 d-block">{{ $dashboardData['total_request_leave'] }}</span>
                                            <span class="opacity-50">Leave Request</span>
                                        </div>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card widget 3-->
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-calendar-day text-white fs-2qx lh-0"></i>
                                            <!-- Changed icon to represent "today" -->
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                        <div class="fw-bold text-white py-2">
                                            <span class="fs-1 d-block">{{ $dashboardData['total_leave'] }}</span>
                                            <span class="opacity-50">Total Approved Leave</span>
                                        </div>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card widget 3-->
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-users text-white fs-2qx lh-0"></i>
                                            <!-- Changed icon to represent active employees -->
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                        <div class="fw-bold text-white py-2">
                                            <span class="fs-1 d-block">{{ $dashboardData['total_active_employee'] }}</span>
                                            <span class="opacity-50">Active Employees</span>
                                        </div>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card widget 3-->
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-user-times text-white fs-2qx lh-0"></i>
                                            <!-- Changed icon to represent inactive employees -->
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                        <div class="fw-bold text-white py-2">
                                            <span
                                                class="fs-1 d-block">{{ $dashboardData['total_inactive_employee'] }}</span>
                                            <span class="opacity-50">InActive Employees</span>
                                        </div>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card widget 3-->
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <!--begin::Card widget 3-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                    style="background-color: #1642b3; background-image:url('assets/media/wave-bg-purple.svg')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-3">
                                        <!--begin::Icon-->
                                        <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                            style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
                                            <i class="fa fa-user-check text-white fs-2qx lh-0"></i>
                                            <!-- Kept as is for "Total Present" -->
                                        </div>
                                        <!--end::Icon-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer"
                                        style="border-top: 1px solid rgba(255, 255, 255, 0.3); background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                        <div class="fw-bold text-white py-2">
                                            <span class="fs-1 d-block">{{ $dashboardData['total_present'] }}</span>
                                            <span class="opacity-50">Total Present</span>
                                        </div>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card widget 3-->
                            </div>
                        </div>
                        <style>
                            .nospacing .col-md-2 {
                                padding: 0 3px !important;
                            }

                            .nospacing {
                                padding: 0 10px 10px;
                                border-bottom: 1px solid var(--kt-card-border-color);
                            }
                        </style>
                        <div class="card card-body col-md-12 mb-3">
                            <div class="">
                                <div class="row align-items-center nospacing">
                                    <div class="col-md-2">
                                        <h5>Employee Details</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="branch">
                                            <option value="">Branch</option>
                                            @foreach ($dashboardData['allCompanyBranch'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select class="form-control" id="department_id">
                                            <option value="">Department</option>
                                            @foreach ($dashboardData['allDepartment'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="designation_id">
                                            <option value="">Designation</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select class="form-control" id="status">
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
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
                                            <input class="form-control form-control-solid ps-14 min-w-150px me-2"
                                                placeholder="Search by name" type="text" name="search" value=""
                                                id="SearchByPatientName">
                                            <button style="opacity: 0; display: none !important"
                                                id="table-search-btn"></button>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Employee Table -->
                            <div class="card-body py-3">
                                <div id="employee-table">
                                    @include('company.dashboard.list', ['employees' => $dashboardData['all_users_details']])
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $dashboardData['all_users_details']->links() }}
                                    <!-- Laravel's built-in pagination links -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
    </div>
    <div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="contactUsModal" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content dark-sign-up overflow-hidden">
                <div class="modal-body social-profile text-start">
                    <div class="modal-toggle-wrapper">
                        <h4 class="text-dark">Contact Us</h4>
                        <p>
                            Fill in your information below to continue.</p>
                        <form class="row g-3" id="contact_us_form">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label">Subject</label>
                                <input class="form-control" type="text" name="subject" placeholder="Enter Subject"
                                    id="subject">
                                @error('subject')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" placeholder="Enter Message" name="message" id="" cols="30"
                                    rows="10"></textarea>
                                @error('message')
                                    <span class="text-denger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /** get all Designation Using Department Id*/
        jQuery('#department_id').on('change', function () {
            var department_id = $(this).val();
            const all_department_id = [department_id];
            get_all_designation_using_department_id(all_department_id);
        });
        function get_all_designation_using_department_id(all_department_id, designationId = '') {
            if (all_department_id) {
                $.ajax({
                    url: "{{ route('get.all.designation') }}",
                    type: "GET",
                    dataType: "json",
                    data: {
                        'department_id': all_department_id
                    },
                    success: function (response) {
                        var select = $('#designation_id');
                        select.empty();
                        if (response.status == true) {
                            $('#designation_id').append(
                                '<option>Select The Designation</option>');
                            $.each(response.data, function (key, value) {
                                select.append('<option ' + ((designationId == value.id) ? "selected" :
                                    "") + ' value=' + value.id + '>' + value.name + '</option>');
                            });
                        } else {
                            select.append('<option value="">' + response.error +
                                '</option>');
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something Went Wrong!! Please try Again"
                        });
                        return false;
                    }
                });
            } else {
                $('#designation_id').empty();
            }

        }
    </script>
    <script>
        $(document).ready(function () {
            function fetchEmployees() {
                $.ajax({
                    url: "{{ route('company.employee_search.filter') }}",
                    type: "GET",
                    data: {
                        branch: $('#branch').val(),
                        department: $('#department_id').val(),
                        designation: $('#designation_id').val(),
                        status: $('#status').val(),
                        name: $('#SearchByPatientName').val()
                    },
                    success: function (data) {
                        $('#employee-table').html(data);
                    }

                });
            }

            $('#branch, #department_id, #designation_id, #status, #SearchByPatientName').on('change keyup', fetchEmployees);


        })

        jQuery(document).ready(function ($) {
            jQuery("#contact_us_form").validate({
                rules: {
                    subject: "required",
                    message: "required",
                },
                messages: {
                    subject: "Please enter subject",
                    message: "Please enter message",
                },
                submitHandler: function (form) {
                    var companyTypeData = $(form).serialize();
                    $.ajax({
                        url: "{{ route('company.send-enquiry') }}",
                        type: 'POST',
                        data: companyTypeData,
                        success: function (response) {
                            jQuery('#contactUsModal').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            jQuery("#contact_us_form")[0].reset();

                        },
                        error: function (error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[
                                    error_key] + '</span>');
                                setTimeout(function () {
                                    jQuery("." + error_key + "_error").remove();
                                }, 5000);
                            }
                        }
                    });
                }
            });

        });
    </script>
@endsection
