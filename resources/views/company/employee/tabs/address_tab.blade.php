<div class="tab-pane fade" id="address_tab">
    <!--begin::Wrapper-->
    <input type="hidden" name="user_id" class="id">
        <div class="row">
            <div class="col-md-6">
                <h4>Present Address</h4>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Address *</label>
                        <textarea class="form-control" type="text"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Country *</label>
                        <select class="form-control" id="present_country_id" name="country_id">
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
                        <select name="state_id" class="form-control" id="present_state_id">
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">City *</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Pincode *</label>
                        <input class="form-control" type="text">
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <h4>Permanent Address <input type="checkbox"> <small class="text-muted">Same as
                        present address</small></h4>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Address *</label>
                        <textarea class="form-control" type="text"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Country *</label>
                        <select class="form-control" id="permanent_country_id" name="country_id">
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
                        <select name="state_id" class="form-control" id="permanent_state_id"></select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">City *</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Pincode *</label>
                        <input class="form-control" type="text">
                    </div>

                </div>
            </div>
        </div>
        <button onclick="show_next_tab('advance_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>   Previous</button>
                {{-- <button onclick="save_data_show_next_tab('advance_details_tab')"
    class="btn btn-primary">Save & Continue</button> --}}
                <button onclick="show_next_tab('bank_details_tab')" class="btn btn-primary float-right">Next <i class="fa fa-arrow-right"></i>  </button>
    <!--end::Wrapper-->
</div>
<script>
     /** Start Function Get All State Using Country ID */
    jQuery('#present_country_id').on('change', function() {
            var country_id = $(this).val();
            var div_id = 'present_state_id';
            get_all_state_using_country_id(country_id, div_id);
        });

        jQuery('#permanent_country_id').on('change', function() {
            var country_id = $(this).val();
            var div_id = 'permanent_state_id';
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
       
</script>
