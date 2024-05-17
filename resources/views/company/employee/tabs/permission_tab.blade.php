<div class="tab-pane fade" id="permission_tab">
    <!--begin::Wrapper-->
    <div class="row">
        <input type="hidden" name="company_id" class="id">
        <div class="col-md-4 form-group">
            <label for="">Employment Type *</label>
            <select class="form-control">
                <option value="">Select The Employee Type</option>
                @forelse ($allEmployeeType as $employeeType)
                    <option value="{{ $employeeType->id }}">
                        {{ $employeeType->name }}</option>
                @empty
                    <option value="">No Employee Type Found</option>
                @endforelse
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="">Department*</label>
            <select class="form-control" name="department_id" id="department_id">
                <option value="">Select The Department</option>
                @forelse ($alldepartmentDetails as $departmentDetails)
                    <option value="{{ $departmentDetails->id }}">
                        {{ $departmentDetails->name }}</option>
                @empty
                    <option value="">No Department Found</option>
                @endforelse
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="">Designation</label>
            <select class="form-control" id="designation_id">
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="">Branch *</label>
            <select class="form-control">
                <option value="">Select the Branch</option>
                <option value="">Noida</option>
                <option value="">Delhi</option>
            </select>

        </div>
        <div class="col-md-4 form-group">
            <label for="">Role</label>
            <select class="form-control">
                <option value="">Select the Role</option>
                <option value="">Account Executive</option>
                <option value="">HR Recruiter</option>
            </select>
        </div>

        <div class="col-md-4 form-group">
            <div class="k-w-300">
                <label for="qualification">Highest Qualification*</label>
                <input id="Qualification" class="form-control" />
            </div>
            <script id="noQualificationTemplate" type="text/x-kendo-tmpl">
                <div>
                    No data found. Do you want to add new item - '#: instance.filterInput.val() #' ?
                </div>
                <br />
                <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNewQualification('#: instance.element[0].id #', '#: instance.filterInput.val() #')">Add new item</button>
            </script>
        </div>
   
        <div class="col-md-4 form-group">
                <div>
                    <label>Skills (Multiselect)</label>
                    <input id="Skill" class="form-control" ></input>
                </div>
                <script id="noSkillTemplate" type="text/x-kendo-tmpl">
                    <div class="kd-nodata-wrapper">
                        # var value = instance.input.val(); #
                        # var id = instance.element[0].id; #
                        <div>
                            No data found. Do you want to add new item - '#: value #' ?
                        </div>
                        <br />
                        <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNewSkill('#: id #', '#: value #')" ontouchend="addNew('#: id #', '#: value #')">Add new item</button>
                    <div>
                </script>
        </div>
        <div class="col-md-4 form-group">
            <label for="">Shift</label>
            <select class="form-control">
                <option value="">Select the Shift</option>
                <option value="">10 to 6</option>
                <option value="">9:30 to 6:30</option>
                <option value="">02:00 to 10:00</option>
                <option value="">Angular</option>
                <option value="">UI/UX Design </option>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="">Shirt Start Time *</label>
            <input class="form-control" type="time" name="">
        </div>
        <div class="col-md-4 form-group">
            <label for="">Offer ID *</label>
            <input class="form-control" type="text" name="">
        </div>
        <div class="col-md-4 form-group">
            <label for="">Official Phone Number *</label>
            <input class="form-control" type="text" name="">
        </div>
        <div class="col-md-6 form-group">
            <h5>Work from Home</h5>
            <div class="d-flex align-items-center mt-3">
                <!--begin::Option-->
                <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                    <input class="form-check-input" name="communication[]" type="radio" value="1" checked>
                    <span class="fw-semibold ps-2 fs-6">
                        Yes
                    </span>
                </label>
                <!--end::Option-->

                <!--begin::Option-->
                <label class="form-check form-check-custom form-check-inline form-check-solid is-valid">
                    <input class="form-check-input" name="communication[]" type="radio" value="2">
                    <span class="fw-semibold ps-2 fs-6">
                        No
                    </span>
                </label>
                <!--end::Option-->
            </div>
        </div>
    </div>
    
    <button onclick="show_next_tab('past_work_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    {{-- <button onclick="save_data_show_next_tab('advance_details_tab')"
    class="btn btn-primary">Save & Continue</button> --}}
    <button onclick="show_next_tab('family_details_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
    <!--end::Wrapper-->
</div>

<style>
    .k-picker-solid {
        height: 47px;
    }

    .k-picker-solid {
        background-color: white !important;
    }

    .k-list-item.k-selected,
    .k-selected.k-list-optionlabel {
        color: #ffffff;
        background-color: #1642b3 !important;
    }
    .k-input:not(:-webkit-autofill) {
    animation-name: autoFillEnd;
    height: 47px!important;
}
</style>
