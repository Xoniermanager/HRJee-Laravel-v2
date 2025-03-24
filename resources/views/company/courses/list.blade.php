<div class="table-responsive" id="course_list">
    <!--begin::Table-->
    <table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
        <!--begin::Table head-->
        <thead>
            <tr class="fw-bold">
                <th>Sr. No.</th>
                <th>Title</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Type</th>
                <th>Link</th>
                <th>Status</th>
                <th class="float-right">Action</th>
            </tr>
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        @forelse ($allCourses as $key => $course)
            <tbody class="">
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->department->name }}</td>
                    <td>{{ $course->designation->name }}</td>
                    <td>{{ $course->video_type }}</td>
                    <td><a href="{{ $course->video_type == "pdf" ? $course->pdf_file : $course->video_url }}"
                            target="_blank">{{ $course->video_type == "pdf" ? $course->pdf_file : $course->video_url }}</a>
                    </td>
                    <td data-order="Invalid date">
                        <label class="switch">
                            <input type="checkbox" <?= $course->status == '1' ? 'checked' : '' ?>
                                onchange="handleStatus({{ $course->id }})" id="checked_value_{{$course->id}}">
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="{{ route('course.view', $course->id) }}"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-eye"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="{{ route('course.edit', $course->id) }}"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                onclick="deleteFunction('{{ $course->id }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
        @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Courses Available!</strong>
                    </span>
                </td>
            </tbody>
        @endforelse
        <!--end::Table body-->
    </table>
    {{ $allCourses->links() }}
</div>
