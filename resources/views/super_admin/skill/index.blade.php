@extends('layouts.employee.main')
@section('content')
@section('title')
    Skills
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
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
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_skill"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Skills</a>
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
                                                    <th>Skills</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            @forelse ($allSkillDetails as $key => $skillDetails)
                                                <tbody class="">
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $skillDetails->name }}</td>
                                                        <td>{{ $skillDetails->description }}</td>
                                                        <td data-order="Invalid date">
                                                            <label class="switch">
                                                                <input type="checkbox"
                                                                    <?= $skillDetails->status == '1' ? 'checked' : '' ?>
                                                                    onchange="handleStatus({{ $skillDetails->id }},{{ $skillDetails->status }},'status')">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="#" data-bs-toggle="modal"
                                                                    onClick="edit_company('{{ $skillDetails->id }}', '{{ $skillDetails->name }}','{{ $skillDetails->description }}')"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('skills.delete', $skillDetails->id) }}"
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
                                                        <strong>No Skills Found!</strong>
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
</div>

<!-- Modal for creation form-->
<div class="modal" id="kt_modal_skill" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0">
                <h2>Add Skills</h2>
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
                <form id="skills_form">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label for="">Name*</label>
                        <input class="form-control" name="name" type="text">
                    </div>
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <div class="col-md-12 form-group">
                        <label for="">Description</label>
                        <input class="form-control" name="description" type="text">
                    </div>
                    @error('description')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
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
<div class="modal" id="kt_modal_skills_update" tabindex="-1" aria-modal="true" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0">
                <h2>Edit Skills</h2>
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
                    <div class="col-md-12 form-group">
                        <label for="">Description</label>
                        <input class="form-control" name="description" type="text" value=""
                            id="description">
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
    function edit_company(id, name, description) {
        $('#id').val(id);
        $('#name').val(name);
        $('#description').val(description);
        jQuery('#kt_modal_skills_update').modal('show');
    }

    jQuery.noConflict();
    jQuery(document).ready(function($) {
        jQuery("#skills_form").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "Please enter name",
            },
            submitHandler: function(form) {
                var company_status = $(form).serialize();
                $.ajax({
                    url: "{{ route('skills.store') }}",
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
                var company_status = $(form).serialize();
                var id = $('#id').val();
                $.ajax({
                    url: "<?= route('skills.update') ?>",
                    type: 'post',
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
    function handleStatus(id, status) {
        $.ajax({
            url: "{{ route('skills.statusUpdate') }}",
            type: 'get',
            data: {
                'id': id,
                'status': status,
            },
            success: function(res) {
                if (res) {
                    swal.fire("Done!", 'Status update successfully', "success");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    swal.fire("Oops!", 'Something Went Wrong', "error");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
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
