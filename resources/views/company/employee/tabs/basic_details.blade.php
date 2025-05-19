<div class="tab-pane fade show active" id="basic_Details_tab">
    <!--begin::Wrapper-->
    <form id="basic_create_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $singleUserDetails->id ?? '' }}">
        <input type="hidden" name="user_details_id" value="{{ $singleUserDetails->details->id ?? '' }}">
        <input type="hidden" id="highest_qualification_id"
            value="{{ $singleUserDetails->details->qualification_id ?? '' }}">
        <p id="get_skills_id" style="display: none">{{ $userSkills ?? '' }}</p>
        <div class="row m-0 mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                Profile Photo
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <!--begin::Image input-->
                <div class="image-input image-input-outline" data-kt-image-input="true"
                    style="background-image: url('/assets/media/user.jpg')">
                    <!--begin::Preview existing avatar-->
                    <div class="image-input-wrapper w-125px h-125px"
                        style="background-image: url({{ $singleUserDetails->details->profile_image ?? '/assets/media/user.jpg' }})">
                    </div>
                    <!--end::Preview existing avatar-->
                    <!--begin::Label-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar"
                        data-bs-original-title="Change avatar" data-kt-initialized="1">
                        <i class="fa fa-edit fs-7"><span class="path1"></span><span class="path2"></span></i>
                        <!--begin::Inputs-->
                        <input type="file" name="profile_image" accept=".png, .jpg, .jpeg">
                        <!--end::Inputs-->
                    </label>
                    <!--end::Label-->
                    <!--begin::Cancel-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar"
                        data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                        <i class="fa fa-times fs-2"><span class="path1"></span><span class="path2"></span></i> </span>
                    <!--end::Cancel-->
                </div>
                <!--end::Image input-->
                <!--begin::Hint-->
                <div class="form-text">Allowed file types: png, jpg, jpeg.
                </div>
                <!--end::Hint-->
            </div>
            <!--end::Col-->
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Full Name *</label>
                <input class="form-control" type="text" name="name" value="{{ $singleUserDetails->name ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Email *</label>
                <input class="form-control" type="email" name="email" value="{{ $singleUserDetails->email ?? '' }}"
                    {{ isset($singleUserDetails->email) ? 'readonly' : '' }}>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Official Email *</label>
                <input class="form-control" type="email" name="official_email_id"
                    value="{{ $singleUserDetails->details->official_email_id ?? '' }}">
            </div>
            @if (!isset($singleUserDetails))
                <div class="col-md-4 form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="password" name="password">
                </div>
            @endif
            <div class="col-md-4 form-group">
                <label for="">Father's Name</label>
                <input class="form-control" type="text" name="father_name"
                    value="{{ $singleUserDetails->details->father_name ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Mother's Name</label>
                <input class="form-control" type="text" name="mother_name"
                    value="{{ $singleUserDetails->details->mother_name ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Blood Group *</label>
                <select class="form-control" name="blood_group">
                    <option value="">Select the Blood Group</option>
                    <option
                        {{ ($singleUserDetails->details->blood_group ?? old('blood_group')) == 'A-' ? 'selected' : '' }} value="A-">A-
                    </option>
                    <option
                        {{ ($singleUserDetails->details->blood_group ?? old('blood_group')) == 'A+' ? 'selected' : '' }} value="A+">A+
                    </option>
                    <option
                        {{ ($singleUserDetails->details->blood_group ?? old('blood_group')) == 'B+' ? 'selected' : '' }}  value="B+">B+
                    </option>
                    <option
                        {{ ($singleUserDetails->details->blood_group ?? old('blood_group')) == 'B-' ? 'selected' : '' }}  value="B-">B-
                    </option>
                    <option
                        {{ ($singleUserDetails->details->blood_group ?? old('blood_group')) == 'O+' ? 'selected' : '' }} value="O+">O+
                    </option>
                    <option
                        {{ ($singleUserDetails->details->blood_group ?? old('blood_group')) == 'O-' ? 'selected' : '' }} value="O-">O-
                    </option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Gender *</label>
                <select class="form-control" name="gender">
                    <option value="">Select the Gender</option>
                    <option {{ ($singleUserDetails->details->gender ?? old('gender')) == 'M' ? 'selected' : '' }} value="M">
                        Male</option>
                    <option {{ ($singleUserDetails->details->gender ?? old('gender')) == 'F' ? 'selected' : '' }} value="F">
                        Female</option>
                    <option
                        {{ ($singleUserDetails->details->gender ?? old('gender')) == 'O' ? 'selected' : '' }}value="O">
                        Other
                    </option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Marital Status *</label>
                <select class="form-control" name="marital_status">
                    <option value="">Select the Marital Status</option>
                    <option
                        {{ ($singleUserDetails->details->marital_status ?? old('marital_status')) == 'M' ? 'selected' : '' }}
                        value="M">Married</option>
                    <option
                        {{ ($singleUserDetails->details->marital_status ?? old('marital_status')) == 'S' ? 'selected' : '' }}
                        value="S">Single</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Emp Status *</label>
                <select class="form-control" name="employee_status_id">
                    <option value="">Select The Employee Status</option>
                    @forelse ($allEmployeeStatus as $employeeStatus)
                        <option
                            {{ ($singleUserDetails->details->employee_status_id ?? old('employee_status_id')) == $employeeStatus->id ? 'selected' : '' }}
                            value="{{ $employeeStatus->id }}">
                            {{ $employeeStatus->name }}</option>
                    @empty
                        <option value="">No Employee Status Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Date of Birth *</label>
                <input class="form-control" type="date" name="date_of_birth"
                    value="{{ $singleUserDetails->details->date_of_birth ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Date of Joining *</label>
                <input class="form-control" type="date" name="joining_date"
                    value="{{ $singleUserDetails->details->joining_date ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Phone Number *</label>
                <input class="form-control" type="number" name="phone"
                    value="{{ $singleUserDetails->details->phone ?? '' }}">
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
                <label for="">Employee Id *</label>
                <input class="form-control" type="text" name="emp_id"
                    value="{{ $singleUserDetails->details->emp_id ?? '' }}"
                    @if (isset($singleUserDetails->details->offer_letter_id)) disabled @endif>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Role*</label>
                <select class="form-control" name="role_id">
                    <option value="">Select Role</option>
                    @forelse ($allRoles as $role)
                        <option {{ ($singleUserDetails->role_id ?? 'old("role_id")') == $role->id ? 'selected' : '' }}
                            value="{{ $role->id }}">{{ $role->name }}</option>
                    @empty
                        <option value="">No Roles Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Employment Type *</label>
                <select class="form-control" name="employee_type_id">
                    <option value="">Select The Employee Type</option>
                    @forelse ($allEmployeeType as $employeeType)
                        <option
                            {{ ($singleUserDetails->details->employee_type_id ?? old('employee_type_id')) ? 'selected' : '' }}
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
                        <option value="{{ $departmentDetails->id }}"
                            {{ ($singleUserDetails->details->department_id ?? '') == $departmentDetails->id ? 'selected' : '' }}>
                            {{ $departmentDetails->name }}</option>
                    @empty
                        <option value="">No Department Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Designation *</label>
                <select class="form-control" id="designation_id" name="designation_id">
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Branch *</label>
                <select class="form-control" name="company_branch_id" id="company_branch_id">
                    <option value="">Please Select the Branch</option>
                    @forelse ($allBranches as $branch)
                        <option
                            {{ ($singleUserDetails->details->company_branch_id ?? old('company_branch_id')) == $branch->id ? 'selected' : '' }}
                            value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @empty
                        <option value="">No Branches Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4 form-group">
                <div>
                    <label>Manager IDs</label>
                    <select id="manager_id" class="form-control" data-control="select2" data-close-on-select="false"
                        data-placeholder="Select managers" data-allow-clear="true" multiple="multiple"
                        name="manager_id[]">
                    </select>
                </div>
            </div>
            {{-- <div class="col-md-4 form-group">
                <label for="">Shift *</label>
                <select class="form-control" id="shift" name="shift_id">
                    <option value="">Please Select the Shift</option>
                    @forelse ($allShifts as $shift)
                        <option
                            {{ ($singleUserDetails->details->shift_id ?? old('shift_id')) == $shift->id ? 'selected' : '' }}
                            value="{{ $shift->id }}" data-time="{{ $shift->start_time }}">{{ $shift->name }}
                        </option>
                    @empty
                        <option value="">No Shift Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Shirt Start Time</label>
                <input class="form-control" type="time" id="start_time" readonly
                    value="{{ $singleUserDetails->details->officeShift->start_time ?? '' }}">
            </div> --}}

             <!-- Shift Type Selector -->
            @if(isset($singleUserDetails))
                <div class="form-group col-md-4">
                    <label for="">Shift Type:</label>
                    <select id="shift_type_selector" class="form-control" name="shift_type">
                        <option {{ ($singleUserDetails->details->shift_type == 'single' ? 'selected' : '') }} value="single">Single
                            Shift (Whole Week)</option>
                        <option value="daily" {{ $singleUserDetails->details->shift_type == 'daily' ? 'selected' : '' }}>
                            Daily Shift
                            (Different Each Day)</option>
                    </select>
                </div>
            @else
             <div class="form-group col-md-4">
                <label for="">Shift Type:</label>
                <select id="shift_type_selector" class="form-control" name="shift_type">
                    <option value="single">Single
                        Shift (Whole Week)</option>
                    <option value="daily">Daily Shift (Different Each Day)</option>
                </select>
            </div>
            @endif
            <!-- Single Shift Selection -->
            <div id="single_shift_div" class="form-group col-md-4">
                <label for="">Office Timing:</label>
                <select name="office_shift_id[]" id="office_shift_id" class="form-control select2-multi" multiple>
                    <option value="">Select Shift</option>
                    @if (isset($allShifts))
                        @foreach ($allShifts as $shift)
                            <option value="{{ $shift->id }}" {{ in_array($shift->id, $userShifts) ? 'selected' : '' }}>
                                {{ ucfirst($shift->name) }} ({{ date('h:i A', strtotime($shift->start_time)) }} -
                                {{ date('h:i A', strtotime($shift->end_time)) }})
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <!-- Daily Shift Selection -->
            <div id="daily_shift_div" class="row" style="display:none;">
                <?php $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']; ?>
                @foreach ($weekdays as $day)
                    <div class="form-group col-md-4">
                        <label for=""><?= $day ?> Shift:</label>
                        <select name="office_shift_id[<?= $day ?>][]" class="form-control select2-multi" multiple>
                            <option value="">Select Shift</option>
                            <?php foreach ($allShifts as $shift): ?>
                            <option value="<?= $shift->id ?>"
                                <?= isset($userShifts[$day]) && in_array($shift->id, $userShifts[$day]) ? 'selected' : '' ?>>
                                <?= ucfirst($shift->name) ?>
                                (<?= date('h:i A', strtotime($shift->start_time)) ?> -
                                <?= date('h:i A', strtotime($shift->end_time)) ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4 form-group">
                <label for="">Offer ID *</label>
                <input class="form-control" type="text" name="offer_letter_id"
                    value="{{ $singleUserDetails->details->offer_letter_id ?? '' }}"
                    @if (isset($singleUserDetails->offer_letter_id)) disabled @endif>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Official Phone Number *</label>
                <input class="form-control" type="text" name="official_mobile_no"
                    value="{{ $singleUserDetails->details->official_mobile_no ?? '' }}">
            </div>
        </div>
        <div class="container">
            <div id="language_list">
                @if (count($userLanguages) > 0)
                    @include('company.employee.languages.user_language')
                @else
                    @include('company.employee.languages.create_language')
                @endif
            </div>
        </div>
        <button class="btn btn-primary" id="submit">Save & Continue</button>
    </form>
    <form id="add_language">
        @csrf
        <div class="row mt-4">
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
        </div>
    </form>
    @if (isset($singleUserDetails) && !empty($singleUserDetails))
        <button onclick="show_next_tab('advance_details_tab')" class="btn btn-primary float-right">Next <i
                class="fa fa-arrow-right"></i> </button>
    @else
        <button class="btn btn-primary float-right" id="submit">Save & Continue</button>
    @endif
</div>
<!-- Add to <head> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Add before </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function createBasicDetails(form) {
        var basic_details_Data = new FormData(form);
        $.ajax({
            url: "{{ route('employee.store') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: basic_details_Data,
            success: function(response) {
                if (response.data.status == "createdEmployee") {
                    location.href = '/company/employee/edit/' + response.data.id;
                    setTimeout(function() {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        jQuery('.nav-pills a[href="#advance_details_tab"]').tab('show');
                    }, 4000);
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    jQuery('.nav-pills a[href="#advance_details_tab"]').tab('show');
                }

                // This variable is used on save all records button
                all_data_saved = true;
            },
            error: function(error_messages) {
                // This variable is used on save all records button
                all_data_saved = false;

                let errors = error_messages.responseJSON.errors;
                for (var error_key in errors) {
                    $(document).find('[name=' + error_key + ']').after(
                        '<span class="' + error_key + '_error text text-danger">' + errors[error_key] +
                        '</span>'
                    );
                    setTimeout(function() {
                        jQuery("." + error_key + "_error").remove();
                    }, 8000);
                }
            }
        });
    }
</script>
<script>
    jQuery(document).ready(function() {
        // Initialize Select2
        $('.select2-multi').select2({
            width: '100%'
        });

        // Toggle shift sections based on selected type
        function toggleShiftSections() {
            var shiftType = $('#shift_type_selector').val();
            if (shiftType === 'single') {
                $('#single_shift_div').show().find('select').prop('disabled', false);
                $('#daily_shift_div').hide().find('select').prop('disabled', true);
            } else if (shiftType === 'daily') {
                $('#single_shift_div').hide().find('select').prop('disabled', true);
                $('#daily_shift_div').show().find('select').prop('disabled', false);
            }
        }

        // Initial toggle
        toggleShiftSections();

        // Change event for shift type
        $('#shift_type_selector').change(function() {
            toggleShiftSections();
        });

        var departmentId = '{{ $singleUserDetails->details->department_id ?? '' }}';
        const all_department_id = [departmentId];
        var designation_id = '{{ $singleUserDetails->details->designation_id ?? '' }}';
        get_all_designation_using_department_id(all_department_id, designation_id);
    });

    /** get all Designation Using Department Id*/
    jQuery('#department_id').on('change', function() {
        var department_id = $(this).val();
        const all_department_id = [department_id];
        get_all_designation_using_department_id(all_department_id);
    });

    function get_all_designation_using_department_id(all_department_id, designationId = '') {
        if (all_department_id) {
            $.ajax({
                url: "{{ route('get.all.designation') }}",
                type: "GET",
                dataType: "json",
                data: {
                    'department_id': all_department_id
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

    /** get all managers using branch Id*/
    jQuery('#company_branch_id').on('change', function() {
        var company_branch_id = $(this).val();
        const all_company_branch_id = [company_branch_id];
        getAllManagersUsingBranchId(all_company_branch_id);
    });

    function getAllManagersUsingBranchId(all_company_branch_id) {
        if (all_company_branch_id) {
            $.ajax({
                url: "{{ route('get.all.managers') }}",
                type: "GET",
                dataType: "json",
                data: {
                    'branch_id': all_company_branch_id
                },
                success: function(response) {
                    var select = $('#manager_id');
                    select.empty();
                    if (response.status == true) {
                        $('#manager_id').append(
                            '<option>Select The Manager</option>');
                        $.each(response.data, function(key, value) {
                            select.append('<option value=' + value.id + '>' + value.name +
                                '</option>');
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

    jQuery("#languageID").keyup(function() {
        $('.text-danger').hide();
    });

    jQuery.noConflict();
    jQuery(document).ready(function($) {
        jQuery("#add_language").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "Please enter language",
            },
            submitHandler: function(form) {
                let languages = [];
                jQuery('.language').each(function(ele, value) {
                    languages.push(jQuery(value).val());
                });
                let language_params = $(form).serialize() + "&" + $.param({
                    "languages": languages
                });
                $.ajax({
                    url: "{{ route('language.create') }}",
                    type: 'POST',
                    data: language_params,
                    success: function(response) {
                        let exists = jQuery("#language_" + response.language_id).html();
                        if (exists) {
                            $('.text-danger').text('The language is already added!')
                                .show();
                        } else {
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

    function remove_language(language_id) {
        jQuery("#language_" + language_id).remove();
    }
</script>
