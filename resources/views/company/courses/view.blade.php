@extends('layouts.company.main')
@section('title', 'View Course Details')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
                    @csrf
                    <div class="card h-md-100">
                        <!--begin::Header-->
                        <div class="card-header p-0 align-items-center">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed align-middle">
                                            <tbody class="text-center">
                                                <tr>
                                                    <th class="w-200px">Title</th>
                                                    <td>{{ $courseDetail->title  }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Department</th>
                                                    <td>{{ $courseDetail->department->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Designation</th>
                                                    <td>{{$courseDetail->designation->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td>{{ $courseDetail->video_type }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Link</th>
                                                    <td> <a href="{{ $courseDetail->video_type == 'pdf' ? $courseDetail->pdf_file : $courseDetail->video_url }}"
                                                            target="_blank">
                                                            {{ $courseDetail->video_type == 'pdf' ? $courseDetail->pdf_file : $courseDetail->video_url }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="mt-5 text-center">All Curriculum Details</h2>
                    @foreach ($courseDetail->curriculums as $key => $item)
                        <div class="col-md-4 mt-4">
                            <div class="card h-md-100 mt-4">
                                <!--begin::Header-->
                                <div class="card-header p-0 align-items-center">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-row-dashed table-row-gray-300 align-middle">
                                                    <tbody>
                                                        <tr>
                                                            <th class="w-200px">Sr No.</th>
                                                            <td>{{$key + 1 }}</td>
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
                                                            <td> <a href="{{ $item->content_type == 'pdf' ? $item->pdf_file : $item->video_url }}"
                                                                    target="_blank">
                                                                    {{ $item->content_type == 'pdf' ? $item->pdf_file : $item->video_url }}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($item->curriculamAssignment) && count($item->curriculamAssignment) > 0)
                                    <h2 class="mt-5 text-center">Assignment Details</h2>
                                    @foreach ($item->curriculamAssignment as $key => $assignementDetails)
                                        {{-- <div class="col-md-6 mt-4"> --}}
                                            <div class="card">
                                                <!--begin::Header-->
                                                <div class="card-header p-0 align-items-center">
                                                    <div class="card-body">
                                                        {{-- {{ dd($allSalaryComponentDetails) }} --}}

                                                        <div class="row">
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
                                                                        <tr>
                                                                            @if(!empty($assignementDetails->getRawOriginal('file')))
                                                                                <th>File</th>
                                                                                <td> <a href="{{ $assignementDetails->file}}" download>
                                                                                        Download
                                                                                    </a>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--
                                        </div> --}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection
