jQuery(document).ready(function () {
    jQuery.validator.addMethod("validName", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s.\-]+$/.test(value);
    }, "Name can only contain letters, spaces, dots");
    jQuery.validator.addMethod("validPasswordComplex", function (value, element) {
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
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
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
            phone: {
                required: "Please enter your phone number",
                digits: "Please enter only digits",
                minlength: "Phone number must be exactly 10 digits",
                maxlength: "Phone number must be exactly 12 digits"
            },
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
    $.validator.addMethod("validPAN", function (value, element) {
        return this.optional(element) || /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(value);
    }, "Please enter a valid PAN Card Number (e.g., ABCDE1234F)");

    jQuery("#advance_details_form").validate({
        rules: {
            aadhar_no: {
                required: true,
                digits: true,
                minlength: 12,
                maxlength: 12
            },
            pan_no: {
                required: true,
                validPAN: true,    // use the custom method
                minlength: 10,
                maxlength: 10
            },
            uan_no: {
                digits: true,
                minlength: 12,
                maxlength: 12
            },
            esic_no: {
                digits: true,
                minlength: 10,
                maxlength: 17
            },
            insurance_no: {
                maxlength: 20
            },
            driving_licence_no: {
                maxlength: 20
            },
            pf_no: {
                maxlength: 20
            },
            probation_period: {
                digits: true,
                maxlength: 3
            }
        },
        messages: {
            aadhar_no: {
                required: "Please enter the Aadhar Number",
                digits: "Aadhar Number must contain only digits",
                minlength: "Aadhar Number must be exactly 12 digits",
                maxlength: "Aadhar Number must be exactly 12 digits"
            },
            pan_no: {
                required: "Please enter the PAN Card Number",
                minlength: "PAN Card Number must be exactly 10 characters",
                maxlength: "PAN Card Number must be exactly 10 characters"
            },
            uan_no: {
                digits: "UAN Number must contain only digits",
                minlength: "UAN Number must be exactly 12 digits",
                maxlength: "UAN Number must be exactly 12 digits"
            },
            esic_no: {
                digits: "ESIC Number must contain only digits",
                minlength: "ESIC Number must be at least 10 digits",
                maxlength: "ESIC Number must not exceed 17 digits"
            },
            insurance_no: {
                maxlength: "Insurance Number must not exceed 20 characters"
            },
            driving_licence_no: {
                maxlength: "Driving Licence Number must not exceed 20 characters"
            },
            pf_no: {
                maxlength: "PF Number must not exceed 20 characters"
            },
            probation_period: {
                digits: "Please enter only digits",
                maxlength: "Probation Period must not exceed 3 digits"
            },
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
    // Allow only letters and spaces for city
    $.validator.addMethod("validCity", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "City name must contain only letters and spaces");

    // Allow letters, numbers, spaces, and dash for postal code
    $.validator.addMethod("validPostal", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s\-]+$/.test(value);
    }, "Postal Code can contain letters, numbers, spaces, and dashes");

    /**Address Validation */
    /** Address Details created Ajax*/
    jQuery("#address_Details_form").validate({
        rules: {
            l_address: "required",
            l_country_id: "required",
            l_state_id: "required",
            l_city: {
                required: true,
                validCity: true,
                maxlength: 50
            },
            l_pincode: {
                required: true,
                validPostal: true,
                minlength: 3,
                maxlength: 12
            },
            p_city: {
                validCity: true,
                maxlength: 50
            },
            p_pincode: {
                validPostal: true,
                minlength: 3,
                maxlength: 12
            }
        },
        messages: {
            l_address: "Please enter the Address",
            l_country_id: "Please select the Country",
            l_state_id: "Please select the State",
            l_city: {
                required: "Please enter the City",
                validCity: "City name must contain only letters and spaces",
                maxlength: "City name should not exceed 50 characters"
            },
            l_pincode: {
                required: "Please enter the Postal Code",
                validPostal: "Postal Code can contain letters, numbers, spaces, and dashes",
                minlength: "Postal Code must be at least 3 characters",
                maxlength: "Postal Code must not exceed 12 characters"
            },
            p_city: {
                validCity: "City name must contain only letters and spaces",
                maxlength: "City name should not exceed 50 characters"
            },
            p_pincode: {
                validPostal: "Postal Code can contain letters, numbers, spaces, and dashes",
                minlength: "Postal Code must be at least 3 characters",
                maxlength: "Postal Code must not exceed 12 characters"
            },
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
    // Allow letters, spaces, numbers for account name
    $.validator.addMethod("validAccountName", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value);
    }, "Account name can contain letters, numbers and spaces");

    // Allow only letters & spaces for bank name
    $.validator.addMethod("validBankName", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Bank name must contain only letters and spaces");

    // Validate IFSC format: 4 letters + 0 + 6 digits
    $.validator.addMethod("validIFSC", function (value, element) {
        return this.optional(element) || /^[A-Z]{4}0[0-9]{6}$/.test(value);
    }, "Please enter a valid IFSC Code (e.g., SBIN0005900)");

    /** Bank Details created Ajax*/
    jQuery("#bank_details_form").validate({
        rules: {
            account_name: {
                required: true,
                validAccountName: true,
                maxlength: 50
            },
            account_number: {
                required: true,
                digits: true,
                minlength: 9,
                maxlength: 20
            },
            bank_name: {
                required: true,
                validBankName: true,
                maxlength: 50
            },
            ifsc_code: {
                required: true,
                validIFSC: true,
                maxlength: 11
            }
        },
        messages: {
            account_name: {
                required: 'Please enter the Account Name',
                validAccountName: 'Account name can contain letters, numbers and spaces',
                maxlength: 'Account name should not exceed 50 characters'
            },
            account_number: {
                required: 'Please enter the Account Number',
                digits: 'Account Number must contain only numbers',
                minlength: 'Account Number must be at least 9 digits',
                maxlength: 'Account Number must not exceed 20 digits'
            },
            bank_name: {
                required: 'Please enter the Bank Name',
                validBankName: 'Bank name must contain only letters and spaces',
                maxlength: 'Bank name should not exceed 50 characters'
            },
            ifsc_code: {
                required: 'Please enter the IFSC Code',
                validIFSC: 'Please enter a valid IFSC Code (e.g., SBIN0005900)',
                maxlength: 'IFSC Code must be exactly 11 characters'
            }
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
