@extends('layouts.company.main')

@section('title', 'Face Recognition Management')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="card card-body col-md-12">
                    <!--end::Action-->
                    <div class="mb-5 mb-xl-10">
                        <div class="">
                            <div class="">
                                <!--begin::Body-->
                                <div class="">
                                    <div class="card-body py-3">
                                        <!--begin::Table container-->
                                        @include('company.face_recognition.list')
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
    @endsection
