@extends('layouts.company.main')
@section('content')
@section('title')
    Announcements
@endsection
<div class="card card-body col-md-12">
    <div class="card-header p-4">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0"> Add Announcement</h3>
        </div>
        <!--end::Card title-->
    </div>
    <div class="mb-5 mb-xl-10">
        <div class="card-body">
            {{-- enctype="multipart/form-data" method="post"
                action="{{ route('announcement.store') }}" --}}
            <form class="row" id="save-assign-anouncement-frm">
                @csrf
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label required">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $announcement->title }}"
                            placeholder="announcement title" id="title">
                        <label class="field_error title_error"> </label>

                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label required">Start Date</label>
                        <input type="text" class="form-control  datetimepicker" name="start_date_time"
                            id="start_date_time" autocomplete="off" placeholder="select date & time"
                            value="{{ $announcement->start_date_time }}">
                        <label class="field_error start_date_time_error"> </label>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label">Expire At</label>
                        <input type="text" class="form-control  datetimepicker" name="expires_at" autocomplete="off"
                            value="{{ $announcement->expires_at }}" placeholder="select date & time">
                        <label class="field_error expires_at_error"> </label>

                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label required">Status</label>
                        <select class="bg-white form-select form-select-solid " data-control="select2"
                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                            data-allow-clear="true" name="status" style="width:100%" id="status">
                            <option value=""></option>
                            @foreach (transLang('action_status') as $key => $status)
                                <option value="{{ $key }}"
                                    {{ $announcement->status == $key ? 'selected' : '' }}>
                                    {{ $status }}</option>
                            @endforeach
                        </select>
                        <label class="field_error status_error"> </label>

                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        <label class="field_error image_error"> </label>
                        <img src="{{ $announcement->announcement_image }}" height="100">
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label required">Description</label>
                        <textarea rows="1" class="form-control  " name='description' placeholder="description" id="description">
                        {{ $announcement->description }}
                        </textarea>
                        <label class="field_error description_error"> </label>

                    </div>

                    <div class="col-sm-6 ">
                        <div class="h-100">
                            <div class="row card-body">

                                <div class="row">
                                    <div class="col-md-2 form-group mt-3">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox" name="all_branch">
                                            {{-- onchange="get_checkedValue('department')" id="department_checkbox" --}}
                                        </label>
                                    </div>

                                    <div
                                        class="col-md-10 form-group {{ !empty(auth()->guard('admin')->user()->company_id) && empty(auth()->guard('admin')->user()->branch_id) ? '' : 'd-none' }}">
                                        <label class="required">Company Branches </label>


                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple="multiple" name="branch_id[]"
                                            id="company_branch_id">
                                            <option value=""></option>
                                            @foreach ($branches as $key => $row)
                                                <option value="{{ $row->id }}"
                                                    {{ in_array($row->id, $assignBrancheIds) ? 'selected' : '' }}>
                                                    {{ $row->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="field_error branch_id_error"> </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 form-group mt-3">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox" name="all_department">
                                            {{-- onchange="get_checkedValue('department')" id="department_checkbox" --}}
                                        </label>
                                    </div>

                                    <div class="col-md-10 form-group">
                                        <label class=" ">Department </label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple name="department_id[]"
                                            id="department_id" style="width:100%">
                                            <option value=""></option>
                                            @foreach ($departments as $key => $department)
                                                <option value="{{ $department->id }}"
                                                    {{ in_array($row->id, $assignDepartmentIds) ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="field_error department_id_error"> </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 form-group mt-3">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox"
                                                name="all_department">
                                            {{-- onchange="get_checkedValue('department')" id="department_checkbox" --}}
                                        </label>
                                    </div>

                                    <div class="col-md-10 form-group">
                                        <label class="">Designation </label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple name="designation_id[]"
                                            id="designation_id" style="width:100%">
                                            <option value=""></option>
                                            @forelse ($designations as $key => $designation)
                                                <option value="{{ $designation->id }}"
                                                    {{ in_array($designation->id, $assignDesignationIds) ? 'selected' : '' }}>
                                                    {{ $designation->name }}
                                                </option>
                                            @empty
                                                <option value=""> </option>
                                            @endforelse
                                        </select>
                                        <label class="field_error designation_id_error"> </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="required">Assign Announcement </label>
                                    <div class="d-flex align-items-center mt-3">
                                        <!--begin::Option-->
                                        <label
                                            class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                            <input class="form-check-input" name="assign_announcement" type="radio"
                                                onchange="assignAnnouncement(1)" value="1">
                                            <span class="fw-semibold ps-2 fs-6">
                                                Now
                                            </span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label
                                            class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                            <input class="form-check-input" name="assign_announcement" type="radio"
                                                onchange="assignAnnouncement(0)" value="0" checked>
                                            <span class="fw-semibold ps-2 fs-6">
                                                Leter
                                            </span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                </div>

                                <div class="form-group notification_schedule_time">
                                    <label class="required">Schedule Date</label>
                                    <input class="form-control datetimepicker" name="notification_schedule_time"
                                        type="text">
                                </div>
                                <label class="field_error notification_schedule_time_error"> </label>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-">
                            <div class="card-body">
                                <div class="employee_listing">
                                    @forelse ($users as $user)
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="assets/media/user.jpg" alt="">
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#"
                                                    class="text-dark fw-bold text-hover-primary fs-6">Full
                                                    {{ $user->user->name }}</a>
                                                <span
                                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $user->user->email }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No users</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                </div><br>


                {{-- <span class="">
                    <a href="#" class="btn btn-primary mt-5">Save</a>
                </span> --}}
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary px-5 radius-30 save-assign-anouncement-frm"
                        onclick="addUpdateFormData('message_assign-anouncement_box','post','{{ route('announcement.update',$announcement->id) }}','save-assign-anouncement-frm','','{{ route('announcement.index') }}','class','')">
                        Save
                        & Close</button>
                    <button type="button" class="btn btn-outline-primary px-5 radius-30"
                        onclick="resetForm('save-assign-anouncement-frm')">Reset</button>
                    <div>
            </form>

        </div>
    </div>
</div>
<!--end::Content-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<script>
    function assignAnnouncement(value) {
        if (value == 1)
            $('.notification_schedule_time').hide();
        else
            $('.notification_schedule_time').show();
    }
    $(document).ready(function() {

        $(document).on('change', '#announcement_id', function() {
            let id = $(this).val();
            alert(id);
            $.ajax({
                url: `{{ route('announcement.details') }}` + '/' + id,
                type: 'get',
                processData: false,
                contentType: false,
                contentType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status == true) {
                        $("#assign_title").val(response.data.title);
                        $("#expires_at").val(response.data.expires_at);
                        $("#assign_description").text(response.data.assign_description);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        })

        $(document).on('change', '#company_branch_id', function() {
            let ids = $(this).val();
            console.log(ids);
            // if ($.inArray("all", ids) !== -1) {
            //     console.log('found');
            // }

            // $(this).find("option").remove().end().append(
            //     '<option value = "gfg">GeeksForGeeks</option>');

            $.ajax({
                url: `{{ route('announcement.branch.users') }}`,
                type: 'get',
                data: {
                    ids: ids
                },
                contentType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        let html = '';
                        if (response.data.branchUsers.length > 0) {
                            $('.employee_listing').html(html);
                            $.each(response.data.branchUsers, function(key, value) {
                                html += ` <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="assets/media/user.jpg" alt="">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
                                            ${value.user.name }</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">${value.user.email }</span>
                                    </div>
                                </div>`;

                            });
                        } else {
                            html += `<p>Users not found</p>`;
                        }

                        $('.employee_listing').html(html);
                        let departments = '<option value=""></option>';
                        $.each(response.data.branchDepartments, function(key, value) {
                            departments += `<option value="${value.id}">
                         ${value.name}  </option>`;
                        });
                        $("#department_id").html(departments);

                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        })
        $(document).on('change', '#department_id', function() {
            let department_id = $(this).val();
            // let branch_id = $('select#company_branch_id option:selected').val();
            let branch_id = new Array();
            $("select#company_branch_id option:selected").each(function() {
                branch_id.push($(this).val());
            });
            $.ajax({
                url: `{{ route('announcement.branch.department.users') }}`,
                type: 'get',
                data: {
                    branchIds: branch_id,
                    departmentIds: department_id
                },
                contentType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        let html = '';
                        if (response.data.branchDepartmentUsers.length > 0) {
                            $.each(response.data.branchDepartmentUsers, function(key,
                                value) {
                                html += ` <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="assets/media/user.jpg" alt="">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
                                            ${value.user.name }</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">${value.user.email }</span>
                                    </div>
                                </div>`;

                            });
                        } else {
                            html += `<p>Users Not Found</p>`;
                        }

                        $('.employee_listing').html(html);
                        let designations = '<option value=""><option>';
                        if (response.data.branchDepartmentDesignations.length > 0) {
                            $.each(response.data.branchDepartmentDesignations, function(key,
                                value) {
                                designations += `<option value="${value.id}">
                                   ${value.name}  </option>`;
                            });
                        }else {
                            designations += '<option value=""><option>';
                        }

                        $("#designation_id").html(designations);

                    }
                },
                error: function(xhr, status, error) {
                    // console.error(xhr.responseText);
                }
            });
        })


        $(document).on('change', '#designation_id', function() {
            let designation_id = $(this).val();
            // let designation_id = $('select#designation_id option:selected').val();
            let department_id = new Array();
            let branch_id = new Array();
            //         let branchsd = $('select#company_branch_id option:selected').val();
            // console.log(branchsd);
            $("select#company_branch_id option:selected").each(function() {
                branch_id.push($(this).val());
            });
            $("select#department_id option:selected").each(function() {
                department_id.push($(this).val());
            });

            $.ajax({
                url: `{{ route('announcement.branch.department.designation.users') }}`,
                type: 'get',
                data: {
                    branchIds: branch_id,
                    departmentIds: department_id,
                    designationIds: designation_id,
                },
                success: function(response) {
                    if (response.status == true) {
                        let html = '';
                        console.log(response.data, 'checking');
                        if (response.data.length > 0) {
                            $.each(response.data, function(key, value) {
                                html += ` <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="assets/media/user.jpg" alt="">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
                                            ${value.user.name }</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">${value.user.email }</span>
                                    </div>
                                </div>`;

                            });
                        } else {
                            html += `<p>Users Not Found</p>`;
                        }
                        $('.employee_listing').html(html);

                    }
                },
                error: function(xhr, status, error) {
                    // console.error(xhr.responseText);
                }
            });
        })
    })


    $(".datetimepicker").each(function() {
        $(this).datetimepicker();
    });

    $(document).ready(function() {
        $("#create_announcement").validate({
            rules: {
                company_branch_id: {
                    required: true,
                },
            },
            messages: {
                company_branch_id: "Please enter old password",
            },
            submitHandler: function(form) {
                let data = new FormData($('form#create_announcement')[0]);
                $.ajax({
                    url: "{{ route('announcement.store') }}",
                    type: 'post',
                    data: data,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection
