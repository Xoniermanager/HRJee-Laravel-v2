@extends('layouts.company.main')
@section('content')
@section('title')
    Resignation Status Lists
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
                    <div class="card-title">
                        <div class="min-w-200px me-2 d-flex align-items-center position-relative my-1">
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
                            <input class="form-control form-control-solid ps-14" placeholder="Search " type="text"
                                value="{{ request()->get('search') }}" id="search">
                        </div>
                        <select class="me-2 form-control min-w-200px" id="status">
                            <option value="">Status</option>
                            <option {{ request()->get('status') == '1' ? 'selected' : '' }} value="1">Active
                            </option>
                            <option {{ request()->get('status') == '2' ? 'selected' : '' }} value="2">Inactive
                            </option>
                        </select>

                        <select class="form-control min-w-200px me-2" id="filter_state_id" style="display: none">
                        </select>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_resignation_status"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Resignation Status</a>

                    <!--end::Action-->
                </div>
                <div class="mb-5 mb-xl-10">
                    @include('company.resignation_status.resignation-status-list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="modal" id="edit_resignation_status">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2> Edit Resignation Status</h2>
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
                    <form class="row g-3" id="edit_resignation_status_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" placeholder="Enter Resignation Status"
                                name="name" id="name">
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
    <div class="modal" id="add_resignation_status">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2> Add Resignation Status</h2>
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
                    <form class="row g-3" id="status_create_form">
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" placeholder="Enter Status" name="name"
                                id="name">
                            @error('name')
                                <span class="text-denger">{{ $message }} </span>
                            @enderror
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

        /** Filter By Search By Dropdown*/
        $("#search").on('blur', function() {
            search_filter_results();
        });
        $("#status").on('change', function() {
            search_filter_results();
        });
    

        function search_filter_results() {
            $.ajax({
                type: 'GET',
                url:  `{{route('resignation.status.search')}}`,
                data: {
                    'status': $('#status').val(),
                    'search': $('#search').val(),
                },
                success: function(response) {
                    $('#company_resignation_status_list').replaceWith(response.data);
                }
            });
        }
        /**-------------End----------*/

        /** Validation and Ajax Creation and Updated*/
        jQuery(document).ready(function($) {
            jQuery("#edit_resignation_status_form").validate({
                rules: {
                    name: "required",
                },
                submitHandler: function(form) {
                    var resignationStatusData = $(form).serialize();
                    $.ajax({
                        url: "{{ route('resignation.status.update') }}",
                        type: 'POST',
                        data: resignationStatusData,
                        success: function(response) {
                            $('#edit_resignation_status').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#company_resignation_status_list').replaceWith(response
                                .data);
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


            jQuery("#status_create_form").validate({
                rules: {
                    name: "required",
                },
                submitHandler: function(form) {
                    var resignationData = $(form).serialize();
                    $.ajax({
                        url: `{{ route('resignation.status.store') }}`,
                        type: 'post',
                        data: resignationData,
                        success: function(response) {
                            $('#add_resignation_status').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#company_resignation_status_list').replaceWith(response
                                .data);
                            $("#status_create_form")[0].reset();
                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.errors;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span id="' + error_key +
                                    '_error" class="text text-danger">' + errors[
                                        error_key] + '</span>');
                                setTimeout(function() {
                                    jQuery("#" + error_key + "_error").remove();
                                }, 4000);
                            }
                        }
                    });
                }
            });
        });

        function edit_resignationStatus_details(resignationStatus) {

            resignationStatus = JSON.parse(resignationStatus);
            console.log(resignationStatus);
            $('#id').val(resignationStatus.id);
            $('#name').val(resignationStatus.name);
            jQuery('#edit_resignation_status').modal('show');
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
                url: "{{ route('resignation.status.statusUpdate') }}",
                type: 'get',
                data: {
                    'id': id,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        jQuery('#company_resignation_status_list').replaceWith(res.data);
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
                        url: `{{ route('resignation.status.delete') }}` + "/" + id,
                        type: "get",
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#company_resignation_status_list').replaceWith(response.data);
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
