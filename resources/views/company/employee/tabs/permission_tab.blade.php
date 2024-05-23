<div class="tab-pane fade" id="permission_tab">
    <!--begin::Wrapper-->
    <form id="user_details_form">
        @csrf
        <input type="hidden" id="highest_qualification_id" value="{{$userDetails->qualification_id}}">
        <p id="get_skills_id">{{ $userSkills ?? '' }}</p>
        <div class="row">
            <input type="hidden" name="user_id" class="id"
                value="{{ $userDetails->user_id ?? (Request::segment(3) ?? '') }}">
            <div class="col-md-4 form-group">
                <label for="">Employment Type *</label>
                <select class="form-control" name="employee_type_id">
                    <option value="">Select The Employee Type</option>
                    @forelse ($allEmployeeType as $employeeType)
                        <option {{ $userDetails->employee_type_id ?? old('employee_type_id') ? 'selected' : '' }}
                            value="{{ $employeeType->id }}">
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
                        <option {{ $userDetails->department_id ?? old('department_id') ? 'selected' : '' }}
                            value="{{ $departmentDetails->id }}">
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
                        <option {{ $userDetails->company_branch_id ?? old('company_branch_id') ? 'selected' : '' }}
                            value="{{ $branch->id }}">{{ $branch->name }}</option>
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
                        <option {{ $userDetails->role_id ?? old('role_id') ? 'selected' : '' }}
                            value="{{ $role->id }}">{{ $role->name }}</option>
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
                        <option {{ $userDetails->shift_id ?? old('shift_id') ? 'selected' : '' }}
                            value="{{ $shift->id }}" data-time="{{ $shift->start_time }}">{{ $shift->name }}
                        </option>
                    @empty
                        <option value="">No Shift Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Shirt Start Time</label>
                <input class="form-control" type="time" name="start_time" id="start_time" readonly
                    value="{{ $userDetails->start_time ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Offer ID</label>
                <input class="form-control" type="text" name="offer_letter_id"
                    value="{{ $userDetails->offer_letter_id ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Official Phone Number</label>
                <input class="form-control" type="text" name="official_mobile_no"
                    value="{{ $userDetails->official_mobile_no ?? '' }}">
            </div>
            <div class="col-md-6 form-group">
                <h5>Work from Home</h5>
                <div class="d-flex align-items-center mt-3">
                    <!--begin::Option-->
                    <label class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                        <input class="form-check-input" name="work_from_office" type="radio" value="1"
                            {{ $userDetails->official_mobile_no ?? '' }}>
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
    </form>
    <form id="add_language">
        @csrf
        <div class="col-md-4 form-group">
            <div class="k-w-300">
                <label for="language">Language</label>
                <input id="languageID" class="form-control" name="name" />
                <span class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-4 form-group">
            <label class="mt-3"><button class="btn btn-primary btn-sm mt-5">
                    <i class="fa fa-plus"></i></button>
            </label>
                
        </div>
    </form>
    <div class="container">
        <div id="language_list">
            @foreach($languages as $language)
            <div class="row" id="language_{{ $language->id }}" style="min-height:37px">
                <div class="col-md-2">{{ $language->name }}</div>
                <input class="language" value="{{ $language->id }}" type="hidden" name="language[{{ $language->id }}][language_id]">
                <div class="col-md-9">
                    <div class="chkbox"> <label>Read</label>
                        <select name="language[{{ $language->id }}][read]">
                            <option>Beginner</option>
                            <option>Intermediate</option>
                            <option>Excellent</option>
                        </select>
                        <label>write</label>
                        <select name="language[{{ $language->id }}][write]">
                            <option>Beginner</option>
                            <option>Intermediate</option>
                            <option>Excellent</option>
                        </select>
                        <label>speak</label>
                        <select name="language[{{ $language->id }}][speak]">
                            <option>Beginner</option>
                            <option>Intermediate</option>
                            <option>Excellent</option>
                        </select>
                    </div>
                </div>
                @if(!in_array($language->name,['Hindi','English']))
                <div class="col-md-1 text-center">
                    <button class="btn btn-danger btn-sm" onclick="remove_language({{ $language->id }})"> 
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
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

    .chkbox label {
        padding: 5px;
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
    .text-danger
    {
        color: #ff0000  !important;
        font-weight: 700
        }
</style>
<script>
    jQuery(document).ready(function() {
        var departmentId = '{{ $userDetails->department_id ?? '' }}';
        var designationId = '{{ $userDetails->designation_id ?? '' }}';
        get_all_designation_using_department_id(departmentId, designationId);
    });

    /** get all Designation Using Department Id*/
    jQuery('#department_id').on('change', function() {
        var department_id = $(this).val();
        get_all_designation_using_department_id(department_id);
    });

    function get_all_designation_using_department_id(department_id, designationId = '') {
        if (department_id) {
            $.ajax({
                url: "{{ route('get.all.designation') }}",
                type: "GET",
                dataType: "json",
                data: {
                    'department_id': department_id
                },
                success: function(response) {
                    var select = $('#designation_id');
                    select.empty();
                    if (response.status == true) {
                        $('#designation_id').append(
                            '<option>Select The Designation</option>');
                        $.each(response.data, function(key, value) {
                            select.append('<option ' + ((designationId == value.id) ? "selected" :
                                "") + ' value=' + value.id + '>' + value.name + '</option>');
                        });
                    } else {
                        select.append('<option value="">' + response.error +
                            '</option>');
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something Went Wrong!! Please try Again"
                    });
                    return false;
                }
            });
        } else {
            $('#designation_id').empty();
        }

    }
    /** end get all Designation Using Department Id*/

    jQuery('#shift').change(function() {
        var startTime = $(this).find('option:selected').data('time');
        $('#start_time').val(startTime);
    });

    jQuery("#languageID").keyup(function(){
        $('.text-danger').hide(); 
});

    /** Qualification Details created Ajax*/
    jQuery(document).ready(function() {
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
                createPermissionDetails(form);
            }
        });
    });

    function createPermissionDetails(form) {
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
                // This variable is used on save all records button
                all_data_saved = true;
            },
            error: function(error_messages) {
                // This variable is used on save all records button
                all_data_saved = false;
                jQuery('.nav-pills a[href="#permission_tab"]').tab('show');
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
</script>

<script>

    jQuery.noConflict();
    jQuery(document).ready(function($) {
        jQuery("#add_language").validate({
            rules: {
                name: "required",
                department_id: "required"
            },
            messages: {
                name: "Please enter language",
            },
            submitHandler: function(form) {
               let languages =  [];
               
                jQuery('.language').each(function(ele,value){
                    languages.push(jQuery(value).val());
                });
                console.log("languages : " + languages);
                let language_params = $(form).serialize() + "&" + $.param({"languages":languages});
                $.ajax({
                    url: "{{ route('language.create') }}",
                    type: 'POST',
                    data: language_params,
                    success: function(response) {
                        console.log(response.data);
                        jQuery('#add_designation').modal('hide');

                        let exists = jQuery("#language_"+response.language_id).html();
                        if(exists)
                        {
                        $('.text-danger').text('The language is already added!').show();  
                        }
                        else
                        {
                            $('.text-danger').hide(); 
                            $('#language_list').append(response.data);
                        }                        

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
    });

    function remove_language(language_id)
    {
        jQuery("#language_"+language_id).remove();
    }
</script>
