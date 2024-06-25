@extends('layouts.company.main')

@section('title', 'View Employee Details')

@section('content')
    {{-- {{$singleViewEmployeeDetails}} --}}
    <!--begin::Header-->
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->

                <div class="card card-flush mb-xxl-10">
                    <!--begin::Header-->

                    <!--begin::Body-->
                    <div class="row card-body mt-4">
                        <!--begin::Nav-->
                        <ul class="col-md-4 nav nav-pills verticle_tab mb-3" role="tablist">
                            <!--begin::Item-->
                            <li class="nav-item mb-3" role="presentation">
                                <!--begin::Link-->
                                <a class="nav-link active" data-bs-toggle="pill" href="#tab_1" aria-selected="true"
                                    role="tab">
                                    <!--begin::Subtitle-->
                                    <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                        Personal Details <i class="fa fa-arrow-right"></i>
                                    </span>
                                    <!--end::Subtitle-->
                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="nav-item mb-3" role="presentation">
                                <!--begin::Link-->
                                <a class="nav-link" data-bs-toggle="pill" href="#tab_2" aria-selected="false"
                                    role="tab" tabindex="-1">

                                    <!--begin::Subtitle-->
                                    <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                        Advance & Bank Details <i class="fa fa-arrow-right"></i>
                                    </span>
                                    <!--end::Subtitle-->

                                    <!--begin::Bullet-->

                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item mb-3" role="presentation">
                                <!--begin::Link-->
                                <a class="nav-link" data-bs-toggle="pill" href="#tab_4" aria-selected="false"
                                    role="tab" tabindex="-1">

                                    <!--begin::Subtitle-->
                                    <span class="nav-text  fw-bold fs-6 lh-1">
                                        Address <i class="fa fa-arrow-right"></i>

                                    </span>
                                    <!--end::Subtitle-->

                                    <!--begin::Bullet-->

                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->

                            <!--begin::Item-->
                            <li class="nav-item mb-3" role="presentation">
                                <!--begin::Link-->
                                <a class="nav-link" data-bs-toggle="pill" href="#tab_5" aria-selected="false"
                                    role="tab" tabindex="-1">
                                    <!--begin::Subtitle-->
                                    <span class="nav-text fw-bold fs-6 lh-1">
                                        Skills,Languages & Qualification<i class="fa fa-arrow-right"></i>
                                    </span>
                                    <!--end::Subtitle-->

                                    <!--begin::Bullet-->

                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item mb-3" role="presentation">
                                <!--begin::Link-->
                                <a class="nav-link" data-bs-toggle="pill" href="#tab_6" aria-selected="false"
                                    role="tab" tabindex="-1">

                                    <!--begin::Subtitle-->
                                    <span class="nav-text  fw-bold fs-6 lh-1">
                                        Previous Company Experience<i class="fa fa-arrow-right"></i>
                                    </span>
                                    <!--end::Subtitle-->
                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item mb-3" role="presentation">
                                <!--begin::Link-->
                                <a class="nav-link" data-bs-toggle="pill" href="#tab_7" aria-selected="false"
                                    role="tab" tabindex="-1">

                                    <!--begin::Subtitle-->
                                    <span class="nav-text  fw-bold fs-6 lh-1">
                                        Family Details<i class="fa fa-arrow-right"></i>

                                    </span>
                                    <!--end::Subtitle-->

                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item mb-3" role="presentation">
                                <!--begin::Link-->
                                <a class="nav-link" data-bs-toggle="pill" href="#tab_8" aria-selected="false"
                                    role="tab" tabindex="-1">

                                    <!--begin::Subtitle-->
                                    <span class="nav-text  fw-bold fs-6 lh-1">
                                        Asset Details<i class="fa fa-arrow-right"></i>

                                    </span>
                                    <!--end::Subtitle-->

                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <!--end::Item-->
                            <li class="nav-item mb-3" role="presentation">
                                <!--begin::Link-->
                                <a class="nav-link" data-bs-toggle="pill" href="#tab_10" aria-selected="false"
                                    role="tab" tabindex="-1">

                                    <!--begin::Subtitle-->
                                    <span class="nav-text  fw-bold fs-6 lh-1">
                                        Upload Document<i class="fa fa-arrow-right"></i>

                                    </span>
                                    <!--end::Subtitle-->

                                </a>
                                <!--end::Link-->
                            </li>


                        </ul>
                        <!--end::Nav-->

                        <!--begin::Tab Content-->
                        <div class="col-md-8 tab-content verticle_tab_content">
                            <!--begin::PERSONAL DETAILS Tap pane-->
                            <div class="tab-pane fade active show" id="tab_1" role="tabpanel">
                                <!--begin::Table container-->
                                <div class="">
                                    <!--begin::Card header-->
                                    <div class="head cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="">
                                            <h3 class="fw-bold m-0 text-white">Personal Details</h3>
                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--begin::Card header-->

                                    <div class="card-body p-9">
                                        <!--begin::Row-->
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold mb-3">Profile Picture</label>
                                                    <!--end::Label-->
                                                    <div class="col-lg-6">

                                                        <!--begin::Image input-->
                                                        <div class="image-input image-input-outline"
                                                            data-kt-image-input="true"
                                                            style="background-image: url('/assets/media/user.jpg')">
                                                            <!--begin::Preview existing avatar-->
                                                            <div class="image-input-wrapper w-125px h-125px"
                                                                style="background-image: url({{ $singleViewEmployeeDetails->profile_image ?? '/assets/media/user.jpg' }})">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--begin::Row-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Employee ID</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span class="">{{ $singleViewEmployeeDetails->emp_id }}
                                                        </span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Full Name</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span class="">{{ $singleViewEmployeeDetails->name }}
                                                        </span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Official Email </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails->official_email_id }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Email </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <span class="">{{ $singleViewEmployeeDetails->email }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">
                                                        Father's Name </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6 d-flex align-items-center">
                                                        <span
                                                            class=" me-2">{{ $singleViewEmployeeDetails->father_name }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">
                                                        Mother's Name </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6 d-flex align-items-center">
                                                        <span
                                                            class=" me-2">{{ $singleViewEmployeeDetails->mother_name }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Gender</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span class=" me-2">
                                                            @php
                                                                if ($singleViewEmployeeDetails->gender == 'M') {
                                                                    echo 'Male';
                                                                } elseif ($singleViewEmployeeDetails->gender == 'F') {
                                                                    echo 'Female';
                                                                } else {
                                                                    echo 'Other';
                                                                }

                                                            @endphp
                                                        </span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">
                                                        Blood Group</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6 d-flex align-items-center">
                                                        <span
                                                            class=" me-2">{{ $singleViewEmployeeDetails->blood_group }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">
                                                        Date of Birth </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails->date_of_birth }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">
                                                        Joining of Date </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails->joining_date }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Mobile
                                                        No.</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails->phone }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>

                                                <!--begin::Input group-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Marital Status
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span class="">@php
                                                            if ($singleViewEmployeeDetails->marital_status == 'M') {
                                                                echo 'Married';
                                                            } else {
                                                                echo 'Single';
                                                            }
                                                        @endphp</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                               
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Employee Status
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails->employeeStatus->name }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Card body-->
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Employee Type</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->employeeTypes->name ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Department</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->department->name ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Designation</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->designation->name ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Company Branch</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->companyBranches->name ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Role</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->roles->name ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Highest Qualification</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->qualification->name ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Offer Letter ID</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->offer_letter_id ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Work From Office</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span class="">
                                                            @php
                                                                if (
                                                                    $singleViewEmployeeDetails['userDetails']
                                                                        ->work_from_office ??
                                                                    ' ' == '1'
                                                                ) {
                                                                    echo 'Yes';
                                                                } else {
                                                                    echo 'No';
                                                                }
                                                            @endphp</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Exit Date</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->exit_date ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-2">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Official Mobile No.</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['userDetails']->official_mobile_no ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::ADVANCE DETAILS Tap pane-->
                            <div class="tab-pane fade tabcustome" id="tab_2" role="tabpanel">

                                <!--begin::Col-->
                                <div class="tab-pane mb-5">
                                    <!--begin::Card header-->
                                    <div class="head cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Advance Details</h3>
                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--begin::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body p-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!--begin::Row-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Aadhar No.</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->aadhar_no ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->

                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Pan No.
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->pan_no ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">UAN No.</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class=" me-2">{{ $singleViewEmployeeDetails['advanceDetails']->uan_no ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">
                                                        ESIC No. </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->esic_no ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">PF No.</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->pf_no ?? '' }}
                                                        </span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <div class="col-md-6">

                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Insurance No.
                                                    </label>
                                                    <!--begin::Label-->

                                                    <!--begin::Label-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->insurance_no ?? '' }}</span>
                                                    </div>
                                                    <!--begin::Label-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Driving Licence No.</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->driving_licence_no ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">Probation Period</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->probation_period ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">CTC Monthly In Probation</label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->ctc_monthly_in_probation ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-3">
                                                    <!--begin::Label-->
                                                    <label class="col-md-6 fw-bold">CTC Monthly After Probation
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <span
                                                            class="">{{ $singleViewEmployeeDetails['advanceDetails']->ctc_monthly_after_probation ?? '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <div class="tab-pane mb-5">
                                    <!--begin::Card header-->
                                    <div class="head cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Bank Details</h3>
                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--begin::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body p-9">
                                        <!--begin::Row-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Account Name </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6">
                                                <span
                                                    class="">{{ $singleViewEmployeeDetails['bankDetails']->account_name ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Account Number </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <span
                                                    class="">{{ $singleViewEmployeeDetails['bankDetails']->account_number ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">
                                                Bank Name </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 d-flex align-items-center">
                                                <span
                                                    class=" me-2">{{ $singleViewEmployeeDetails['bankDetails']->bank_name ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Ifsc Code </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6">
                                                <span
                                                    class=" me-2">{{ $singleViewEmployeeDetails['bankDetails']->ifsc_code ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::ADDRESS DETAILS Tap pane-->
                            <div class="tab-pane fade tabcustome" id="tab_4" role="tabpanel">
                                <!--begin::Col-->
                                @php
                                    $local = [];
                                    $permanent = [];
                                    foreach ($singleViewEmployeeDetails['addressDetails'] as $userAddress) {
                                        if ($userAddress->address_type == 'local') {
                                            $local = $userAddress;
                                        }
                                        if ($userAddress->address_type == 'permanent') {
                                            $permanent = $userAddress;
                                        }
                                        if ($userAddress->address_type == 'both_same') {
                                            $permanent = $userAddress;
                                            $local = $userAddress;
                                        }
                                    }
                                @endphp
                                <div class="tab-pane mb-5">
                                    <!--begin::Card header-->
                                    <div class="head cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Local Address </h3>
                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--begin::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body p-9">
                                        <!--begin::Row-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Address </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6">
                                                <span class="">{{ $local->address ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">City </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <span class="">{{ $local->city ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Pincode </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6">
                                                <span class=" me-2">{{ $local->pin_code ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">
                                                State </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 d-flex align-items-center">
                                                <span class=" me-2">{{ $local->state->name ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">
                                                Country </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 d-flex align-items-center">
                                                <span class=" me-2">{{ $local->country->name ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Pincode </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6">
                                                <span class=" me-2">{{ $local->pin_code ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <div class="tab-pane mb-3 mt-3rem">
                                    <!--begin::Card header-->
                                    <div class="head cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Perament Address </h3>
                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--begin::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body p-9">
                                        <!--begin::Row-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Address </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6">
                                                <span class="">{{ $permanent->address ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">City </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <span class="">{{ $permanent->city ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Pincode </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6">
                                                <span class=" me-2">{{ $permanent->pin_code ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">
                                                State </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 d-flex align-items-center">
                                                <span class=" me-2">{{ $permanent->state->name ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">
                                                Country </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6 d-flex align-items-center">
                                                <span class=" me-2">{{ $permanent->country->name ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-3">
                                            <!--begin::Label-->
                                            <label class="col-md-6 fw-bold">Pincode </label>
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-md-6">
                                                <span class=" me-2">{{ $permanent->pin_code ?? '' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Card body-->
                                </div>
                            </div>

                            <!--begin::Qualification Details Tap pane-->
                            <div class="tab-pane fade tabcustome" id="tab_5" role="tabpanel">
                                <!--begin::Col-->
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <!--begin::Card header-->
                                        <div class="tab-pane mb-3">
                                            <!--begin::Card header-->
                                            <div class="head cursor-pointer">
                                                <!--begin::Card title-->
                                                <div class="card-title m-0">
                                                    <h3 class="fw-bold m-0">
                                                        Skills</h3>
                                                </div>
                                                <!--end::Card title-->

                                            </div>
                                            <!--begin::Card body-->
                                            <div class="card-body p-4">
                                                <ul>
                                                    @foreach ($singleViewEmployeeDetails['skills'] as $user_skills)
                                                        <li>{{ $user_skills->name }}</li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <!--begin::Card header-->
                                        <div class="tab-pane mb-3">
                                            <!--begin::Card header-->
                                            <div class="head cursor-pointer">
                                                <!--begin::Card title-->
                                                <div class="card-title m-0">
                                                    <h3 class="fw-bold m-0">
                                                        Languages</h3>
                                                </div>
                                                <!--end::Card title-->

                                            </div>
                                            <!--begin::Card body-->
                                            <div class="card-body p-4">
                                                <div class="card-body p-4">
                                                    <ul>
                                                        @foreach ($singleViewEmployeeDetails['languages'] as $user_languages)
                                                            <li>{{ $user_languages->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row">
                                    @foreach ($singleViewEmployeeDetails['qualificationDetails'] as $qualificationDetails)
                                        <div class="col-md-6 mb-5">
                                            <!--begin::Card header-->
                                            <div class="tab-pane mb-3">
                                                <!--begin::Card header-->
                                                <div class="head cursor-pointer">
                                                    <!--begin::Card title-->
                                                    <div class="card-title m-0">
                                                        <h3 class="fw-bold m-0">
                                                            {{ $qualificationDetails->qualification->name ?? '' }}</h3>
                                                    </div>
                                                    <!--end::Card title-->

                                                </div>
                                                <!--begin::Card body-->
                                                <div class="card-body p-4">
                                                    <!--begin::Row-->
                                                    <!--begin::Input group-->
                                                    <div class="row mb-2">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Institute
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 fv-row">
                                                            <span
                                                                class="">{{ $qualificationDetails->institute ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-2">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">University
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span
                                                                class=" me-2">{{ $qualificationDetails->university ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row mb-2">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Course
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span
                                                                class=" me-2">{{ $qualificationDetails->course ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-2">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Year
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span
                                                                class=" me-2">{{ $qualificationDetails->year ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-2">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Percentage</label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span
                                                                class=" me-2">{{ $qualificationDetails->percentage ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                    @endforeach
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Past Work Details Tap pane-->
                            <div class="tab-pane fade tabcustome" id="tab_6" role="tabpanel">
                                <!--begin::Col-->
                                <div class="row">

                                    @foreach ($singleViewEmployeeDetails['pastWorkDetails'] as $pastWorkDetails)
                                        <div class="col-md-6 mb-5">
                                            <div class="tab-pane mb-3">
                                                <!--begin::Card header-->
                                                <div class="head cursor-pointer">
                                                    <!--begin::Card title-->
                                                    <div class="card-title m-0">
                                                        <h3 class="fw-bold m-0">
                                                            {{ $pastWorkDetails->previousCompanies->name ?? '' }}</h3>
                                                    </div>
                                                    <!--end::Card title-->

                                                </div>
                                                <div class="card-body p-9">
                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Designation
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 fv-row">
                                                            <span
                                                                class="">{{ $pastWorkDetails->designation ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">From
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{ $pastWorkDetails->from ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">To
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{ $pastWorkDetails->to ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Duration
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span
                                                                class=" me-2">{{ $pastWorkDetails->duration ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Current Company</label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">
                                                                @php
                                                                    if ($pastWorkDetails->current_company == '1') {
                                                                        echo 'Yes';
                                                                    } else {
                                                                        echo 'No';
                                                                    }
                                                                @endphp
                                                            </span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Past Work Details Tap pane-->
                            <div class="tab-pane fade tabcustome" id="tab_7" role="tabpanel">
                                <!--begin::Col-->
                                <div class="row">
                                    @foreach ($singleViewEmployeeDetails['familyDetails'] as $familyDetails)
                                        <div class="col-md-6 mb-5">
                                            <div class="tab-pane mb-3">
                                                <!--begin::Card header-->
                                                <div class="head cursor-pointer">
                                                    <!--begin::Card title-->
                                                    <div class="card-title m-0">
                                                        <h3 class="fw-bold m-0">
                                                            {{ $familyDetails->relation_name ?? '' }}
                                                        </h3>
                                                    </div>
                                                    <!--end::Card title-->

                                                </div>
                                                <div class="card-body p-9">
                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Name
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 fv-row">
                                                            <span class="">{{ $familyDetails->name ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Dob
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{ $familyDetails->dob ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Phone
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{ $familyDetails->phone ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Nominee</label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">
                                                                @php
                                                                    if ($familyDetails->nominee == '1') {
                                                                        echo 'Yes';
                                                                    } else {
                                                                        echo 'No';
                                                                    }
                                                                @endphp
                                                            </span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    @endforeach
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade tabcustome" id="tab_8" role="tabpanel">
                                <div class="row">
                                    @foreach ($singleViewEmployeeDetails['assetDetails'] as $assetDetails)
                                        <div class="col-md-6 mb-5">
                                            <div class="tab-pane mb-3">
                                                <!--begin::Card header-->
                                                <div class="head cursor-pointer">
                                                    <!--begin::Card title-->
                                                    <div class="card-title m-0">
                                                        <h3 class="fw-bold m-0">
                                                            {{ $assetDetails->asset->name ?? '' }}
                                                        </h3>
                                                    </div>
                                                    <!--end::Card title-->

                                                </div>
                                                <div class="card-body p-9">
                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Asset Manufacturer
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6 fv-row">
                                                            <span class="">{{ $assetDetails->asset->assetManufacturers->name ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Asset Category
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{ $assetDetails->asset->assetCategories->name ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Model
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{  $assetDetails->asset->model ?? '' }}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Serial No.</label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{$assetDetails->asset->serial_no ?? ''}}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Invoice No.</label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{$assetDetails->asset->invoice_no ?? ''}}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <div class="row mb-3">
                                                        <!--begin::Label-->
                                                        <label class="col-md-6 fw-bold">Assigned Date</label>
                                                        <!--end::Label-->

                                                        <!--begin::Col-->
                                                        <div class="col-md-6">
                                                            <span class=" me-2">{{$assetDetails->assigned_date ?? ''}}</span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    @endforeach
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Tap pane-->
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade tabcustome" id="tab_10" role="tabpanel">
                                <div class="row">
                                    @foreach ($singleViewEmployeeDetails['documentDetails'] as $documentDetails)
                                        <div class="col-md-6 mb-5">
                                            <!--begin::Card header-->
                                            <div class="tab-pane mb-3">
                                                <!--begin::Card header-->
                                                <div class="head cursor-pointer">
                                                    <!--begin::Card title-->
                                                    <div class="card-title m-0">
                                                        <h3 class="fw-bold m-0">
                                                            {{ $documentDetails->documentTypes->name ?? '' }}</h3>
                                                    </div>
                                                    <!--end::Card title-->

                                                </div>
                                                <!--begin::Card body-->
                                                <div class="card-body p-4">
                                                    <!--begin::Row-->
                                                    <!--begin::Input group-->
                                                    <div class="col-md-6">
                                                        @php
                                                            $fileExtension = pathinfo(
                                                                $documentDetails->document,
                                                                PATHINFO_EXTENSION,
                                                            );
                                                        @endphp
                                                        <div class="form-wrap">
                                                            <object data="{{ $documentDetails->document }}"
                                                                type="application/pdf" width="300" height="150"
                                                                id="certificates" style=" object-fit: fill;">
                                                            </object>
                                                        </div>
                                                        <span class="fw-bold fs-6 text-gray-800"><a
                                                                href="{{ $documentDetails->document }}"
                                                                class="btn btn-sm btn-primary" download>Download</a>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                    @endforeach
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Tap pane-->

                        </div>
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end: Card Body-->
            </div>
        </div>
        <!--end::Row-->
    </div>
@endsection
