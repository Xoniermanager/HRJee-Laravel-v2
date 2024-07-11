@extends('layouts.company.main')
@section('content')
@section('title')
    Edit Announcement
@endsection

@php
    if ($editAnnouncementDetails->all_company_branch == 0) {
        $selectedDepartmentId = $editAnnouncementDetails->departments->pluck('id');
    }
    if ($editAnnouncementDetails->all_department == 0) {
        $selectedCompanyBranchId = $editAnnouncementDetails->companyBranches->pluck('id');
    }
    if ($editAnnouncementDetails->all_designation == 0) {
        $selectedDesignationId = $editAnnouncementDetails->designations->pluck('id');
    }
@endphp
<div class="card card-body col-md-12">
    <div class="mb-5 mb-xl-10">
        <div class="card-body">
            <form method="POST" action="{{ route('announcement.update', $editAnnouncementDetails->id) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="all_company_branch" value="0">
                <input type="hidden" name="all department" value="0">
                <input type="hidden" name="all_designation" value="0">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label class="col-form-label required">Title</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ $editAnnouncementDetails->title }}" placeholder="editAnnouncementDetails title"
                            id="title">
                        <label class="field_error title_error"> </label>

                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label required">Start Date</label>
                        <input class="form-control" name="start_date_time" type="datetime-local"
                            value="{{ $editAnnouncementDetails->start_date_time }}">
                        @if ($errors->has('start_date_time'))
                            <div class="text-danger">{{ $errors->first('start_date_time') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label required">End Date</label>
                        <input class="form-control" name="expires_at_time" type="datetime-local"
                            value="{{ $editAnnouncementDetails->expires_at_time }}">
                        @if ($errors->has('expires_at_time'))
                            <div class="text-danger">{{ $errors->first('expires_at_time') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">Image</label>
                        <input type="file" class="form-control" name="image">
                        @if ($errors->has('image'))
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group mb-4">
                        <label class="col-form-label required">Description </label>
                        <textarea id="editor" name="description" value="{{ old('description') }}">{{ $editAnnouncementDetails->description }}</textarea>
                        @if ($errors->has('description'))
                            <div class="text-danger">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group mb-4">
                        <div class="row h-75px">
                            <div class="col-md-6">
                                <label class="required">Assign Announcement </label>
                                <div class="d-flex align-items-center">
                                    <!--begin::Option-->
                                    <label
                                        class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                        <input class="form-check-input" name="assign_announcement" type="radio"
                                            onchange="assignAnnouncement(1)" value="1"
                                            {{ $editAnnouncementDetails->assign_announcement == 1 ? 'checked' : '' }}>
                                        <span class="fw-semibold ps-2 fs-6">
                                            Now
                                        </span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label
                                        class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                        <input class="form-check-input" name="assign_announcement" type="radio"
                                            onchange="assignAnnouncement(0)" value="0"
                                            {{ $editAnnouncementDetails->assign_announcement == 0 ? 'checked' : '' }}>
                                        <span class="fw-semibold ps-2 fs-6">
                                            later
                                        </span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="col-md-6 mb-2"> --}}
                                <div class="form-group notification_schedule_time mb-0">
                                    <label class="required">Schedule Date</label>
                                    <input class="form-control" name="notification_schedule_time" type="datetime-local"
                                        value="{{ $editAnnouncementDetails->notification_schedule_time }}"
                                        id="time">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox"
                                                name="all_company_branch" onchange="get_checked_value('company_branch')"
                                                id="company_branches_checkbox"
                                                {{ $editAnnouncementDetails->all_company_branch == 1 ? 'checked' : '' }}
                                                value="1">
                                        </label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <label for="">Company Branches *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple="multiple" name="company_branch_id[]"
                                            id="company_branch"
                                            {{ $editAnnouncementDetails->all_company_branch == 1 ? 'disabled' : '' }}
                                            onchange="get_all_user()">
                                            @if ($editAnnouncementDetails->all_company_branch == 0)
                                                @foreach ($allCompanyBranchesDetails as $compayBranches)
                                                    <option value="{{ $compayBranches->id }}"
                                                        {{ $selectedCompanyBranchId->contains($compayBranches->id) ? 'selected' : null }}>
                                                        {{ $compayBranches->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach ($allCompanyBranchesDetails as $compayBranches)
                                                    <option value="{{ $compayBranches->id }}">
                                                        {{ $compayBranches->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('company_branch_id'))
                                            <div class="text-danger">{{ $errors->first('company_branch_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox" name="all_department"
                                                onchange="get_checked_value('department')" id="department_checkbox"
                                                {{ $editAnnouncementDetails->all_department == 1 ? 'checked' : '' }}
                                                value="1">
                                        </label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <label for="">Department *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Department"
                                            data-allow-clear="true" multiple="multiple" id="department_id"
                                            onchange="get_designation_by_department_id('','',true)"
                                            name="department_id[]"
                                            {{ $editAnnouncementDetails->all_department == 1 ? 'disabled' : '' }}>
                                            @if ($editAnnouncementDetails->all_department == 0)
                                                @foreach ($allDepartmentsDetails as $departmentsDetails)
                                                    <option value="{{ $departmentsDetails->id }}"
                                                        {{ $selectedDepartmentId->contains($departmentsDetails->id) ? 'selected' : null }}>
                                                        {{ $departmentsDetails->name }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($allDepartmentsDetails as $departmentsDetails)
                                                    <option value="{{ $departmentsDetails->id }}">
                                                        {{ $departmentsDetails->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('department_id'))
                                            <div class="text-danger">{{ $errors->first('department_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox"
                                                name="all_designation" onchange="get_checked_value('designation')"
                                                id="designation_checkbox"
                                                {{ $editAnnouncementDetails->all_designation == 1 ? 'checked' : '' }}
                                                value="1">
                                        </label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <label for="">Designation *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select an designation"
                                            data-allow-clear="true" multiple="multiple" id="designation_id"
                                            name="designation_id[]" onchange="get_all_user()">
                                        </select>
                                        @if ($errors->has('designation_id'))
                                            <div class="text-danger">{{ $errors->first('designation_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="user_listing">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var check_condition = {{ $editAnnouncementDetails->all_department }}
        var check_all_company_branch = {{ $editAnnouncementDetails->all_company_branch }}
        var check_all_designaion = {{ $editAnnouncementDetails->all_designation }}
        var check_assign_announcement = {{ $editAnnouncementDetails->assign_announcement }}
        if (check_condition == 0) {
            get_designation_by_department_id({{ $selectedDesignationId ?? '' }});
        }
        if (check_all_company_branch == 1) {
            get_all_user(true, '', '');
        }
        if (check_all_designaion == 1) {
            get_all_user('', true, '');
        }
        if (check_condition == 1) {
            get_all_user('', '', true);
        }
        if (check_assign_announcement == 0) {
            assignAnnouncement(0);
        } else {
            assignAnnouncement(1);
        }
        get_all_user();
    });
</script>
@endsection
