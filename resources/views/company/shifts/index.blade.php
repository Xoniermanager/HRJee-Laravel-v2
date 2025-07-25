@extends('layouts.company.main')
@section('content')
    @section('title')
        Office Shift
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
                                <input class="form-control form-control-solid ps-14 min-w-150px me-2" placeholder="Search "
                                    type="text" name="search" value="{{ request()->get('search') }}" id="search">
                                <button style="opacity: 0; display: none !important" id="table-search-btn"></button>

                            </div>
                            <select class="form-control min-w-150px me-2" id="status">
                                <option value="">Status</option>
                                <option {{ old('status') == '1' || request()->get('status') == '1' ? 'selected' : '' }}
                                    value="1">Active</option>
                                <option {{ old('status') == '2' || request()->get('status') == '2' ? 'selected' : '' }}
                                    value="2">Inactive</option>
                            </select>
                            <select class="form-control min-w-150px me-2" id="default">
                                <option value="">Is Default</option>
                                <option {{ old('default') == '1' || request()->get('default') == '1' ? 'selected' : '' }}
                                    value="1">Yes</option>
                                <option {{ old('default') == '2' || request()->get('default') == '2' ? 'selected' : '' }}
                                    value="2">No</option>
                            </select>

                        </div>
                        <!--end::Card title-->
                        <!--begin::Action-->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_department"
                            class="btn btn-sm btn-primary align-self-center">
                            Add Office Shift</a>

                        <!--end::Action-->
                    </div>

                    <div class="card-body mb-5 mb-xl-10">
                        @include('company.shifts.shift_list')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <div class="modal" id="edit_department">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-600px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Close-->
                        <h2>Edit Office Shift</h2>
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
                        <!--begin::Wrapper-->
                        <form id="edit_shift_form">
                            @csrf
                            <!--begin::Wrapper-->
                            <div class="mw-lg-600px mx-auto p-4">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="text" name="name" id="name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">

                                        <label>Office Time</label>
                                        <select name="office_timing_config_id" class="form-control mb-5 mt-3"
                                            id="office_timing_config_id">
                                            <option value="">Select Time Config</option>
                                            @forelse ($allConfigTimes as $allConfigTime)
                                                <option value="{{ $allConfigTime->id }}">{{ $allConfigTime->name }}</option>
                                            @empty
                                                <p>No branches Available</p>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Start Time<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="time" name="start_time" id="start_time">
                                        @error('start_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>End Time<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="time" name="end_time" id="end_time">
                                        @error('end_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Punch-in Buffer(in minutes)<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="number" name="check_in_buffer"
                                            id="check_in_buffer" min="1">
                                        @error('check_in_buffer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Punch-out Buffer(in minutes)<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="number" name="check_out_buffer"
                                            id="check_out_buffer">
                                        @error('check_out_buffer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label class="required">Auto Punch Out</label>
                                        <select name="auto_punch_out" id="auto_punch_out" class="form-control">
                                            <option value="">Please Select the Time</option>
                                            @php
                                                for ($mins = 5; $mins <= 40; $mins += 5) {
                                                    echo '<option value= "' .  $mins . '">' . $mins .' Minutes' .  '</option>';
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Login Before Shift Time</label>
                                        <select name="login_before_shift_time" id="login_before_shift_time"
                                            class="form-control">
                                            <option value="">Please Select the Time</option>
                                            @php
                                                for ($mins = 0; $mins <= 60; $mins += 5) {
                                                    echo '<option value= "' .
                                                        $mins .
                                                        '">' .
                                                        $mins .
                                                        ' Minutes' .
                                                        '</option>';
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Min Late Count</label>
                                        <input class="form-control mb-5 mt-3" type="number" name="min_late_count"
                                            id="min_late_count">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Early Checkout Count</label>
                                        <input class="form-control mb-5 mt-3" type="number" name="early_checkout_count"
                                            id="early_checkout_count">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Half Day Login</label>
                                        <input class="form-control mb-5 mt-3" type="time" name="half_day_login"
                                            id="half_day_login">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>No of Late Count</label>
                                        <input class="form-control mb-5 mt-3" type="number" name="total_late_count"
                                            id="total_late_count">
                                    </div>
                                    <div class="col-md-6">
                                        <label>No of Leave Deduction</label>
                                        <input class="form-control mb-5 mt-3" type="number" name="total_leave_deduction"
                                            id="total_leave_deduction">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" id="status" class="status">isActive
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" id="apply_late_count"
                                                class="apply_late_count">Apply late count
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" id="apply_early_checkout_count" class="apply_early_checkout_count
                                                    ">Apply
                                            early checkout count
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" class="lock_attendance">Lock Attendence
                                        </label>
                                    </div>
                                </div>

                                <!--end::Input group-->
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
        <!----------modal------------>
        <div class="modal" id="add_department">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-600px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Close-->
                        <h2>Add Office Shift</h2>
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
                        <form id="add_shift_form">
                            @csrf
                            <!--begin::Wrapper-->
                            <div class="mw-lg-600px mx-auto p-4">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="text" name="name" id="name">
                                    </div>
                                    <div class="col-md-6">

                                        <label>Office Time</label>
                                        <select name="office_timing_config_id" id="" class="form-control mb-5 mt-3"
                                            id="office_timing_config_id">
                                            <option value="">Select Time Config</option>
                                            @forelse ($allConfigTimes as $allConfigTime)
                                                <option value="{{ $allConfigTime->id }}">{{ $allConfigTime->name }}
                                                </option>
                                            @empty
                                                <p>No branches Available</p>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Start Time<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="time" name="start_time" id="start_time">
                                    </div>
                                    <div class="col-md-6">
                                        <label>End Time<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="time" name="end_time" id="end_time">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Punch-in Buffer(in minutes)<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="number" min="1" name="check_in_buffer"
                                            id="check_in_buffer">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Punch-out Buffer(in minutes)<span style="color: red">*</span></label>
                                        <input class="form-control mb-5 mt-3" type="number" name="check_out_buffer"
                                            id="check_out_buffer">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label class="required">Auto Punch Out</label>
                                        <select name="auto_punch_out" id="" class="form-control">
                                            <option value="">Please Select the Time</option>
                                            @php
                                                for ($mins = 5; $mins <= 40; $mins += 5) {
                                                    echo '<option value= "' .  $mins . '">' . $mins .' Minutes' .  '</option>';
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="required">Login Before Shift Time</label>
                                        <select name="login_before_shift_time" id="" class="form-control">
                                            <option value="">Please Select the Time</option>
                                            @php
                                                for ($mins = 0; $mins <= 60; $mins += 5) {
                                                    echo '<option value= "' .
                                                        $mins .
                                                        '">' .
                                                        $mins .
                                                        ' Minutes' .
                                                        '</option>';
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Min Late Count</label>
                                        <input class="form-control mb-5 mt-3" type="number" name="min_late_count"
                                            id="min_late_count">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Early Checkout Count</label>
                                        <input class="form-control mb-5 mt-3" type="number" name="early_checkout_count"
                                            id="early_checkout_count">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Half Day Login</label>
                                        <input class="form-control mb-5 mt-3" type="time" name="half_day_login"
                                            id="half_day_login">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="">isActive
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" id="apply_late_count">Apply late count
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" id="apply_early_checkout_count">Apply
                                            early checkout count
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>No of Late Count</label>
                                        <input class="form-control mb-5 mt-3" type="number" name="total_late_count">
                                    </div>
                                    <div class="col-md-6">
                                        <label>No of Leave Deduction</label>
                                        <input class="form-control mb-5 mt-3" type="number" name="total_leave_deduction">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" id="lock_attendance">Lock Attendence
                                        </label>
                                    </div>
                                </div>

                                <!--end::Input group-->
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
        <script>
            function edit_department_details(allshift) {
                let shift = JSON.parse(allshift);
                $('#id').val(shift.id);
                $('#name').val(shift.name);
                $('#start_time').val(shift.start_time);
                $('#end_time').val(shift.end_time);
                $('#check_in_buffer').val(shift.check_in_buffer);
                $('#check_out_buffer').val(shift.check_out_buffer);
                $('#min_late_count').val(shift.min_late_count);
                $('#early_checkout_count').val(shift.early_checkout_count);
                $('#half_day_login').val(shift.half_day_login);
                $('#office_timing_config_id').val(shift.office_timing_config_id);
                $('#login_before_shift_time').val(shift.login_before_shift_time);
                $('#total_late_count').val(shift.total_late_count);
                $('#total_leave_deduction').val(shift.total_leave_deduction);
                $('#auto_punch_out').val(shift.auto_punch_out);
                if (shift.lock_attendance == 1) {
                    $('.lock_attendance').prop('checked', true).val(shift.lock_attendance);
                }
                if (shift.apply_late_count == 1) {
                    $('.apply_late_count').prop('checked', true).val(shift.apply_late_count);
                }
                if (shift.apply_early_checkout_count == 1) {
                    $('.apply_early_checkout_count').prop('checked', true).val(shift.apply_early_checkout_count);
                }

                jQuery('#edit_department').modal('show');

            }

            jQuery(document).ready(function ($) {
                // Define custom validation for pattern (only letters and spaces)
                jQuery.validator.addMethod("pattern", function (value, element, param) {
                    return this.optional(element) || param.test(value);
                }, "Name must contain only letters and spaces");

                // Common validation rules and messages
                const validationRules = {
                    name: {
                        required: true,
                        maxlength: 50,
                        pattern: /^[A-Za-z\s]+$/ // Only allows letters and spaces
                    },
                    start_time: "required",
                    end_time: "required",
                    check_in_buffer: "required",
                    check_out_buffer: "required",
                    office_timing_config_id: "required"
                };

                const validationMessages = {
                    name: {
                        required: "Please enter name",
                        maxlength: "Name must be no more than 50 characters",
                        pattern: "Name must contain only letters and spaces"
                    },
                    start_time: "Please enter start time",
                    end_time: "Please enter end time",
                    check_in_buffer: "Please enter check-in buffer",
                    check_out_buffer: "Please enter check-out buffer",
                    office_timing_config_id: "Please select office timing config"
                };

                // Function to handle form submission with AJAX
                function handleFormSubmit(form, url, modalId) {
                    var formData = $(form).serialize();
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            jQuery(modalId).modal('hide');
                            swal.fire("Done!", response.message, "success");
                            jQuery('#shift_time_list').replaceWith(response.data);
                            jQuery(form)[0].reset();
                        },
                        error: function (error_messages) {
                            console.log(error_messages);
                            let errors = error_messages.responseJSON.error; // assuming backend returns "errors"

                            // Clear all previous error messages
                            jQuery(".text-danger").remove();

                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key + '_error text text-danger">' + errors[error_key] + '</span>'
                                );
                                setTimeout(function () {
                                    jQuery("." + error_key + "_error").remove();
                                }, 5000);

                            }
                        }
                    });
                }

                // Initialize validation and submission for add form
                jQuery("#add_shift_form").validate({
                    rules: validationRules,
                    messages: validationMessages,
                    submitHandler: function (form) {
                        handleFormSubmit(form, "{{ route('shift.store') }}", '#add_department');
                    }
                });

                // Initialize validation and submission for edit form
                jQuery("#edit_shift_form").validate({
                    rules: validationRules,
                    messages: validationMessages,
                    submitHandler: function (form) {
                        handleFormSubmit(form, "<?= route('shift.update') ?>", '#edit_department');
                    }
                });
            });


            function handleStatus(id) {
                var checked_value = $('#checked_value_status_' + id).prop('checked');
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
                    url: "{{ route('shift.statusUpdate') }}",
                    type: 'get',
                    data: {
                        'id': id,
                        'status': status,
                    },
                    success: function (res) {
                        if (res) {
                            swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        } else {
                            swal.fire("Oops!", 'Something Went Wrong', "error");
                        }
                    }
                })
            }

            function handleDefault(id) {
                var default_checked_value = $('#checked_value_default_' + id).prop('checked');
                let default_value;
                let default_name;
                if (default_checked_value == true) {
                    default_value = 1;
                    default_name = 'Yes';
                } else {
                    default_value = 0;
                    default_name = 'No';
                }
                $.ajax({
                    url: "{{ route('shift.statusUpdate') }}",
                    type: 'get',
                    data: {
                        'id': id,
                        'default': default_value
                    },
                    success: function (res) {
                        if (res) {
                            if (res.success) {
                                swal.fire("Done!", 'Default ' + default_name + ' Updated Successfully', "success");
                            } else {
                                search_filter_results();
                                swal.fire("Oops!", res.message, "error");
                            }

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
                            url: "<?= route('shift.delete') ?>",
                            type: "get",
                            data: {
                                id: id
                            },
                            success: function (res) {
                                Swal.fire("Done!", "It was succesfully deleted!", "success");
                                $('#shift_time_list').replaceWith(res.data);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error Deleting!", "This shift is assigned to a user. You cannot delete this shift.", "error");
                            }
                        });
                    }
                });
            }
            jQuery("#search").on('blur', function () {
                search_filter_results();
            });
            jQuery("#status").on('change', function () {
                search_filter_results();
            });
            jQuery("#default").on('change', function () {
                search_filter_results();
            });

            function search_filter_results() {
                $.ajax({
                    type: 'GET',
                    url: company_ajax_base_url + '/shifts/office-shifts/search/filter',
                    data: {
                        'status': $('#status').val(),
                        'search': $('#search').val(),
                        'default': $('#default').val()
                    },
                    success: function (response) {
                        $('#shift_time_list').replaceWith(response.data);
                    }
                });
            }
        </script>
@endsection
