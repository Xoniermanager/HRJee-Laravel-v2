<div class="tab-pane fade" id="qualification_tab">
    <!--begin::Wrapper-->
    <form id="qualification_details_form">
        @csrf
        <input type="hidden" name="user_id" class="id">
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
                                            class="form-control" type="text"
                                            name="degree[{{ $i }}][university]"
                                            value="{{ $userQualificationDetail->university }}"></div>
                                    <div class="col-md-3 form-group"><label for="">Course *</label><input
                                            class="form-control" type="text"
                                            name="degree[{{ $i }}][course]"
                                            value="{{ $userQualificationDetail->course }}"></div>
                                    <div class="col-md-1 form-group"><label for="">Year *</label><input
                                            class="form-control" type="text" name="degree[{{ $i }}][year]"
                                            value="{{ $userQualificationDetail->year }}"></div>
                                    <div class="col-md-1 form-group"><label for="">Percentage*</label><input
                                            class="form-control" type="text"
                                            name="degree[{{ $i }}][percentage]"
                                            value="{{ $userQualificationDetail->percentage }}">
                                        <input class="form-control" type="hidden"
                                            name="degree[{{ $i }}][qualification_id]"
                                            value="{{ $userQualificationDetail->qualification_id }}">
                                    </div>
                                    <div class="col-md-1 form-group text-center mt-5"><button
                                            class="btn btn-danger btn-sm mt-3"
                                            onclick="remove_qualification_html(this)"> <i
                                                class="fa fa-minus"></i></button></div>
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
        <button class="btn btn-primary">Save & Continue</button>
    </form>
    <button onclick="show_next_tab('bank_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button onclick="show_next_tab('past_work_tab')" class="btn btn-primary float-right">Next <i
            class="fa fa-arrow-right"></i> </button>
</div>
<script>
    /** Qualification HTML*/
    var qualification_counter = 0;

    function get_qualification_html() {
        var degree_name = $('#qualification_id').find(':selected').text().trim();
        var degree_id = $('#qualification_id').find(':selected').val();
        var exist = false;
        jQuery('.degree_name').each(function(key, ele) {
            var existing_ele = jQuery(ele).text().trim();
            if (existing_ele == degree_name) {
                exist = true;
            }
        });
        if (exist == false) {
            var qualificationhtml = '<div class="row"><div class="panel-head"><h5 class="degree_name">' + degree_name +
                '</h5></div>\
                                     <div class="panel-body"><div class="row"><div class="col-md-3 form-group"><label for="">Institute/College *</label><input class="form-control" type="text" name="degree[' +
                qualification_counter +
                '][institute]"></div>\
                                     <div class="col-md-3 form-group"><label for="">University *</label><input class="form-control" type="text" name="degree[' +
                qualification_counter +
                '][university]"></div>\
                                     <div class="col-md-3 form-group"><label for="">Course *</label><input class="form-control" type="text" name="degree[' +
                qualification_counter +
                '][course]"></div>\
                                     <div class="col-md-1 form-group"><label for="">Year *</label><input class="form-control" type="text" name="degree[' +
                qualification_counter +
                '][year]"></div>\
                                     <div class="col-md-1 form-group"><label for="">Percentage*</label><input class="form-control" type="text" name="degree[' +
                qualification_counter + '][percentage]">\
                                     <input class="form-control" type="hidden" name="degree[' + qualification_counter +
                '][qualification_id]" value="' + degree_id +
                '"></div>\
                                     <div class="col-md-1 form-group text-center mt-5"><button class="btn btn-danger btn-sm mt-3" onclick="remove_qualification_html(this)"> <i class="fa fa-minus"></i></button></div></div></div></div>';
            $('#qualification_html').append(qualificationhtml);
            qualification_counter += 1;
        }

    }

    function remove_qualification_html(ele) {
        jQuery(ele).parent().parent().parent().parent().remove();
    }

    /** end Qualification HTMl*/

    /** Qualification Details created Ajax*/
    jQuery.noConflict();
    jQuery("#qualification_details_form").validate({
        rules: {
            "degree[][university]": "required",
            "degree[][course]": "required",
            "degree[][year]": "required",
            "degree[][percentage]": "required"
        },
        messages: {
            'degree[][institute]': 'Please Enter the Institute Name',
            'degree[][university]': 'Please Enter the University Name',
            'degree[][course]': 'Please Enter the Course Name',
            'degree[][year]': 'Please Enter the year',
            'degree[][percentage]': 'Please Enter Percentage %'
        },
        submitHandler: function(form) {
            var qualification_details_data = $(form).serialize();
            $.ajax({
                url: "{{ route('employee.qualification.details') }}",
                type: 'POST',
                data: qualification_details_data,
                success: function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    jQuery('.nav-pills a[href="#qualification_tab"]').tab('show');
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
