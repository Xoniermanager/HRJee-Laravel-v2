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
                <div class="col-md-4">
                    <div class="mb-3 h-100">
                        <div class="row card-body">

                            <div class="form-group">
                                <label class="required">Announcement</label>
                                <select class="form-control select2  " name="announcement_id" id="announcement_id"
                                    style="width:100%">
                                    <option value=""></option>
                                    @foreach ($announcements as $key => $row)
                                        <option value="{{ $row->id }}"
                                            {{ old('announcement_id', $row->id) == $announcement->id ? 'selected' : '' }}>
                                            {{ $row->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="field_error announcement_id_error"> </label>

                            <div class="form-group">
                                <label class=" ">Title </label>
                                <input class="form-control" name="title" type="text" readonly
                                    value="{{ $announcement->title }}" id='assign_title'>

                            </div>
                            <div class="form-group">
                                <label class=" ">Expiry Date </label>
                                <input class="form-control datetimepicker" name="start_date_time"
                                    value="{{ $announcement->start_date_time }}" type="text" id='expires_at'
                                    readonly>
                            </div>

                            <div class="form-group">
                                <label class=" ">Description </label>
                                <textarea type="text" class="form-control" readonly name="description" id='assign_description'>{{ $announcement->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="h-100">
                        <div class="row card-body">
                            <div class="form-group">
                                <label class="required">Company Branches </label>
                                <select class="form-control select2  " multiple name="company_branch_id[]"
                                    id="company_branch_id" style="width:100%">
                                    <option value=""></option>
                                    @foreach ($branches as $key => $row)
                                        <option value="{{ $row->id }}"
                                            {{ in_array($row->id, $branch_id) ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="field_error company_branch_id_error"> </label>

                            <div class="form-group">
                                <label class=" ">Department </label>
                                <select class="form-control select2  " multiple name="department_id[]"
                                    id="department_id" style="width:100%">
                                    <option value=""></option>
                                    @foreach ($departments as $key => $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id', $department) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="">Designation </label>
                                <select class="form-control select2  " multiple name="designation_id[]"
                                    id="designation_id" style="width:100%">
                                    <option value=""></option>
                                    {{-- @foreach ($designations as $key => $designation)
                                        <option value="{{ $designation->id }}"
                                            {{ old('designation_id', $designation) == $designation->id ? 'selected' : '' }}>
                                            {{ $designation->name }}
                                        </option>
                                    @endforeach --}}
                                </select>
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
                                @forelse ($branchUsers as $user)
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="symbol symbol-45px me-5">
                                            <img src="assets/media/user.jpg" alt="">
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
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

                {{-- <span class="">
                    <a href="#" class="btn btn-primary mt-5">Save</a>
                </span> --}}
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary px-5 radius-30 save-assign-anouncement-frm"
                        onclick="addUpdateFormData('message_assign-anouncement_box','post','{{ route('announcement.assign.save') }}','save-assign-anouncement-frm','','{{ route('announcement.index') }}','class','')">
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
    $(document).on('change', '#announcement_id', function() {
        let id = $(this).val();
        $.ajax({
            url: `{{ route('announcement.details') }}` + '/' + id,
            type: 'get',
            processData: false,
            contentType: false,
            contentType: 'json',
            success: function(response) {
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
        let id = $(this).val();
        console.log(id);
        $.ajax({
            url: `{{ route('announcement.branch.users') }}`,
            type: 'get',
            data: {
                ids: id
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
                        html += `<p>not found</p>`;
                    }

                    $('.employee_listing').html(html);
                    let departments = '<option value=""><option>';
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
                        $.each(response.data.branchDepartmentUsers, function(key, value) {
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

                    $.each(response.data.branchDepartmentDesignations, function(key, value) {
                        designations += `<option value="${value.id}">
                         ${value.name}  </option>`;
                    });

                    $("#designation_id").html(designations);

                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    })


    $(document).on('change', '#designation_id', function() {
        let department_id = $(this).val();
        // let designation_id = $('select#designation_id option:selected').val();
        let designation_id = new Array();
        let branch_id = new Array();
        //         let branchsd = $('select#company_branch_id option:selected').val();
        // console.log(branchsd);
        $("select#company_branch_id option:selected").each(function() {
            branch_id.push($(this).val());
        });
        $("select#designation_id option:selected").each(function() {
            designation_id.push($(this).val());
        });
        $.ajax({
            url: `{{ route('announcement.branch.department.designation.users') }}`,
            type: 'get',
            data: {
                branchIds: branch_id,
                designationIds: designation_id,
                departmentIds: department_id,
            },
            contentType: 'json',
            success: function(response) {
                if (response.status == true) {
                    let html = '';
                    $('.employee_listing').html(html);
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
                    $('.employee_listing').html(html);

                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    })

    $('.select2').select2({
        placeholder: "select",
        allowClear: true
    });
    $(".datetimepicker").each(function() {
        $(this).datetimepicker();
    });
    $(document).on('click', '#', function() {
        alert('test');
    })
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
