@extends('layouts.employee.main')

@section('title', 'Course Details')

@section('content')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }
    .card:hover {
        transform: scale(1.02);
    }
    .table th {
        background-color: #f8f9fa;
    }
    .table td {
        text-align: center;
    }
    .heading {
        text-align: center;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 20px;
    }
    .btn-custom {
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        padding: 5px 10px;
    }
</style>
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl d-flex justify-content-center" id="kt_content_container">
        <div class="col-md-10">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h2 class="heading">Course Details</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>Title</th><td>{{ $courseDetails->title }}</td></tr>
                                <tr><th>Type</th><td>{{ $courseDetails->video_type }}</td></tr>
                                <tr>
                                    <th>Link</th>
                                    <td>
                                        <a href="{{ $courseDetails->video_type == 'pdf' ? $courseDetails->pdf_file : $courseDetails->video_url }}"
                                           class="btn btn-custom" target="_blank">View Resource</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <h2 class="heading mt-5">Curriculum Details</h2>
            @foreach ($courseDetails->curriculums as $key => $item)
                <div class="card mt-4 p-4">
                    <div class="card-body">
                        <h4 class="text-center text-dark">Module {{ $key + 1 }}: {{ $item->title }}</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr><th>Instructor</th><td>{{ $item->instructor }}</td></tr>
                                    <tr><th>Short Description</th><td>{{ $item->short_description }}</td></tr>
                                    <tr><th>Content Type</th><td>{{ $item->content_type }}</td></tr>
                                    <tr>
                                        <th>Link</th>
                                        <td>
                                            <a href="{{ $item->content_type == 'pdf' ? $item->pdf_file : $item->video_url }}"
                                               class="btn btn-custom" target="_blank">View Content</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if (isset($item->curriculamAssignment) && count($item->curriculamAssignment) > 0)
                    <h3 class="heading mt-4">Assignments</h3>
                    @foreach ($item->curriculamAssignment as $key => $assignementDetails)
                        <div class="card mt-3 p-4">
                            <div class="card-body">
                                <h5 class="text-center text-warning">Assignment {{ $key + 1 }}</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr><th>Question</th><td>{{ $assignementDetails->question }}</td></tr>
                                            <tr><th>Option 1</th><td>{{ $assignementDetails->option1 }}</td></tr>
                                            <tr><th>Option 2</th><td>{{ $assignementDetails->option2 }}</td></tr>
                                            <tr><th>Option 3</th><td>{{ $assignementDetails->option3 }}</td></tr>
                                            <tr><th>Option 4</th><td>{{ $assignementDetails->option4 }}</td></tr>
                                            @if (!empty($assignementDetails->getRawOriginal('file')))
                                                <tr>
                                                    <th>File</th>
                                                    <td>
                                                        <a href="{{ $assignementDetails->file }}" class="btn btn-custom" download>Download</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
