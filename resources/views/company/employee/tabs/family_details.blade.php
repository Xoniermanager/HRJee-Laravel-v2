<div class="tab-pane fade" id="family_details_tab">
    <!--begin::Wrapper-->
    <form id="family_details_form">
        @csrf
        <input type="hidden" name="user_id" class="id">
        <div class="row align-items-center panel panel-body mb-3">
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
                <button class="btn btn-primary btn-sm float-right p2px" onclick="get_family_details_html()"><i
                        class="fa fa-plus btn btn-primary btn-sm float-right" style="line-height: 0.5;"></i></button>
            </div>
        </div>
        <div id="family_details_html" class="">

        </div>
        <button class="btn btn-primary">Save & Continue</button>
    </form>
    <!--end::Wrapper-->
    <button onclick="show_next_tab('permission_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('asset_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i>
    </button>
</div>
    <script>
        /** Family details create html*/

        var get_family_details_counter = 1;
        function get_family_details_html() {
            var family_details_html =
                '<div class=""><div class="row panel panel-body mb-3"><div class="col-md-3 form-group"><label for="">Relationship *</label><input class="form-control" type="text" name="family_details['+get_family_details_counter+'][relation_name]"></div>\
                                                                    <div class="col-md-3 form-group"><label for="">Name *</label><input class="form-control" type="text" name="family_details['+get_family_details_counter+'][name]"></div>\
                                                                    <div class="col-md-2 form-group"><label for="">Number *</label><input class="form-control" type="text" name="family_details['+get_family_details_counter+'][phone]"></div>\
                                                                    <div class="col-md-2 form-group"><label for="">Date of birth *</label><input class="form-control" type="date" name="family_details['+get_family_details_counter+'][dob]"></div>\
                                                                    <div class="col-md-2 form-group mt-5"><input type="checkbox" name="family_details['+get_family_details_counter+'][nominee]" value="1"> <label for=""> Nominee </label><button onclick="remove_family_details_html(this)" class="btn btn-danger btn-sm float-right"> <i class="fa fa-minus"></i></button></div></div></div>';
            $('#family_details_html').append(family_details_html);
            get_family_details_counter +=1;
        }

        function remove_family_details_html(this_ele) {
            jQuery(this_ele).parent().parent().remove();
        }
        /** End Family details create html*/

        jQuery.noConflict();
        jQuery("#family_details_form").validate({
            rules: {},
            messages: {},
            submitHandler: function(form) {
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
                        jQuery('.nav-pills a[href="#asset_tab"]').tab('show');
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
                            }, 3000);
                        }
                    }
                });
            }
        });
    </script>
