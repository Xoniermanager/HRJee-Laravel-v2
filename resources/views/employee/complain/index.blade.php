@extends('layouts.employee.main')
@section('content')
@section('title')
    Employee Complain
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    {{-- <a href="{{ route('hr_complain.add') }}" class="btn btn-sm btn-primary align-self-center">
                        Add Complain</a> --}}
                    <!--end::Action-->
                </div>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mb-5 mb-xl-10">
                    <div class="">
                        <div class="">
                            <!--begin::Body-->
                            <div class="">
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fw-bold">
                                                    <th>Sr. No.</th>
                                                    <th>Employee Name</th>
                                                    <th>Complain Category</th>
                                                    <th>Description</th>
                                                    <th>Complain Status</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="">
                                                @foreach ($allComplainDetails as $key => $complainDetail)
                                                    <tr>
                                                        <td>{{ $key + 1 }} </td>
                                                        <td>{{ $complainDetail->user->name }} </td>
                                                        <td>{{ $complainDetail->complainCategory->name }}</td>
                                                        <td>{{ $complainDetail->description }}</td>
                                                        <td>{{ $complainDetail->complainStatus->name }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('employee.getComplainDetails', $complainDetail->id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->

                                </div>
                            </div>
                            <!--begin::Body-->

                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection
