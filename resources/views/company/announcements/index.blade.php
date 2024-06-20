@extends('layouts.company.main')
@section('content')
@section('title')
    Announcements
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
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
                            <input data-kt-patient-filter="search"
                                class="min-w-200px form-control form-control-solid ps-14" placeholder="Search "
                                type="text" id="SearchByPatientName" name="SearchByPatientName" value="">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>
                        {{-- <select class="form-control ml-2">
                            <option value="">Select Department</option>
                            <option value="">Development</option>
                            <option value="">Marketing</option>
                            <option value="">Management</option>
                        </select> --}}
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    {{-- <a href="{{ route('announcement.create') }}" class="btn btn-sm btn-primary align-self-center">
                        Add Announcement</a> --}}
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_company_branch"
                        class="btn btn-sm btn-primary align-self-center">
                        Add Announcement</a>
                    <!--end::Action-->
                </div>

                <div class="mb-5 mb-xl-10">
                    @include('company.announcements.announcement_list')
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::Content-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Root-->
<!--end::Scrolltop-->

<!---------Modal---------->
<div class="modal" id="add_company_branch">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Close-->
                <h2>Add Announcement</h2>
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
                <form id="create_announcement" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label required">Branches</label>
                            <select class="form-control select2  " style="width:100%" name="company_branch_id">
                                <option value=""></option>
                                @foreach ($branches as $key => $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_branch_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label required">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="announcement title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label required">Start Date</label>
                            <input type="text" class="form-control  datetimepicker" name="start_date_time"
                                autocomplete="off" placeholder="select date & time">
                            @error('start_date_time')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label">Expire At</label>
                            <input type="text" class="form-control  datetimepicker"
                                name="expires_at"autocomplete="off" placeholder="select date & time">
                            @error('expires_at')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label required">Status</label>
                            <select class="form-control select2 " name="status" style="width:100%">
                                <option value=""></option>
                                @foreach (transLang('action_status') as $key => $status)
                                    <option value="{{ $key }}">
                                        {{ $status }}</option>
                                @endforeach
                            </select>

                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="col-form-label required">Description</label>
                            <textarea rows="2" class="form-control  " name='description' placeholder="description">
                            </textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div><br>
                    <button class="btn btn-primary" type="submit">save</button>
                </form>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<div class="modal" id="edit_company_branch">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Close-->
                <h2>Edit Announcement</h2>
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
                <form id="edit_announcement" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label required">Branches</label>
                            <select class="form-control sele ct2  " name="company_branch_id" id="company_branch_id"
                                style="width:100%">
                                <option value=""></option>
                                @foreach ($branches as $key => $row)
                                    <option value="{{ $row->id }}"
                                        {{ old('company_branch_id') == $row->id ? 'selected' : '' }}>
                                        {{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_branch_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label required">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                placeholder="announcement title" id="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label required">Start Date</label>
                            <input type="text" class="form-control  datetimepicker" name="start_date_time"
                                autocomplete="off" placeholder="select date & time" id='start_date_time'>
                            @error('start_date_time')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label">Expire At</label>
                            <input type="text" class="form-control  datetimepicker"
                                name="expires_at"autocomplete="off" placeholder="select date & time" id='expires_at'>
                            @error('expires_at')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label required">Status</label>
                            <select class="form-control selec t2 " name="status" id='status' style="width:100%">
                                <option value=""></option>
                                @foreach (transLang('action_status') as $key => $status)
                                    <option value="{{ $key }}"
                                        {{ old('status') == $key ? 'selected' : '' }}>
                                        {{ $status }}</option>
                                @endforeach
                            </select>

                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label">Image</label>
                            <input type="file" class="form-control " name="image">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label class="col-form-label required">Description</label>
                            <textarea rows="2" class="form-control  " name='description' placeholder="description" id='description'>
                            {{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div><br>
                    <button class="btn btn-primary" type="submit">save</button>
                </form>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
 
<script>
    $(".datetimepicker").each(function() {
        $(this).datetimepicker();
    });
    $(document).ready(function() {
        $("#create_announcement").validate({
            rules: {
                company_branch_id: {
                    required: true,
                },
                title: {
                    required: true,
                    minlength: 10
                },
                start_date_time: {
                    required: true,
                },
                expires_at: {
                    required: false
                },
                description: {
                    required: true,
                    minlength: 10
                },
                status: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                var data = new FormData(form);
                $.ajax({
                    url: "{{ route('announcement.store') }}",
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        jQuery('#add_company_branch').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#announcement_list').replaceWith(response.data);
                        jQuery("#create_announcement")[0].reset();
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
    $(document).ready(function() {
        $("#edit_announcement").validate({
            rules: {
                company_branch_id: {
                    required: true,
                },
                title: {
                    required: true
                },
                start_date_time: {
                    required: true
                },
                expires_at: {
                    required: false
                },
                description: {
                    required: true,
                },
                status: {
                    required: true,
                },
            },

            submitHandler: function(form) {
                var data = new FormData(form);
                $.ajax({
                    url: "{{ route('announcement.update') }}",
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        jQuery('#edit_company_branch').modal('hide');
                        swal.fire("Done!", response.message, "success");
                        jQuery('#announcement_list').replaceWith(response.data);
                        jQuery("#edit_announcement")[0].reset();
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

    function edit_announcement_details(companyAnnouncementDetails) {
        companyAnnouncementDetails = JSON.parse(companyAnnouncementDetails);
        console.log(companyAnnouncementDetails);
        $('#id').val(companyAnnouncementDetails.id);
        $('#title').val(companyAnnouncementDetails.title);
        $('#company_branch_id').val(companyAnnouncementDetails.company_branch_id);
        $('#description').val(companyAnnouncementDetails.description);
        $('#status').val(companyAnnouncementDetails.status);
        $('#start_date_time').val(companyAnnouncementDetails.start_date_time);
        $('#expires_at').val(companyAnnouncementDetails.expires_at);

        jQuery('#edit_company_branch').modal('show');
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
                    url: "<?= route('announcement.delete') ?>",
                    type: "get",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        Swal.fire("Done!", "It was succesfully deleted!", "success");
                        $('#announcement_list').replaceWith(res.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
        });
    }

    function handleStatus(id) {
        var checked_value = $('#checked_value').prop('checked');
        let status;
        let status_name;
        if (checked_value == true) {
            status = 'active';
            status_name = 'Active';
        } else {
            status = 'inactive';
            status_name = 'Inactive';
        }
        $.ajax({
            url: "{{ route('announcement.statusUpdate') }}",
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
    $('.select2').select2({
        placeholder: "select",
        allowClear: true
    });
</script>
@endsection
