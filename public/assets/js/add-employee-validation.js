jQuery(document).ready(function () {
    jQuery.validator.addMethod("validName", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s.\-]+$/.test(value);
    }, "Name can only contain letters, spaces, dots");
    jQuery.validator.addMethod("validPasswordComplex", function(value, element) {
        if (value === "") return true; // optional: allow empty
        // Regex: at least one lowercase, one uppercase, one digit, min length 6
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/.test(value);
    }, "Password must be at least 6 characters long and include at least one uppercase letter, one lowercase letter, and one digit.");

    /** Basic Details created Ajax*/
    jQuery("#basic_create_form").validate({
        rules: {
            name: {
                required: true,
                minlength: 5,
                maxlength: 255,
                validName: true
            },
            father_name: {
                minlength: 3,
                maxlength: 100,
                validName: true
            },
            mother_name: {
                minlength: 3,
                maxlength: 100,
                validName: true
            },
            password: {
                validPasswordComplex: true
            },
            email: {
                required: true,
                email: true
            },
            official_email_id: {
                required: true,
                email: true
            },
            blood_group: "required",
            gender: "required",
            marital_status: "required",
            // employee_status_id: "required",
            date_of_birth: "required",
            joining_date: "required",
            phone: "required",
            employee_type_id: 'required',
            department_id: 'required',
            designation_id: 'required',
            company_branch_id: 'required',
            qualification_id: 'required',
            skill_id: 'required',
            role_id: 'required',
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 5 characters long",
                maxlength: "Name cannot be more than 255 characters"
            },
            father_name: {
                minlength: "Father's name must be at least 3 characters long",
                maxlength: "Father's name cannot be more than 100 characters"
            },
            mother_name: {
                minlength: "Mother's name must be at least 3 characters long",
                maxlength: "Mother's name cannot be more than 100 characters"
            },
            password: {
                validPasswordComplex: "Password must be at least 6 characters long and include at least one uppercase letter, one lowercase letter, and one digit."
            },
            email: {
                required: "Please enter the Email",
                email: "Please enter a valid Email address"
            },
            official_email_id: {
                required: "Please enter the Official Email",
                email: "Please enter a valid Email address"
            },
            blood_group: "Please select the Blood Group",
            gender: "Please select the Gender",
            marital_status: "Please select the Marital Status",
            // employee_status_id: "Please select the Employee Status",
            date_of_birth: "Please fill the Date of Birth",
            joining_date: "Please fill the Joining Date",
            phone: "Please enter the Phone",
            employee_type_id: 'Please Select The Employee type',
            department_id: 'Please Select the Department',
            designation_id: 'Please Select the Designation',
            company_branch_id: 'Please Select the Branch',
            qualification_id: 'Please select the qualification',
            skill_id: 'Please select the skill',
            role_id: 'Please Select the job role',
        },
        submitHandler: function (form) {
            if (submit_handler == true) {
                createBasicDetails(form);
            }
            if (submit_handler == false) {
                updatePersonalDetails(form);
            }
        }
    });



    /** Advance Details Validation */
    jQuery("#advance_details_form").validate({
        rules: {
            aadhar_no: "required",
            pan_no: "required",
        },
        messages: {
            aadhar_no: "Please enter the Aadhar Number",
            pan_no: "Please enter the Pan Card Number",
        },
        submitHandler: function (form) {
            if (submit_handler == true) {
                createAdvanceDetails(form);
            }
            if (submit_handler == false) {
                updateAdvanceDetails(form);
            }
        }
    });

    /**Address Validation */
    /** Address Details created Ajax*/
    jQuery("#address_Details_form").validate({
        rules: {
            l_address: "required",
            l_country_id: "required",
            l_state_id: "required",
            l_city: "required",
            l_pincode: "required",
        },
        messages: {
            l_address: "Please enter the Address",
            l_country_id: "Please select the Country",
            l_state_id: "Please select the State",
            l_city: "Please enter the City",
            l_pincode: "Please enter the Pincode",
        },
        submitHandler: function (form) {
            if (submit_handler == true) {
                createAddressDetails(form);
            }
            if (submit_handler == false) {
                updateAddressDetails(form);
            }
        }
    });

    /**Bank Details Validation Ajax */
    /** Bank Details created Ajax*/
    jQuery("#bank_details_form").validate({
        rules: {
            account_name: 'required',
            account_number: 'required',
            bank_name: 'required',
            ifsc_code: 'required'
        },
        messages: {
            account_name: 'Please Enter the Account Name',
            account_number: 'Please Enter the Account Number ',
            bank_name: 'Please Enter the Bank Name',
            ifsc_code: 'Please Enter the IFSC Code'
        },
        submitHandler: function (form) {
            if (submit_handler == true) {
                createBankDetails(form);
            }
            if (submit_handler == false) {
                updateBankDetails(form);
            }
        }
    });



    /** Course Details created Ajax*/
    jQuery("#course_details_form").validate({
        rules: {
            title: "required",
            description: "required",
            video_type: "required",
            department_id: 'required',
            designation_id: 'required',
            pdf_file: {
                required: function () {
                    return $("#video_type").val() === "pdf" && $("#id").val() === "";
                }
            },
            video_url: {
                required: function () {
                    return $("#video_type").val() !== "pdf" && $("#id").val() === "";
                },
                url: true
            }
        },
        messages: {
            title: "Please enter the title",
            description: "Please enter the description",
            video_type: "Please select the type",
            department_id: 'Please Select the Department',
            designation_id: 'Please Select the Designation',
            pdf_file: {
                required: "Please upload a PDF file."
            },
            video_url: {
                required: "Please provide a valid video URL."
            }
        },
        submitHandler: function (form) {
            createBasicDetails(form);
        }
    });
});


