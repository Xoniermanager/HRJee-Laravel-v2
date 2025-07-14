<div class="tab-pane fade" id="qualification_tab">
    <!--begin::Wrapper-->
    <form id="qualification_details_form">
        @csrf
        <input type="hidden" name="user_id" class="id" value="{{$singleUserDetails->id ?? ''}}">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="">Degree*</label>
                <select class="form-control" onchange="get_qualification_html()" name="qualification_id"
                    id="qualification_id">
                    <option value="">Select The Qualification</option>
                    @forelse ($allQualification as $qualificationDetails)
                    <option value="{{ $qualificationDetails->id }}">
                        {{ $qualificationDetails->name }}</option>
                    @empty
                    <option value="">No Qualification Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-12 form-group">
                <div class="panel" id="qualification_html">
                    @php
                    $i = 0;
                    @endphp
                    @foreach ($userQualificationDetails as $userQualificationDetail)
                    <div class="row">
                        <div class="panel-head">
                            <h5 class="degree_name">{{ $userQualificationDetail->qualification->name }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 form-group"><label for="">Institute/College
                                        *</label><input class="form-control" type="text"
                                        name="degree[{{ $i }}][institute]"
                                        value="{{ $userQualificationDetail->institute }}"></div>
                                <div class="col-md-3 form-group"><label for="">University *</label><input
                                        class="form-control" type="text" name="degree[{{ $i }}][university]"
                                        value="{{ $userQualificationDetail->university }}"></div>
                                <div class="col-md-3 form-group"><label for="">Course *</label><input
                                        class="form-control" type="text" name="degree[{{ $i }}][course]"
                                        value="{{ $userQualificationDetail->course }}"></div>
                                <div class="col-md-1 form-group"><label for="">Year *</label><input class="form-control"
                                        type="text" name="degree[{{ $i }}][year]"
                                        value="{{ $userQualificationDetail->year }}"></div>
                                <div class="col-md-1 form-group"><label for="">Percentage*</label><input
                                        class="form-control" type="text" name="degree[{{ $i }}][percentage]"
                                        value="{{ $userQualificationDetail->percentage }}">
                                    <input class="form-control" type="hidden" name="degree[{{ $i }}][qualification_id]"
                                        value="{{ $userQualificationDetail->qualification_id }}">
                                </div>
                                <div class="col-md-1 form-group text-center mt-5"><button
                                        class="btn btn-danger btn-sm mt-3"
                                        onclick="remove_qualification_html(this,'{{ $userQualificationDetail->qualification_id }}')">
                                        <i class="fa fa-minus"></i></button></div>
                            </div>
                        </div>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="m-auto text-center">
        <button class="btn btn-primary">Save & Continue</button>
        </div>
    </form>
    <button onclick="show_next_tab('bank_details_tab')" class="tab-btn-inline btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('past_work_tab')" class="tab-btn-inline btnnext btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
</div>
    <script>
        var qualification_counter = {{ $i }};
    </script>

    <script>
    jQuery(document).ready(function () {
        var form = jQuery("#qualification_details_form");

        // Initialize validation
        form.validate({
            ignore: [],
            errorClass: 'text-danger',
            submitHandler: function (form) {
                createQualification(form);
            }
        });

        // Add validation to all existing fields initially
        addValidationRules();

        // redefine get_qualification_html to always add validation after adding html
        window.get_qualification_html = function() {
            var degree_name = $('#qualification_id').find(':selected').text().trim();
            var degree_id = $('#qualification_id').find(':selected').val();
            var exist = false;
            jQuery('.degree_name').each(function() {
                if ($(this).text().trim() == degree_name) {
                    exist = true;
                }
            });
            if (!exist && degree_id) {
                var index = qualification_counter;
                var html = `
                <div class="row">
                  <div class="panel-head"><h5 class="degree_name">${degree_name}</h5></div>
                  <div class="panel-body"><div class="row">
                    <div class="col-md-3 form-group">
                      <label>Institute/College *</label>
                      <input class="form-control" type="text" name="degree[${index}][institute]">
                    </div>
                    <div class="col-md-3 form-group">
                      <label>University *</label>
                      <input class="form-control" type="text" name="degree[${index}][university]">
                    </div>
                    <div class="col-md-3 form-group">
                      <label>Course *</label>
                      <input class="form-control" type="text" name="degree[${index}][course]">
                    </div>
                    <div class="col-md-1 form-group">
                      <label>Year *</label>
                      <input class="form-control" type="text" name="degree[${index}][year]">
                    </div>
                    <div class="col-md-1 form-group">
                      <label>Percentage*</label>
                      <input class="form-control" type="text" name="degree[${index}][percentage]">
                      <input type="hidden" name="degree[${index}][qualification_id]" value="${degree_id}">
                    </div>
                    <div class="col-md-1 form-group text-center mt-5">
                      <button type="button" class="btn btn-danger btn-sm mt-3" onclick="remove_qualification_html(this)">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div></div>
                </div>`;
                $('#qualification_html').append(html);
                qualification_counter++;

                // Add validation to these new fields by name
                addValidationRulesForIndex(index);
            }
        }

        window.remove_qualification_html = function(ele, id = null) {
            if (id) {
                event.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.get(company_ajax_base_url + '/employee/qualification/delete/' + id, function () {
                            Swal.fire("Deleted!", "Record removed.", "success");
                            $(ele).closest('.row').remove();
                        }).fail(() => Swal.fire("Error!", "Please try again.", "error"));
                    }
                });
            } else {
                $(ele).closest('.row').remove();
            }
        }

        /** add validation to all existing fields initially **/
        function addValidationRules() {
            $('[name^="degree["]').each(function () {
                var name = $(this).attr('name');
                addRuleByFieldName(name);
            });
        }

        /** add validation to new fields by index **/
        function addValidationRulesForIndex(index) {
            addRuleByFieldName(`degree[${index}][institute]`);
            addRuleByFieldName(`degree[${index}][university]`);
            addRuleByFieldName(`degree[${index}][course]`);
            addRuleByFieldName(`degree[${index}][year]`);
            addRuleByFieldName(`degree[${index}][percentage]`);
        }

        /** core: add validation rules by name **/
        function addRuleByFieldName(name) {
            var field = $('[name="'+name+'"]');
            if (name.includes('[institute]')) {
                field.rules('add', { required: true, messages: { required: "Please enter the institute name" } });
            }
            if (name.includes('[university]')) {
                field.rules('add', { required: true, messages: { required: "Please enter the university name" } });
            }
            if (name.includes('[course]')) {
                field.rules('add', { required: true, messages: { required: "Please enter the course name" } });
            }
            if (name.includes('[year]')) {
                field.rules('add', {
                    required: true, digits: true, minlength:4, maxlength:4,
                    messages: { required:"Enter year", digits:"Must be digits", minlength:"4 digits", maxlength:"4 digits" }
                });
            }
            if (name.includes('[percentage]')) {
                field.rules('add', {
                    required: true, number: true, min:0, max:100,
                    messages: { required:"Enter %", number:"Must be number", min:"Min 0", max:"Max 100" }
                });
            }
        }
    });

    function createQualification(form) {
        $.ajax({
            url: "{{ route('employee.qualification.details') }}",
            type: "POST",
            data: $(form).serialize(),
            success: function(res) {
                Swal.fire({ icon: "success", title: res.message, showConfirmButton:false, timer:1500 });
                jQuery('.nav-pills a[href="#past_work_tab"]').tab('show');
                all_data_saved = true;
            },
            error: function(errors) {
                all_data_saved = false;
                jQuery('.nav-pills a[href="#qualification_tab"]').tab('show');
                $.each(errors.responseJSON.errors, function (key, messages) {
                    var parts = key.split('.');
                    var selector = `input[name="${parts[0]}[${parts[1]}][${parts[2]}]"]`;
                    $(selector).after(`<span class="text-danger _error${parts[1]}">${messages[0]}</span>`);
                    setTimeout(() => { $('.'+ `_error${parts[1]}`).remove(); }, 3000);
                });
            }
        });
    }
    </script>

