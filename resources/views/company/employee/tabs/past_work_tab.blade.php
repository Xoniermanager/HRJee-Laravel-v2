<div class="tab-pane fade" id="past_work_tab">
    <!--begin::Wrapper-->
    <form id="past_work_details">
        @csrf
        <input type="hidden" name="user_id" class="id" value="2">
        <div class="row">

            <div class="col-md-4 form-group">
                <div class="k-w-300 old_company">
                    <label for="previous_company_id">Previous Company*</label>
                    <input id="previous_company_id" class="form-control"  name="previous_company_id" />
                </div>
                <script id="noPreviousCompanyTemplate" type="text/x-kendo-tmpl">
                    <div>
                        No data found. Do you want to add new item - '#: instance.filterInput.val() #' ?
                    </div>
                    <br />
                    <button class="k-button k-button-solid-base k-button-solid k-button-md k-rounded-md" onclick="addNewPreviousCompany('#: instance.element[0].id #', '#: instance.filterInput.val() #')">Add new item</button>
                </script>
            </div>

            <div class="col-md-4 form-group">
                <label class="mt-3"> <button class="btn btn-primary btn-sm mt-5"
                        onclick="get_previous_company_html()"> <i class="fa fa-plus"></i></button>
                </label>
            </div>
            <div class="col-md-12 form-group">
                <div class="panel" id="previous_company_html">
                </div>

            </div>
        </div>
        <button class="btn btn-primary">Save & Continue</button>
    </form>
    <button onclick="show_next_tab('qualification_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('permission_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
    <!--end::Wrapper-->
</div>
<script>
    /** Previous Company HTML*/
    var previous_company_counter = 0;

    function get_previous_company_html() {

        var previous_company = $('.old_company .k-picker .k-input-value-text').text().trim();
        var previous_company_id = $('previous_company_id').val();

        // var previous_company = $('select[name=previous_company_id]').find(':selected').text().trim();
        // var previous_company_id = $('select[name=previous_company_id]').find(':selected').val();
        var exist = false;
        if (previous_company_id != '') {
            jQuery('.previous_company').each(function(key, ele) {
                var existing_ele = jQuery(ele).text().trim();
                if (existing_ele == previous_company) {
                    exist = true;
                }
            });
            if (exist == false) {
                var previous_company_html = '<div class="row"><div class="panel-head"><h5 class="previous_company">' +
                    previous_company +
                    '</h5></div>\
                        <div class="panel-body"><div class="row"><div class="col-md-3 form-group"><label for="">Designation *</label><input class="form-control" type="text" name="previous_company[' +
                    previous_company_counter +
                    '][designation]"></div>\
                        <div class="col-md-2 form-group"><label for="">From *</label><input class="form-control" type="date" name="previous_company[' +
                    previous_company_counter +
                    '][from]"></div>\
                        <div class="col-md-2 form-group"><label for="">To *</label><input class="form-control" type="date" name="previous_company[' +
                    previous_company_counter +
                    '][to]"></div>\
                        <div class="col-md-2 form-group"><label for="">Duration (In Years) *</label><input class="form-control" type="text" name="previous_company[' +
                    previous_company_counter +
                    '][duration]"><input class="form-control" type="hidden" name="previous_company[' +
                    previous_company_counter + '][previous_company_id]" value="' + previous_company_id +
                    '"></div>\
                        <div class="col-md-2 form-group text-center"><label for="">Current Company *</label><p class="mt-2"><input class="h-20w-100" type="checkbox" name="[' + previous_company_counter +
                    '][current_company]" value="1"></p></div>\
                        <div class="col-md-1 form-group text-center mt-5"><button class="btn btn-danger btn-sm mt-3" onclick="remove_previous_company_html(this)"> <i class="fa fa-minus"></i></button></div></div></div></div>';
                $('#previous_company_html').append(previous_company_html);
                previous_company_counter += 1;

            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please Select the Previous Company"
            });
            return false;
        }

    }

    function remove_previous_company_html(ele) {
        jQuery(ele).parent().parent().parent().parent().remove();
    }

    /** end Previous Company HTML*/

    jQuery.noConflict();
    jQuery("#past_work_details").validate({
        rules: {},
        messages: {},
        submitHandler: function(form) {
            var past_work_details_data = $(form).serialize();
            $.ajax({
                url: "{{ route('employee.past.work.details') }}",
                type: 'POST',
                data: past_work_details_data,
                success: function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    jQuery('.nav-pills a[href="#permission_tab"]').tab('show');
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