/** Address Details */
/** Start Function Get All State Using Country ID */
jQuery('#l_country_id').on('change', function () {
    var country_id = $(this).val();
    var div_id = 'l_state_id';
    get_all_state_using_country_id(country_id, div_id);
});

jQuery('#p_country_id').on('change', function () {
    var country_id = $(this).val();
    var div_id = 'p_state_id';
    get_all_state_using_country_id(country_id, div_id);
});

function get_all_state_using_country_id(country_id, div_id, state_id = '') {
    if (country_id) {
        $.ajax({
            url: company_ajax_base_url + '/state/get/all/state',
            type: "GET",
            dataType: "json",
            data: {
                'country_id': country_id
            },
            success: function (response) {
                var select = $('#' + div_id);
                select.html('');
                if (response.status == true) {
                    $("#" + div_id).append(
                        '<option value="">Select State</option>');
                    $.each(response.data, function (key, value) {
                        select.append('<option ' + ((state_id == value.id) ? "selected" : "") +
                            ' value=' + value.id + ' >' + value.name + '</option>');
                    });
                } else {
                    select.append('<option value="">' + response.error +
                        '</option>');
                }
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Somethiong went Wrong!! Please try again"
                });
                return false;
            }
        });
    } else {
        $('#' + div_id).empty();
    }
}
/** End Get All State Using Country ID */

function get_all_present_address_details() {
    var checkbox = document.getElementById('checkbox');
    if (checkbox.checked != false) {
        $('#address_type').val('1');
        let l_address = $('#l_address').val();
        let l_country_id = $('#l_country_id').val();
        let l_state_html = $('#l_state_id').html();
        let l_state_id = $('#l_state_id').val();
        let l_city = $('#l_city').val();
        let l_pincode = $('#l_pincode').val();


        //send to permament address
        $('#p_state_id').empty();

        $('#p_address').val(l_address).prop('disabled', true);
        $('#p_country_id').val(l_country_id).prop('disabled', true);
        $('#p_state_id').append(l_state_html);
        $('#p_state_id').val(l_state_id).prop('disabled', true);
        $('#p_city').val(l_city).prop('disabled', true);
        $('#p_pincode').val(l_pincode).prop('disabled', true);
    } else {
        $('#address_type').val('0');
        $('#p_address').val('').prop('disabled', false);
        $('#p_country_id').val('').prop('disabled', false);
        $('#p_state_id').empty().prop('disabled', false);
        $('#p_state_id').val('').prop('disabled', false);
        $('#p_city').val('').prop('disabled', false);
        $('#p_pincode').val('').prop('disabled', false);
    }
}

jQuery('.alldetails').on('blur', function () {
    get_all_present_address_details();
});
