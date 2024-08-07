@extends('layouts.company.main')
@section('content')
@section('title')
    News Details
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="mb-5 mb-xl-10">
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                                <!--begin::Table body-->
                                <tbody class="">
                                    <tr>
                                        <th class="min-w-150px">Title</th>
                                        <td><b>{{ $viewNewsDetails->title }}</b></td>
                                    </tr>
                                    <tr>
                                        <th>Company Branches</th>
                                        <td>
                                            @if ($viewNewsDetails->all_company_branch == 0)
                                                @foreach ($viewNewsDetails->companyBranches as $companyBranch)
                                                    <span
                                                        class="btn btn-primary btn-sm me-1">{{ $companyBranch->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="btn btn-primary btn-sm me-1">All</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Department</th>
                                        <td>
                                            @if ($viewNewsDetails->all_department == 0)
                                                @foreach ($viewNewsDetails->departments as $departmentDetails)
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
                                            @if ($viewNewsDetails->all_designation == 0)
                                                @foreach ($viewNewsDetails->designations as $designationDetails)
                                                    <button
                                                        class="btn btn-sm btn-primary">{{ $designationDetails->name }}</button>
                                                @endforeach
                                            @else
                                                <span class="btn btn-primary btn-sm me-1">All</span>
                                            @endif
                                        </td>       
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td><span
                                                class="btn btn-primary btn-sm me-1">{{ $viewNewsDetails->newsCategories->name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Start Date</th>
                                        <td><span
                                                class="btn btn-success btn-sm me-1">{{ $viewNewsDetails->start_date }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>End Date</th>
                                        <td><span
                                                class="btn btn-danger btn-sm me-1">{{ $viewNewsDetails->end_date }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td><img src="{{ $viewNewsDetails->image }}" class="news-img" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Attachment</th>
                                        <td><object data="{{ $viewNewsDetails->file }}" type="application/pdf"
                                                width="100%" height="200">
                                            </object>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{!! $viewNewsDetails->description !!}</td>
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
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
@endsection
