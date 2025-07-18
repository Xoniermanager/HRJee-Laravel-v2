@extends('layouts.company.main')
@section('content')
@section('title')
    Leave Credit Management
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="custom-table card p-0">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title">
                        {{-- <div class="min-w-200px me-2 d-flex align-items-center position-relative my-1"> --}}
                        <select class="me-2 form-control min-w-200px" id="status">
                            <option value="">Status</option>
                            <option {{ request()->get('status') == '1' ? 'selected' : '' }} value="1">Active
                            </option>
                            <option {{ request()->get('status') == '0' ? 'selected' : '' }} value="0">Inactive
                            </option>
                        </select>

                        <select class="me-2 form-control min-w-200px" id="filter_company_branch">
                            <option value="">Company Branch</option>
                            @foreach ($allCompanyBranches as $companyBranch)
                                <option
                                    {{ request()->get('filter_company_branch') == $companyBranch->id ? 'selected' : '' }}
                                    value="{{ $companyBranch->id }}">{{ $companyBranch->name }}</option>
                            @endforeach
                        </select>
                        <select class="me-2 form-control min-w-200px" id="filter_employee_type">
                            <option value="">Employee Type</option>
                            @foreach ($allEmployeeType as $employeeType)
                                <option
                                    {{ request()->get('filter_employee_type') == $employeeType->id ? 'selected' : '' }}
                                    value="{{ $employeeType->id }}">{{ $employeeType->name }}</option>
                            @endforeach
                        </select>
                        <select class="me-2 form-control min-w-200px" id="filter_leave_type">
                            <option value="">Leave Type</option>
                            @foreach ($allLeaveType as $leaveType)
                                <option {{ request()->get('filter_leave_type') == $leaveType->id ? 'selected' : '' }}
                                    value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_leave_credit_modal"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Leave Credit Management</a>

                    <!--end::Action-->
                </div>

                <div class="mb-xl-10">
                    @include('company.leave_credit_management.leave_credit_list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="modal" id="edit_leave_credit_modal">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Edit Leave Credit</h2>
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <!--begin::Wrapper-->
                    <form class="row g-3" id="leave_credit_update_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-6">
                            <label class="form-label">Branch *</label>
                            <select name="company_branch_id" class="form-control" id="company_branch_id">
                                <option value="">Select the Branch</option>
                                @foreach ($allCompanyBranches as $companyBranch)
                                    <option value="{{ $companyBranch->id }}">{{ $companyBranch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Employee Type *</label>
                            <select name="employee_type_id" class="form-control" id="employee_type_id">
                                <option value="">Select the Employee Type</option>
                                @foreach ($allEmployeeType as $employeeType)
                                    <option value="{{ $employeeType->id }}">{{ $employeeType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="row g-3">
                                <div id="edit_div_select_repeat_frequency" class="col-md-12">
                                    <label class="form-label">Repeat in months *</label>
                                    <select name="repeat_in_months" class="form-control" id="edit_repeat_in_months">
                                        <option value="">Please select the Month</option>
                                        <option value="1">Every Month</option>
                                        <option value="2">Every Two Month</option>
                                        <option value="3">Every Three Month</option>
                                        <option value="4">Every Four Month</option>
                                        <option value="5">Every Five Month</option>
                                        <option value="6">Every Six Month</option>
                                        <option value="7">Every Seven Month</option>
                                        <option value="8">Every Eight Month</option>
                                        <option value="9">Every Nine Month</option>
                                        <option value="10">Every Ten Month</option>
                                        <option value="11">Every Eleven Month</option>
                                        <option value="12">Every Year</option>
                                    </select>
                                </div>
                                <div class="div_minimum_working_days_if_month col-md-6" style="display: none">
                                    <label class="form-label">Minimum Working Days if month *</label>
                                    <input type="number" name="minimum_working_days_if_month" class="form-control"
                                        id="val_minimum_working_days_if_month">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Credit Leave On Day *</label>
                            <select name="credit_leave_on_day" class="form-control" id="credit_leave_on_day">
                                <option value="">Select the day</option>
                                @php
                                    for ($i = 0; $i <= 28; $i++) {
                                        if ($i == 0) {
                                            echo '<option value="' . $i . '">End of the Month</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . ' Day</option>';
                                        }
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Leave Type *</label>
                            <select name="leave_type_id" class="form-control" id="leave_type_id">
                                <option value="">Select the Leave Type</option>
                                @foreach ($allLeaveType as $leaveType)
                                    <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No of Leaves *</label>
                            <input type="text" class="form-control" min="0.5" name="number_of_leaves"
                                id="number_of_leaves">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!----------modal------------>
    <div class="modal" id="add_leave_credit_modal">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Add Leave Credit</h2>
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
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <form class="row g-3" id="leave_credit_create_form">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">Branch *</label>
                            <select name="company_branch_id" class="form-control">
                                <option value="">Select the Branch</option>
                                @foreach ($allCompanyBranches as $companyBranch)
                                    <option value="{{ $companyBranch->id }}">{{ $companyBranch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Employee Type *</label>
                            <select name="employee_type_id" class="form-control">
                                <option value="">Select the Employee Type</option>
                                @foreach ($allEmployeeType as $employeeType)
                                    <option value="{{ $employeeType->id }}">{{ $employeeType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="row g-3">
                                <div class="col-md-12" id="div_select_repeat_frequency">
                                    <label class="form-label">Repeat in months *</label>
                                    <select name="repeat_in_months" class="form-control"
                                        id="credit_repeat_in_months">
                                        <option value="">Please select the Month</option>
                                        <option value="1">Every Month</option>
                                        <option value="2">Every Two Month</option>
                                        <option value="3">Every Three Month</option>
                                        <option value="4">Every Four Month</option>
                                        <option value="5">Every Five Month</option>
                                        <option value="6">Every Six Month</option>
                                        <option value="7">Every Seven Month</option>
                                        <option value="8">Every Eight Month</option>
                                        <option value="9">Every Nine Month</option>
                                        <option value="10">Every Ten Month</option>
                                        <option value="11">Every Eleven Month</option>
                                        <option value="12">Every Year</option>
                                    </select>
                                </div>
                                <div class="div_minimum_working_days_if_month col-md-6" style="display: none">
                                    <label class="form-label">Minimum Working Days if month *</label>
                                    <input type="number" name="minimum_working_days_if_month" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Credit Leave On Day *</label>
                            <select name="credit_leave_on_day" class="form-control">
                                <option value="">Select the day</option>
                                @php
                                    for ($i = 0; $i <= 28; $i++) {
                                        if ($i == 0) {
                                            echo '<option value="' . $i . '">End of the Month</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . ' Day</option>';
                                        }
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Leave Type *</label>
                            <select name="leave_type_id" class="form-control">
                                <option value="">Select the Leave Type</option>
                                @foreach ($allLeaveType as $leaveType)
                                    <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No of Leaves *</label>
                            <input type="text" class="form-control" min="0.5" name="number_of_leaves">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <script>
        /** Validation and Ajax Creation and Updated*/
        jQuery(document).ready(function($) {
            jQuery("#leave_credit_create_form").validate({
                rules: {
                    company_branch_id: "required",
                    employee_type_id: "required",
                    repeat_in_months: "required",
                    credit_leave_on_day: "required",
                    leave_type_id: "required",
                    number_of_leaves: "required",
                    minimum_working_days_if_month: {
                        required: function(element) {
                            return ($("#credit_repeat_in_months").val() == 1);
                        }
                    }
                },
                messages: {
                    company_branch_id: "Please Select the Company Branch",
                    employee_type_id: "Please Select the Employee Type",
                    repeat_in_months: "Please Select the Repeat in Month",
                    credit_leave_on_day: "Please Select the day",
                    leave_type_id: "Please Select Leave Type",
                    number_of_leaves: "Please Enter the No of Leave",
                    minimum_working_days_if_month: "Please enter the minimum working days"
                },
                submitHandler: function(form) {
                    var leave_credit_data = $(form).serialize();
                    $.ajax({
                        url: "{{ route('leave.credit.store') }}",
                        type: 'POST',
                        data: leave_credit_data,
                        success: function(response) {
                            jQuery('#add_leave_credit_modal').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#leave_credit_list').replaceWith(response.data);
                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.errors;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[error_key] +
                                    '</span>'
                                );
                            }
                            setTimeout(function() {
                                for (var error_key in errors) {
                                    $("." + error_key + "_error").remove();
                                }
                            }, 2000);
                        }
                    });
                }
            });
            jQuery("#leave_credit_update_form").validate({
                rules: {
                    company_branch_id: "required",
                    employee_type_id: "required",
                    repeat_in_months: "required",
                    credit_leave_on_day: "required",
                    leave_type_id: "required",
                    number_of_leaves: "required",
                    minimum_working_days_if_month: {
                        required: function(element) {
                            return ($("#edit_repeat_in_months").val() == 1);
                        }
                    }
                },
                messages: {
                    company_branch_id: "Please Select the Company Branch",
                    employee_type_id: "Please Select the Employee Type",
                    repeat_in_months: "Please Select the Repeat in Month",
                    credit_leave_on_day: "Please Select the day",
                    leave_type_id: "Please Select Leave Type",
                    number_of_leaves: "Please Enter the No of Leave",
                    minimum_working_days_if_month: "Please Enter the minimum working day"
                },
                submitHandler: function(form) {
                    var leave_credit_data = $(form).serialize();
                    $.ajax({
                        url: "{{ route('leave.credit.update') }}",
                        type: 'POST',
                        data: leave_credit_data,
                        success: function(response) {
                            jQuery('#edit_leave_credit_modal').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#leave_credit_list').replaceWith(response.data);
                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.errors;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[error_key] +
                                    '</span>'
                                );
                            }
                            setTimeout(function() {
                                for (var error_key in errors) {
                                    $("." + error_key + "_error").remove();
                                }
                            }, 2000);
                        }
                    });
                }
            });
        });
        jQuery("#credit_repeat_in_months").on('change', function() {
            var repeatMonth = this.value;
            var type = 'create';
            div_minimum_working_hide_show(repeatMonth, type);
        });
        jQuery("#edit_repeat_in_months").on('change', function() {
            var repeatMonth = this.value;
            var type = 'edit'
            div_minimum_working_hide_show(repeatMonth, type);
        });

        function div_minimum_working_hide_show(repeatMonth, type) {
            if (repeatMonth == '1') {
                if (type == 'create') {
                    $('#div_select_repeat_frequency').attr('class', 'col-md-6');
                } else {
                    $('#edit_div_select_repeat_frequency').attr('class', 'col-md-6');
                }
                $('.div_minimum_working_days_if_month').show();
            } else {
                if (type == 'edit') {
                    $('#edit_div_select_repeat_frequency').attr('class', 'col-md-12');
                } else {
                    $('#div_select_repeat_frequency').attr('class', 'col-md-12');
                }
                $('.div_minimum_working_days_if_month').hide();
            }
        }

        function edit_leave_credit_management(leaveCreditDetails) {
            leaveCreditDetails = JSON.parse(leaveCreditDetails);
            $('#id').val(leaveCreditDetails.id);
            $('#company_branch_id').val(leaveCreditDetails.company_branch_id);
            $('#employee_type_id').val(leaveCreditDetails.employee_type_id);
            $('#edit_repeat_in_months').val(leaveCreditDetails.repeat_in_months);
            $('#credit_leave_on_day').val(leaveCreditDetails.credit_leave_on_day);
            $('#leave_type_id').val(leaveCreditDetails.leave_type_id);
            $('#number_of_leaves').val(leaveCreditDetails.number_of_leaves);
            if (leaveCreditDetails.minimum_working_days_if_month != null) {
                $('#edit_div_select_repeat_frequency').attr('class', 'col-md-6');
                $('.div_minimum_working_days_if_month').show();
                $('#val_minimum_working_days_if_month').val(leaveCreditDetails.minimum_working_days_if_month);
            }
            $('#edit_leave_credit_modal').modal('show');
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
                        url: "<?= route('leave.credit.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#leave_credit_list').replaceWith(res.data);
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
                url: "{{ route('leave.credit.statusUpdate') }}",
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
        /**-------------End----------*/
        jQuery("#status").on('change', function() {
            search_filter_results();
        });
        jQuery("#filter_company_branch").on('change', function() {
            search_filter_results();
        });
        jQuery("#filter_employee_type").on('change', function() {
            search_filter_results();
        });
        jQuery("#filter_leave_type").on('change', function() {
            search_filter_results();
        });

        function search_filter_results() {
            $.ajax({
                type: 'GET',
                url: company_ajax_base_url + '/leave-credit-management/search/filter',
                data: {
                    'status': $('#status').val(),
                    'search': $('#search').val(),
                    'filter_company_branch': $('#filter_company_branch').val(),
                    'filter_employee_type': $('#filter_employee_type').val(),
                    'filter_leave_type': $('#filter_leave_type').val()
                },
                success: function(response) {
                    $('#leave_credit_list').replaceWith(response.data);
                }
            });
        }
    </script>
@endsection
