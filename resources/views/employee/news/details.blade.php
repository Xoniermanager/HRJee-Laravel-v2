@extends('layouts.employee.main')
@section('content')
@section('title')
    News Details
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
                                <img src="{{ $newsDetails->image }}" class="card-rounded img-fluid mb-5">

                                <!--end::Image-->
                                <!--begin::Body-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <h5>
                                        <span class="category">{{ $newsDetails->newsCategories->name }}</span>
                                        {{ $newsDetails->title }}
                                    </h5>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <div class="fw-semibold fs-5 text-gray-900 text-dark my-4">
                                        <i class="fa fa-calendar-days"></i>
                                        {{ date('j F,Y', strtotime($newsDetails->created_at)) }}
                                    </div>
                                    <!--end::Text-->
                                    <div class="fw-semibold fs-5 text-gray-900 text-dark my-4">
                                        {!! $newsDetails->description !!} </div>

                                </div>
                                <!--end::Body-->

                                <object data="{{ $newsDetails->file }}" type="application/pdf" width="100%"
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
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5> Recent News</h5>
                        </div>
                    </div>
                    <div class="card mb-3 scrollbar-news">
                        <div class="card-body">
                            <table class="table m-0">
                                @foreach ($allAssinedNewsDetails as $allNewsDetails)
                                    @if ($allNewsDetails->id != $newsDetails->id)
                                        <div class="small-post">
                                            <div class="eblog-post-list-style">
                                                <div class="image-area">
                                                    <a href="#"><img src="{{ $allNewsDetails->image }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="blog-content">
                                                    <h4 class="heading-title">
                                                        <a class="title-animation"
                                                            href="{{ route('employee.news.details', $allNewsDetails->id) }}">
                                                            {{ $allNewsDetails->title }}</a>
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
@endsection
