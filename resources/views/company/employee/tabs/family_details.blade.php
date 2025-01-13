<div class="tab-pane fade" id="family_details_tab">
    <!--begin::Wrapper-->
    <form id="family_details_form">
        @csrf
        <input type="hidden" name="user_id" class="id"
            value="{{ $singleUserDetails->id ?? '' }}">
        {{-- <div class="row align-items-center panel panel-body mb-3">
            <div class="col-md-3 form-group">
                <label for="">Relationship *</label>
                <input class="form-control" type="text" name="family_details[0][relation_name]">
            </div>
            <div class="col-md-3 form-group">
                <label for="">Name *</label>
                <input class="form-control" type="text" name="family_details[0][name]">
            </div>
            <div class="col-md-2 form-group">
                <label for="">Number *</label>
                <input class="form-control" type="text" name="family_details[0][phone]">
            </div>
            <div class="col-md-2 form-group">
                <label for="">Date of birth *</label>
                <input class="form-control" type="date" name="family_details[0][dob]">
            </div>
            <div class="col-md-2 form-group mt-5">
                <input type="checkbox" name="family_details[0]['nominee']" value="1">
                <label for="">Nominee</label>

            </div>
        </div> --}}
       <div class="row">
        <div class="col-md-12 p-0 mb-2">
        <a class="btn btn-primary btn-sm" onclick="get_family_details_html()"><i
            class="fa fa-plus fs-5"></i> Create a Family Details</a>
       </div>
    </div>
        <div id="family_details_html" class="">
        </div>
        @php
            $i = 0;
        @endphp
        @foreach ($userfamilyDetails as $userfamilyDetail)
            <div class="row align-items-center panel panel-body mb-3">
                <div class="col-md-3 form-group">
                    <label for="">Relationship *</label>
                    <input class="form-control" type="text" name="family_details[{{ $i }}][relation_name]"
                        value="{{ $userfamilyDetail->relation_name }}">
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Name *</label>
                    <input class="form-control" type="text" name="family_details[{{ $i }}][name]"
                        value="{{ $userfamilyDetail->name }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="">Number *</label>
                    <input class="form-control" type="text" name="family_details[{{ $i }}][phone]"
                        value="{{ $userfamilyDetail->phone }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="">Date of birth *</label>
                    <input class="form-control" type="date" name="family_details[{{ $i }}][dob]"
                        value="{{ $userfamilyDetail->dob }}">
                </div>
                <div class="col-md-2 form-group mt-5">
                    <input type="checkbox" name="family_details[{{ $i }}]['nominee']" value="1">
                    <label for="">Nominee</label>
                    <a onclick="remove_family_details_html(this,{{$userfamilyDetail->id}})" class="btn btn-danger btn-sm float-right"> <i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
        <button class="btn btn-primary">Save & Continue</button>
    </form>
    <!--end::Wrapper-->
    <button onclick="show_next_tab('past_work_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('asset_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i>
    </button>
</div>
<script>
    /** Family details create html*/

    var get_family_details_counter = {{ $i}};

    function get_family_details_html() {
        var family_details_html =
            '<div class=""><div class="row panel panel-body mb-3"><div class="col-md-3 form-group"><label for="">Relationship *</label><input class="form-control" type="text" name="family_details[' +
            get_family_details_counter +
            '][relation_name]"></div>\
                                                                    <div class="col-md-3 form-group"><label for="">Name *</label><input class="form-control" type="text" name="family_details[' +
            get_family_details_counter +
            '][name]"></div>\
                                                                    <div class="col-md-2 form-group"><label for="">Number *</label><input class="form-control" type="text" name="family_details[' +
            get_family_details_counter +
            '][phone]"></div>\
                                                                    <div class="col-md-2 form-group"><label for="">Date of birth *</label><input class="form-control" type="date" name="family_details[' +
            get_family_details_counter +
            '][dob]"></div>\
                                                                    <div class="col-md-2 form-group mt-5"><input type="checkbox" name="family_details[' +
            get_family_details_counter +
            '][nominee]" value="1"> <label for=""> Nominee </label><button onclick="remove_family_details_html(this)" class="btn btn-danger btn-sm float-right"> <i class="fa fa-minus"></i></button></div></div></div>';
        $('#family_details_html').append(family_details_html);
        get_family_details_counter += 1;
    }

    function remove_family_details_html(this_ele,id) {
        if (id != null) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: company_ajax_base_url + '/employee/family/delete/' + id,
                        type: "get",
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            jQuery(this_ele).parent().parent().remove();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        } else {
            jQuery(this_ele).parent().parent().remove();
        }
    }
    /** End Family details create html*/

    jQuery(document).ready(function() {
        jQuery("#family_details_form").validate({
            rules: {},
            messages: {},
            submitHandler: function(form) {
                createFamilyDetails(form);
            }
        });
    });


    function createFamilyDetails(form) {
        var family_details_data = $(form).serialize();
        $.ajax({
            url: "{{ route('employee.family.details') }}",
            type: 'POST',
            data: family_details_data,
            success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                jQuery('.nav-pills a[href="#document_tab"]').tab('show');
                // This variable is used on save all records button
                all_data_saved = true;
            },
            error: function(error_messages) {
                // This variable is used on save all records button
                all_data_saved = false;
                jQuery('.nav-pills a[href="#family_details_tab"]').tab('show');
                for (let [key, value] of Object.entries(error_messages.responseJSON.errors)) {
                    let split_arr = key.split('.');
                    let error_key = 'input[name="' + split_arr[0] +'['+split_arr[1]+']'+'['+split_arr[2]+']"]';
                    $(document).find(error_key).after(
                        '<span class="_error'+split_arr[1]+' text text-danger">' + value[0].replace(split_arr[0]+'.'+split_arr[1]+'.',' ') + '</span>');
                    setTimeout(function() {
                        jQuery('._error'+split_arr[1]).remove();
                    }, 5000);
                }
            }
        });
    }
</script>
