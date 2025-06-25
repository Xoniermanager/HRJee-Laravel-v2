@extends('layouts.company.main')
@section('title', ' Leaves Type')
@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_leave_type"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Leaves Type</a>
                    <!--end::Action-->
                </div>
                <div class="mb-5 mb-xl-10">
                    @include('admin.leave_type.leave_type_list')
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
</div>

<!-- Modal for creation form-->
<div class="modal" id="kt_modal_leave_type" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0">
                <h2>Add Leaves Type</h2>
                <!--begin::Close-->
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
            <div class="modal-body scroll-y pb-5 border-top">
                <!--begin::Wrapper-->
                <form id="leave_type_form">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label for="">Name*</label>
                        <input class="form-control" name="name" type="text">
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


<!-- Modal for Edit  form-->
<div class="modal" id="kt_modal_leave_type_update" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0">
                <h2>Edit Leaves Type</h2>
                <!--begin::Close-->
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
            <div class="modal-body scroll-y pb-5 border-top">
                <!--begin::Wrapper-->
                <form id="update-form">
                    @csrf
                    <input type="hidden" id="id" value="" name="id">
                    <div class="col-md-12 form-group">
                        <label for="">Name*</label>
                        <input class="form-control" name="name" type="text" value="" id="name">
                    </div>
                    <!--end::Wrapper-->
                    <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Update</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please
                                wait...
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
    function edit_leave_type(id, name) {
        $('#id').val(id);
        $('#name').val(name);
        jQuery('#kt_modal_leave_type_update').modal('show');
    }
    jQuery.noConflict();
jQuery(document).ready(function($) {

    // Utility: Clear all errors inside a form
    function clearErrors(form) {
        $(form).find('.text-danger').remove();
    }

    // Utility: Show single error per input field
    function showErrors(errors, form) {
        for (let field in errors) {
            const input = $(form).find(`[name="${field}"]`);
            input.next('.text-danger').remove(); // remove existing error
            input.after(`<span class="text-danger">${errors[field]}</span>`);
        }

        // Optional: remove error messages after 4s
        setTimeout(() => {
            $(form).find('.text-danger').fadeOut(300, function() { $(this).remove(); });
        }, 4000);
    }

    // Shared form submit handler
    function handleFormSubmit(formId, url, modalId, successMessage) {
        $(formId).validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Please enter name"
            },
            submitHandler: function(form) {
                clearErrors(form);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function(response) {
                        jQuery(modalId).modal('hide');
                        Swal.fire("Done!", successMessage || response.message, "success");
                        $('#leave_type_list').html(response.data);
                        form.reset();
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON?.error) {
                            showErrors(xhr.responseJSON.error, form);
                        }
                    }
                });
            }
        });
    }
    // Initialize both forms
    handleFormSubmit('#leave_type_form', "{{ route('leave.type.store') }}", '#kt_modal_leave_type', 'Leave Type Added');
    handleFormSubmit('#update-form', "{{ route('leave.type.update') }}", '#kt_modal_leave_type_update', 'Leave Type Updated');
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
            url: "{{ route('leave.type.statusUpdate') }}",
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
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('leave.type.delete') }}",
                        type: "GET",
                        data: { id: id },
                        success: function (res) {
                            Swal.fire("Deleted!", res.success || "Leave type deleted successfully.", "success");
                            $('#leave_type_list').replaceWith(res.data);
                        },
                        error: function (xhr) {
                            let message = "Something went wrong. Please try again.";
                            if (xhr.status === 400 && xhr.responseJSON?.error) {
                                message = xhr.responseJSON.error;
                            }
                            Swal.fire("Delete Failed!", message, "error");
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
