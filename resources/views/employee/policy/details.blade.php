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
                                    <h5>
                                        <span class="category">{{ $policyDetails->policyCategories->name }}</span>
                                        {{ $policyDetails->title }}
                                    </h5>
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
                                <a href="{{ $policyDetails->file }}" download class="btn btn-outline-primary">
                                    <i class="fa fa-download me-1"></i> Download File
                                </a>
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
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5> Recent Policy</h5>
                        </div>
                    </div>
                    <div class="card mb-3 scrollbar-news">
                        <div class="card-body">
                            <table class="table m-0">
                                @foreach ($allAssignPolicyDetails as $allPolicyDetails)
                                    @if ($allPolicyDetails->id != $policyDetails->id)
                                        <div class="small-post">
                                            <div class="eblog-post-list-style">
                                                <div class="image-area">
                                                    <a href="#"><img src="{{ $allPolicyDetails->image }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="blog-content">
                                                    <h4 class="heading-title">
                                                        <a class="title-animation"
                                                            href="{{ route('employee.policy.details', $allPolicyDetails->id) }}">
                                                            {{ $allPolicyDetails->title }}</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
