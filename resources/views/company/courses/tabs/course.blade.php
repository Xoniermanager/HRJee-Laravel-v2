<div class="tab-pane fade show active" id="basic_Details_tab">
    <!--begin::Wrapper-->
    <form id="course_details_form">
        @csrf
        <input type="hidden" id="" name="id" value="{{ $course->id ?? '' }}">

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="">Title *</label>
                <input class="form-control" type="text" name="title" value="{{ $course->title ?? '' }}">
            </div>

            <div class="col-md-6 form-group">
                <label for="">Department*</label>
                <select class="form-control" name="department_id" id="department_id">
                    <option value="">Select The Department</option>
                    @forelse ($alldepartmentDetails as $department)
                        <option value="{{ $department->id }}"
                            {{ $editDetails && $course->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}</option>
                    @empty
                        <option value="">No Department Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="">Designation *</label>
                <select class="form-control" id="designation_id" name="designation_id">
                </select>
            </div>

            <div class="col-md-6 form-group">
                <label for="">Type *</label>
                <select class="form-control" name="video_type" id="video_type" onchange="toggleVideoInput()">
                    <option value="pdf" {{ $editDetails && $course->video_type == 'pdf' ? 'selected' : '' }}>PDF
                    </option>
                    <option value="youtube" {{ $editDetails && $course->video_type == 'youtube' ? 'selected' : '' }}>
                        Youtube Link/Vimeo Link</option>
                    {{-- <option value="youtube">YouTube</option>
                    <option value="vimeo">Vimeo</option> --}}
                </select>
            </div>

            <div class="col-md-6 form-group">
                <div id="videoFileDiv"
                    style="display: {{ isset($course) ? ($course->video_type == 'pdf' ? 'block' : 'none') : 'block' }};">
                    <label>Upload PDF:</label>
                    <input class="form-control" type="file" name="pdf_file" accept="application/pdf">
                </div>

                <div id="videoUrlDiv"
                    style="display: {{ isset($course) ? ($course->video_type == 'youtube' ? 'block' : 'none') : 'none' }};">
                    <label>Enter Video URL:</label>
                    <input class="form-control" type="url" name="video_url"
                        value="{{ $editDetails && $course->video_type == 'youtube' ? $course->video_url : '' }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Description *</label>
                    <textarea class="form-control" id="description_editor" name="description" rows="20" cols="20">{!! $editDetails && $course->description ? $course->description : '' !!}</textarea>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" id="submit">Save & Continue</button>
    </form>
</div>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description_editor', {
        height: 200,
        width: 1000,
        removeButtons: 'PasteFromWord'
    });

    function createBasicDetails(form) {
        var basic_details_Data = new FormData(form);
        $.ajax({
            url: "{{ route('course.store') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: basic_details_Data,
            success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                jQuery('.nav-pills a[href="#curriculum_details_tab"]').tab('show');
            },
            error: function(error_messages) {
                console.log("errr => ", error_messages, error_messages.responseJSON)
                let errors = error_messages.responseJSON.errors;
                for (var error_key in errors) {
                    $(document).find('[name=' + error_key + ']').after(
                        '<span class="' + error_key + '_error text text-danger">' + errors[error_key] +
                        '</span>'
                    );
                    setTimeout(function() {
                        jQuery("." + error_key + "_error").remove();
                    }, 8000);
                }
            }
        });
    }
</script>
<script>
    function toggleVideoInput() {
        const type = document.getElementById("video_type").value;
        document.getElementById("videoFileDiv").style.display = (type === "pdf") ? "block" : "none";
        document.getElementById("videoUrlDiv").style.display = (type === "pdf") ? "none" : "block";
    }
    jQuery(document).ready(function() {
        var departmentId = '{{ $course->department_id ?? '' }}';
        const all_department_id = [departmentId];
        var designation_id = '{{ $course->designation_id ?? '' }}';
        get_all_designation_using_department_id(all_department_id, designation_id);
    });

    /** get all Designation Using Department Id*/
    jQuery('#department_id').on('change', function() {
        var department_id = $(this).val();
        const all_department_id = [department_id];
        get_all_designation_using_department_id(all_department_id);
    });

    function get_all_designation_using_department_id(all_department_id, designationId = '') {
        if (all_department_id) {
            $.ajax({
                url: "{{ route('get.all.designation') }}",
                type: "GET",
                dataType: "json",
                data: {
                    'department_id': all_department_id
                },
                success: function(response) {
                    var select = $('#designation_id');
                    select.empty();
                    if (response.status == true) {
                        $('#designation_id').append(
                            '<option>Select The Designation</option>');
                        $.each(response.data, function(key, value) {
                            select.append('<option ' + ((designationId == value.id) ? "selected" :
                                "") + ' value=' + value.id + '>' + value.name + '</option>');
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
                        text: "Something Went Wrong!! Please try Again"
                    });
                    return false;
                }
            });
        } else {
            $('#designation_id').empty();
        }

    }
    /** end get all Designation Using Department Id*/
</script>
