@extends('layouts.company.main')

@section('title', 'Add Employee')

@section('content')
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
        /** Qualification HTML*/

        function get_qualification_html() {
            var degree_name = $('select[name=qualification_id]').find(':selected').text().trim();
            var exist = false;
            jQuery('.degree_name').each(function(key, ele) {
                var existing_ele = jQuery(ele).text().trim();
                if (existing_ele == degree_name) {
                    exist = true;
                }
            });
            if (exist == false) {
                var qualificationhtml = '<div class="row"><div class="panel-head"><h5 class="degree_name">' + degree_name +
                    '</h5></div>\
                                                                <div class="panel-body"><div class="row"><div class="col-md-3 form-group"><label for="">Institute/College *</label><input class="form-control" type="text" name=""></div>\
                                                                <div class="col-md-3 form-group"><label for="">University *</label><input class="form-control" type="text" name=""></div>\
                                                                <div class="col-md-3 form-group"><label for="">Course *</label><input class="form-control" type="text" name=""></div>\
                                                                <div class="col-md-1 form-group"><label for="">Year *</label><input class="form-control" type="text" name=""></div>\
                                                                <div class="col-md-1 form-group"><label for="">Percentage*</label><input class="form-control" type="text" name=""></div>\
                                                                <div class="col-md-1 form-group text-center mt-5"><button class="btn btn-danger btn-sm mt-3" onclick="remove_qualification_html(this)"> <i class="fa fa-minus"></i></button></div></div></div></div>';
                $('#qualification_html').append(qualificationhtml);
            }

        }

        function remove_qualification_html(ele) {
            jQuery(ele).parent().parent().parent().parent().remove();
        }

        /** end Qualification HTMl*/

        /** Previous Company HTML*/

        function get_previous_company_html() {
            var previous_company = $('select[name=previous_company_id]').find(':selected').text().trim();
            var exist = false;
            if ($('#previous_company_id').val() != '') {
                jQuery('.previous_company').each(function(key, ele) {
                    var existing_ele = jQuery(ele).text().trim();
                    if (existing_ele == previous_company) {
                        exist = true;
                    }
                });
                if (exist == false) {
                    var previous_company_html = '<div class="row"><div class="panel-head"><h5 class="previous_company">' +
                        previous_company +
                        '</h5></div>\
                                                                                        <div class="panel-body"><div class="row"><div class="col-md-3 form-group"><label for="">Designation *</label><input class="form-control" type="text" name=""></div>\
                                                                                        <div class="col-md-2 form-group"><label for="">From *</label><input class="form-control" type="date" name=""></div>\
                                                                                        <div class="col-md-2 form-group"><label for="">To *</label><input class="form-control" type="date" name=""></div>\
                                                                                        <div class="col-md-2 form-group"><label for="">Duration (In Years) *</label><input class="form-control" type="text" name=""></div>\
                                                                                        <div class="col-md-2 form-group text-center"><label for="">Current Company *</label><p class="mt-2"><input class="h-20w-100" type="checkbox" name=""></p></div>\
                                                                                        <div class="col-md-1 form-group text-center mt-5"><button class="btn btn-danger btn-sm mt-3" onclick="remove_previous_company_html(this)"> <i class="fa fa-minus"></i></button></div></div></div></div>';
                    $('#previous_company_html').append(previous_company_html);
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select the Previous Company"
                });
                return false;
            }

        }

        function remove_previous_company_html(ele) {
            jQuery(ele).parent().parent().parent().parent().remove();
        }

        /** end Previous Company HTML*/


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

        /** Family details create html*/
        function get_family_details_html() {
            var family_details_html =
                '<div class=""><div class="row panel panel-body mb-3"><div class="col-md-3 form-group"><label for="">Relationship *</label><input class="form-control" type="text"></div>\
                                                        <div class="col-md-3 form-group"><label for="">Name *</label><input class="form-control" type="text"></div>\
                                                        <div class="col-md-2 form-group"><label for="">Number *</label><input class="form-control" type="text"></div>\
                                                        <div class="col-md-2 form-group"><label for="">Date of birth *</label><input class="form-control" type="date"></div>\
                                                        <div class="col-md-2 form-group mt-5"><input type="checkbox"> <label for=""> Nominee </label><button onclick="remove_family_details_html(this)" class="btn btn-danger btn-sm float-right"> <i class="fa fa-minus"></i></button></div></div></div>';
            $('#family_details_html').append(family_details_html);
        }

        function remove_family_details_html(this_ele) {
            jQuery(this_ele).parent().parent().remove();
        }
        /** End Family details create html*/


        /**
         * close current tab and open next tab
         */
        function show_next_tab(tab) {
            jQuery('.nav-pills a[href="#' + tab + '"]').tab('show');
        }
    </script>
@endsection
