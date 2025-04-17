<div class="tab-pane fade" id="curriculum_details_tab">
    <!--begin::Wrapper-->
    <form id="course_details_form" action="{{ route('curriculum.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" id="course_id" name="course_id" value="{{ $course->id ?? '' }}">
        @php
            $i = 0;
            $assignmentCount = 0;
        @endphp
        @if (isset($course->curriculums) && count($course->curriculums) > 0)
            @foreach ($course->curriculums as $item)
                <div id="courseContainer">
                    <div class="row course-row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-danger remove-course btn-sm float-right">
                                <i class="fa fa-minus"></i>
                        </div>
                        </button>
                        <div class="col-md-4 form-group">
                            <label>Title *</label>
                            <input class="form-control" type="text" name="curriculum_details[{{ $i }}][title]"
                                value="{{ $item->title }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Instructor *</label>
                            <input class="form-control" type="text" name="curriculum_details[{{ $i }}][instructor]"
                                value="{{ $item->instructor }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Short Description *</label>
                            <input class="form-control" type="text" name="curriculum_details[{{ $i }}][short_description]"
                                value="{{ $item->short_description }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Content Type *</label>
                            <select class="form-control content_type" name="curriculum_details[{{ $i }}][content_type]"
                                onchange="toggleCirVideoInput(this,{{ $i }})">
                                <option value="pdf" {{  $item->content_type == 'pdf' ? 'selected' : ''}}>PDF</option>
                                <option value="youtube" {{  $item->content_type == 'youtube' ? 'selected' : ''}}>Youtube Link/Vimeo
                                    Link</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <div id="cir_videoFileDiv_{{ $i }}"
                                style="display: {{ $item->content_type == 'pdf' ? 'block' : 'none'}};">
                                <label>Upload PDF:</label>
                                <input class="form-control" type="file" name="curriculum_details[{{ $i }}][pdf_file]"
                                    accept="application/pdf">
                            </div>
                            <div id="cir_videoUrlDiv_{{ $i }}"
                                style="display: {{ $item->content_type == 'youtube' ? 'block' : 'none'}};">
                                <label>Enter Video URL:</label>
                                <input class="form-control" type="url" name="curriculum_details[{{ $i }}][video_url]"
                                    value="{{ $item->video_url }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex align-items-center">
                                <label class="form-check form-check-inline">
                                    <input type="hidden" name="curriculum_details[{{ $i }}][has_assignment]" value="0">
                                    <input class="form-check-input toggleCheckbox" type="checkbox"
                                        name="curriculum_details[{{ $i }}][has_assignment]" value="1" {{ $item->has_assignment == '1' ? 'checked' : ''}}>
                                    <span class="fw-semibold ps-2 fs-6">Add Assignment</span>
                                </label>
                            </div>
                            <div class="assignmentContainer"
                                style="display: {{ $item->has_assignment == '1' ? 'block' : 'none'}};">
                                @if(isset($item->curriculamAssignment) && count($item->curriculamAssignment) > 0)
                                            @foreach ($item->curriculamAssignment as $assignmentDetails)
                                                        <div id="assignment_{{$assignmentCount}}">
                                                            <div class="assignmentDiv mt-3">
                                                                <div class="float-right">
                                                                    @if($loop->first)
                                                                    <button type="button" class="btn btn-success btn-sm addAssignment"
                                                                    onclick="getAssignementHtml({{ $i }},{{ $assignmentCount }})">+</button>
                                                                    @else
                                                                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-assignment"><i class="fa fa-minus"></i></button>
                                                                    @endif

                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Write your question *</label>
                                                                    <input class="form-control" type="text"
                                                                        name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][question]"
                                                                        value="{{ $assignmentDetails->question }}">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3 form-group">
                                                                        <label>Write option 1 *</label>
                                                                        <input class="form-control" type="text"
                                                                            name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][option1]"
                                                                            value="{{ $assignmentDetails->option1 }}">
                                                                    </div>
                                                                    <div class="col-md-3 form-group">
                                                                        <label>Write option 2 *</label>
                                                                        <input class="form-control" type="text"
                                                                            name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount}}][option2]"
                                                                            value="{{ $assignmentDetails->option2 }}">
                                                                    </div>
                                                                    <div class="col-md-3 form-group">
                                                                        <label>Write option 3 *</label>
                                                                        <input class="form-control" type="text"
                                                                            name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][option3]"
                                                                            value="{{ $assignmentDetails->option3 }}">
                                                                    </div>
                                                                    <div class="col-md-3 form-group">
                                                                        <label>Write option 4 *</label>
                                                                        <input class="form-control" type="text"
                                                                            name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount}}][option4]"
                                                                            value="{{ $assignmentDetails->option4 }}">
                                                                    </div>
                                                                    <div class="col-md-12 form-group">
                                                                        <label>Upload File (Optional)</label>
                                                                        <input class="form-control" type="file"
                                                                            name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][file]"
                                                                            value="{{ $assignmentDetails->file }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $assignmentCount++;
                                                        @endphp
                                            @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
            <div class="row">
                <div class="col-md-12 m-4">
                    <span class="float-right"> <button type="button" class="btn btn-success add-course btn-sm">+ Add More
                            Curriculum</button></span>
                </div>
            </div>
        @else
            <div id="courseContainer">
                <div class="row course-row">
                    <div class="col-md-12">
                        <span class="float-right"> <button type="button"
                                class="btn btn-success add-course btn-sm">+</button></span>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Title *</label>
                        <input class="form-control" type="text" name="curriculum_details[{{ $i }}][title]" value="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Instructor *</label>
                        <input class="form-control" type="text" name="curriculum_details[{{ $i }}][instructor]" value="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Short Description *</label>
                        <input class="form-control" type="text" name="curriculum_details[{{ $i }}][short_description]"
                            value="">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Content Type *</label>
                        <select class="form-control content_type" name="curriculum_details[{{ $i }}][content_type]"
                            onchange="toggleCirVideoInput(this,{{ $i }})">
                            <option value="pdf">PDF</option>
                            <option value="youtube">Youtube Link/Vimeo Link</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <div id="cir_videoFileDiv_{{ $i }}">
                            <label>Upload PDF:</label>
                            <input class="form-control" type="file" name="curriculum_details[{{ $i }}][pdf_file]"
                                accept="application/pdf">
                        </div>
                        <div id="cir_videoUrlDiv_{{ $i }}" style="display:none;">
                            <label>Enter Video URL:</label>
                            <input class="form-control" type="url" name="curriculum_details[{{ $i }}][video_url]" value="">
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="d-flex align-items-center">
                            <label class="form-check form-check-inline">
                                <input type="hidden" name="curriculum_details[{{ $i }}][has_assignment]" value="0">
                                <input class="form-check-input toggleCheckbox" type="checkbox"
                                    name="curriculum_details[{{ $i }}][has_assignment]" value="1">
                                <span class="fw-semibold ps-2 fs-6">Add Assignment</span>
                            </label>
                        </div>
                        <div class="assignmentContainer" style="display: none;">
                            <div id="assignment_{{$assignmentCount}}">
                                <div class="assignmentDiv mt-3">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-success btn-sm addAssignment"
                                            onclick="getAssignementHtml({{ $i }},{{ $assignmentCount }})">+</button>
                                    </div>
                                    <div class="form-group">
                                        <label>Write your question *</label>
                                        <input class="form-control" type="text"
                                            name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][question]">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Write option 1 *</label>
                                            <input class="form-control" type="text"
                                                name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][option1]">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Write option 2 *</label>
                                            <input class="form-control" type="text"
                                                name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][option2]">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Write option 3 *</label>
                                            <input class="form-control" type="text"
                                                name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][option3]">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Write option 4 *</label>
                                            <input class="form-control" type="text"
                                                name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][option4]">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Upload File (Optional)</label>
                                            <input class="form-control" type="file"
                                                name="curriculum_details[{{ $i }}][assignment][{{ $assignmentCount }}][file]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div id="html_output"></div>
        <button class="btn btn-primary" id="submit">Save & Continue</button>
    </form>
