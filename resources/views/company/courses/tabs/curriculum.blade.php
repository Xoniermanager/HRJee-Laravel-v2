<div class="tab-pane fade" id="curriculum_details_tab">
    <!--begin::Wrapper-->
    <form id="course_details_form">
        @csrf
        <input type="hidden" id="" name="course_id" value="{{ $course->id ?? '' }}">

        @if(isset($curriculums) && count($curriculums))

        @else
            
        <div id="courseContainer">
            <div class="row course-row">
                    <div class="col-md-12">                   
                        <span class="float-right"> <button type="button" class="btn btn-success add-course btn-sm">+</button></span>
                    </div> 
                                   
                    <div class="col-md-4 form-group">
                        <label>Title *</label>
                        <input class="form-control" type="text" name="title[]" value="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Instructor *</label>
                        <input class="form-control" type="text" name="instructor[]" value="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Short Description *</label>
                        <input class="form-control" type="text" name="short_description[]" value="">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Content Type *</label>
                        <select class="form-control content_type" name="content_type[]" onchange="toggleVideoInput(this)">
                            <option value="pdf">PDF</option>
                            <option value="youtube">Youtube Link/Vimeo Link</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="videoFileDiv">
                            <label>Upload PDF:</label>
                            <input class="form-control" type="file" name="pdf_file[]" accept="application/pdf">
                        </div>
                        <div class="videoUrlDiv" style="display:none;">
                            <label>Enter Video URL:</label>
                            <input class="form-control" type="url" name="video_url[]" value="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        
                    <div class="d-flex align-items-center">
                    <label class="form-check form-check-inline">
                        <input class="form-check-input toggleCheckbox" type="checkbox">
                        <span class="fw-semibold ps-2 fs-6">Add Assignment</span>
                    </label>
                </div>
                <div class="assignmentContainer" style="display: none;">
                    <div class="assignmentDiv mt-3">
                        <div class="float-right">
                            <button type="button" class="btn btn-success btn-sm addAssignment">+</button>
                        </div>
                        <div class="form-group">
                            <label>Write your question *</label>
                            <input class="form-control" type="text" name="question[]">
                        </div>  
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Write option 1 *</label>
                                <input class="form-control" type="text" name="option1[]">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Write option 2 *</label>
                                <input class="form-control" type="text" name="option2[]">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Write option 3 *</label>
                                <input class="form-control" type="text" name="option3[]">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Write option 4 *</label>
                                <input class="form-control" type="text" name="option4[]">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Upload File (Optional)</label>
                                <input class="form-control" type="file" name="file[]">
                            </div>
                        </div>
                    </div>
                </div>


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

<script>
   $(document).ready(function() {
    // Add new course row
    $(document).on("click", ".add-course", function() {
        let newRow = `
        <div class="row course-row">
            <div class="col-md-12 mt-2">
                <button type="button" class="btn btn-danger remove-course btn-sm float-right">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <div class="col-md-4 form-group">
                <label>Title *</label>
                <input class="form-control" type="text" name="title[]">
            </div>
            <div class="col-md-4 form-group">
                <label>Instructor *</label>
                <input class="form-control" type="text" name="instructor[]">
            </div>
            <div class="col-md-4 form-group">
                <label>Short Description *</label>
                <input class="form-control" type="text" name="short_description[]">
            </div>
            <div class="col-md-6 form-group">
                <label>Content Type *</label>
                <select class="form-control content_type" name="content_type[]">
                    <option value="pdf">PDF</option>
                    <option value="youtube">Youtube/Vimeo</option>
                </select>
            </div>
            <div class="col-md-6 form-group video-container">
                <label class="pdf-label">Upload PDF:</label>
                <input class="form-control pdf-input" type="file" name="pdf_file[]" accept="application/pdf">
                <label class="url-label d-none">Enter Video URL:</label>
                <input class="form-control url-input d-none" type="url" name="video_url[]">
            </div>
            <div class="d-flex align-items-center">
                <label class="form-check form-check-inline">
                    <input class="form-check-input toggleCheckbox" type="checkbox">
                    <span class="fw-semibold ps-2 fs-6">Add Assignment</span>
                </label>
            </div>
            <div class="assignmentContainer" style="display: none;">
                <div class="assignmentDiv mt-3">
                    <div class="float-right">
                        <button type="button" class="btn btn-success btn-sm addAssignment">+</button>
                    </div>
                    <div class="form-group">
                        <label>Write your question *</label>
                        <input class="form-control" type="text" name="question[]">
                    </div>  
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Write option 1 *</label>
                            <input class="form-control" type="text" name="option1[]">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Write option 2 *</label>
                            <input class="form-control" type="text" name="option2[]">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Write option 3 *</label>
                            <input class="form-control" type="text" name="option3[]">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Write option 4 *</label>
                            <input class="form-control" type="text" name="option4[]">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Upload File (Optional)</label>
                            <input class="form-control" type="file" name="file[]">
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $("#courseContainer").append(newRow);
    });

    // Remove course row
    $(document).on("click", ".remove-course", function() {
        $(this).closest(".course-row").remove();
    });

    // Toggle video input based on content type
    $(document).on("change", ".content_type", function() {
        let parent = $(this).closest(".course-row").find(".video-container");
        let isPdf = $(this).val() === "pdf";
        parent.find(".pdf-input, .pdf-label").toggle(isPdf);
        parent.find(".url-input, .url-label").toggle(!isPdf);
    });

    // Toggle assignment section within its respective course
    $(document).on("change", ".toggleCheckbox", function() {
        let assignmentContainer = $(this).closest(".course-row").find(".assignmentContainer");
        assignmentContainer.toggle($(this).prop("checked"));
    });

    // Clone assignmentDiv within its respective course row
    $(document).on("click", ".addAssignment", function() {
        let assignmentContainer = $(this).closest(".assignmentContainer");
        let originalAssignment = $(this).closest(".assignmentDiv");
        let clonedAssignment = originalAssignment.clone();

        // Clear input values
        clonedAssignment.find("input").val("");

        // Remove any existing remove buttons to prevent duplication
        clonedAssignment.find(".remove-assignment").remove();

        // Append a fresh "Remove" button
        clonedAssignment.append('<button type="button" class="btn btn-danger btn-sm mt-2 remove-assignment"><i class="fa fa-minus"></i></button>');

        // Append the cloned assignment within the correct container
        assignmentContainer.append(clonedAssignment);
    });

    // Remove cloned assignment
    $(document).on("click", ".remove-assignment", function() {
        $(this).closest(".assignmentDiv").remove();
    });
});

</script>

