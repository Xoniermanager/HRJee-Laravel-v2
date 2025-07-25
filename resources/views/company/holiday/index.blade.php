@extends('layouts.company.main')
@section('content')
    @section('title')
        Holidays
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
                            <div class="min-w-250px d-flex align-items-center position-relative my-1">
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
                                    placeholder="Search" type="text" id="search" value="">
                                <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                            </div>
                            <select class="form-control ml-2 min-w-150px" id="status">
                                <option value="">Status</option>
                                <option {{ old('status') == '1' || request()->get('status') == '1' ? 'selected' : '' }}
                                    value="1">Active</option>
                                <option {{ old('status') == '0' || request()->get('status') == '0' ? 'selected' : '' }}
                                    value="0">Inactive</option>
                            </select>
                            <select class="form-control ml-2 min-w-200px" id="searchbranchId">
                                <option value="">Select Branch</option>
                                @foreach ($allCompanyBranchesDetails as $compayBranches)
                                    <option value="{{ $compayBranches->id }}">
                                        {{ $compayBranches->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <!--end::Card title-->
                        <!--begin::Action-->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_holidays"
                            class="btn btn-sm btn-primary align-self-center">
                            Add Holiday</a>
                        <!--end::Action-->
                    </div>

                    <div class="mb-5 mb-xl-10">
                        @include('company.holiday.holiday_list')
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <div class="modal" id="edit_holidays">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Close-->
                        <h2>Edit Holiday</h2>
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
                        <form id="holidays_update_form">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            @csrf
                            <!--begin::Wrapper-->
                            <div class="mw-lg-600px mx-auto p-4">
                                <!--begin::Input group-->

                                <div class="mt-3">
                                    <label class="required">Name</label>
                                    <input class="form-control mb-5 mt-3" type="text" name="name" id="name">
                                    <!--end::Switch-->
                                </div>
                                <div class="mt-3">
                                    <label class="required">Date</label>
                                    <input class="form-control mb-5 mt-3" type="date" name="date" id="date">
                                    <!--end::Switch-->
                                </div>
                                <div class="mt-3">
                                    <label class="required">Branch</label>
                                    <select class="form-control mb-5 mt-3" data-control="select2"
                                        data-close-on-select="false" data-placeholder="Select the Company Branch"
                                        data-allow-clear="true" multiple="multiple" name="company_branch_id[]"
                                        id="edit_company_branch">
                                        <option value="all">All</option>
                                        @foreach ($allCompanyBranchesDetails as $compayBranches)
                                            <option value="{{ $compayBranches->id }}" @if (old('company_branch_id')) {{
                                                in_array($departmentsDetails->id, old('company_branch_id')) ? 'selected' : '' }}
                                            @endif>
                                                {{ $compayBranches->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <?php
    //get the current year
    $Startyear = date('Y');
    $endYear = $Startyear + 2;

    // set start and end year range i.e the start year
    $yearArray = range($Startyear, $endYear);
                                ?>
                                <div class="mt-3">
                                    <label class="required">Year</label>
                                    <select name="year" class="form-control mb-3" name="year" id="year">
                                        <option value="">Select Year</option>
                                        <?php
    foreach ($yearArray as $year) {
        // this allows you to select a particular year
        $selected = $year == $Startyear ? 'selected' : '';
        echo '<option ' . $selected . ' value="' . $year . '">' . $year . '</option>';
    }
                                        ?>
                                    </select>
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
        <!----------modal------------>
        <div class="modal" id="add_holidays">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Close-->
                        <h2>Add Holiday</h2>
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
                        <form id="holidays_form">
                            @csrf
                            <!--begin::Wrapper-->
                            <div class="mw-lg-600px mx-auto p-4">
                                <!--begin::Input group-->

                                <div class="mt-3">
                                    <label class="required">Name</label>
                                    <input class="form-control mb-5 mt-3" type="text" name="name">
                                    <!--end::Switch-->
                                </div>
                                <div class="mt-3">
                                    <label class="required">Date</label>
                                    <input class="form-control mb-5 mt-3" type="date" name="date">
                                    <!--end::Switch-->
                                </div>
                                {{-- allBranches --}}
                                <div class="mt-3">
                                    <label class="required">Branch</label>
                                    <select class="form-control mb-5 mt-3" data-control="select2"
                                        data-close-on-select="false" data-placeholder="Select the Company Branch"
                                        data-allow-clear="true" multiple="multiple" name="company_branch_id[]"
                                        id="company_branch">
                                        <option value="all">All</option>
                                        @foreach ($allCompanyBranchesDetails as $compayBranches)
                                            <option value="{{ $compayBranches->id }}" @if (old('company_branch_id')) {{
                                                in_array($departmentsDetails->id, old('company_branch_id')) ? 'selected' : '' }}
                                            @endif>
                                                {{ $compayBranches->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label class="required">Year</label>
                                    <select name="year" class="form-control mb-3" name="year">
                                        <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                    </select>
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
        <script>
            function edit_holiday_details(id, name, date, year, companyBranchesId) {
                if (typeof companyBranchesId === 'string') {
                    companyBranchesId = JSON.parse(companyBranchesId);
                }
                $('#id').val(id);
                $('#name').val(name);
                $('#date').val(date);
                $('#year').val(year);
                $('#edit_company_branch').val(companyBranchesId).trigger('change');
                jQuery('#edit_holidays').modal('show');
            }
            jQuery.noConflict();
            jQuery(document).ready(function ($) {

                jQuery("#company_branch").on("change", function () {
                    if ($(this).val() == 'all') {
                        $("#company_branch > option").prop("selected", true);
                        $("#company_branch").trigger("change");
                    }
                });
                jQuery("#edit_company_branch").on("change", function () {
                    if ($(this).val() == 'all') {
                        $("#edit_company_branch > option").prop("selected", true);
                        $("#edit_company_branch").trigger("change");
                    }
                });
            });
            jQuery(document).ready(function () {
                // Custom rule to allow only alphabetic characters and spaces
                jQuery.validator.addMethod("alphaOnly", function (value, element) {
                    return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
                }, "Name must contain only letters and spaces");

                const validationRules = {
                    name: {
                        required: true,
                        alphaOnly: true
                    },
                    date: {
                        required: true,
                        date: true
                    },
                    'company_branch_id[]': {
                        required: true,
                        minlength: 1
                    },
                    year: {
                        required: true
                    }
                };

                const validationMessages = {
                    name: {
                        required: "Please enter a name",
                        alphaOnly: "Name must contain only letters"
                    },
                    date: "Please select a valid date",
                    'company_branch_id[]': "Please select at least one branch",
                    year: "Please select a year"
                };

                // Error display function - prevents duplicate errors and auto-clears after 5s
                function handleErrors(error_messages) {
                    const errors = error_messages.responseJSON.error;
                    for (let key in errors) {
                        const $field = $('[name="' + key + '"]');

                        // Only append error if it's not already shown
                        if (!$field.next().hasClass('text-danger')) {
                            $field.after(
                                '<span class="text text-danger ' + key + '_error">' + errors[key] + '</span>'
                            );

                            // Remove error after 5 seconds
                            setTimeout(() => {
                                $('.' + key + '_error').remove();
                            }, 5000);
                        }
                    }
                }

                // Reusable validator initializer
                function initValidator(selector, url, successCallback) {
                    $(selector).validate({
                        rules: validationRules,
                        messages: validationMessages,
                        submitHandler: function (form) {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: $(form).serialize(),
                                success: function (response) {
                                    $(selector)[0].reset();
                                    swal.fire("Done!", response.message, "success");
                                    $('#holidays_list').replaceWith(response.data);
                                    if (successCallback) successCallback(response);
                                    const modalId = (selector === '#holidays_form') ? '#add_holidays' : '#edit_holidays';
                                    $(modalId).modal('hide');
                                },
                                error: handleErrors
                            });
                        }
                    });
                }

                // Initialize both forms
                initValidator("#holidays_form", "{{ route('holiday.store') }}");
                initValidator("#holidays_update_form", "<?= route('holiday.update') ?>");
            });

            function handleStatus(id) {
                var checked_value = $('#checked_value').prop('checked');
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
                    url: "{{ route('holiday.statusUpdate') }}",
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
                            url: "<?= route('holiday.delete') ?>",
                            type: "get",
                            data: {
                                id: id
                            },
                            success: function (res) {
                                Swal.fire("Done!", "It was succesfully deleted!", "success");
                                $('#holidays_list').replaceWith(res.data);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error deleting!", "Please try again", "error");
                            }
                        });
                    }
                });
            }

            jQuery("#search").on('input', function () {
                search_filter_results();
            });
            jQuery("#status").on('change', function () {
                search_filter_results();
            });
            jQuery("#searchbranchId").on('change', function () {
                search_filter_results();
            });
            jQuery(document).on('click', '#holidays_list a', function (e) {
                e.preventDefault();
                var page_no = $(this).attr('href').split('page=')[1];
                search_filter_results(page_no);
            });
            function search_filter_results(page_no = 1) {
                $.ajax({
                    type: 'GET',
                    url: company_ajax_base_url + '/holiday/search/filter?page=' + page_no,
                    data: {
                        'status': $('#status').val(),
                        'search': $('#search').val(),
                        'companyBranchId': $('#searchbranchId').val()
                    },
                    success: function (response) {
                        $('#holidays_list').replaceWith(response.data);
                    }
                });
            }
        </script>
@endsection
