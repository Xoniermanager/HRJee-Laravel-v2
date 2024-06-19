<!--begin::Modal dialog-->
<div class="modal-dialog mw-600px">
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header pb-0">
            <!--begin::Close-->
            <h3 class="fw-bold m-0"> Bank Details </h3>
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                            transform="rotate(-45 6 17.3137)" fill="currentColor" />
                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                            transform="rotate(45 7.41422 6)" fill="currentColor" />
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
                <div class="row">
                    <form id="bank_details_form">
                        @csrf
                        <input type="hidden" name="user_id" id="bank_user_id">
                        <input type="hidden" name="id" id="bank_id">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Account Holder Name *</label>
                                        <input class="form-control" type="text" name="account_name"
                                            id="account_name">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Account Number *</label>
                                        <input class="form-control" type="number" name="account_number"
                                            id="account_number">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Bank Name *</label>
                                        <input class="form-control" type="text" name="bank_name" id="bank_name">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">IFSC/RTGS Code *</label>
                                        <input class="form-control" type="text" name="ifsc_code" id="ifsc_code">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
<!--end::Modal dialog-->
<script>
    function getBankDetails(userId) {
        $.ajax({
            url: company_ajax_base_url + '/get/bank/details/' + userId,
            type: 'get',
            success: function(response) {
                console.log(response.data);
                if (response.data != null) {
                    $('#bank_id').val(response.data.id);
                    $('#account_name').val(response.data.account_name);
                    $('#account_number').val(response.data.account_number);
                    $('#bank_name').val(response.data.bank_name);
                    $('#ifsc_code').val(response.data.ifsc_code);
                    $('#bank_user_id').val(response.data.user_id);
                } else {
                    $('#bank_details_form')[0].reset();
                }
            },
        });
    }

    function updateBankDetails(form) {
        var bank_detail_data = new FormData(form);
        $.ajax({
            url: "{{ route('employee.banks.details') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: bank_detail_data,
            success: function(response) {
                $('#bank_details').modal('hide');
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
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
