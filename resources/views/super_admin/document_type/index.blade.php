@extends('layouts.employee.main')
@section('content')
@section('title')
    Document Types
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <div class="card card-body col-md-12">
            <div class="card-header cursor-pointer p-0">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
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
                <a href="#" data-bs-toggle="modal" data-bs-target="#add_document"
                    class="btn btn-sm btn-primary align-self-center">
                    Add Document</a>

                <!--end::Action-->
            </div>

            <div class="mb-5 mb-xl-10">
                @include('super_admin.document_type.document_type_list')
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->
</div>
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                fill="currentColor" />
            <path
                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                fill="currentColor" />
        </svg>
    </span>
    <!--end::Svg Icon-->
</div>
<!---------Modal for update---------->
<div class="modal" id="edit_document">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Close-->
                <h2>Update Document</h2>
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
                <form id="update-form">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <!--begin::Wrapper-->
                    <div class="mw-lg-600px mx-auto p-4">
                        <div class="mb-3 mt-3">
                            <label>Document Name</label>
                            <input class="form-control mb-5 mt-3" type="text" name="name" id="name">
                        </div>
                        <!--begin::Input group-->
                        <div class="mt-3">
                            <label>Description</label>
                            <textarea class="form-control mb-5 mt-3" name="description" id="description"></textarea>
                            <h6>Is Mandatory </h6>
                            <div class="d-flex align-items-center mt-3 mb-3">
                             
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                    <input class="form-check-input" name="is_mandatory" value="1" type="radio" id="yes_mandatory">
                                    <span class="fw-semibold ps-2 fs-6">
                                      Yes
                                    </span>
                                </label>
                                <!--end::Option-->

                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid ml-2">
                                    <input class="form-check-input" name="is_mandatory" value="0" type="radio" id="no_mandatory">
                                    <span class="fw-semibold ps-2 fs-6">
                                       No
                                    </span>
                                </label>
                                <!--end::Option-->
                            </div>

                          
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
<!----------modal for create------------>
<div class="modal" id="add_document">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Close-->
                <h2>Add Document</h2>
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
                <form id="dcoument_type_form">
                    @csrf
                    <div class="mw-lg-600px mx-auto p-4">
                        <div class="mb-3 mt-3">
                            <label>Document Name</label>
                            <input class="form-control mb-5 mt-3" type="text" name="name">
                        </div>
                        <!--begin::Input group-->
                        <div class="mt-3">
                            <label>Description</label>
                            <textarea class="form-control mb-5 mt-3" name="description"></textarea>

                            <div class="d-flex align-items-center mt-3 mb-3">

                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid">
                                    <input class="form-check-input" name="is_mandatory" type="checkbox" value="1">
                                    <span class="fw-semibold ps-2 fs-6">
                                        Is Mandatory
                                    </span>
                                </label>
                                <!--end::Option-->
                            </div>
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
@endsection
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    function editDocuments(id, name, description, is_mandatory) {
        $('#id').val(id);
        $('#name').val(name);
        $('#description').val(description);
        if (is_mandatory == 1) {
            $('#yes_mandatory').prop('checked', true).val(is_mandatory);
        }
        if (is_mandatory == 0) {
            $('#no_mandatory').prop('checked', true).val(is_mandatory);
        }

        jQuery('#edit_document').modal('show');
    }

    jQuery.noConflict();
    jQuery(document).ready(function($) {
        jQuery("#dcoument_type_form").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "Please enter name",
            },
            submitHandler: function(form) {
                var company_status = $(form).serialize();
                $.ajax({
                    url: "{{ route('document.type.store') }}",
                    type: 'POST',
                    data: company_status,
                    success: function(response) {
                        jQuery('#add_document').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        $('#document_type_list').replaceWith(response.data);
                        $('#dcoument_type_form')[0].reset();
                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            $(document).find('[name=' + error_key + ']').after(
                                '<span class="' + error_key +
                                'store_error text text-danger">' + errors[
                                    error_key] + '</span>');
                            setTimeout(function() {
                                jQuery("." + error_key + "store_error").css('display','none');
                            }, 4000);
                        }
                    }
                });
            }
        });
        $("#update-form").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "Please enter name",
            },
            submitHandler: function(form) {
                var document_type = $(form).serialize();
                var id = $('#id').val();
                $.ajax({
                    url: "<?= route('document.type.update') ?>",
                    type: 'post',
                    data: document_type,
                    success: function(response) {
                        jQuery('#edit_document').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        $('#document_type_list').replaceWith(response.data);
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
                            }, 4000);
                        }
                    }
                });
            }
        });
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
            url: "{{ route('document.type.statusUpdate') }}",
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
                    url: "<?= route('document.type.delete') ?>",
                    type: "get",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        Swal.fire("Done!", "It was succesfully deleted!", "success");
                        $('#document_type_list').replaceWith(res.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
        });
    }
</script>
<style>
.error {
    color: red;
}
</style>
