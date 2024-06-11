<div class="tab-pane fade show active" id="basic_Details_tab">
    <!--begin::Wrapper-->
    <form id="basic_create_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $singleUserDetails->id ?? '' }}">
        <div class="row mb-6 m-0">
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
                        style="background-image: url({{ $singleUserDetails->profile_image ?? '/assets/media/user.jpg' }})">
                    </div>
                    <!--end::Preview existing avatar-->
                    <!--begin::Label-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar"
                        data-bs-original-title="Change avatar" data-kt-initialized="1">
                        <i class="fa fa-edit fs-7"><span class="path1"></span><span class="path2"></span></i>
                        <!--begin::Inputs-->
                        <input type="file" name="profile_image" accept=".png, .jpg, .jpeg">
                        <input type="hidden">
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
                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
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
                <input class="form-control" type="email" name="email" value="{{ $singleUserDetails->email ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Official Email *</label>
                <input class="form-control" type="email" name="official_email_id"
                    value="{{ $singleUserDetails->official_email_id ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Password</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Father's Name</label>
                <input class="form-control" type="text" name="father_name"
                    value="{{ $singleUserDetails->father_name ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Mother's Name</label>
                <input class="form-control" type="text" name="mother_name"
                    value="{{ $singleUserDetails->mother_name ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Blood Group *</label>
                <select class="form-control" name="blood_group">
                    <option value="">Select the Blood Group</option>
                    <option {{ $singleUserDetails->blood_group ?? old('blood_group') == 'A-' ? 'selected' : '' }}
                        value="A-">A-</option>
                    <option {{ $singleUserDetails->blood_group ?? old('blood_group') == 'A+' ? 'selected' : '' }}
                        value="A+">A+</option>
                    <option {{ $singleUserDetails->blood_group ?? old('blood_group') == 'B+' ? 'selected' : '' }}
                        value="B+">B+</option>
                    <option {{ $singleUserDetails->blood_group ?? old('blood_group') == 'B-' ? 'selected' : '' }}
                        value="B-">B-</option>
                    <option {{ $singleUserDetails->blood_group ?? old('blood_group') == 'O+' ? 'selected' : '' }}
                        value="O+">O+</option>
                    <option {{ $singleUserDetails->blood_group ?? old('blood_group') == 'O-' ? 'selected' : '' }}
                        value="O-">O</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Gender *</label>
                <select class="form-control" name="gender">
                    <option value="">Select the Gender</option>
                    <option {{ $singleUserDetails->gender ?? old('gender') == 'M' ? 'selected' : '' }} value="M">
                        Male</option>
                    <option {{ $singleUserDetails->gender ?? old('gender') == 'F' ? 'selected' : '' }} value="F">
                        Female</option>
                    <option {{ $singleUserDetails->gender ?? old('gender') == 'O' ? 'selected' : '' }}value="O">Other
                    </option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Marital Status *</label>
                <select class="form-control" name="marital_status">
                    <option value="">Select the Marital Status</option>
                    <option {{ $singleUserDetails->marital_status ?? old('marital_status') == 'M' ? 'selected' : '' }}
                        value="M">Married</option>
                    <option {{ $singleUserDetails->marital_status ?? old('marital_status') == 'S' ? 'selected' : '' }}
                        value="S">Single</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Emp Status *</label>
                <select class="form-control" name="employee_status_id">
                    <option value="">Select The Employee Status</option>
                    @forelse ($allEmployeeStatus as $employeeStatus)
                        <option
                            {{ $singleUserDetails->employee_status_id ?? old('employee_status_id') == $employeeStatus->id ? 'selected' : '' }}
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
                    value="{{ $singleUserDetails->date_of_birth ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Date of Joining *</label>
                <input class="form-control" type="date" name="joining_date"
                    value="{{ $singleUserDetails->joining_date ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Phone Number *</label>
                <input class="form-control" type="number" name="phone"
                    value="{{ $singleUserDetails->phone ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Employee Id *</label>
                <input class="form-control" type="text" name="emp_id"
                    value="{{ $singleUserDetails->emp_id ?? '' }}">
            </div>
        </div>
        <button class="btn btn-primary" id="submit">Save &
            Continue</button>
    </form>
    <button onclick="show_next_tab('advance_details_tab')"
        class="btn btn-primary float-right {{ $buttonDisabled }}">Next <i class="fa fa-arrow-right"></i> </button>
    <!--end::Wrapper-->
</div>
<script>
    /** Basic Details created Ajax*/
    jQuery(document).ready(function() {
        jQuery("#basic_create_form").validate({
            rules: {
                name: "required",
                email: "required",
                // password: "required",
                official_email_id: "required",
                blood_group: "required",
                gender: "required",
                marital_status: "required",
                employee_status_id: "required",
                date_of_birth: "required",
                joining_date: "required",
                phone: "required",
                // profile_image: "required",
            },
            messages: {
                name: "Please enter the Full Name",
                email: "Please enter the Email",
                // password: "Please enter the Password",
                official_email_id: "Please enter the Official Email",
                blood_group: "Please select the Blood Group",
                gender: "Please select the Gender",
                marital_status: "Please select the Marital Status",
                employee_status_id: "Please select the Employee Status",
                date_of_birth: "Please fill the Date of Birth",
                joining_date: "Please fill the Joining Date",
                phone: "Please enter the Phone",
                // profile_image: "Please upload the profile images",
            },
            submitHandler: function(form) {
                createBasicDetails(form);
            }
        });
    });

    function createBasicDetails(form) {
        var basic_details_Data = new FormData(form);
        $.ajax({
            url: "{{ route('employee.store') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: basic_details_Data,
            success: function(response) {
                if (response.data.status == 'createData') {
                    location.href = '/employee/edit/' + response.data.id;
                    setTimeout(function() {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        jQuery('.nav-pills a[href="#advance_details_tab"]').tab(
                            'show');
                    },4000);
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    jQuery('.nav-pills a[href="#advance_details_tab"]').tab(
                        'show');
                }
                // This variable is used on save all records button
                all_data_saved = true;
            },
            error: function(error_messages) {
                // This variable is used on save all records button
                all_data_saved = false;
                let errors = error_messages.responseJSON.error;
                for (var error_key in errors) {
                    $(document).find('[name=' + error_key + ']').after(
                        '<span class="' + error_key +
                        '_error text text-danger">' + errors[
                            error_key] + '</span>');
                    setTimeout(function() {
                        jQuery("." + error_key + "_error").remove();
                    }, 5000);
                }
            }
        });
    }
</script>
