@extends('layouts.employee.main')
@section('content')
@section('title')
    Announcement Details
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
                                <img src="{{ $announcementDetails->image }}" class="card-rounded img-fluid mb-5">

                                <!--end::Image-->
                                <!--begin::Body-->
                                <div class="m-0">
                                    <!--begin::Title-->
                                    <a href="#"
                                        class="fs-6 text-dark fw-bold text-hover-primary text-dark lh-base cat-links">{{ $announcementDetails->title }}</a>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <div class="fw-semibold fs-5 text-gray-900 text-dark my-4">
                                        <i class="fa fa-calendar-days"></i>
                                        {{ date('j F,Y', strtotime($announcementDetails->created_at)) }}
                                    </div>
                                    <!--end::Text-->
                                    <div class="fw-semibold fs-5 text-gray-900 text-dark my-4">
                                        {!! $announcementDetails->description !!} </div>

                                </div>
                                <!--end::Body-->

                                <object data="{{ $announcementDetails->file }}" type="application/pdf" width="100%"
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
                            <h5> Recent Announcements</h5>
                        </div>
                    </div>
                    <div class="card mb-3 scrollbar-news">
                        <div class="card-body">
                            <table class="table m-0">
                                @foreach ($allAssinedAnnouncementDetails as $allAnnouncementDetails)
                                    @if ($allAnnouncementDetails->id != $announcementDetails->id)
                                        <div class="small-post">
                                            <div class="eblog-post-list-style">
                                                <div class="image-area">
                                                    <a href="#"><img src="{{ $allAnnouncementDetails->image }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="blog-content">
                                                    <h4 class="heading-title">
                                                        <a class="title-animation"
                                                            href="{{ route('employee.announcement.details', $allAnnouncementDetails->id) }}">
                                                            {{ $allAnnouncementDetails->title }}</a>
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
