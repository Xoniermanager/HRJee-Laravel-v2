<form action="#" id="change-password">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="input-block input-block-new">
                <label class="form-label">Old Password</label>
                <input type="password" class="form-control" name="old_password" autocomplete="off">
                <span class="text-danger" id="old_password_error">
            </div>
            <div class="input-block input-block-new">
                <label class="form-label">New Password</label>
                <div class="pass-group">
                    <input type="password" class="form-control pass-input" name="password" id="password"
                        autocomplete="off">
                    <span class="feather-eye-off toggle-password"></span>
                    <span class="text-danger" id="password_error">
                </div>
            </div>
            <div class="input-block input-block-new mb-0">
                <label class="form-label">Confirm Password</label>
                <div class="pass-group">
                    <input type="password" class="form-control pass-input-sub" name="confirm_password"
                        autocomplete="off">
                    <span class="feather-eye-off toggle-password-sub"></span>
                    <span class="text-danger" id="confirm_password_error">
                </div>
            </div>
            <div class="form-set-button mt-4">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
            jQuery("#change-password").validate({
                rules: {
                    old_password: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 30
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        maxlength: 30,
                        equalTo: "#password"
                    },
                },
                messages: {
                    old_password: "Please enter a valid old password",
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 8 characters long",
                        maxlength: "Password must be no more than 30 characters long"
                    },
                    confirm_password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 8 characters long",
                        maxlength: "Password must be no more than 30 characters long",
                        equalTo: "Confirm password does not match"
                    },
                },
                submitHandler: function(form, event) {
                    var errorTimeout;
                    event.preventDefault(); // Prevent default form submission
                    var formData = new FormData(form);
                    $.ajax({
                        url: "<?= route('user.update.password') ?>",
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire("Done!", response.message, "success");
                                $('#change-password')[0].reset();
                                $('#change_password_model').hide();
                            }
                        },
                        error: function(error_messages) {
                            $('#change_password_model').show();
                            if (error_messages.responseJSON && error_messages.responseJSON
                                .errors) {
                                // Iterate over the errors object
                                $.each(error_messages.responseJSON.errors, function(key,
                                    value) {
                                    // Check if the error element exists for the key
                                    var errorElement = $('#' + key + '_error');
                                    if (errorElement.length) {
                                        errorElement.html(value).show();
                                    }
                                });

                                // Clear the existing timeout if it exists
                                if (errorTimeout) {
                                    clearTimeout(errorTimeout);
                                }

                                // Set a timeout to hide error messages after 2 seconds
                                errorTimeout = setTimeout(function() {
                                    $('.text-danger').fadeOut();
                                }, 2000);
                            }

                        }
                    });
                }
            });
        });
</script>
