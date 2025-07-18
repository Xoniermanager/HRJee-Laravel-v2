@extends('layouts.company.main')
@section('content')
@section('title','Reward Category')
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
                                type="text" name="search" value="{{ request()->get('search') }}" id="search">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>

                        </div>
                        <select name="status" class="form-control min-w-150px me-2" id="status">
                            <option value="">Status</option>
                            <option {{ old('status') == '1' || request()->get('status') == '1' ? 'selected' : '' }}
                                value="1">Active</option>
                            <option {{ old('status') == '0' || request()->get('status') == '0' ? 'selected' : '' }}
                                value="0">Inactive</option>
                        </select>

                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_reward_category_modal"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Reward Category</a>

                    <!--end::Action-->
                </div>

                <div class="mb-5 mb-xl-10">
                    @include('company.reward_category.list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="modal" id="edit_reward_category">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Edit Reward Category</h2>
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
                    <form id="reward_category_update_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="mw-lg-600px mx-auto p-4">
                            <!--begin::Input group-->
                            <div class="mt-3">
                                <label class="required">Name</label>
                                <input class="form-control mb-5 mt-3" type="text" name="name" id="name">
                            </div>
                            <!--end::Input group-->
                            <div class="mt-3">
                                <label>Description</label>
                                <textarea class="form-control mb-5 mt-3" type="text" name="description" id="description"> </textarea>
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
    <div class="modal" id="add_reward_category_modal">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2>Add Reward Category</h2>
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
                    <form id="add_reward_category_form">
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
                                <label>Description</label>
                                <textarea class="form-control mb-5 mt-3" type="text" name="description" id=""> </textarea>
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
        function edit_reward_category_details(id, name,description) {
            $('#id').val(id);
            $('#name').val(name);
            $('#description').val(description);
            jQuery('#edit_reward_category').modal('show');
        }
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#add_reward_category_form").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Please enter name",
                },
                submitHandler: function(form) {
                    var reward_category_data = $(form).serialize();
                    $.ajax({
                        url: "{{ route('reward_category.store') }}",
                        type: 'POST',
                        data: reward_category_data,
                        success: function(response) {
                            jQuery('#add_reward_category_modal').modal('hide');
                            jQuery("#add_reward_category_form")[0].reset();
                            swal.fire("Done!", response.message, "success");
                            $('#category_list').replaceWith(response.data);

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
            jQuery("#reward_category_update_form").validate({
                rules: {
                    name: "required"
                },
                messages: {
                    name: "Please enter name",

                },
                submitHandler: function(form) {
                    var reward_category_data = $(form).serialize();
                    $.ajax({
                        url: "<?= route('reward_category.update') ?>",
                        type: 'post',
                        data: reward_category_data,
                        success: function(response) {
                            jQuery('#edit_reward_category').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            jQuery('#category_list').replaceWith(response.data);
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
                url: "{{ route('reward_category.statusUpdate') }}",
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
                        url: "<?= route('reward_category.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#category_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
        jQuery("#search").on('input', function() {
            search_filter_results();
        });
        jQuery("#status").on('change', function() {
            search_filter_results();
        });
        jQuery(document).on('click', '#category_list a', function(e) {
            e.preventDefault();
            var page_no = $(this).attr('href').split('page=')[1];
            search_filter_results(page_no);
        });
        function search_filter_results(page_no = 1) {
            $.ajax({
                type: 'GET',
                url: company_ajax_base_url + '/reward-category/search/filter?page=' + page_no,
                data: {
                    'status': $('#status').val(),
                    'search': $('#search').val()
                },
                success: function(response) {
                    $('#category_list').replaceWith(response.data);
                }
            });
        }
    </script>
@endsection
