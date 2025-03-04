<div class="tab-pane fade" id="past_work_tab">
    <!--begin::Wrapper-->
    <form id="past_work_details">
        @csrf
        <input type="hidden" name="user_id" value="{{ $singleUserDetails->id ?? ''}}">
        <div class="row">
            <div class="col-md-4 form-group">
                <div class="k-w-300 old_company">
                    <label for="previous_company_id">Previous Company*</label>
                    <select id="previous_company_id" class="form-control" name="previous_company_id"></select>
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
                <label class="mt-3"> <a class="btn btn-primary btn-sm mt-5" onclick="get_previous_company_html()"> <i
                            class="fa fa-plus"></i></a>
                </label>
            </div>
            @php
                $i = 0;
            @endphp
            <div class="col-md-12 form-group">
                <div class="panel" id="previous_company_html">
                </div>
                @foreach ($userpastWorkDetails as $pastWorkDetail)
                    <div class="row">
                        <div class="panel-head">
                            <h5 class="previous_company">{{ $pastWorkDetail->previousCompanies->name }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="">Designation *</label>
                                    <input class="form-control" type="text"
                                        name="previous_company[{{ $i }}][designation]"
                                        value="{{ $pastWorkDetail->designation }}">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="">From *</label><input class="form-control" type="date"
                                        name="previous_company[{{ $i }}][from]"
                                        value="{{ $pastWorkDetail->from }}">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="">To *</label><input class="form-control" type="date"
                                        name="previous_company[{{ $i }}][to]"
                                        value="{{ $pastWorkDetail->to }}">
                                </div>
                                <div class="col-md-2 form-group"><label for="">Duration (In Years) *</label>
                                    <input class="form-control" type="text"
                                        name="previous_company[{{ $i }}][duration]"
                                        value="{{ $pastWorkDetail->duration }}">
                                    <input class="form-control" type="hidden"
                                        name="previous_company[{{ $i }}][previous_company_id]"
                                        value="{{ $pastWorkDetail->previous_company_id }}">
                                </div>
                                <div class="col-md-2 form-group text-center"><label for="">Current Company
                                        *</label>
                                    <p class="mt-2">
                                        <input class="h-20w-100" type="checkbox" name="[current_company]"
                                            {{ $pastWorkDetail->current_company == 1 ? 'checked' : '' }}>
                                    </p>
                                </div>
                                <div class="col-md-1 form-group text-center mt-5">
                                    <button class="btn btn-danger btn-sm mt-3"
                                        onclick="remove_previous_company_html(this,{{$pastWorkDetail->previous_company_id}})"> <i
                                            class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </div>

        </div>
        <div class="m-auto text-center">
        <button class="btn btn-primary">Save & Continue</button>
        </div>
    </form>
    <button onclick="show_next_tab('qualification_tab')" class="tab-btn-inline btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('family_details_tab')" class="tab-btn-inline btnnext btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
    <!--end::Wrapper-->
</div>
<script>
    /** Previous Company HTML*/
    var previous_company_counter = {{ $i }};

    function get_previous_company_html() {
        var previous_company = $('select[name=previous_company_id]').find(':selected').text().trim();
        var previous_company_id = $('select[name=previous_company_id]').find(':selected').val();
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
                        <div class="col-md-2 form-group text-center"><label for="">Current Company *</label><p class="mt-2"><input class="h-20w-100" type="checkbox" name="[' +
                    previous_company_counter +
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

    function remove_previous_company_html(ele,id = null) {
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
                        url: company_ajax_base_url + '/employee/past/work/delete/' + id,
                        type: "get",
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            jQuery(ele).parent().parent().parent().parent().remove();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        } else {
            jQuery(ele).parent().parent().parent().parent().remove();
        }
    }

    /** end Previous Company HTML*/

    jQuery(document).ready(function() {
        jQuery("#past_work_details").validate({
            rules: {},
            messages: {},
            submitHandler: function(form) {
                createPastWorkDetails(form);
            }
        });
    });

    function createPastWorkDetails(form) {
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
                jQuery('.nav-pills a[href="#family_details_tab"]').tab('show');
                // This variable is used on save all records button
                all_data_saved = true;
            },
            error: function(error_messages) {
                // This variable is used on save all records button
                all_data_saved = false;
                jQuery('.nav-pills a[href="#past_work_tab"]').tab('show');
                for (let [key, value] of Object.entries(error_messages.responseJSON.errors)) {
                    let split_arr = key.split('.');
                    let error_key = 'input[name="' + split_arr[0] +'['+split_arr[1]+']'+'['+split_arr[2]+']"]';
                    $(document).find(error_key).after(
                        '<span class="_error'+split_arr[1]+' text text-danger">' + value[0].replace(split_arr[0]+'.'+split_arr[1]+'.',' ') + '</span>');
                    setTimeout(function() {
                        jQuery('._error'+split_arr[1]).remove();
                    }, 3000);
                }
            }
        });
    }
</script>
