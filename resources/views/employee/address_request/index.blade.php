@extends('layouts.employee.main')
@section('content')
@section('title','Address Request')
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
                        <select name="status" class="form-control min-w-250px" id="status">
                            <option value="">Status</option>
                            <option {{ old('status') == 'pending' || request()->get('status') == 'pending' ? 'selected' : '' }}
                                value="pending">Pending</option>
                            <option {{ old('status') == 'approved' || request()->get('status') == 'approved' ? 'selected' : '' }}
                                value="approved">Approved</option>
                            <option {{ old('status') == 'rejected' || request()->get('status') == 'rejected' ? 'selected' : '' }}
                                value="rejected">Rejected</option>
                        </select>
                    </div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_address_request_modal"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Address Request</a>
                </div>

                <div class="mb-5 mb-xl-10">
                    @include('employee.address_request.list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="modal" id="edit_address_request">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Edit Address Request</h2>
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
                    <form id="address_request_update_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="mw-lg-600px mx-auto p-4">
                            <div class="mt-3">
                                <label class="required">Address</label>
                                <textarea class="form-control mb-5 mt-3" type="text" name="address" id="address"></textarea>
                                <!--end::Switch-->
                            </div>
                            <div class="mt-3">
                                <label class="required">Reason</label>
                                <textarea class="form-control mb-5 mt-3" type="text"  name="reason" id="reason"></textarea>
                                <!--end::Switch-->
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
    <div class="modal" id="add_address_request_modal">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Add Address Request</h2>
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
                    <form id="add_address_request_form">
                        @csrf
                        <!--begin::Wrapper-->
                        <div class="mw-lg-600px mx-auto p-4">
                            <!--begin::Input group-->
                            <div class="mt-3">
                                <label class="required">Address</label>
                                <textarea class="form-control mb-5 mt-3" type="text"  name="address"></textarea>
                                <!--end::Switch-->
                            </div>
                            <div class="mt-3">
                                <label class="required">Reason</label>
                                <textarea class="form-control mb-5 mt-3" type="text"  name="reason"></textarea>
                                <!--end::Switch-->
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
        function edit_address_request_details(id,address,reason) {
            $('#id').val(id);
            $('#address').val(address);
            $('#reason').val(reason);
            jQuery('#edit_address_request').modal('show');
        }
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#add_address_request_form").validate({
                rules: {
                    address: "required",
                    reason: "required",
                },
                messages: {
                    address: "Please Enter the Address",
                    reason: "Please Enter the Reason",
                },
                submitHandler: function(form) {
                    var country_data = $(form).serialize();
                    $.ajax({
                        url: "{{ route('employee.address.request.store') }}",
                        type: 'POST',
                        data: country_data,
                        success: function(response) {
                            jQuery('#add_address_request_modal').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#address_request_list').replaceWith(response.data);
                            jQuery("#add_address_request_form")[0].reset();

                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span class="' + error_key +
                                    '_error text text-danger">' + errors[
                                        error_key] + '</span>');
                                setTimeout(function() {
                                    jQuery("." + error_key + "_error").remove();
                                }, 5000);
                            }
                        }
                    });
                }
            });
            jQuery("#address_request_update_form").validate({
                rules: {
                    address: "required",
                    reason: "required",
                },
                messages: {
                    address: "Please Enter the Address",
                    reason: "Please Enter the Reason",
                },
                submitHandler: function(form) {
                    var country_data = $(form).serialize();
                    $.ajax({
                        url: "<?= route('employee.address.request.update') ?>",
                        type: 'post',
                        data: country_data,
                        success: function(response) {
                            jQuery('#edit_address_request').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            jQuery('#address_request_list').replaceWith(response.data);
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
                        url: "<?= route('employee.address.request.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#address_request_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
        jQuery("#status").on('change', function() {
            search_filter_results();
        });
        jQuery(document).on('click', '#address_request_list a', function(e) {
            e.preventDefault();
            var page_no = $(this).attr('href').split('page=')[1];
            search_filter_results(page_no);
        });

        function search_filter_results(page_no = 1) {
            $.ajax({
                type: 'GET',
                url: employee_ajax_base_url + '/address/request/search/filter?page=' + page_no,
                data: {
                    'status': $('#status').val(),
                },
                success: function(response) {
                    $('#address_request_list').replaceWith(response.data);
                }
            });
        }
    </script>
    @endsection
