<div class="modal-dialog mw-600px">
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header pb-0">
            <!--begin::Close-->
            <h3 class="fw-bold m-0"> Advance Details </h3>
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
                    <form id="advance_details_form">
                        @csrf
                        <input type="hidden" name="user_id" id="advance_user_id">
                        <input type="hidden" name="id" id="advance_details_id">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="">Aadhar Number *</label>
                                <input class="form-control" type="text" name="aadhar_no" id="aadhar_no">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">PAN Number *</label>
                                <input class="form-control" type="text" name="pan_no" id="pan_no">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">UAN No</label>
                                <input class="form-control" name="uan_no" type="text" id="uan_no">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">ESIC Number </label>
                                <input class="form-control" name="esic_no" type="text" id="esic_no">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Insurance Number </label>
                                <input class="form-control" type="text" name="insurance_no" id="insurance_no">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Driving Licence No. </label>
                                <input class="form-control" type="text" name="driving_licence_no"
                                    id="driving_licence_no">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="">PF Number </label>
                                <input class="form-control" type="text" name="pf_no" id="pf_no">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Probation Period (Days) </label>
                                <input class="form-control" type="text" name="probation_period"
                                    id="probation_period">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">CTC Vaue</label>
                                <input class="form-control" type="number" name="ctc_value" id="ctc_value">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Salary Structured</label>
                                <select name="salary_id" id="salary_id" class="form-control">
                                    <option value="">Please Select Salary Structured</option>
                                    @foreach ($allSalaryStructured as $item)
                                    <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                    @endforeach
                                </select>
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
<script>
    function getAdvanceDetails(userId) {
        $('#advance_user_id').val(userId);
        $.ajax({
            url: company_ajax_base_url + '/get/advance/details/' + userId,
            type: 'get',
            success: function(response) {
                if (response.data != null) {
                    $('#advance_details_id').val(response.data.id);
                    $('#aadhar_no').val(response.data.aadhar_no);
                    $('#ctc_value').val(response.data.ctc_value);
                    $('#salary_id').val(response.data.salary_id);
                    $('#driving_licence_no').val(response.data.driving_licence_no);
                    $('#insurance_no').val(response.data.insurance_no);
                    $('#esic_no').val(response.data.esic_no);
                    $('#pan_no').val(response.data.pan_no);
                    $('#pf_no').val(response.data.pf_no);
                    $('#probation_period').val(response.data.probation_period);
                    $('#uan_no').val(response.data.uan_no);
                    $('#advance_user_id').val(response.data.user_id);
                } else {
                    $('#advance_details_form')[0].reset();
                }
            },
        });
    }

    function updateAdvanceDetails(form) {
        var advance_details_data = new FormData(form);
        $.ajax({
            url: "{{ route('employee.advance.details') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: advance_details_data,
            success: function(response) {
                $('#advance_details').modal('hide');
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
