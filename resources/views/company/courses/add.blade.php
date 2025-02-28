@extends('layouts.company.main')

@section('title', 'Add Course')

@section('content')
    @php
        $editDetails = false;
        if (isset($singleUserDetails)) {
            $editDetails = true;
        }
    @endphp
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
                        <ul class="nav nav-stretch nav-pills nav-pills-custom nav-pills-active-custom d-flex justify-content-between b-5 px-3">
                            <li class="nav-item p-0 ms-0">
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger active"
                                    data-bs-toggle="tab" href="#basic_Details_tab">
                                    <span class="fs-7 fw-semibold">Course Details</span>
                                </a>
                            </li>
                            @php
                                if ($editDetails == false) {
                                    $buttonDisabled = 'disabled';
                                } else {
                                    $buttonDisabled = '';
                                }
                            @endphp
                            <li class="nav-item p-0 ms-0">
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{ $buttonDisabled }}"
                                    data-bs-toggle="tab" href="#curriculum_details_tab">
                                    <span class="fs-7 fw-semibold">Curriculum</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0">
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger {{ $buttonDisabled }}"
                                    data-bs-toggle="tab" href="#advance_details_tab">
                                    <span class="fs-7 fw-semibold">Curriculum</span>

                                </a>
                            </li>
                        </ul>
                        <!--end::Nav-->

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-7 px-0">
                        <!--begin::Tab Content-->
                        <div class="tab-content mb-2 px-9">
                            <!--begin::Tap pane Basic Details-->
                            @include('company.courses.tabs.course')
                            <!--end::Tap pane -->

                            <!--begin::Tap pane Advance Details-->
                            @include('company.courses.tabs.curriculum')
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Address Tab-->
                            @include('company.courses.tabs.assignment')
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
            if (jQuery("#course_details_form").valid()) {
                jQuery('.nav-pills a[href="#basic_Details_tab"]').tab('show');
                setTimeout(function() {
                    createBasicDetails(jQuery('#course_details_form')[0]);
                }, 3000);
            } else {
                jQuery('.nav-pills a[href="#course_details_form"]').tab('show');
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
                        createDocumentDetails(jQuery('#document_details')[0]);
                    } else {
                        jQuery('.nav-pills a[href="#document_tab"]').tab('show');
                    }
                }
            }, 18000);
        });
    </script>
@endsection
