@extends('layouts.employee.main')
@section('content')
@section('title')
    Document Types
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
            @endif
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
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

                    <div class="">
                        <div class="">
                            <!--begin::Body-->
                            <div class="">
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fw-bold">
                                                    <th>Sr. No.</th>
                                                    <th>Document Name</th>
                                                    <th>Description</th>
                                                    <th>Mandatory</th>
                                                    <th>Active/Inactive</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            @forelse ($allDocumentTypes as $key => $documentTypes)
                                                <tbody class="">
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $documentTypes->name }}</td>
                                                        <td>{{ $documentTypes->description }}</td>
                                                        <td>
                                                            <?php
                                                            $is_mandatory = '';
                                                            if ($documentTypes->is_mandatory == '1') {
                                                                $is_mandatory = 'Yes';
                                                            } else {
                                                                $is_mandatory = 'No';
                                                            }
                                                            ?>
                                                            <span class="badge py-3 px-4 fs-7 badge-light-danger">
                                                                {{ $is_mandatory }}</span>
                                                        </td>
                                                        <td>
                                                            <label class="switch">
                                                                <input type="checkbox"
                                                                    {{ $documentTypes->status == 1 ? 'checked' : '' }}
                                                                    onchange="handleStatus('{{ $documentTypes->id }}')"
                                                                    id="checked_value">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="#" data-bs-toggle="modal"
                                                                    onClick="editDocuments('{{ $documentTypes->id }}', '{{ $documentTypes->name }}','{{ $documentTypes->description }}','{{ $documentTypes->is_mandatory }}')"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('document.type.delete', $documentTypes->id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="alert('Are you sure want to delete')">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-trash"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @empty
                                                <td colspan="3">
                                                    <span class="text-danger">
                                                        <strong>No Document Found!</strong>
                                                    </span>
                                                </td>
                                            @endforelse
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->

                                </div>
                            </div>
                            <!--begin::Body-->

                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Body-->
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

                            <div class="d-flex align-items-center mb-3">
                                <!--begin::Option-->
                                <label class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                    <input class="form-check-input" name="is_mandatory" type="checkbox"
                                        id="is_mandatory" value="1">
                                    <span class="fw-semibold ps-2 fs-6">
                                        Is Mandatory
                                    </span>
                                </label>
                                <!--end::Option-->

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
                                    <input class="form-check-input" name="is_mandatory" type="checkbox"
                                        value="1">
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
            $('#is_mandatory').prop('checked', true);
        } else {
            $('#is_mandatory').prop('checked', false);

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
                        swal.fire("Done!", response.message, "success");
                        // refresh page after 2 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
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
</script>
<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
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
                        swal.fire("Done!", response.message, "success");
                        // location.reload();
                        // refresh page after 2 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
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
</script>
<script>
    function handleStatus(id) {
        var checked_value = $('#checked_value').prop('checked');
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
</script>
<style>
.error {
    color: red;
}
</style>
