<div class="tab-pane fade" id="address_tab">
    <!--begin::Wrapper-->
    <form id="address_Details_form">
        @csrf
        <input type="hidden" name="user_id" class="id">
        <input type="hidden" name="address_type" id="address_type" value="0">
        <div class="row">
            <div class="col-md-6">
                <h4>Present Address</h4>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Address *</label>
                        <textarea class="form-control alldetails" type="text" name="l_address" id="l_address"> </textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Country *</label>
                        <select class="form-control alldetails" id="l_country_id" name="l_country_id">
                            <option value="">Please Select Country</option>
                            @forelse ($allCountries as $countriesDetails)
                                <option value="{{ $countriesDetails->id }}">
                                    {{ $countriesDetails->name }}</option>
                            @empty
                                <option value="">No Country Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">State *</label>
                        <select name="l_state_id" class="form-control alldetails" id="l_state_id">
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">City *</label>
                        <input class="form-control alldetails" type="text" name="l_city" id="l_city">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Pincode *</label>
                        <input class="form-control alldetails" type="text" name="l_pincode" id="l_pincode">
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <h4>Permanent Address <input type="checkbox" onclick="get_all_present_address_details()" id="checkbox">
                    <small class="text-muted">Same as
                        present address</small>
                </h4>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Address *</label>
                        <textarea class="form-control" type="text" name="p_address" id="p_address"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Country *</label>
                        <select class="form-control" id="p_country_id" name="p_country_id">
                            <option value="">Please Select Country</option>
                            @forelse ($allCountries as $countriesDetails)
                                <option value="{{ $countriesDetails->id }}">
                                    {{ $countriesDetails->name }}</option>
                            @empty
                                <option value="">No Country Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">State *</label>
                        <select name="p_state_id" class="form-control" id="p_state_id"></select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">City *</label>
                        <input class="form-control" type="text" name="p_city" id="p_city">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Pincode *</label>
                        <input class="form-control" type="text" name="p_pincode" id="p_pincode">
                    </div>

                </div>
            </div>
        </div>
        <button class="btn btn-primary">Save & Continue</button>
    </form>
    <button onclick="show_next_tab('advance_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('bank_details_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
    <!--end::Wrapper-->
</div>
<script>
    /** Start Function Get All State Using Country ID */
    jQuery('#l_country_id').on('change', function() {
        var country_id = $(this).val();
        var div_id = 'l_state_id';
        get_all_state_using_country_id(country_id, div_id);
    });

    jQuery('#p_country_id').on('change', function() {
        var country_id = $(this).val();
        var div_id = 'p_state_id';
        get_all_state_using_country_id(country_id, div_id);
    });

    function get_all_state_using_country_id(country_id, div_id) {
        if (country_id) {
            $.ajax({
                url: "{{ route('get.all.country.state') }}",
                type: "GET",
                dataType: "json",
                data: {
                    'country_id': country_id
                },
                success: function(response) {
                    var select = $('#' + div_id);
                    select.empty();
                    if (response.status == true) {
                        $("#" + div_id).append(
                            '<option>Select State</option>');
                        $.each(response.data, function(key, value) {
                            select.append('<option value=' + value.id + '>' +
                                value
                                .name + '</option>');
                        });
                    } else {
                        select.append('<option value="">' + response.error +
                            '</option>');
                    }
                },
                error: function() {
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
        }
        else {
            $('#address_type').val('0');
            $('#p_address').val('').prop('disabled', false);
            $('#p_country_id').val('').prop('disabled', false);
            $('#p_state_id').empty().prop('disabled', false);
            $('#p_state_id').val('').prop('disabled', false);
            $('#p_city').val('').prop('disabled', false);
            $('#p_pincode').val('').prop('disabled', false);
        }
    }

    jQuery('.alldetails').on('blur', function() {
        get_all_present_address_details();
    });



    /** Address Details created Ajax*/
    jQuery.noConflict();
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
        submitHandler: function(form) {
            var basic_details_Data = new FormData(form);
            $.ajax({
                url: "{{ route('employee.address.details') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: basic_details_Data,
                success: function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('.id').val(response.data);
                    jQuery('.nav-pills a[href="#bank_details_tab"]').tab('show');
                    $('#submit').hide();
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
