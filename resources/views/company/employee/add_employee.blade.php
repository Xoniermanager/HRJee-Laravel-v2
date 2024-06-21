@extends('layouts.company.main')

@section('title', 'Add Employee')

@section('content')
    @php
        $editDetails = false;
        $userQualificationDetails = [];
        $userAddressDetails = [];
        $userAdvanceDetails = [];
        $userbankDetails = [];
        $userpastWorkDetails = [];
        $userfamilyDetails = [];
        $userdocumentDetails = [];
        $userDetails = [];
        $userSkills = '';
        $userLanguages = [];
        if (isset($singleUserDetails)) {
            $editDetails = true;
            $userQualificationDetails = $singleUserDetails['qualificationDetails'];
            $userAdvanceDetails = $singleUserDetails['advanceDetails'];
            $userAddressDetails = $singleUserDetails['addressDetails'];
            $userbankDetails = $singleUserDetails['bankDetails'];
            $userpastWorkDetails = $singleUserDetails['pastWorkDetails'];
            $userfamilyDetails = $singleUserDetails['familyDetails'];
            $userdocumentDetails = $singleUserDetails['documentDetails'];
            $userDetails = $singleUserDetails['userDetails'];
            $userSkills = $singleUserDetails['skills']->pluck('id');
            $userLanguages = $singleUserDetails['languages'];
        }
    @endphp
    {{-- <div class="loading_item" id="loading_item">
    <div class="loading-wave">
    <div class="loading-bar"></div>
    <div class="loading-bar"></div>
    <div class="loading-bar"></div>
    <div class="loading-bar"></div>
  </div>
  </div> --}}
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
                <!--begin::Timeline widget 3-->
                <div class="card h-md-100">
                    <!--begin::Header-->
                    <div class="card-header p-0 align-items-center">
                        <!--begin::Nav-->
                        <ul
                            class="nav nav-stretch nav-pills nav-pills-custom nav-pills-active-custom d-flex justify-content-between b-5 px-3">
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger active"
                                    data-bs-toggle="tab" href="#basic_Details_tab">
                                    <span class="fs-7 fw-semibold">Basic Details</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            @php
                                if($editDetails == false)
                                {
                                    $buttonDisabled = 'disabled';
                                }
                                else {
                                    $buttonDisabled = '';
                                }
                            @endphp
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#advance_details_tab">
                                    <span class="fs-7 fw-semibold">Advance Details</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#address_tab">
                                    <span class="fs-7 fw-semibold">Address</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#bank_details_tab">
                                    <span class="fs-7 fw-semibold">Bank Details</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#qualification_tab">
                                    <span class="fs-7 fw-semibold">Qualification</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#past_work_tab">
                                    <span class="fs-7 fw-semibold">Past work</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#permission_tab">
                                    <span class="fs-7 fw-semibold">Permissions</span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#family_details_tab">
                                    <span class="fs-7 fw-semibold">Family Details</span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#asset_tab">
                                    <span class="fs-7 fw-semibold">Asset </span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{$buttonDisabled}}"
                                    data-bs-toggle="tab" href="#document_tab">
                                    <span class="fs-7 fw-semibold">Documents</span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--end::Nav-->

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-7 px-0">
                        <!--begin::Tab Content-->
                        <div class="tab-content mb-2 px-9">
                            <!--begin::Tap pane Basic Details-->
                            @include('company.employee.tabs.basic_details')
                            <!--end::Tap pane -->

                            <!--begin::Tap pane Advance Details-->
                            @include('company.employee.tabs.advance_details')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Address Tab-->
                            @include('company.employee.tabs.address_tab')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Bank Details-->
                            @include('company.employee.tabs.bank_details')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Qualification-->
                            @include('company.employee.tabs.qualification_tab')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane PAst Work-->
                            @include('company.employee.tabs.past_work_tab')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Permission-->
                            @include('company.employee.tabs.permission_tab')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Family Details-->
                            @include('company.employee.tabs.family_details')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Asset Tab-->
                            @include('company.employee.tabs.asset_tab')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Document Tab-->
                            @include('company.employee.tabs.document_tab')
                            <!--end::Tap pane-->

                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Action-->

                        <!--end::Action-->
                    </div>
                    <!--end: Card Body-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <script>

        /**
         * close current tab and open next tab
         */
        function show_next_tab(tab) {
            jQuery('.nav-pills a[href="#' + tab + '"]').tab('show');
        }

        /** Submitting All Details */
        var all_data_saved = true;
        let submit_handler = true;


        jQuery('#submit_all').click(function() {
            //Basic Details
            if (jQuery("#basic_create_form").valid()) {
                jQuery('.nav-pills a[href="#basic_Details_tab"]').tab('show');
                setTimeout(function() {
                    createBasicDetails(jQuery('#basic_create_form'));
                }, 3000);
            } else {
                jQuery('.nav-pills a[href="#basic_create_form"]').tab('show');
            }

            //Advance Details
            setTimeout(function() {
                if (all_data_saved) {
                    if (jQuery("#advance_details_form").valid()) {
                        createAdvanceDetails(jQuery('#advance_details_form'));
                    } else {
                        jQuery('.nav-pills a[href="#advance_details_tab"]').tab('show');
                    }
                }
            }, 4000);


            //Address Details
            setTimeout(function() {
                if (all_data_saved) {
                    if (jQuery("#address_Details_form").valid()) {
                        createAddressDetails(jQuery('#address_Details_form'));
                    } else {
                        jQuery('.nav-pills a[href="#address_tab"]').tab('show');
                    }
                }
            }, 6000);

            //Bank Details
            setTimeout(function() {
                if (all_data_saved) {
                    if (jQuery("#bank_details_form").valid()) {
                        createBankDetails(jQuery('#bank_details_form'));
                    } else {
                        jQuery('.nav-pills a[href="#bank_details_tab"]').tab('show');
                    }
                }
            }, 8000);

            //Qualification Details
            setTimeout(function() {
                if (all_data_saved) {
                    if (jQuery("#qualification_details_form").valid()) {
                        createQualification(jQuery('#qualification_details_form'));
                    } else {
                        jQuery('.nav-pills a[href="#qualification_tab"]').tab('show');
                    }
                }
            }, 10000);

            //Past Work Details
            setTimeout(function() {
                if (all_data_saved) {
                    if (jQuery("#past_work_details").valid()) {
                        createPastWorkDetails(jQuery('#past_work_details'));
                    } else {
                        jQuery('.nav-pills a[href="#past_work_tab"]').tab('show');
                    }
                }
            }, 12000);

            //Permission Details
            setTimeout(function() {
                if (all_data_saved) {
                    if (jQuery("#user_details_form").valid()) {
                        createPermissionDetails(jQuery('#user_details_form'));
                    } else {
                        jQuery('.nav-pills a[href="#permission_tab"]').tab('show');
                    }
                }
            }, 14000);

            //Fmaily Details  Details
            setTimeout(function() {
                if (all_data_saved) {
                    if (jQuery("#family_details_form").valid()) {
                        createFamilyDetails(jQuery('#family_details_form'));
                    } else {
                        jQuery('.nav-pills a[href="#family_details_tab"]').tab('show');
                    }
                }
            }, 16000);

            //Documents Details
            setTimeout(function() {
                if (all_data_saved) {
                    if (jQuery("#document_details").valid()) {
                        createDocumentDetails(jQuery('#document_details'));
                    } else {
                        jQuery('.nav-pills a[href="#document_tab"]').tab('show');
                    }
                }
            }, 18000);
        });
    </script>
@endsection
