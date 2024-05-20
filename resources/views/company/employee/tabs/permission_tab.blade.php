<div class="tab-pane fade" id="permission_tab">
    <!--begin::Wrapper-->
    <form id="user_details_form">
        @csrf
        <div class="row">
            <input type="hidden" name="user_id" class="id">
            <div class="col-md-4 form-group">
                <label for="">Employment Type *</label>
                <select class="form-control" name="employee_type_id">
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
                <select class="form-control" id="designation_id" name="designation_id">
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Branch *</label>
                <select class="form-control" name="company_branch_id">
                    <option value="">Please Select the Branch</option>
                    @forelse ($allBranches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @empty
                        <option value="">No Branches Found</option>
                    @endforelse
                </select>

            </div>
            <div class="col-md-4 form-group">
                <label for="">Role</label>
                <select class="form-control" name="role_id">
                    <option value="">Select the roles</option>
                    @forelse ($allRoles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @empty
                        <option value="">No Roles Found</option>
                    @endforelse
                </select>
            </div>

            <div class="col-md-4 form-group">
                <div class="k-w-300">
                    <label for="qualification">Highest Qualification*</label>
                    <select id="Qualification" class="form-control" name="qualification_id"> </select>
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
                    <select id="Skill" class="form-control" name="skill_id[]"></select>
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
                <select class="form-control" id="shift" name="shift_id">
                    <option value="">Please Select the Shift</option>
                    @forelse ($allShifts as $shift)
                        <option value="{{ $shift->id }}" data-time="{{ $shift->start_time }}">{{ $shift->name }}
                        </option>
                    @empty
                        <option value="">No Shift Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Shirt Start Time</label>
                <input class="form-control" type="time" name="start_time" id="start_time" readonly>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Offer ID</label>
                <input class="form-control" type="text" name="offer_letter_id">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Official Phone Number</label>
                <input class="form-control" type="text" name="official_mobile_no">
            </div>
            <div class="col-md-6 form-group">
                <h5>Work from Home</h5>
                <div class="d-flex align-items-center mt-3">
                    <!--begin::Option-->
                    <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                        <input class="form-check-input" name="work_from_office" type="radio" value="1" checked>
                        <span class="fw-semibold ps-2 fs-6">
                            Yes
                        </span>
                    </label>
                    <!--end::Option-->

                    <!--begin::Option-->
                    <label class="form-check form-check-custom form-check-inline form-check-solid is-valid">
                        <input class="form-check-input" name="work_from_office" type="radio" value="0">
                        <span class="fw-semibold ps-2 fs-6">
                            No
                        </span>
                    </label>
                    <!--end::Option-->
                </div>
            </div>
        </div>
        <button class="btn btn-primary">Save & Continue</button>
    </form>

    <button onclick="show_next_tab('past_work_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>

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
        height: 47px !important;
    }
</style>
<script>
    jQuery('#shift').change(function() {
        var startTime = $(this).find('option:selected').data('time');
        $('#start_time').val(startTime);
    });

    /** Qualification Details created Ajax*/
    jQuery.noConflict();
    jQuery("#user_details_form").validate({
        rules: {
            'employee_type_id': 'required',
            'department_id': 'required',
            'designation_id': 'required',
            'company_branch_id': 'required',
            'role_id': 'required',
            'qualification_id': 'required',
            'skill_id[]': 'required',
            'shift_id': 'required',
        },
        messages: {
            'employee_type_id': 'Please Select The Employee type',
            'department_id': 'Please Select the Department',
            'designation_id': 'Please Select the Designation',
            'company_branch_id': 'Please Select the Branch',
            'role_id': 'Please Select the Roles',
            'qualification_id': 'Please select the qualification',
            'skill_id[]': 'Please select the skill',
            'shift_id': 'Please Select the Shift',

        },
        submitHandler: function(form) {
            var users_details_data = $(form).serialize();
            $.ajax({
                url: "{{ route('employee.users.details') }}",
                type: 'POST',
                data: users_details_data,
                success: function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    jQuery('.nav-pills a[href="#family_details_tab"]').tab('show');
                },
                error: function(error_messages) {
                    let errors = error_messages.responseJSON.error;
                    for (var error_key in errors) {
                        $(document).find('[name=' + error_key + ']').after(
                            '<span class="' + error_key +
                            '_error text text-danger">' + errors[
                                error_key] + '</span>');
                        setTimeout(function() {
                            jQuery("." + error_key + "_error").remove();
                        }, 3000);
                    }
                }
            });
        }
    });
</script>