</div>
<script>
    function toggleCirVideoInput(ele, index) {
        const type = ele.value;
        if (type == 'pdf') {
            $('#cir_videoFileDiv_' + index).show();
            $('#cir_videoUrlDiv_' + index).hide();
        } else {
            $('#cir_videoFileDiv_' + index).hide();
            $('#cir_videoUrlDiv_' + index).show();
        }
    }
</script>
<script>
    var i = {{ $i + 1 }};
    var assignmentCount = {{ $assignmentCount+1 }};
    $(document).ready(function () {
        // Add new course row
        $(document).on("click", ".add-course", function () {
            let newRow = `
        <div class="row course-row">
            <div class="col-md-12 mt-2">
                <button type="button" class="btn btn-danger remove-course btn-sm float-right">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <div class="col-md-4 form-group">
                <label>Title *</label>
                <input class="form-control" type="text" name="curriculum_details[${i}][title]">
            </div>
            <div class="col-md-4 form-group">
                <label>Instructor *</label>
                <input class="form-control" type="text" name="curriculum_details[${i}][instructor]">
            </div>
            <div class="col-md-4 form-group">
                <label>Short Description *</label>
                <input class="form-control" type="text" name="curriculum_details[${i}][short_description]">
            </div>
            <div class="col-md-6 form-group">
                <label>Content Type *</label>
                <select class="form-control content_type" name="curriculum_details[${i}][content_type]" onchange="toggleCirVideoInput(this,${i})">
                    <option value="pdf">PDF</option>
                    <option value="youtube">Youtube/Vimeo</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                        <div id="cir_videoFileDiv_${i}">
                            <label>Upload PDF:</label>
                            <input class="form-control" type="file" name="curriculum_details[${i}][pdf_file]" accept="application/pdf">
                        </div>
                        <div id="cir_videoUrlDiv_${i}" style="display:none;">
                            <label>Enter Video URL:</label>
                            <input class="form-control" type="url" name="curriculum_details[${i}][video_url]" value="">
                        </div>
                    </div>
            <div class="d-flex align-items-center">
                <label class="form-check form-check-inline">
                    <input type="hidden" name="curriculum_details[${i}][has_assignment]" value="0">
                    <input class="form-check-input toggleCheckbox" type="checkbox" name="curriculum_details[${i}][has_assignment]" value="1">
                    <span class="fw-semibold ps-2 fs-6">Add Assignment</span>
                </label>
            </div>
            <div class="assignmentContainer" style="display: none;">
                <div class="assignmentDiv mt-3">
                    <div class="float-right">
                        <button type="button" class="btn btn-success btn-sm addAssignment"  onclick="getAssignementHtml({{ $i }},{{ $assignmentCount }})">+</button>
                    </div>
                    <div class="form-group">
                        <label>Write your question *</label>
                        <input class="form-control" type="text" name="curriculum_details[${i}][assignment][${assignmentCount}][question]">
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Write option 1 *</label>
                            <input class="form-control" type="text" name="curriculum_details[${i}][assignment][${assignmentCount}][option1]">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Write option 2 *</label>
                            <input class="form-control" type="text" name="curriculum_details[${i}][assignment][${assignmentCount}][option2]">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Write option 3 *</label>
                            <input class="form-control" type="text" name="curriculum_details[${i}][assignment][${assignmentCount}][option3]">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Write option 4 *</label>
                            <input class="form-control" type="text" name="curriculum_details[${i}][assignment][${assignmentCount}][option4]">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Upload File (Optional)</label>
                            <input class="form-control" type="file" name="curriculum_details[${i}][assignment][${assignmentCount}][file]">
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
            $("#html_output").append(newRow);
            i++;
        });
        // Remove course row
        $(document).on("click", ".remove-course", function () {
            $(this).closest(".course-row").remove();
        });

        // Toggle video input based on content type
        $(document).on("change", ".content_type", function () {
            let parent = $(this).closest(".course-row").find(".video-container");
            let isPdf = $(this).val() === "pdf";
            parent.find(".pdf-input, .pdf-label").toggle(isPdf);
            parent.find(".url-input, .url-label").toggle(!isPdf);
        });

        // Toggle assignment section within its respective course
        $(document).on("change", ".toggleCheckbox", function () {
            let assignmentContainer = $(this).closest(".course-row").find(".assignmentContainer");
            assignmentContainer.toggle($(this).prop("checked"));
        });

        // // Clone assignmentDiv within its respective course row
        // $(document).on("click", ".addAssignment", function () {
        //     let assignmentContainer = $(this).closest(".assignmentContainer");
        //     let originalAssignment = $(this).closest(".assignmentDiv");
        //     let clonedAssignment = originalAssignment.clone();

        //     // Clear input values
        //     clonedAssignment.find("input").val("");

        //     // Remove any existing remove buttons to prevent duplication
        //     clonedAssignment.find(".remove-assignment").remove();

        //     // Append a fresh "Remove" button
        //     clonedAssignment.append(
        //         '<button type="button" class="btn btn-danger btn-sm mt-2 remove-assignment"><i class="fa fa-minus"></i></button>'
        //     );

        //     // Append the cloned assignment within the correct container
        //     assignmentContainer.append(clonedAssignment);
        // });
        // Remove cloned assignment
        $(document).on("click", ".remove-assignment", function () {
            $(this).closest(".assignmentDiv").remove();
        });
    });
    function getAssignementHtml(curriculumCount, index) {
        let assignmentHtml = '';
        assignmentHtml = `<div class="assignmentContainer"><div class="assignmentDiv mt-3"><div class="float-right">
                                                <button type="button" class="btn btn-danger btn-sm mt-2 remove-assignment"><i class="fa fa-minus"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <label>Write your question *</label>
                                                <input class="form-control" type="text"
                                                    name="curriculum_details[${curriculumCount}][assignment][${assignmentCount}][question]" value="">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 form-group">
                                                    <label>Write option 1 *</label>
                                                    <input class="form-control" type="text"
                                                        name="curriculum_details[${curriculumCount}][assignment][${assignmentCount}][option1]"
                                                        value="">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label>Write option 2 *</label>
                                                    <input class="form-control" type="text"
                                                        name="curriculum_details[${curriculumCount}][assignment][${assignmentCount}][option2]"
                                                        value="">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label>Write option 3 *</label>
                                                    <input class="form-control" type="text"
                                                        name="curriculum_details[${curriculumCount}][assignment][${assignmentCount}][option3]"
                                                        value="">
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label>Write option 4 *</label>
                                                    <input class="form-control" type="text"
                                                        name="curriculum_details[${curriculumCount}][assignment][${assignmentCount}][option4]"
                                                        value="">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Upload File (Optional)</label>
                                                    <input class="form-control" type="file"
                                                        name="curriculum_details[${curriculumCount}][assignment][${assignmentCount}][file]"
                                                        value="">
                                                </div>
                                            </div></div></div>
                                        `;
        $('#assignment_' + index).append(assignmentHtml);
        assignmentCount++;
    }
</script>
