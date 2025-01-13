<div class="tab-pane fade" id="permission_tab">
    <!--begin::Wrapper-->
    <form id="user_details_form">
        @csrf
        <div class="row">
            <input type="hidden" name="user_id" value="{{ $singleUserDetails->id ?? '' }}">
        </div>
        <div class="container">
            <div id="language_list">
                @if (count($userLanguages) > 0)
                @include('company.employee.languages.user_language')
                @else
                @include('company.employee.languages.create_language')
                @endif
            </div>
        </div>
        <button class="btn btn-primary">Save & Continue</button>
    </form>
    <form id="add_language">
        @csrf
        <div class="col-md-4 form-group">
            <div class="k-w-300">
                <label for="language">Language</label>
                <input id="languageID" class="form-control" name="name" />
                <span class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-4 form-group">
            <label class="mt-3"><button class="btn btn-primary btn-sm mt-5">
                    <i class="fa fa-plus"></i></button>
            </label>
        </div>
    </form>
    <button onclick="show_next_tab('past_work_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>

    <button onclick="show_next_tab('family_details_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
    <!--end::Wrapper-->
</div>
<style>
    .k-picker-solid {
        height: 47px;
    }

    .chkbox label {
        padding: 5px;
    }

    .k-picker-solid {
        background-color: white !important;
    }

    .k-list-item.k-selected,
    .k-selected.k-list-optionlabel {
        color: #ffffff;
        background-color: #1642b3 !important;
    }


    .k-input:not(:-webkit-autofill) {
        animation-name: autoFillEnd;
        height: 47px !important;
    }

    .text-danger {
        color: #ff0000 !important;
        font-weight: 700
    }
</style>
<script>
//     jQuery(document).ready(function() {
//         var departmentId = '{{ $userDetails->department_id ?? '' }}';
//         const all_department_id = [departmentId];
//         var designation_id = '{{ $userDetails->designation_id ?? '' }}';
//         get_all_designation_using_department_id(all_department_id, designation_id);
//     });

//     /** get all Designation Using Department Id*/
//     jQuery('#department_id').on('change', function() {
//         var department_id = $(this).val();
//         const all_department_id = [department_id];
//         get_all_designation_using_department_id(all_department_id);
//     });

//     function get_all_designation_using_department_id(all_department_id, designationId = '') {
//         if (department_id) {
//             $.ajax({
//                 url: "{{ route('get.all.designation') }}",
//                 type: "GET",
//                 dataType: "json",
//                 data: {
//                     'department_id': all_department_id
//                 },
//                 success: function(response) {
//                     var select = $('#designation_id');
//                     select.empty();
//                     if (response.status == true) {
//                         $('#designation_id').append(
//                             '<option>Select The Designation</option>');
//                         $.each(response.data, function(key, value) {
//                             select.append('<option ' + ((designationId == value.id) ? "selected" :
//                                 "") + ' value=' + value.id + '>' + value.name + '</option>');
//                         });
//                     } else {
//                         select.append('<option value="">' + response.error +
//                             '</option>');
//                     }
//                 },
//                 error: function() {
//                     Swal.fire({
//                         icon: "error",
//                         title: "Oops...",
//                         text: "Something Went Wrong!! Please try Again"
//                     });
//                     return false;
//                 }
//             });
//         } else {
//             $('#designation_id').empty();
//         }

//     }
//     /** end get all Designation Using Department Id*/

//     jQuery('#shift').change(function() {
//         var startTime = $(this).find('option:selected').data('time');
//         $('#start_time').val(startTime);
//     });

//     jQuery("#languageID").keyup(function() {
//         $('.text-danger').hide();
//     });

//     /** Qualification Details created Ajax*/
//     jQuery(document).ready(function() {
//         jQuery("#user_details_form").validate({
//             rules: {
//                 'employee_type_id': 'required',
//                 'department_id': 'required',
//                 'designation_id': 'required',
//                 'company_branch_id': 'required',
//                 'role_id': 'required',
//                 'qualification_id': 'required',
//                 'skill_id[]': 'required',
//                 'shift_id': 'required',
//             },
//             messages: {
//                 'employee_type_id': 'Please Select The Employee type',
//                 'department_id': 'Please Select the Department',
//                 'designation_id': 'Please Select the Designation',
//                 'company_branch_id': 'Please Select the Branch',
//                 'role_id': 'Please Select the Roles',
//                 'qualification_id': 'Please select the qualification',
//                 'skill_id[]': 'Please select the skill',
//                 'shift_id': 'Please Select the Shift',

//             },
//             submitHandler: function(form) {
//                 createPermissionDetails(form);
//             }
//         });
//     });

//     function createPermissionDetails(form) {
//         var users_details_data = $(form).serialize();
//         $.ajax({
//             url: "{{ route('employee.users.details') }}",
//             type: 'POST',
//             data: users_details_data,
//             success: function(response) {
//                 Swal.fire({
//                     position: "top-end",
//                     icon: "success",
//                     title: response.message,
//                     showConfirmButton: false,
//                     timer: 1500
//                 });
//                 jQuery('.nav-pills a[href="#family_details_tab"]').tab('show');
//                 // This variable is used on save all records button
//                 all_data_saved = true;
//             },
//             error: function(error_messages) {
//                 // This variable is used on save all records button
//                 all_data_saved = false;
//                 jQuery('.nav-pills a[href="#permission_tab"]').tab('show');
//                 let errors = error_messages.responseJSON.error;
//                 for (var error_key in errors) {
//                     $(document).find('[name=' + error_key + ']').after(
//                         '<span class="' + error_key +
//                         '_error text text-danger">' + errors[
//                             error_key] + '</span>');
//                     setTimeout(function() {
//                         jQuery("." + error_key + "_error").remove();
//                     }, 3000);
//                 }
//             }
//         });
//     }
// </script>

// <script>
//     jQuery.noConflict();
//     jQuery(document).ready(function($) {
//         jQuery("#add_language").validate({
//             rules: {
//                 name: "required",
//             },
//             messages: {
//                 name: "Please enter language",
//             },
//             submitHandler: function(form) {

//                 let languages = [];

//                 jQuery('.language').each(function(ele, value) {
//                     languages.push(jQuery(value).val());
//                 });
//                 console.log("languages : " + languages);
//                 let language_params = $(form).serialize() + "&" + $.param({
//                     "languages": languages
//                 });
//                 $.ajax({
//                     url: "{{ route('language.create') }}",
//                     type: 'POST',
//                     data: language_params,
//                     success: function(response) {
//                         console.log(response.data);
//                         jQuery('#add_designation').modal('hide');

//                         let exists = jQuery("#language_" + response.language_id).html();
//                         if (exists) {
//                             $('.text-danger').text('The language is already added!')
//                                 .show();
//                         } else {
//                             $('.text-danger').hide();
//                             $('#language_list').append(response.data);
//                         }

//                     },
//                     error: function(error_messages) {
//                         let errors = error_messages.responseJSON.error;
//                         for (var error_key in errors) {
//                             $(document).find('[name=' + error_key + ']').after(
//                                 '<span class="' + error_key +
//                                 '_error text text-danger">' + errors[
//                                     error_key] + '</span>');
//                             setTimeout(function() {
//                                 jQuery("." + error_key + "_error").remove();
//                             }, 3000);
//                         }
//                     }
//                 });
//             }
//         });
//     });

//     function remove_language(language_id) {
//         jQuery("#language_" + language_id).remove();
//     }
</script>
