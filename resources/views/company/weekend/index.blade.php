@extends('layouts.company.main')
@section('content')
@section('title')
Weekend Management
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input data-kt-patient-filter="search" class="form-control form-control-solid ps-14"
                                placeholder="Search " type="text" id="SearchByPatientName" name="SearchByPatientName"
                                value="">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>

                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_weekend"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Weekend</a>
                    <!--end::Action-->
                </div>

                <div class="mb-5 mb-xl-10">
                    @include('company.weekend.weekend_list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="modal" id="add_weekend">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Weekend</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                    fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <form id="add_weekend_form">
                        @csrf
                        <input type="hidden" id="weekend_id" name="weekend_id">
                        <!--begin::Wrapper-->
                        <div class="mw-lg-600px mx-auto p-4">
                            <div class="mt-3">
                                <label class="required">Company Branch</label>
                                <select class="form-control mb-5 mt-3" name="company_branch_id" id="company_branch_id"
                                    onchange="getDetailsByCompanyBranchId()">
                                    @foreach ($allCompanyBranchesDetails as $compayBranches)
                                    <option value="">Select the Company Branch</option>
                                    <option value="{{ $compayBranches->id }}">
                                        {{ $compayBranches->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label class="required">Department</label>
                                <select class="form-control mb-5 mt-3" name="department_id" id="department_id"
                                    onchange="getDetailsByCompanyBranchId()">
                                    <option value="">Select the Department</option>
                                    @foreach ($allDepartments as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label class="required">Weekends</label>
                                {{-- <select class="form-control mb-5 mt-3" data-control="select2"
                                    data-close-on-select="false" data-placeholder="Select the Weekday"
                                    data-allow-clear="true" multiple="multiple" name="weekday_id[]" id="weekday">
                                    @foreach ($allWeekDay as $weekDay)
                                    <option value="{{ $weekDay->id }}">
                                        {{ $weekDay->name }}
                                    </option>
                                    @endforeach
                                </select> --}}
                                <input type="text" class="form-control" id="datepicker2" name="weekend_dates" readonly>
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
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <script>
        jQuery(document).ready(function() {
        var today = new Date();
        var firstDayOfNextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1); // 1st day of next month
        $('#datepicker2').datepicker({
            // minDate: firstDayOfNextMonth, // Disable all dates before next month
            multidate: true,
            format: 'yyyy-mm-dd',
            closeOnDateSelect: true,
            // beforeShowDay: function (date) {
            //     let dateString = $.datepicker.formatDate('yy-mm-dd', date);
            //     return [true, selectedDates.includes(dateString) ? "highlight-date" : "", "Selected"];
            // }
        });
        });

        function edit_weekend_details(id, companyBranchId,deparmentId, weekendId) {
            if (typeof weekendId === 'string') {
                weekendId = JSON.parse(weekendId);
            }
            $('#weekend_id').val(id);
            $('#company_branch_id').val(companyBranchId);
            $('#department_id').val(deparmentId);
            selectedDates = weekendId;

            // Set input value
            $('#datepicker2').val(weekendId.join(", ")).datepicker("refresh"); // Update UI

            // $('#weekday').val(weekendId).trigger('change');
            jQuery('#add_weekend').modal('show');
        }

        function getDetailsByCompanyBranchId() {
            $.ajax({
                url: "{{ route('weekend.details.companybranchId') }}",
                type: 'GET',
                data: {
                    "company_branch_id": $('#company_branch_id').val(),
                    "department_id" : $('#department_id').val()
                },
                success: function(response) {
                    if(response.status == true){
                        $('#weekend_id').val(response.data.id);
                        $('#weekday').val(response.weekdayId).trigger('change');
                    }
                    else{
                        $('#weekend_id').val('');
                        $('#weekday').val('').trigger('change');
                    }
                },
                error: function(error_messages) {
                    console.log(error_messages)
                }
            });
        }
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#add_weekend_form").validate({
                rules: {
                    'company_branch_id': {
                        required: true,
                    },
                    'department_id': {
                        required: true,
                    },
                    'weekend_dates': {
                        required: true,
                        minlength: 1 // Requires at least one date to be selected
                    },
                },
                messages: {
                    'company_branch_id': "Please select the Company Branch",
                    'department_id': "Please select the Department",
                    'weekend_dates': "Please select at least one date",
                },
                submitHandler: function(form) {
                    var weekend_data = $(form).serialize();
                    $.ajax({
                        url: "{{ route('weekend.store') }}",
                        type: 'POST',
                        data: weekend_data,
                        success: function(response) {
                            jQuery('#add_weekend').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#weekend_list').replaceWith(response.data);
                            jQuery("#add_weekend_form")[0].reset();

                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                jQuery(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[
                                        error_key] + '</span>');
                                setTimeout(function() {
                                    jQuery("." + error_key + "_error").remove();
                                }, 3000);
                            }
                        }
                    });
                }
            });
        });

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
                url: "{{ route('weekend.statusUpdate') }}",
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
                        url: "<?= route('weekend.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#weekend_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
    </script>
    @endsection
