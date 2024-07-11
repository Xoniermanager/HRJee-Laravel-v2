@extends('layouts.company.main')
@section('content')
@section('title')
    Announcement Detail
@endsection
<div class="card card-body col-md-12">
    <div class="mb-5 mb-xl-10">
        <div class="card-body">
            {{-- enctype="multipart/form-data" method="post"
                action="{{ route('viewAnnouncementDetails.store') }}" --}}
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                        <!--begin::Table body-->
                        <tbody class="">
                            <tr>
                                <th class="min-w-150px">Title</th>
                                <td>{{ $viewAnnouncementDetails->title }}</td>
                            </tr>
                            <tr>
                                <th>Company Branches</th>
                                <td>
                                    @if ($viewAnnouncementDetails->all_company_branch == 0)
                                        @foreach ($viewAnnouncementDetails->companyBranches as $companyBranch)
                                            <span class="btn btn-primary btn-sm me-1">{{ $companyBranch->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="btn btn-primary btn-sm me-1">All</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td>
                                    @if ($viewAnnouncementDetails->all_department == 0)
                                        @foreach ($viewAnnouncementDetails->departments as $departmentDetails)
                                            <button
                                                class="btn btn-sm btn-primary">{{ $departmentDetails->name }}</button>
                                        @endforeach
                                    @else
                                        <span class="btn btn-primary btn-sm me-1">All</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td>
                                    @if ($viewAnnouncementDetails->all_designation == 0)
                                        @foreach ($viewAnnouncementDetails->designations as $designationDetails)
                                            <button
                                                class="btn btn-sm btn-primary">{{ $designationDetails->name }}</button>
                                        @endforeach
                                    @else
                                        <span class="btn btn-primary btn-sm me-1">All</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Start Date</th>
                                <td><span
                                        class="btn btn-success btn-sm me-1">{{ date('Y-m-d h:i A', strtotime($viewAnnouncementDetails->start_date_time)) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td><span
                                        class="btn btn-danger btn-sm me-1">{{ date('Y-m-d h:i A', strtotime($viewAnnouncementDetails->expires_at)) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td><img src="{{ $viewAnnouncementDetails->image }}" class="news-img" alt="NO Image">
                                </td>
                            </tr>

                            <tr>
                                <th>Description</th>
                                <td> {!! $viewAnnouncementDetails->description !!}</td>
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
