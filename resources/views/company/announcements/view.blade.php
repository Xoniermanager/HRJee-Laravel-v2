@extends('layouts.company.main')
@section('content')
@section('title')
    Announcements
@endsection
<div class="card card-body col-md-12">
    <div class="card-header p-4">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0"> Announcement Assign Details</h3>
        </div>
        <!--end::Card title-->
    </div>

    <div class="mb-5 mb-xl-10">
        <div class="card-body">
            {{-- enctype="multipart/form-data" method="post"
                action="{{ route('announcement.store') }}" --}}
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                        <!--begin::Table body-->
                        <tbody class="">
                            <tr>
                                <th class="min-w-150px">Title</th>
                                <td>{{ $announcement->title }}</td>
                            </tr>
                            <tr>
                                <th>Branch</th>
                                <td>
                                    @forelse($branches as $row)
                                        <span class="btn btn-primary btn-sm me-1">{{ $row->name }}</span>
                                    @empty
                                        <span class="btn btn-primary btn-sm me-1"></span>
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>


                                    @forelse($departments as $row)
                                        <button class="btn btn-sm btn-primary">{{ $row->name }}</button>
                                    @empty
                                        <button class="btn btn-sm btn-primary"></button>
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td>
                                    @forelse($designations as $row)
                                        <button class="btn btn-sm btn-primary">{{ $row->name }}</button>
                                    @empty
                                        <button class="btn btn-sm btn-primary"></button>
                                    @endforelse

                                </td>
                            </tr>
                            <tr>
                                <th>Start Date</th>
                                <td><span class="btn btn-success btn-sm me-1">{{date('Y-m-d h:i A', strtotime($announcement->start_date_time))}}</span></td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td><span class="btn btn-danger btn-sm me-1">{{date('Y-m-d h:i A', strtotime($announcement->expires_at))}}</span></td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td><img src="{{$announcement->announcement_image}}" class="news-img" alt=""></td>
                            </tr>
                         
                            <tr>
                                <th>Description</th>
                                <td> {{$announcement->description}}</td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->

            </div>

        </div>
    </div>
</div>
<!--end::Content-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
@endsection
