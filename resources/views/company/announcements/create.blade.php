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
                        <input type="text" class="form-control" name="title" placeholder="announcement title"
                            id="title">
                        <label class="field_error title_error"> </label>

                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label required">Start Date</label>
                        <input type="text" class="form-control  datetimepicker" name="start_date_time"
                            id="start_date_time" autocomplete="off" placeholder="select date & time">
                        <label class="field_error start_date_time_error"> </label>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label">Expire At</label>
                        <input type="text" class="form-control  datetimepicker" name="expires_at"autocomplete="off"
                            placeholder="select date & time">
                        <label class="field_error expires_at_error"> </label>

                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label required">Status</label>
                        <select class="bg-white form-select form-select-solid " data-control="select2"
                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                            data-allow-clear="true" name="status" style="width:100%" id="status">
                            <option value=""></option>
                            @foreach (transLang('action_status') as $key => $status)
                                <option value="{{ $key }}">
                                    {{ $status }}</option>
                            @endforeach
                        </select>
                        <label class="field_error status_error"> </label>

                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        <label class="field_error image_error"> </label>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-form-label required">Description</label>
                        <textarea rows="1" class="form-control  " name='description' placeholder="description" id="description">
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
                                            <input class="form-check-input m-4" type="checkbox" name="all_branch"
                                                onchange="get_checked_value('company_branch')"
                                                id="company_branches_checkbox">

                                        </label>
                                    </div>

                                    <div
                                        class="col-md-10 form-group {{ !empty(auth()->guard('admin')->user()->company_id) && empty(auth()->guard('admin')->user()->branch_id) ? '' : 'd-none' }}">
                                        <label class="required">Company Branches </label>

                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple="multiple" name="branch_id[]"
                                            id="company_branch">
                                            @foreach ($branches as $key => $row)
                                                <option value="{{ $row->id }}">
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
                                            <input class="form-check-input m-4" type="checkbox" name="all_department"
                                                onchange="get_checked_value('department')" id="department_checkbox">
                                            {{-- onchange="get_checked_value('department')" id="department_checkbox" --}}
                                        </label>
                                    </div>

                                    <div class="col-md-10 form-group">
                                        <label class=" ">Department </label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple name="department_id[]" id="department_id"
                                            style="width:100%">
                                            @foreach ($departments as $key => $department)
                                                <option value="{{ $department->id }}">
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
                                            <input class="form-check-input m-4" type="checkbox" name="all_department"
                                                onchange="get_checked_value('designation')" id="designation_checkbox">
                                            {{-- onchange="get_checked_value('department')" id="department_checkbox" --}}
                                        </label>
                                    </div>

                                    <div class="col-md-10 form-group">
                                        <label class="">Designation </label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple name="designation_id[]"
                                            id="designation_id" style="width:100%">
                                            s
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
                                    @forelse ($branchUsers as $user)
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
                        onclick="addUpdateFormData('message_assign-anouncement_box','post','{{ route('announcement.store') }}','save-assign-anouncement-frm','','{{ route('announcement.index') }}','class','')">
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
        $('#company_branches_checkbox').on('change', function(event) {
            let branch_id = new Array();
            $("select#company_branch option:selected").each(function() {
                branch_id.push($(this).val());
            });
            var type = $(this).val(); // this gives me null
            getUsesByBranchIdAndType(type, branch_id);
        });


        $(document).on('change', '#company_branch', function() {
            let branch_id = new Array();
            $("select#company_branch option:selected").each(function() {
                branch_id.push($(this).val());
            });
            let type = $("#company_branches_checkbox").is(":checked");
            if (type == true) {
                type = 1;
            } else {
                type = 0;
            }
            getUsesByBranchIdAndType(type, branch_id);
        })
        $(document).on('change', '#department_id', function() {
            let branch_id = new Array();
            let department_id = new Array();
            $("select#company_branch option:selected").each(function() {
                branch_id.push($(this).val());
            });

            $("select#department_id option:selected").each(function() {
                department_id.push($(this).val());
            });
            let branch_type = 0;
            let type = $("#company_branches_checkbox").is(":checked");
            if (type == true) {
                branch_type = 1;
            }

            let department_type = 0;
            let typeCheck = $("#department_checkbox").is(":checked");
            if (typeCheck == true) {
                department_type = 1;
            }

            getUsesByBranchAndDepartmentIdAndType(branch_type, branch_id, department_type,
                department_id);

        })
        $(document).on('change', '#designation_id', function() {
            let branch_id = new Array();
            let department_id = new Array();
            let designationIds = new Array();
            $("select#company_branch option:selected").each(function() {
                branch_id.push($(this).val());
            });

            $("select#department_id option:selected").each(function() {
                department_id.push($(this).val());
            });
            $("select#designation_id option:selected").each(function() {
                designationIds.push($(this).val());
            });
            let branch_type = 0;
            let type = $("#company_branches_checkbox").is(":checked");
            if (type == true) {
                branch_type = 1;
            }

            let department_type = 0;
            let typeCheck = $("#department_checkbox").is(":checked");
            if (typeCheck == true) {
                department_type = 1;
            }
            let designation_type = 0;
            let typeCheckDesignation = $("#designation_checkbox").is(":checked");
            if (typeCheckDesignation == true) {
                designation_type = 1;
            }

            getUsesByBranchAndDepartmentDesignationIdAndType(branch_type, branch_id, department_type,
                department_id, designation_type, designationIds);

        })


    })

    function getUsesByBranchIdAndType(type, ids) {
        let data = {
            ids: ids,
            type: type
        };
        $.ajax({
            url: `{{ route('announcement.branch.users') }}`,
            type: 'get',
            data: data,
            success: function(response) {
                if (response.status == true) {
                    let html = '';
                    console.log(response.data);
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
                    let departments = '';
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
    }

    function getUsesByBranchAndDepartmentIdAndType(branch_type, branchIds, department_type, departmentIds) {
        let data = {
            branch_type: branch_type,
            branchIds: branchIds,
            department_type: department_type,
            departmentIds: departmentIds
        };
        $.ajax({
            url: `{{ route('announcement.branch.department.users') }}`,
            type: 'get',
            data: data,
            success: function(response) {
                if (response.status == true) {
                    let html = '';
                    console.log(response.data);
                    if (response.data.branchDepartmentUsers.length > 0) {
                        $('.employee_listing').html(html);
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
                        html += `<p>Users not found</p>`;
                    }

                    $('.employee_listing').html(html);
                    let designations = '';
                    $.each(response.data.branchDepartmentDesignations, function(key, value) {
                        designations += `<option value="${value.id}">  ${value.name}  </option>`;
                    });

                    $("#designation_id").html(designations);

                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function getUsesByBranchAndDepartmentDesignationIdAndType(branch_type, branchIds, department_type, departmentIds,
        designation_type, designationids) {
        let data = {
            branch_type: branch_type,
            branchIds: branchIds,
            designation_type: designation_type,
            designationIds: designationids,
            department_type: department_type,
            departmentIds: departmentIds
        };
        $.ajax({
            url: `{{ route('announcement.branch.department.designation.users') }}`,
            type: 'get',
            data: data,
            success: function(response) {
                if (response.status == true) {
                    let html = '';
                    if (response.data.length > 0) {
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
                    } else {
                        html += `<p>Users not found</p>`;
                    }
                    $('.employee_listing').html(html);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    $(".datetimepicker").each(function() {
        $(this).datetimepicker();
    });
</script>
@endsection
