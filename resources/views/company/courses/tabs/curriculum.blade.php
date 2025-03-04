<div class="tab-pane fade" id="curriculum_details_tab">
    <!--begin::Wrapper-->
    <form id="course_details_form">
        @csrf
        <input type="hidden" id="" name="course_id" value="{{ $course->id ?? '' }}">

        @if(isset($curriculums) && count($curriculums))

        @else
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="">Title *</label>
                    <input class="form-control" type="text" name="title[]" value="">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Instructor *</label>
                    <input class="form-control" type="text" name="instructor[]" value="">
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Short Description *</label>
                    <input class="form-control" type="text" name="short_description[]" value="">
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Content Type *</label>
                    <select class="form-control" name="content_type[]" id="content_type" onchange="toggleVideoInput()">
                        <option value="pdf">PDF</option>
                        <option value="youtube">Youtube Link/Vimeo Link</option>
                    </select>
                </div>

                <div class="col-md-6 form-group">
                    <div id="videoFileDiv">
                        <label>Upload PDF:</label>
                        <input class="form-control" type="file" name="pdf_file[]" accept="application/pdf">
                    </div>
                    <div id="videoUrlDiv"
                        style="display:none;">
                        <label>Enter Video URL:</label>
                        <input class="form-control" type="url" name="video_url[]" value="">
                    </div>
                </div>
            </div>
        @endif
        <button class="btn btn-primary" id="submit">Save & Continue</button>
    </form>
</div>
<script>

    function createBasicDetails(form) {
        var basic_details_Data = new FormData(form);
        $.ajax({
            url: "{{ route('course.store') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: basic_details_Data,
            success: function(response) {
                console.log("response => ", response)
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
            }
        });
    }
</script>
<script>
    function toggleVideoInput() {
        const type = document.getElementById("content_type").value;
        document.getElementById("videoFileDiv").style.display = (type === "pdf") ? "block" : "none";
        document.getElementById("videoUrlDiv").style.display = (type === "pdf") ? "none" : "block";
    }
    jQuery(document).ready(function() {
    });

    
</script>
