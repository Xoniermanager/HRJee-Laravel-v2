<div class="tab-pane fade" id="ctc_tab">
    <form id="ctc_details_form">
        @csrf
        <input type="hidden" name="user_id" value="{{ $singleUserDetails->id ?? '' }}">
        <div class="row">
            <div class="col-md-4 form-group">
                <label class="required">CTC Vaue</label>
                <input class="form-control" type="number" name="ctc_value"
                    value="{{ $userctcDetails->ctc_value ?? '' }}">
            </div>
            <div class="col-md-4 form-group">
                <label class="required">Effective Date</label>
                <input class="form-control" type="date" name="effective_date">
            </div>
            <div class="col-md-4 form-group">
                <label class="required">Salary Structured</label>
                <select name="salary_id" id="" class="form-control" onchange="getComponentDetails(this)">
                    <option value="">Please Select Salary Structured</option>
                    @foreach ($allSalaryStructured as $item)
                        <option value="{{ $item->id }}" {{ ($userctcDetails->salary_id ?? '') == $item->id ? 'selected' : ''}}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div id="component_html">
            </div>
            <div class="m-auto text-center">
                <button id="submit_advance_details" class="btn btn-primary">Save & Continue</button>
            </div>
        </div>
    </form>
    <button onclick="show_next_tab('asset_tab')" class="tab-btn-inline btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('document_tab')" class="tab-btn-inline btnnext btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i>
    </button>
</div>
<script>
    function getComponentDetails(ele) {
        getComponentHtml(ele.value);
    }
    jQuery(document).ready(function () {
        getComponentHtml({{$userctcDetails->salary_id ?? '' }})
    });
    function getComponentHtml(salaryId) {
        $.ajax({
            type: 'GET',
            url: company_ajax_base_url + '/salary/component/details',
            data: {
                'salary_id': salaryId,
            },
            success: function (response) {
                $('#component_html').html();
                $('#component_html').html(response.data);
            }
        });
    }
    jQuery(document).ready(function () {
        jQuery("#ctc_details_form").validate({
            rules: {
                ctc_value: "required",
                salary_id: "required",
                effective_date: "required",
                'componentDetails[][value]': {
                    required: true,
                    pattern: /^[0-9]*\.?[0-9]+$/, // Allows numbers and decimals
                },
                // Earning or Deduction radio buttons
                'componentDetails[][earning_or_deduction]': {
                    required: true
                },
                // Value type radio buttons
                'componentDetails[][value_type]': {
                    required: true
                },
                // Parent component dropdown
                'componentDetails[][parent_component]': {
                    required: function (element) {
                        // Make the parent_component field required if value_type is "percentage"
                        return $('input[name="componentDetails[][value_type]"]:checked').val() === 'percentage';
                    }
                }
            },
            messages: {
                ctc_value: "Please enter the CTC Value",
                salary_id: "Please select the salary",
                effective_date: "Please enter the date",
                'componentDetails[][value]': {
                    required: "Please enter a default value.",
                    pattern: "Please enter a valid number."
                },
                'componentDetails[][earning_or_deduction]': {
                    required: "Please select whether it's earning or deduction."
                },
                'componentDetails[][value_type]': {
                    required: "Please select a value type."
                },
                'componentDetails[][parent_component]': {
                    required: "Please select a parent component when the value type is percentage."
                }
            },
            submitHandler: function (form) {
                var ctc_details = $(form).serialize();
                $.ajax({
                    url: "{{ route('employee.ctc.details') }}",
                    type: 'POST',
                    data: ctc_details,
                    success: function (response) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#submit').hide();
                        all_data_saved = true;
                    },
                    error: function (error_messages) {
                        jQuery('.nav-pills a[href="#ctc_tab"]').tab('show');
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            $(document).find('[name=' + error_key + ']').after(
                                '<span class="' + error_key +
                                '_error text text-danger">' + errors[
                                error_key] + '</span>');
                            setTimeout(function () {
                                jQuery("." + error_key + "_error").remove();
                            }, 5000);
                        }
                    }
                });
            }
        });
    });
</script>
