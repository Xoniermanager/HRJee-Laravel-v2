<div class="tab-pane fade" id="bank_details_tab">
    <!--begin::Wrapper-->
    <form id="bank_details_form">
        @csrf
        <input type="hidden" name="user_id" value="{{ $userbankDetails->user_id ?? Request::segment(3) ?? '' }}">
        <input type="hidden" name="id" value="{{ $userbankDetails->id ?? ''}}">

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Account Holder Name *</label>
                        <input class="form-control" type="text" name="account_name"
                            value="{{ $userbankDetails->account_name ?? '' }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Account Number *</label>
                        <input class="form-control" type="number" name="account_number"
                            value="{{ $userbankDetails->account_number ?? '' }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Bank Name *</label>
                        <input class="form-control" type="text" name="bank_name"
                            value="{{ $userbankDetails->bank_name ?? '' }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">IFSC/RTGS Code *</label>
                        <input class="form-control" type="text" name="ifsc_code"
                            value="{{ $userbankDetails->ifsc_code ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">Save & Continue</button>
    </form>
    <button onclick="show_next_tab('address_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('qualification_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
    <!--end::Wrapper-->
</div>
<script>
    jQuery(document).ready(function()
    {
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
            submitHandler: function(form) {
                createBankDetails(form);
            }
        });
    });
    
    function createBankDetails(form) {
        var bank_details_data = $(form).serialize();
        $.ajax({
            url: "{{ route('employee.banks.details') }}",
            type: 'POST',
            data: bank_details_data,
            success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                jQuery('.nav-pills a[href="#qualification_tab"]').tab('show');
                // This variable is used on save all records button
                all_data_saved = true;
            },
            error: function(error_messages) {
                // This variable is used on save all records button
                all_data_saved = false;

                setTimeout(function(){
                    jQuery('.nav-pills a[href="#bank_details_tab"]').tab('show');
                },1000);
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
