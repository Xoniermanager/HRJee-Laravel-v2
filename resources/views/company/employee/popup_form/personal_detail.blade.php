<!--begin::Modal dialog-->
<div class="modal-dialog mw-600px">
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header pb-0">
            <!--begin::Close-->
            <h3 class="fw-bold m-0"> Personal Details </h3>
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                            transform="rotate(-45 6 17.3137)" fill="currentColor" />
                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Close-->
        </div>
        <!--begin::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body scroll-y p-4">
            <div class="card-body">
                <form id="basic_create_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="user_details_id" id="user_details_id">
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
                                <div class="image-input-wrapper w-125px h-125px" id="profile_picture">
                                </div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                    aria-label="Change avatar" data-bs-original-title="Change avatar"
                                    data-kt-initialized="1">
                                    <i class="fa fa-edit fs-7"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="profile_image" accept=".png, .jpg, .jpeg">
                                    <input type="hidden">
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                    aria-label="Cancel avatar" data-bs-original-title="Cancel avatar"
                                    data-kt-initialized="1">
                                    <i class="fa fa-times fs-2"><span class="path1"></span><span
                                            class="path2"></span></i> </span>
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
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" id="name">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Email *</label>
                            <input class="form-control" type="email" name="email" id="email" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Official Email *</label>
                            <input class="form-control" type="email" name="official_email_id"
                                value="{{ old('official_email_id') }}" id="official_email_id">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Password</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Father's Name</label>
                            <input class="form-control" type="text" name="father_name"
                                value="{{ old('official_email_id') }}" id="official_email_id">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Mother's Name</label>
                            <input class="form-control" type="text" name="mother_name" value="{{ old('mother_name') }}"
                                id="mother_name">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Blood Group *</label>
                            <select class="form-control" name="blood_group" id="edit_blood_group">
                                <option value="">Select the Blood Group</option>
                                <option {{ old('blood_group')=='A-' ? 'selected' : '' }} value="A-">A-
                                </option>
                                <option {{ old('blood_group')=='A+' ? 'selected' : '' }} value="A+">A+
                                </option>
                                <option {{ old('blood_group')=='B+' ? 'selected' : '' }} value="B+">B+
                                </option>
                                <option {{ old('blood_group')=='B-' ? 'selected' : '' }} value="B-">B-
                                </option>
                                <option {{ old('blood_group')=='O+' ? 'selected' : '' }} value="O+">O+
                                </option>
                                <option {{ old('blood_group')=='O-' ? 'selected' : '' }} value="O-">O
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Gender *</label>
                            <select class="form-control" name="gender" id="edit_gender">
                                <option {{ old('gender')=='M' ? 'selected' : '' }} value="M">
                                    Male</option>
                                <option {{ old('gender')=='F' ? 'selected' : '' }} value="F">
                                    Female</option>
                                <option {{ old('gender')=='O' ? 'selected' : '' }} value="O">
                                    Other
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Marital Status *</label>
                            <select class="form-control" name="marital_status" id="edit_marital_status">
                                <option value="">Select the Marital Status</option>
                                <option {{ old('marital_status')=='M' ? 'selected' : '' }} value="M">
                                    Married</option>
                                <option {{ old('marital_status')=='S' ? 'selected' : '' }} value="S">
                                    Single</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Emp Status *</label>
                            <select class="form-control" name="employee_status_id" id="edit_employee_status_id">
                                <option value="">Select The Employee Status</option>
                                @forelse ($allEmployeeStatus as $employeeStatus)
                                <option {{ old('employee_status_id')==$employeeStatus->id ? 'selected' : '' }}
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
                                value="{{ old('date_of_birth') }}" id="date_of_birth">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Date of Joining *</label>
                            <input class="form-control" type="date" name="joining_date"
                                value="{{ old('joining_date') }}" id="joining_date">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Phone Number *</label>
                            <input class="form-control" type="number" name="phone" value="{{ old('phone') }}"
                                id="phone">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">Employee Id *</label>
                            <input class="form-control" type="text" name="emp_id" value="{{ old('emp_id') }}"
                                id="emp_id" readonly>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="personal_details_submit">Update</button>
                </form>
            </div>
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
<!--end::Modal dialog-->
<script>
    function getPersonalDetails(id) {
                $.ajax({
                    url: company_ajax_base_url + '/employee/get/personal/details/' + id,
                    type: 'get',
                    success: function(response) {
                        $('#id').val(response.data.id);
                        $('#user_details_id').val(response.details.id);
                        $('#emp_id').val(response.details.emp_id);
                        $('#name').val(response.data.name);
                        $('#father_name').val(response.details.father_name);
                        $('#mother_name').val(response.details.mother_name);
                        $('#official_email_id').val(response.details.official_email_id);
                        $('#phone').val(response.details.phone);
                        $('#edit_marital_status').val(response.details.marital_status);
                        $('#edit_employee_status_id').val(response.details.employee_status_id);
                        $('#email').val(response.data.email);
                        $('#date_of_birth').val(response.details.date_of_birth);
                        $('#joining_date').val(response.details.joining_date);
                        $('#edit_blood_group').val(response.details.blood_group)
                        $('#edit_gender').val(response.details.gender)
                        if (response.details.profile_image != null) {
                            document.getElementById("profile_picture").style.backgroundImage = "url("+ response
                                .details.profile_image + " )";
                        } else {
                            document.getElementById("profile_picture").style.backgroundImage =
                                "url('/assets/media/user.jpg')";
                        }
                    },
                });
            }

            function updatePersonalDetails(form) {
                var basic_details_Data = new FormData(form);
                $.ajax({
                    url: "{{ route('employee.store') }}",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: basic_details_Data,
                    success: function(response) {
                        $('#personal_details').modal('hide');
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#employee_list').replaceWith(response.allUserDetails);
                    },
                    error: function(error_messages) {
                        // This variable is used on save all records button
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
