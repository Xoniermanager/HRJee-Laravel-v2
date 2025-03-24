@extends('layouts.employee.main')

@section('title', 'Course Details')

@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-md-9">
                <div class="card card-body col-md-12">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-row-dashed align-middle">
                                <tbody class="text-center">
                                    <!-- Course Details -->
                                    <tr>
                                        <th class="w-200px">Title</th>
                                        <td>{{ $courseDetails->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{ $courseDetails->video_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Link</th>
                                        <td>
                                            <a href="{{ $courseDetails->video_type == 'pdf' ? $courseDetails->pdf_file : $courseDetails->video_url }}" target="_blank">
                                                {{ $courseDetails->video_type == 'pdf' ? $courseDetails->pdf_file : $courseDetails->video_url }}
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h2 class="mt-5 text-center">All Curriculum Details</h2>
                    @foreach ($courseDetails->curriculums as $key => $item)
                        <div class="col-md-12 mt-4">
                            <div class="card h-md-100 mt-4">
                                <div class="card-header p-0 align-items-center">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-row-dashed table-row-gray-300 align-middle">
                                                <tbody>
                                                    <tr>
                                                        <th class="w-200px">Sr No.</th>
                                                        <td>{{ $key + 1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="w-200px">Title</th>
                                                        <td>{{ $item->title }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Instructor</th>
                                                        <td>{{ $item->instructor }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Short Description</th>
                                                        <td>{{ $item->short_description }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Content Type</th>
                                                        <td>{{ $item->content_type }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Link</th>
                                                        <td>
                                                            <a href="{{ $item->content_type == 'pdf' ? $item->pdf_file : $item->video_url }}" target="_blank">
                                                                {{ $item->content_type == 'pdf' ? $item->pdf_file : $item->video_url }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                @if (isset($item->curriculamAssignment) && count($item->curriculamAssignment) > 0)
                                    <h2 class="mt-5 text-center">Assignment Details</h2>
                                    @foreach ($item->curriculamAssignment as $key => $assignementDetails)
                                        <div class="card">
                                            <div class="card-header p-0 align-items-center">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-row-dashed table-row-gray-300 align-middle">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Sr No.</th>
                                                                    <td>Assignment {{ $key + 1 }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="w-200px">Question</th>
                                                                    <td>{{ $assignementDetails->question }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Option 1</th>
                                                                    <td>{{ $assignementDetails->option1 }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Option 2</th>
                                                                    <td>{{ $assignementDetails->option2 }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Option 3</th>
                                                                    <td>{{ $assignementDetails->option3 }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Option 4</th>
                                                                    <td>{{ $assignementDetails->option4 }}</td>
                                                                </tr>
                                                                @if (!empty($assignementDetails->getRawOriginal('file')))
                                                                    <tr>
                                                                        <th>File</th>
                                                                        <td>
                                                                            <a href="{{ $assignementDetails->file }}" download>Download</a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--end::Col-->
        </div>
    </div>
</div>
@endsection
