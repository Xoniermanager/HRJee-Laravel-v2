@php
$local = [];
$permanent = [];
foreach ($userAddressDetails as $userAddress) {
if ($userAddress->address_type == 'local') {
$local = $userAddress;
}

if ($userAddress->address_type == 'permanent') {
$permanent = $userAddress;
}

if ($userAddress->address_type == 'both_same') {
$permanent = $userAddress;
$local = $userAddress;
$checkedbox = 'checked';
$inputDisabled = 'disabled';
$addressTypeValue = '1';
}
}
@endphp
<div class="tab-pane fade" id="address_tab">
    <!--begin::Wrapper-->
    <form id="address_Details_form">
        @csrf
        <input type="hidden" name="user_id" value="{{ $singleUserDetails->id ?? '' }}">
        <input type="hidden" name="address_type" id="address_type" value="{{ $addressTypeValue ?? '0' }}">
        <div class="row">
            <div class="col-md-6">
                <h4>Present Address</h4>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="" class="required">Address</label>
                        <textarea class="form-control alldetails" type="text" name="l_address"
                            id="l_address">{{ $local->address ?? '' }}</textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="required">Country</label>
                        <select class="form-control alldetails" id="l_country_id" name="l_country_id">
                            <option value="">Please Select Country</option>
                            @forelse ($allCountries as $countriesDetails)
                            <option {{ $local->country_id ?? '' == $countriesDetails->id ? 'selected' : '' }}
                                value="{{ $countriesDetails->id }}">
                                {{ $countriesDetails->name }}</option>
                            @empty
                            <option value="">No Country Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="required">State</label>
                        <select name="l_state_id" class="form-control alldetails" id="l_state_id">
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="required">City </label>
                        <input class="form-control alldetails" type="text" name="l_city" id="l_city"
                            value="{{ $local->city ?? '' }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="required">Pincode</label>
                        <input class="form-control alldetails" type="text" name="l_pincode" id="l_pincode"
                            value="{{ $local->pin_code ?? '' }}">
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <h4>Permanent Address <input type="checkbox" onclick="get_all_present_address_details()" id="checkbox"
                        {{ $checkedbox ?? '' }}>
                    <small class="text-muted">Same as
                        present address</small>
                </h4>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="" class="required">Address</label>
                        <textarea class="form-control" type="text" name="p_address" id="p_address" {{ $inputDisabled
                            ?? '' }}> {{ $permanent->address ?? '' }}</textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="required">Country</label>
                        <select class="form-control" id="p_country_id" name="p_country_id" {{ $inputDisabled ?? '' }}>
                            <option value="">Please Select Country</option>
                            @forelse ($allCountries as $countriesDetails)
                            <option {{ $permanent->country_id ?? '' == $countriesDetails->id ? 'selected' : '' }}
                                value="{{ $countriesDetails->id }}">
                                {{ $countriesDetails->name }}</option>
                            @empty
                            <option value="">No Country Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="required">State</label>
                        <select name="p_state_id" class="form-control" id="p_state_id" {{ $inputDisabled ?? ''
                            }}></select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="required">City</label>
                        <input class="form-control" type="text" name="p_city" id="p_city"
                            value="{{ $permanent->city ?? '' }}" {{ $inputDisabled ?? '' }}>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="required">Pincode</label>
                        <input class="form-control" type="text" name="p_pincode" id="p_pincode"
                            value="{{ $permanent->pin_code ?? '' }}" {{ $inputDisabled ?? '' }}>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-auto text-center">
        <button class="btn btn-primary">Save & Continue</button>
        </div>
    </form>
    <button onclick="show_next_tab('advance_details_tab')" class="tab-btn-inline btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('bank_details_tab')" class="tab-btn-inline btnnext btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
    <!--end::Wrapper-->
</div>
<script>
    jQuery(document).ready(function() {
        var l_div_id = 'l_state_id';
        let l_state_id = '{{ $local->state_id ?? '' }}';
        let l_country_id = '{{ $local->country_id ?? '' }}';
        if (l_state_id && l_country_id) {
            get_all_state_using_country_id(l_country_id, l_div_id, l_state_id);
        }

        var p_div_id = 'p_state_id';
        let p_state_id = '{{ $permanent->state_id ?? ' ' }}';
        let p_country_id = '{{ $permanent->country_id ?? ' ' }}';
        if (p_state_id && p_country_id) {
            get_all_state_using_country_id(p_country_id, p_div_id, p_state_id);
        }
    });

    function createAddressDetails(form) {
        var basic_details_Data = $(form).serialize();
        $.ajax({
            url: "{{ route('employee.address.details') }}",
            type: 'POST',
            data: basic_details_Data,
            success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                jQuery('.nav-pills a[href="#bank_details_tab"]').tab('show');
                $('#submit').hide();
                // This variable is used on save all records button
                all_data_saved = true;
            },
            error: function(error_messages) {
                // This variable is used on save all records button
                all_data_saved = false;
                jQuery('.nav-pills a[href="#address_tab"]').tab('show');
                let errors = error_messages.responseJSON.error;
                for (var error_key in errors)
                {
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
