<div class="tab-pane fade" id="advance_details_tab">
    <!--begin::Wrapper-->
    <form id="advance_details_form">
        @csrf
        <input type="hidden" name="user_id" class="id">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Aadhar Number *</label>
                <input class="form-control" type="text" name="aadhar_no">
            </div>
            <div class="col-md-4 form-group">
                <label for="">PAN Number *</label>
                <input class="form-control" type="text" name="pan_no">
            </div>
            <div class="col-md-4 form-group">
                <label for="">UAN No</label>
                <input class="form-control" name="uan_no" type="text">
            </div>
            <div class="col-md-4 form-group">
                <label for="">ESIC Number </label>
                <input class="form-control" name="esic_no" type="text">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Insurance Number </label>
                <input class="form-control" type="text" name="insurance_no">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Driving Licence No. </label>
                <input class="form-control" type="text" name="driving_licence_no">
            </div>

            <div class="col-md-4 form-group">
                <label for="">PF Number </label>
                <input class="form-control" type="text" name="pf_no">
            </div>
            <div class="col-md-4 form-group">
                <label for="">CTC Monthly (In Probation)</label>
                <input class="form-control" type="text" name="ctc_monthly_in_probation">
            </div>
            <div class="col-md-4 form-group">
                <label for="">Probation Period (Days) </label>
                <input class="form-control" type="text" name="probation_period">
            </div>

            <div class="col-md-4 form-group">
                <label for="">CTC Monthly (After Probation) </label>
                <input class="form-control" type="text" name="ctc_monthly_after_probation">
            </div>
        </div>
        <button id="submit_advance_details" class="btn btn-primary">Save & Continue</button>
    </form>
    <button onclick="show_next_tab('basic_Details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('address_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
</div>
<script>
    jQuery.noConflict();
    jQuery("#advance_details_form").validate({
        rules: {
            aadhar_no: "required",
            pan_no: "required",
        },
        messages: {
            aadhar_no: "Please enter the Aadhar Number",
            pan_no: "Please enter the Pan Card Number",
        },
        submitHandler: function(form) {
            var advance_details_details = $(form).serialize();
            $.ajax({
                url: "{{ route('employee.advance.details') }}",
                type: 'POST',
                data: advance_details_details,
                success: function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('.id').val(response.data);
                    jQuery('.nav-pills a[href="#address_tab"]').tab('show');
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
                        }, 5000);
                    }
                }
            });
        }
    });
</script>
