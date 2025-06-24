@extends('layouts.company.main')
@section('content')
@section('title', 'TaxSlab Rule Management')
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
                            <input class="form-control form-control-solid ps-14 min-w-150px me-2" placeholder="Search "
                                type="text" name="search" value="{{ request()->get('search') }}" id="search">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>

                        </div>
                        <select class="form-control min-w-150px me-2" id="status">
                            <option value="">Status</option>
                            <option {{ old('status')=='1' || request()->get('status') == '1' ? 'selected' : '' }}
                                value="1">Active</option>
                            <option {{ old('status')=='0' || request()->get('status') == '0' ? 'selected' : '' }}
                                value="0">Inactive</option>
                        </select>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_taxslab"
                        class="btn btn-sm btn-primary align-self-center">
                        Add TaxSlab Rule</a>
                </div>

                <div class="mb-5 mb-xl-10">
                    @include('company.taxslab.list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="modal" id="edit_taxSlab">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Edit TaxSlab Rule</h2>
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
                    <form id="edit_taxSlab_form">
                        @csrf
                        <input type="hidden" id="taxslab" name="id">
                        <div>
                            <label class="required">Income Range Start</label>
                            <input class="form-control mb-5 mt-3" type="number" name="income_range_start"
                                placeholder="Enter the Income Range Started" id="edit_income_range_start">
                        </div>
                        <div>
                            <label class="required">Income Range End</label>
                            <input class="form-control mb-5 mt-3" type="number" name="income_range_end"
                                placeholder="Enter the Income Range End" id="edit_income_range_end">
                        </div>
                        <div>
                            <label class="required">Tax Rate</label>
                            <input class="form-control mb-5 mt-3" type="number" name="tax_rate"
                                placeholder="Enter the Tax Rate" id="edit_tax_rate">
                        </div>
                        <!--end::Wrapper-->
                        <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Update</span>
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
    <div class="modal" id="add_taxslab">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Add Tax Slab</h2>
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
                    <form id="add_taxslab_form">
                        @csrf
                        <div>
                            <label class="required">Income Range Start</label>
                            <input class="form-control mb-5 mt-3" type="number" name="income_range_start"
                                placeholder="Enter the Income Range Started" id="income_range_start">
                        </div>
                        <div>
                            <label class="required">Income Range End</label>
                            <input class="form-control mb-5 mt-3" type="number" name="income_range_end"
                                placeholder="Enter the Income Range End">
                        </div>
                        <div>
                            <label class="required">Tax Rate</label>
                            <input class="form-control mb-5 mt-3" type="number" name="tax_rate"
                                placeholder="Enter the Tax Rate">
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
        function edit_taxslab_details(id,incomeRangeStart,taxRateSlab,imcomeRangeEnd) {
            jQuery('#edit_income_range_start').val(incomeRangeStart);
            jQuery('#edit_income_range_end').val(imcomeRangeEnd);
            jQuery('#edit_tax_rate').val(taxRateSlab);
            jQuery('#taxslab').val(id);
            jQuery('#edit_taxSlab').modal('show');
        }

        jQuery(document).ready(function ($) {
            jQuery("#add_taxslab_form").validate({
                rules: {
                    income_range_start: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    income_range_end: {
                        required: true,
                        number: true,
                        min: 0,
                        greaterThan: "#income_range_start"  // Custom validation to check if end is greater than start
                    },
                    tax_rate: {
                        required: true,
                        number: true,
                        min: 0,
                        max:70
                    }
                },
                messages: {
                    income_range_start: {
                        required: "Please enter the starting income range.",
                        number: "Please enter a valid number.",
                        min: "Income range start must be a positive number."
                    },
                    income_range_end: {
                        required: "Please enter the ending income range.",
                        number: "Please enter a valid number.",
                        min: "Income range end must be a positive number.",
                        greaterThan: "Income range end must be greater than the starting range."
                    },
                    tax_rate: {
                        required: "Please enter the tax rate.",
                        number: "Please enter a valid number.",
                        min: "Tax rate cannot be negative.",
                        max: "Tax rate cannot exceed 70%.",
                        range: "Tax rate must be between 0% and 70%."
                    }
                },
                submitHandler: function (form) {
                    var taxSlabData = $(form).serialize();
                    $.ajax({
                        url: "{{ route('taxslab.store') }}",
                        type: 'POST',
                        data: taxSlabData,
                        success: function (response) {
                            jQuery('#add_taxslab').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#tax_slab_list').replaceWith(response.data);
                            jQuery("#add_taxslab_form")[0].reset();
                        },
                        error: function (error_messages) {
                            let errors = error_messages.responseJSON.errors;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[error_key] + '</span>');
                                setTimeout(function () {
                                    jQuery("." + error_key + "_error").remove();
                                }, 5000);
                            }
                        }
                    });
                }
            });
            jQuery("#edit_taxSlab_form").validate({
            rules: {
                    income_range_start: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    income_range_end: {
                        required: true,
                        number: true,
                        min: 0,
                        greaterThan: "#edit_income_range_start"  // Custom validation to check if end is greater than start
                    },
                    tax_rate: {
                        required: true,
                        number: true,
                        min: 0,
                        max:70
                    }
                },
                messages: {
                    income_range_start: {
                        required: "Please enter the starting income range.",
                        number: "Please enter a valid number.",
                        min: "Income range start must be a positive number."
                    },
                    income_range_end: {
                        required: "Please enter the ending income range.",
                        number: "Please enter a valid number.",
                        min: "Income range end must be a positive number.",
                        greaterThan: "Income range end must be greater than the starting range."
                    },
                    tax_rate: {
                        required: "Please enter the tax rate.",
                        number: "Please enter a valid number.",
                        min: "Tax rate cannot be negative.",
                        max: "Tax rate cannot exceed 70%.",
                        range: "Tax rate must be between 0% and 70%."
                    }
                },
            submitHandler: function (form)
            {
                var taxSlabData = $(form).serialize();
                $.ajax({
                    url: "<?= route('taxslab.update') ?>",
                    type: 'post',
                    data: taxSlabData,
                    success: function (response) {
                        jQuery('#edit_taxSlab').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#tax_slab_list').replaceWith(response.data);
                    },
                    error: function (error_messages) {
                        let errors = error_messages.responseJSON.errors;
                        for (var error_key in errors) {
                            $(document).find('[name=' + error_key + ']').after(
                                '<span id="' + error_key +
                                '_error" class="text text-danger">' + errors[
                                error_key] + '</span>');
                            setTimeout(function () {
                                jQuery("#" + error_key + "_error").remove();
                            }, 5000);
                        }
                    }
                });
            }
            });
            jQuery.validator.addMethod("greaterThan", function (value, element, param) {
                return this.optional(element) || parseFloat(value) > parseFloat($(param).val());
            }, "The income range end must be greater than the start.");
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
                url: "{{ route('taxslab.statusUpdate') }}",
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
                        swal.fire("Done!", 'Default ' + default_name + ' Updated Successfully', "success");
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
                        url: "<?= route('taxslab.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function (res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#tax_slab_list').replaceWith(res.data);
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
        function search_filter_results() {
            $.ajax({
                type: 'GET',
                url: company_ajax_base_url + '/tax-slab/search/filter',
                data: {
                    'status': $('#status').val(),
                    'search': $('#search').val(),
                },
                success: function (response) {
                    $('#tax_slab_list').replaceWith(response.data);
                }
            });
        }
    </script>
    @endsection
