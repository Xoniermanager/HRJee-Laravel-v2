@extends('layouts.employee.main')
@section('content')
@section('title','Contact Us')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-sm-4 pe-lg-10">
                <!--begin::Phone-->
                <div class="text-center bg-body card-rounded d-flex flex-column justify-content-center p-10 h-100">
                    <!--begin::Icon-->
                    <!--SVG file not found: icons/duotune/finance/fin006.svgPhone.svg-->
                    <!--end::Icon-->
                    <!--begin::Subtitle-->
                    <h1 class="text-primary fw-bold my-5"><i class="fas fa-map-marker-alt fs-1 pr-10"></i>Company Address</h1>
                    <!--end::Subtitle-->
                    <!--begin::Number-->
                    <div class="text-gray-700 fw-semibold fs-3">{{ Auth()->user()->userCompanyDetails->company_address }}</div>
                    <!--end::Number-->
                </div>
                <!--end::Phone-->
            </div>
            <!--end::Col-->
            <div class="col-sm-4 pe-lg-10">
                <!--begin::Phone-->
                <div class="text-center bg-body card-rounded d-flex flex-column justify-content-center p-10 h-100">
                    <!--begin::Icon-->
                    <!--SVG file not found: icons/duotune/finance/fin006.svgPhone.svg-->
                    <!--end::Icon-->
                    <!--begin::Subtitle-->
                    <h1 class="text-primary fw-bold my-5"><i class="fa fa-envelope fs-1 pr-10"></i>Email</h1>
                    <!--end::Subtitle-->
                    <!--begin::Number-->
                    <div class="text-gray-700 fw-semibold fs-3">{{Auth()->user()->userCompanyDetails->user->email}}</div>
                    <!--end::Number-->
                </div>
                <!--end::Phone-->
            </div>
            <div class="col-sm-4 pe-lg-10">
                <!--begin::Phone-->
                <div class="text-center bg-body card-rounded d-flex flex-column justify-content-center p-10 h-100">
                    <!--begin::Icon-->
                    <!--SVG file not found: icons/duotune/finance/fin006.svgPhone.svg-->
                    <!--end::Icon-->
                    <!--begin::Subtitle-->
                    <h1 class="text-primary fw-bold my-5"><i class="fa fa-phone-flip fs-1 pr-10"></i>Let’s Speak</h1>
                    <!--end::Subtitle-->
                    <!--begin::Number-->
                    <div class="text-gray-700 fw-semibold fs-3"> {{ Auth()->user()->userCompanyDetails->contact_no}}</div>
                    <!--end::Number-->
                </div>
                <!--end::Phone-->
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection
