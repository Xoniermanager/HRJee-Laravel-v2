<div class="modal-dialog modal-dialog-centered modal-lg">
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header">
            <!--begin::Close-->
            <h2>Assign Announcement</h2>
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
            <form id="assign_announcement_form" class="card-body">
                @csrf
                <div class="row"> 
                <input type="hidden" name="id" id="id">
                <div class="col-md-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="required">Assign Announcement </label>
                            <div class="d-flex align-items-center mt-5">
                                <!--begin::Option-->
                                <label
                                    class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                    <input class="form-check-input" name="assign_announcement" type="radio"
                                        onchange="assignAnnouncement(1)" value="1" id="now">
                                    <span class="fw-semibold ps-2 fs-6">
                                        Now
                                    </span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label
                                    class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                    <input class="form-check-input" name="assign_announcement" type="radio"
                                        onchange="assignAnnouncement(0)" value="0" checked id="later">
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
                                    value="{{ old('notification_schedule_time') }}" id="time">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <div class="col-md-2 mt-3 p-0">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox"
                                                name="all_company_branch" onchange="get_checked_value('company_branch')"
                                                id="company_branches_checkbox" value="0"
                                                {{ old('all_company_branch') == '1' ? 'checked' : '' }}>
                                        </label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <label for="">Company Branches *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Company Branch"
                                            data-allow-clear="true" multiple="multiple" name="company_branch_id[]"
                                            id="company_branch" onchange="get_all_user()">
                                            @foreach ($allCompanyBranchesDetails as $compayBranches)
                                                <option value="{{ $compayBranches->id }}"
                                                    @if (old('company_branch_id')) {{ in_array($departmentsDetails->id, old('company_branch_id')) ? 'selected' : '' }} @endif>
                                                    {{ $compayBranches->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company_branch_id'))
                                            <div class="text-danger">
                                                {{ $errors->first('company_branch_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <div class="col-md-2 mt-3 p-0">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox" name="all_department"
                                                onchange="get_checked_value('department')" id="department_checkbox"
                                                value="0" {{ old('all_department') == '1' ? 'checked' : '' }}>
                                        </label>
                                    </div>
                                    <div class="col-md-10 form-group">
                                        <label for="">Department *</label>
                                        <select class="bg-white form-select form-select-solid" data-control="select2"
                                            data-close-on-select="false" data-placeholder="Select the Department"
                                            data-allow-clear="true" multiple="multiple" id="department_id"
                                            onchange="get_designation_by_department_id('','',true)"
                                            name="department_id[]">
                                            @foreach ($allDepartmentsDetails as $departmentsDetails)
                                                <option value="{{ $departmentsDetails->id }}"
                                                    @if (old('department_id')) {{ in_array($departmentsDetails->id, old('department_id')) ? 'selected' : '' }} @endif>
                                                    {{ $departmentsDetails->name }}</option>
                                            @endforeach
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
                                    <div class="col-md-2 mt-3 p-0">
                                        <label class="form-check form-check-custom form-check-inline form-check-solid">
                                            <span class="fw-semibold ps-2 fs-6">
                                                All
                                            </span>
                                            <input class="form-check-input m-4" type="checkbox"
                                                name="all_designation" onchange="get_checked_value('designation')"
                                                id="designation_checkbox" value="0"
                                                {{ old('all_designation') == '1' ? 'checked' : '' }}>
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
                                            <div class="text-danger">
                                                {{ $errors->first('designation_id') }}
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
            </div>
            </form>
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
