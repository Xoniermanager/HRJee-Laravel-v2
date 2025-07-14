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
    var previous_company_counter = {{ $i ?? 0 }};

    function get_previous_company_html() {
        var previous_company = $('select[name=previous_company_id]').find(':selected').text().trim();
        var previous_company_id = $('select[name=previous_company_id]').val();

        if (!previous_company_id) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please select the previous company"
            });
            return false;
        }

        var exists = false;
        $('.previous_company').each(function() {
            if ($(this).text().trim() === previous_company) {
                exists = true;
            }
        });

        if (!exists) {
            var html = `
                <div class="row">
                    <div class="panel-head">
                        <h5 class="previous_company">${previous_company}</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Designation *</label>
                                <input class="form-control" type="text" name="previous_company[${previous_company_counter}][designation]">
                            </div>
                            <div class="col-md-2 form-group">
                                <label>From *</label>
                                <input class="form-control" type="date" name="previous_company[${previous_company_counter}][from]">
                            </div>
                            <div class="col-md-2 form-group">
                                <label>To *</label>
                                <input class="form-control" type="date" name="previous_company[${previous_company_counter}][to]">
                            </div>
                            <div class="col-md-2 form-group">
                                <label>Duration (In Years) *</label>
                                <input class="form-control" type="text" name="previous_company[${previous_company_counter}][duration]">
                                <input type="hidden" name="previous_company[${previous_company_counter}][previous_company_id]" value="${previous_company_id}">
                            </div>
                            <div class="col-md-2 form-group text-center">
                                <label>Current Company *</label>
                                <p class="mt-2">
                                    <input class="h-20w-100" type="checkbox" name="previous_company[${previous_company_counter}][current_company]" value="1">
                                </p>
                            </div>
                            <div class="col-md-1 form-group text-center mt-5">
                                <button type="button" class="btn btn-danger btn-sm mt-3" onclick="remove_previous_company_html(this)">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;
            $('#previous_company_html').append(html);
            previous_company_counter++;
        }
    }

    function remove_previous_company_html(ele, id = null) {
        if (id) {
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
                        type: "GET",
                        success: function() {
                            Swal.fire("Deleted!", "Successfully removed!", "success");
                            $(ele).closest('.row').remove();
                        },
                        error: function() {
                            Swal.fire("Error!", "Please try again.", "error");
                        }
                    });
                }
            });
        } else {
            $(ele).closest('.row').remove();
        }
    }

    $(document).ready(function() {
        $("#past_work_details").validate({
            // Add static rules here if needed
            submitHandler: function(form) {
                createPastWorkDetails(form);
            }
        });
    });

    function createPastWorkDetails(form) {
        var data = $(form).serialize();

        // Clear old errors
        $('._error').remove();

        $.ajax({
            url: "{{ route('employee.past.work.details') }}",
            type: "POST",
            data: data,
            success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('.nav-pills a[href="#family_details_tab"]').tab('show');
                all_data_saved = true;
            },
            error: function(error) {
                all_data_saved = false;
                $('.nav-pills a[href="#past_work_tab"]').tab('show');

                if (error.responseJSON && error.responseJSON.errors) {
                    $.each(error.responseJSON.errors, function(key, messages) {
                        // Example key: previous_company.0.designation
                        var parts = key.split('.');
                        var fieldName = parts[0] + '[' + parts[1] + ']' + '[' + parts[2] + ']';
                        var input = $('[name="' + fieldName + '"]');

                        if (input.length) {
                            input.after('<span class="_error text-danger">' + messages[0] + '</span>');
                        }
                    });

                    // Remove errors after 3s
                    setTimeout(() => { $('._error').remove(); }, 3000);
                }
            }
        });
    }
</script>
