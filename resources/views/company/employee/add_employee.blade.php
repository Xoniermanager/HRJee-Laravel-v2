@extends('layouts.company.main')

@section('title', 'Add Employee')

@section('content')
    @php
        $userQualificationDetails = [];
        if (isset($userDetails)) {
            $userQualificationDetails = $userDetails['qualificationDetails'];
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
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#advance_details_tab">
                                    <span class="fs-7 fw-semibold">Advance Details</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#address_tab">
                                    <span class="fs-7 fw-semibold">Address</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#bank_details_tab">
                                    <span class="fs-7 fw-semibold">Bank Details</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#qualification_tab">
                                    <span class="fs-7 fw-semibold">Qualification</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#past_work_tab">
                                    <span class="fs-7 fw-semibold">Past work</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#permission_tab">
                                    <span class="fs-7 fw-semibold">Permissions</span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#family_details_tab">
                                    <span class="fs-7 fw-semibold">Family Details</span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#asset_tab">
                                    <span class="fs-7 fw-semibold">Asset </span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
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
        /** get all Designation Using Department Id*/
        jQuery('#department_id').on('change', function() {
            var department_id = $(this).val();
            get_all_designation_using_department_id(department_id);
        });

        function get_all_designation_using_department_id(department_id) {
            if (department_id) {
                $.ajax({
                    url: "{{ route('get.all.designation') }}",
                    type: "GET",
                    dataType: "json",
                    data: {
                        'department_id': department_id
                    },
                    success: function(response) {
                        var select = $('#designation_id');
                        select.empty();
                        if (response.status == true) {
                            $('#designation_id').append(
                                '<option>Select The Designation</option>');
                            $.each(response.data, function(key, value) {
                                select.append('<option value=' + value.id + '>' +
                                    value
                                    .name + '</option>');
                            });
                        } else {
                            select.append('<option value="">' + response.error +
                                '</option>');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something Went Wrong!! Please try Again"
                        });
                        return false;
                    }
                });
            } else {
                $('#designation_id').empty();
            }

        }
        /** end get all Designation Using Department Id*/
        
        /**
         * close current tab and open next tab
         */
        function show_next_tab(tab) {
            jQuery('.nav-pills a[href="#' + tab + '"]').tab('show');
        }
    </script>
@endsection
