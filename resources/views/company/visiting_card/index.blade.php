@extends('layouts.company.main')
@section('content')
@section('title')
    Notice
@endsection
@php
    $user = Auth()->user();
@endphp
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <div class="card card-flush h-md-100 mt-5">

                        <!--begin::Body-->
                        <div class="card-body px-0">
                            <!--begin::Table container-->
                            <div class="mx-9">
                                <!--begin::Table-->
                                <div class="visiting-card-main">
                                    <div class="bg">
                                        <div class="visiting-card-outer">
                                            <div class="split left">
                                                <div>
                                                    <img class="visit-image" src="{{asset('assets/company_logo.png') }}"
                                                        style="object-fit: contain;max-height: 50px;">
                                                </div>
                                                <div class="visit-divider">
                                                    <div class="divider"></div>
                                                </div>
                                                <div style="height: 48%;">
                                                    <p class="visiting-name" style="--color: #273896;">{{$user->name}}</p>
                                                    <p>{{$user->userRole->name}}</p>
                                                </div>
                                            </div>
                                            <div class="visit-icon-display">
                                                <div class="icon">
                                                    <i class="fa fa-mobile"></i>
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            </div>

                                            <div class="visit-icon-display" style="--btnColor: #273896;">

                                                <div class="split right">
                                                    <div class="visit-information">
                                                        <p>{{$user->details->phone ?? ''}}</p>
                                                        <p>{{$user->email}}</p>
                                                        <p style="height: 20px; line-break: anywhere; width: 160px;">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn batn-sm btn-primary"> <i class="fa fa-share"></i>
                                            Share</button>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table container-->

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart Widget 35-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
