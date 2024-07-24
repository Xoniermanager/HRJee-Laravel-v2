@extends('layouts.employee.main')
@section('content')
@section('title')
    Policy Details
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-md-9">
                <div class="card card-body col-md-12">
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-md-12">
                            <!--begin::Feature post-->
                            <div class="card-xl-stretch">
                                <!--begin::Image-->
                                <img src="{{ $policyDetails->image }}" class="card-rounded img-fluid mb-5">

                                <!--end::Image-->
                                <!--begin::Body-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <a href="#"
                                        class="fs-6 text-dark fw-bold text-hover-primary text-dark lh-base cat-links">{{ $policyDetails->title }}</a>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <div class="fw-semibold fs-5 text-gray-900 text-dark my-4">
                                        <i class="fa fa-calendar-days"></i>
                                        {{ date('j F,Y', strtotime($policyDetails->created_at)) }}
                                    </div>
                                    <!--end::Text-->
                                    <div class="fw-semibold fs-5 text-gray-900 text-dark my-4">
                                        {!! $policyDetails->description !!} </div>

                                </div>
                                <!--end::Body-->

                                <object data="{{ $policyDetails->file }}" type="application/pdf" width="100%"
                                    height="200">
                                </object>
                            </div>
                            <!--end::Feature post-->
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--end::Col-->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5> Category</h5>
                        <button class="btn btn-sm btn-primary">{{ $policyDetails->policyCategories->name }}</button>

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table m-0">
                            <tr>
                                <th>Start Date: </th>
                                <td><button
                                        class="btn btn-sm btn-success">{{ date('j F,Y', strtotime($policyDetails->start_date)) }}</button>
                                </td>
                            </tr>
                            <tr>
                                <th>Expiry Date: </th>
                                <td><button
                                        class="btn btn-sm btn-danger">{{ date('j F,Y', strtotime($policyDetails->end_date)) }}</button>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
