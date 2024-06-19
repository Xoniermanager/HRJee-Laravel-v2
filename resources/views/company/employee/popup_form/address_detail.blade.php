 <!--begin::Modal dialog-->
 <div class="modal-dialog mw-600px">
     <!--begin::Modal content-->
     <div class="modal-content">
         <!--begin::Modal header-->
         <div class="modal-header pb-0">
             <!--begin::Close-->
             <h3 class="fw-bold m-0"> Address </h3>
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
             <div class="w-100">
                 <div class="mb-3">
                     <form id="address_Details_form">
                         @csrf
                         <input type="hidden" name="user_id" id="address_user_id">
                         <input type="hidden" name="address_type" id="address_type">
                         <div class="row">
                             <div class="col-md-6">
                                 <h4>Present Address</h4>
                                 <div class="row">
                                     <div class="col-md-12 form-group">
                                         <label for="">Address *</label>
                                         <textarea class="form-control alldetails" type="text" name="l_address" id="l_address"></textarea>
                                     </div>
                                     <div class="col-md-6 form-group">
                                         <label for="">Country *</label>
                                         <select class="form-control alldetails" id="l_country_id" name="l_country_id">
                                             <option value="">Please Select Country</option>
                                             @forelse ($allCountries as $countriesDetails)
                                                 <option
                                                     {{ old('l_country_id') == $countriesDetails->id ? 'selected' : '' }}
                                                     value="{{ $countriesDetails->id }}">
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
                                         <input class="form-control alldetails" type="text" name="l_city"
                                             id="l_city">
                                     </div>
                                     <div class="col-md-6 form-group">
                                         <label for="">Pincode *</label>
                                         <input class="form-control alldetails" type="text" name="l_pincode"
                                             id="l_pincode">
                                     </div>

                                 </div>
                             </div>

                             <div class="col-md-6">
                                 <h4>Permanent Address <input type="checkbox"
                                         onclick="get_all_present_address_details()" id="checkbox"
                                         {{ $checkedbox ?? '' }}>
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
                                         <select class="form-control" id="p_country_id" name="p_country_id"
                                             {{ $inputDisabled ?? '' }}>
                                             <option value="">Please Select Country</option>
                                             @forelse ($allCountries as $countriesDetails)
                                                 <option
                                                     {{ old('p_country_id') == $countriesDetails->id ? 'selected' : '' }}
                                                     value="{{ $countriesDetails->id }}">
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
                         <button class="btn btn-primary">Update</button>
                     </form>

                 </div>
             </div>

         </div>
     </div>
     <!--end::Modal body-->
 </div>
 <!--end::Modal content-->
 </div>
 <script>
     function getAddressDetails(userId) {
         $('#advance_user_id').val(userId);
         $.ajax({
             url: company_ajax_base_url + '/get/address/details/' + userId,
             type: 'get',
             success: function(response) {
                 if (response.data != null) {
                     $.each(response.data, function(key, value) {
                         $('#address_user_id').val(value.user_id);
                         if (value.address_type == 'local' || value.address_type == 'permanent') {
                             $('#address_type').val('0');
                             $('#l_address').val(value.address);
                             $('#l_country_id').val(value.country_id);
                             $('#l_city').val(value.city);
                             $('#l_pincode').val(value.pin_code);
                             $('#p_address').val(value.address);
                             $('#p_country_id').val(value.country_id);
                             $('#p_city').val(value.city);
                             $('#p_pincode').val(value.pin_code);
                             var l_div_id = 'l_state_id';
                             if (l_state_id && l_country_id) {
                                 get_all_state_using_country_id(value.country_id, l_div_id, value
                                     .state_id);
                             }
                             var p_div_id = 'p_state_id';
                             if (p_state_id && p_country_id) {
                                 get_all_state_using_country_id(value.country_id, p_div_id, value
                                     .state_id);
                             }
                         } else {
                             $('#address_type').val('1');
                             document.getElementById("checkbox").checked = true;
                             $('#l_address').val(value.address);
                             $('#l_country_id').val(value.country_id);
                             $('#l_city').val(value.city);
                             $('#l_pincode').val(value.pin_code);
                             var l_div_id = 'l_state_id';
                             if (l_state_id && l_country_id) {
                                 get_all_state_using_country_id(value.country_id, l_div_id, value
                                     .state_id);
                             }
                             get_all_present_address_details();
                         }
                     });
                 } else {
                     $('#address_Details_form')[0].reset();
                 }
             },
         });
     }

     function updateAddressDetails(form) {
         var advance_details_data = new FormData(form);
         $.ajax({
             url: "{{ route('employee.address.details') }}",
             type: 'POST',
             processData: false,
             contentType: false,
             data: advance_details_data,
             success: function(response) {
                 $('#address').modal('hide');
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
