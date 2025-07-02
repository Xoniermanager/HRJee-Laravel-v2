@extends('layouts.company.main')
@section('content')
@section('title')
    Lead Details
@endsection
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mt-5">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
            @endif
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-12 position-relative">
                <!--begin::Row-->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <!--begin::Col-->
                    <div class="col-md-3 col-border-right-3">
                        <h5>Customer Details </h5>
                        <!--begin::Chart Widget 35-->
                        <div class="details-box">
                            <div class="keyValue "><span class="item">Name</span><span
                                    class="item span-value ">{{ ucwords($viewLeadDetails->customer_name) }}</span></div>
                            <div class="keyValue "><span class="item">Mobile No</span><span
                                    class="item span-value ">{{ $viewLeadDetails->customer_number }}</span></div>
                            <div class="keyValue "><span class="item">Applicant Type</span><span
                                    class="item span-value ">{{ ucfirst($viewLeadDetails->applicant_type) }}</span>
                            </div>
                            <div class="keyValue "><span class="item">Business Type</span><span
                                    class="item span-value ">{{ ucwords($viewLeadDetails->business_type) }}</span></div>
                            <div class="keyValue "><span class="item">Loan Type</span><span
                                    class="item span-value ">{{ $viewLoanDetails->productName->type }}</span></div>
                            <div class="keyValue hide-bottom"><span class="item">Case ID</span>
                                <div style="display: flex; align-items: center;"><span
                                        class="item span-value">{{ $viewLeadDetails->case_id }}</span><button
                                        type="button" class="ant-btn ant-btn-default ant-btn-sm ant-btn-icon-only"
                                        style="border: none;"><svg width="14" height="17" viewBox="0 0 13 17"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.856627 3.67295L0.854492 12.6595V12.6596C0.854492 13.4746 1.17824 14.2562 1.75453 14.8325C2.33081 15.4087 3.11242 15.7325 3.92741 15.7325H9.73635C9.53573 15.8549 9.30477 15.9201 9.06864 15.92H9.06849H3.92741C3.06269 15.92 2.23339 15.5765 1.62195 14.965C1.0105 14.3536 0.666992 13.5243 0.666992 12.6596V4.34393C0.666992 4.34393 0.666992 4.34392 0.666992 4.34391C0.667005 4.1065 0.732928 3.87432 0.856627 3.67295ZM3.92741 1.0835H6.79199V4.34391C6.79199 4.94894 7.03234 5.52918 7.46015 5.957C7.88797 6.38482 8.46822 6.62516 9.07324 6.62516H12.3337V12.6564C12.3337 12.8247 12.3005 12.9913 12.2361 13.1467C12.1717 13.3022 12.0774 13.4434 11.9584 13.5624C11.8394 13.6814 11.6982 13.7757 11.5427 13.8401C11.3873 13.9045 11.2207 13.9377 11.0524 13.9377H3.92741C3.5876 13.9377 3.26171 13.8027 3.02143 13.5624C2.78115 13.3221 2.64616 12.9962 2.64616 12.6564V2.36475C2.64616 2.02494 2.78115 1.69905 3.02143 1.45877C3.26171 1.21848 3.5876 1.0835 3.92741 1.0835ZM8.97949 4.34391V2.18644L11.2307 4.43766H9.07324C9.04838 4.43766 9.02453 4.42779 9.00695 4.4102C8.98937 4.39262 8.97949 4.36878 8.97949 4.34391Z"
                                                stroke="black"></path>
                                        </svg></button></div>
                            </div>
                        </div>
                        <h5>Connector Details </h5>
                        <div class="details-box">
                            <div class="keyValue "><span class="item">Connector Name</span><span
                                    class="item span-value ">{{ ucfirst($viewLeadDetails->connector->connector_name ?? '') }}</span>
                            </div>
                            <div class="keyValue "><span class="item">Assign To</span><span
                                    class="item span-value ">{{ ucfirst($viewLeadDetails->user->name) }}</span></div>
                            <div class="keyValue  hide-bottom"><span class="item">Assign To Back
                                    Office</span><span
                                    class="item span-value ">{{ ucfirst($viewLeadDetails->assigned_back_office) }}</span>
                            </div>
                        </div>
                        <h5>Call to Action Details</h5>

                        <div class="details-box">
                            <div class="keyValue"><span style="font-size: 14px;">Call to
                                    Action</span>
                                <a href="#view_more_screen" class="btn btn-sm btn-danger"> View More</a>
                            </div>
                            <div class="keyValue"><span
                                    style="font-size: 20px; color: black; margin-bottom: 10px;"></span>
                            </div>
                            <div class="keyValue "><span class="item">Product Type</span><span
                                    class="item span-value  bg"></span></div>
                            <div class="keyValue  hide-bottom"><span class="item">Offer
                                    Amount</span><span class="item span-value  bg"></span></div>
                        </div>
                    </div>
                    <!--end::Col-->
                    <div class="col-md-7 p-0 col-border-right-3">
                        <!--begin::Nav-->
                        <ul class="nav d-flex g-5 mb-3 mx-5 parent__ul">
                            <!--begin::Item-->
                            <li class="nav-item">
                                <!--begin::Link-->
                                <a class="nav-link active" data-bs-toggle="tab" id="kt_charts_widget_35_tab_1"
                                    href="#kt_charts_widget_35_tab_content_1">
                                    Prospect
                                </a>
                                <!--end::Link-->
                            </li> &nbsp;
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item">
                                <!--begin::Link-->
                                <a class="nav-link " data-bs-toggle="tab" id="kt_charts_widget_35_tab_2"
                                    href="#kt_charts_widget_35_tab_content_2">

                                    Documents
                                </a>
                                <!--end::Link-->
                            </li> &nbsp;
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item">
                                <!--begin::Link-->
                                <a class="nav-link " data-bs-toggle="tab" id="kt_charts_widget_35_tab_3"
                                    href="#kt_charts_widget_35_tab_content_3">

                                    Login
                                </a>
                                <!--end::Link-->
                            </li>
                            <!--begin::Item-->
                            <li class="nav-item">
                                <!--begin::Link-->
                                <a class="nav-link " data-bs-toggle="tab" id="kt_charts_widget_35_tab_4"
                                    href="#kt_charts_widget_35_tab_content_4">

                                    Lender Decision Stage
                                </a>
                                <!--end::Link-->
                            </li>
                            <!--end::Item-->


                        </ul>
                        <!--end::Nav-->
                        @php
                            $activeTab = session('tab_value', 'tab_1');
                        @endphp
                        <!--begin::Tab Content-->
                        <div class="tab-content mt-5">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade active show" id="kt_charts_widget_35_tab_content_1">

                                <!--begin::Nav-->
                                <ul class="nav d-flex g-5 mb-3 mx-5 parent__ul">
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3">
                                        <!--begin::Link-->
                                        <a class="nav-link {{ $activeTab == 'tab_1' ? 'active' : '' }}"
                                            data-bs-toggle="tab" id="tab_1" href="#content_1">
                                            Loan Details
                                        </a>
                                        <!--end::Link-->
                                    </li> &nbsp;
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3">
                                        <!--begin::Link-->
                                        <a class="nav-link {{ $activeTab == 'tab_2' ? 'active' : '' }}"
                                            data-bs-toggle="tab" id="tab_2" href="#content_2">

                                            Applicant Details
                                        </a>
                                        <!--end::Link-->
                                    </li> &nbsp;
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3">
                                        <!--begin::Link-->
                                        <a class="nav-link {{ $activeTab == 'tab_3' ? 'active' : '' }}"
                                            data-bs-toggle="tab" id="tab_3" href="#content_3">
                                            Income Details
                                        </a>
                                        <!--end::Link-->
                                    </li>&nbsp;
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3">
                                        <!--begin::Link-->
                                        <a class="nav-link {{ $activeTab == 'tab_4' ? 'active' : '' }}"
                                            data-bs-toggle="tab" id="tab_4" href="#content_4">
                                            Co-Applicant Details
                                        </a>
                                        <!--end::Link-->
                                    </li>&nbsp;
                                    <!--end::Item-->



                                </ul>
                                <!--end::Nav-->
                                <!--begin::Tab Content-->
                                <div class="tab-content mt-5">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade {{ $activeTab == 'tab_1' ? 'active show' : '' }}"
                                        id="content_1">

                                        <div class="mx-5 mt-5">
                                            <form action="{{ route('loan.update', $viewLeadDetails->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="form-label" for="">Loan Amount
                                                        *</label>
                                                    <input type="text" class="form-control" id="amount"
                                                        name="amount" placeholder=""
                                                        value="{{ old('amount', $viewLoanDetails->amount) }}">

                                                    @if ($errors->has('amount'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('amount') }}
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="">Loan Tenure
                                                        (In Years) *</label>
                                                    <input type="text" class="form-control" id=""
                                                        name="tenure" placeholder=""
                                                        value="{{ old('tenure', $viewLoanDetails->tenure) }}">

                                                    @if ($errors->has('tenure'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('tenure') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group form-check mb-3">

                                                    <input type="hidden" name="is_identified" value="2">

                                                    <input type="checkbox" class="form-check-input"
                                                        id="is_identified" name="is_identified" value="1"
                                                        {{ old('is_identified', $viewLoanDetails->is_identified ?? false) == 1 ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="is_identified">
                                                        Is property identified?
                                                    </label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="">Approximate
                                                        Value of Property </label>
                                                    <input type="text" class="form-control" id=""
                                                        name="approximate_value" placeholder=""
                                                        value={{ $viewLoanDetails->approximate_value }}>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="">Ownership</label>

                                                    <select class="form-control" id="ownership" name="ownership">
                                                        <option value="sole"
                                                            {{ old('ownership', $viewLoanDetails->ownership ?? '') == 'sole' ? 'selected' : '' }}>
                                                            Sole
                                                        </option>
                                                        <option value="joint"
                                                            {{ old('ownership', $viewLoanDetails->ownership ?? '') == 'joint' ? 'selected' : '' }}>
                                                            Joint
                                                        </option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>

                                                <div class="border mt-3 mb-3"></div>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Select
                                                            Disposition 1 </label>

                                                        <select class="form-control" id="disposition_1"
                                                            name="disposition_1">
                                                            <option value="">Select Disposition 1</option>
                                                            <option value="cross set - closer"
                                                                {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'cross set - closer' ? 'selected' : '' }}>
                                                                Cross Set - Closer
                                                            </option>
                                                            <option value="language barrier"
                                                                {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'language barrier' ? 'selected' : '' }}>
                                                                Language Barrier
                                                            </option>
                                                            <option value="not interested"
                                                                {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'not interested' ? 'selected' : '' }}>
                                                                Not Interested
                                                            </option>
                                                            <option value="not contactable"
                                                                {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'not contactable' ? 'selected' : '' }}>
                                                                Not Contactable
                                                            </option>
                                                            <option value="rejected"
                                                                {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'rejected' ? 'selected' : '' }}>
                                                                Rejected
                                                            </option>
                                                            <option value="follow up"
                                                                {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'follow up' ? 'selected' : '' }}>
                                                                Follow Up
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Select
                                                            Disposition 2</label>
                                                        <select class="form-control" id=""
                                                            name="disposition_2">

                                                            <option value="sole"
                                                                {{ old('disposition_2', $viewLoanDetails->disposition_2 ?? '') == 'sole' ? 'selected' : '' }}>
                                                                Sole
                                                            </option>
                                                            <option value="joint"
                                                                {{ old('disposition_2', $viewLoanDetails->disposition_2 ?? '') == 'joint' ? 'selected' : '' }}>
                                                                Joint
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <textarea class="form-control" id="comment" name="comment" placeholder="Add comment here...">{{ old('comment', $viewLoanDetails->comment ?? '') }}</textarea>
                                                    </div>

                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <!--end::Tap pane-->


                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade {{ $activeTab == 'tab_2' ? 'active show' : '' }}"
                                        id="content_2">
                                        <div class="mx-5 mt-5">
                                            <!--begin::Table-->
                                            <form action="{{ route('lead.update', $viewLeadDetails->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="applicant_type">Applicant Type
                                                            *</label>
                                                        <select class="form-control" id="applicant_type"
                                                            name="applicant_type">
                                                            <option value="">Select Applicant Type</option>
                                                            <option value="business"
                                                                {{ old('applicant_type', $viewLeadDetails->applicant_type ?? '') == 'business' ? 'selected' : '' }}>
                                                                Business
                                                            </option>
                                                            <option value="individual"
                                                                {{ old('applicant_type', $viewLeadDetails->applicant_type ?? '') == 'individual' ? 'selected' : '' }}>
                                                                Individual
                                                            </option>
                                                        </select>
                                                        @if ($errors->has('applicant_type'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('applicant_type') }}</div>
                                                        @endif

                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="business_type">Business Type
                                                            *</label>
                                                        <select class="form-select" id="business_type"
                                                            name="business_type">
                                                            <option value="">Select Business Type</option>
                                                            <option value="limited"
                                                                {{ old('business_type', $viewLeadDetails->business_type ?? '') == 'limited' ? 'selected' : '' }}>
                                                                Limited
                                                            </option>
                                                            <option value="private limited"
                                                                {{ old('business_type', $viewLeadDetails->business_type ?? '') == 'private limited' ? 'selected' : '' }}>
                                                                Private Limited
                                                            </option>
                                                            <option value="partnership"
                                                                {{ old('business_type', $viewLeadDetails->business_type ?? '') == 'partnership' ? 'selected' : '' }}>
                                                                Partnership
                                                            </option>
                                                            <option value="limited liability partnership"
                                                                {{ old('business_type', $viewLeadDetails->business_type ?? '') == 'limited liability partnership' ? 'selected' : '' }}>
                                                                Limited Liability Partnership
                                                            </option>
                                                            <option value="hindu undivided family"
                                                                {{ old('business_type', $viewLeadDetails->business_type ?? '') == 'hindu undivided family' ? 'selected' : '' }}>
                                                                Hindu Undivided Family
                                                            </option>
                                                            <option value="sole proprietor"
                                                                {{ old('business_type', $viewLeadDetails->business_type ?? '') == 'sole proprietor' ? 'selected' : '' }}>
                                                                Sole Proprietor
                                                            </option>
                                                            <option value="trust"
                                                                {{ old('business_type', $viewLeadDetails->business_type ?? '') == 'trust' ? 'selected' : '' }}>
                                                                Trust
                                                            </option>
                                                        </select>
                                                        @if ($errors->has('business_type'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('business_type') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Business as per PAN
                                                            *</label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="" name="customer_name"
                                                            value={{ $viewLeadDetails->customer_name }}>
                                                        @if ($errors->has('customer_name'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('customer_name') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Email</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="email" placeholder=""
                                                            value={{ $viewLeadDetails->email }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Mobile
                                                            Number *</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="customer_number" placeholder=""
                                                            value={{ $viewLeadDetails->customer_number }}>
                                                        @if ($errors->has('customer_number'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('customer_number') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Business PAN</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="pan" placeholder=""
                                                            value={{ strtoupper($viewLeadDetails->pan) }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Date of
                                                            Incorporation</label>
                                                        <input type="date" class="form-control" id=""
                                                            name="incorporation_date" placeholder=""
                                                            value={{ $viewLeadDetails->incorporation_date }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Vintage/ No. of years
                                                            in
                                                            business</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="no_of_years" placeholder=""
                                                            value={{ $viewLeadDetails->no_of_years }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">
                                                            Business Profile</label>

                                                        <select class="form-control" id="business_profile"
                                                            name="business_profile">

                                                            <option value="manufacturer"
                                                                {{ old('business_profile', $viewLeadDetails->business_profile ?? '') == 'manufacturer' ? 'selected' : '' }}>
                                                                Business
                                                            </option>
                                                            <option value="trader"
                                                                {{ old('business_profile', $viewLeadDetails->business_profile ?? '') == 'trader' ? 'selected' : '' }}>
                                                                Trader
                                                            </option>
                                                            <option value="services"
                                                                {{ old('business_profile', $viewLeadDetails->business_profile ?? '') == 'services' ? 'selected' : '' }}>
                                                                Services
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--end::Table-->
                                                <!--begin::Accordion-->
                                                <div class="accordion accordion-icon-collapse" id="kt_accordion_3">
                                                    <!--begin::Item-->
                                                    <div class="mb-5">
                                                        <!--begin::Header-->
                                                        <div class="accordion-header py-3 d-flex"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_3_item_1">
                                                            <span class="accordion-icon">
                                                                <i
                                                                    class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span></i>
                                                                <i
                                                                    class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i>
                                                            </span>
                                                            <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                                Business Operational Address
                                                            </h3>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_3_item_1"
                                                            class="accordian-body fs-6 collapse show ps-10"
                                                            data-bs-parent="#kt_accordion_3">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">Pincode</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="pincode"
                                                                        value={{ $viewLeadDetails->pincode }}>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label" for="">Address
                                                                        Line
                                                                        1</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="address"
                                                                        value={{ $viewLeadDetails->address }}>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">City</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="city"
                                                                        value={{ $viewLeadDetails->city }}>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">State</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="state"
                                                                        value={{ $viewLeadDetails->state }}>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="country"
                                                                        value={{ $viewLeadDetails->country }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="mb-5">
                                                        <!--begin::Header-->
                                                        <div class="accordion-header py-3 d-flex collapsed"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_3_item_2">
                                                            <span class="accordion-icon">
                                                                <i
                                                                    class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span></i>
                                                                <i
                                                                    class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i>
                                                            </span>
                                                            <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                                Registered Operational Address</h3>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_3_item_2"
                                                            class="accordian-body collapse fs-6 ps-10"
                                                            data-bs-parent="#kt_accordion_3">

                                                            <div class="row">
                                                                <div class="form-group form-check mb-3 float-right">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="exampleCheck1">
                                                                    <label class="form-label" for="exampleCheck1">Same
                                                                        as
                                                                        business address</label>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">Pincode</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder=""
                                                                        name="reg_pincode"
                                                                        value={{ $viewLeadDetails->reg_pincode }}>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label" for="">Address
                                                                        Line
                                                                        1</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder=""
                                                                        name="reg_address"
                                                                        value={{ $viewLeadDetails->reg_address }}>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">City</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="reg_city"
                                                                        value={{ $viewLeadDetails->reg_city }}>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">State</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder=""
                                                                        name="reg_state"
                                                                        value={{ $viewLeadDetails->reg_state }}>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder=""
                                                                        name="reg_country"
                                                                        value={{ $viewLeadDetails->reg_country }}>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Item-->


                                                </div>
                                                <!--end::Accordion-->

                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Select
                                                            Disposition 1 </label>

                                                        <select class="form-control" id="disposition_1"
                                                            name="disposition_1">
                                                            <option value="">Select Disposition 1</option>
                                                            <option value="cross set - closer"
                                                                {{ old('disposition_1', $viewLeadDetails->disposition_1 ?? '') == 'cross set - closer' ? 'selected' : '' }}>
                                                                Cross Set - Closer
                                                            </option>
                                                            <option value="language barrier"
                                                                {{ old('disposition_1', $viewLeadDetails->disposition_1 ?? '') == 'language barrier' ? 'selected' : '' }}>
                                                                Language Barrier
                                                            </option>
                                                            <option value="not interested"
                                                                {{ old('disposition_1', $viewLeadDetails->disposition_1 ?? '') == 'not interested' ? 'selected' : '' }}>
                                                                Not Interested
                                                            </option>
                                                            <option value="not contactable"
                                                                {{ old('disposition_1', $viewLeadDetails->disposition_1 ?? '') == 'not contactable' ? 'selected' : '' }}>
                                                                Not Contactable
                                                            </option>
                                                            <option value="rejected"
                                                                {{ old('disposition_1', $viewLeadDetails->disposition_1 ?? '') == 'rejected' ? 'selected' : '' }}>
                                                                Rejected
                                                            </option>
                                                            <option value="follow up"
                                                                {{ old('disposition_1', $viewLeadDetails->disposition_1 ?? '') == 'follow up' ? 'selected' : '' }}>
                                                                Follow Up
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Select
                                                            Disposition 2</label>
                                                        <select class="form-control" id=""
                                                            name="disposition_2">

                                                            <option value="sole"
                                                                {{ old('disposition_2', $viewLeadDetails->disposition_2 ?? '') == 'sole' ? 'selected' : '' }}>
                                                                Sole
                                                            </option>
                                                            <option value="joint"
                                                                {{ old('disposition_2', $viewLeadDetails->disposition_2 ?? '') == 'joint' ? 'selected' : '' }}>
                                                                Joint
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 form-group">

                                                        <textarea class="form-control" id="comment" name="comment" placeholder="Add comment here...">{{ old('comment', $viewLeadDetails->comment ?? '') }}</textarea>

                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                        <!--end::Table container-->


                                    </div>
                                    <!--end::Tap pane-->


                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade {{ $activeTab == 'tab_3' ? 'active show' : '' }}"
                                        id="content_3">
                                        <!--begin::Chart-->
                                        <!--begin::Table container-->
                                        <div class="mx-5 mt-5">
                                            <!--begin::Table-->

                                            <form action="{{ route('income.update', $viewLeadDetails->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Latest Annual
                                                            Business Turn Over</label>
                                                        <input type="text" class="form-control"
                                                            name="latest_turnover"
                                                            value="{{ old('latest_turnover', $viewIncomeDetails->latest_turnover ?? '') }}"
                                                            placeholder="">
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Previous Annual
                                                            Business Turn
                                                            Over
                                                        </label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="" name="previous_turnover"
                                                            value="{{ old('previous_turnover', $viewIncomeDetails->previous_turnover ?? '') }}">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Net
                                                            Profit as per Latest Financials
                                                        </label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="" name="latest_profit"
                                                            value="{{ old('latest_profit', $viewIncomeDetails->latest_profit ?? '') }}">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Net
                                                            Profit as per Previous Financials
                                                        </label>

                                                        <input type="text" class="form-control" id=""
                                                            placeholder="" name="previous_profit"
                                                            value="{{ old('previous_profit', $viewIncomeDetails->previous_profit ?? '') }}">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Total
                                                            Current Loan/s Outstanding
                                                        </label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="" name="total_loan_outstanding"
                                                            value="{{ old('total_loan_outstanding', $viewIncomeDetails->total_loan_outstanding ?? '') }}">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Total
                                                            current monthly EMI
                                                        </label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="" name="total_current_monthly_emi"
                                                            value="{{ old('total_current_monthly_emi', $viewIncomeDetails->total_current_monthly_emi ?? '') }}">
                                                    </div>
                                                    <div class="col-md-12 form-group form-check mb-3">
                                                        <input type="hidden" name="is_coapplicant" value="2">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="is_coapplicant" name="is_coapplicant" value="1"
                                                            {{ old('is_coapplicant', $viewIncomeDetails->is_coapplicant ?? '2') == '1' ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="is_coapplicant">
                                                            Do you wish to add a Co-applicant?
                                                        </label>
                                                    </div>


                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    <div class="col-md-12 form-group mt-5">
                                                        <textarea class="form-control" id="comment" name="comment" placeholder="Add comment here...">{{ old('comment', $viewIncomeDetails->comment ?? '') }}</textarea>

                                                    </div>
                                                </div>
                                            </form>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->

                                    </div>
                                    <!--end::Tap pane-->

                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade {{ $activeTab == 'tab_4' ? 'active show' : '' }}"
                                        id="content_4">
                                        <!--begin::Chart-->
                                        <div class="mx-5 mt-5">
                                            <form action="{{ route('coapplicant.update', $viewLeadDetails->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="applicant_type">Applicant Type
                                                            *</label>
                                                        <select class="form-control" id="applicant_type"
                                                            name="applicant_type">
                                                            <option value="">Select Applicant Type</option>
                                                            <option value="business"
                                                                {{ old('applicant_type', $coApplicantDetails->applicant_type ?? '') == 'business' ? 'selected' : '' }}>
                                                                Business
                                                            </option>
                                                            <option value="individual"
                                                                {{ old('applicant_type', $coApplicantDetails->applicant_type ?? '') == 'individual' ? 'selected' : '' }}>
                                                                Individual
                                                            </option>


                                                        </select>
                                                        @if ($errors->has('applicant_type'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('applicant_type') }}</div>
                                                        @endif

                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="business_type">Business Type
                                                            *</label>
                                                        <select class="form-select" id="business_type"
                                                            name="business_type">
                                                            <option value="">Select Business Type</option>
                                                            <option value="limited"
                                                                {{ old('business_type', $coApplicantDetails->business_type ?? '') == 'limited' ? 'selected' : '' }}>
                                                                Limited
                                                            </option>
                                                            <option value="private limited"
                                                                {{ old('business_type', $coApplicantDetails->business_type ?? '') == 'private limited' ? 'selected' : '' }}>
                                                                Private Limited
                                                            </option>
                                                            <option value="partnership"
                                                                {{ old('business_type', $coApplicantDetails->business_type ?? '') == 'partnership' ? 'selected' : '' }}>
                                                                Partnership
                                                            </option>
                                                            <option value="limited liability partnership"
                                                                {{ old('business_type', $coApplicantDetails->business_type ?? '') == 'limited liability partnership' ? 'selected' : '' }}>
                                                                Limited Liability Partnership
                                                            </option>
                                                            <option value="hindu undivided family"
                                                                {{ old('business_type', $coApplicantDetails->business_type ?? '') == 'hindu undivided family' ? 'selected' : '' }}>
                                                                Hindu Undivided Family
                                                            </option>
                                                            <option value="sole proprietor"
                                                                {{ old('business_type', $coApplicantDetails->business_type ?? '') == 'sole proprietor' ? 'selected' : '' }}>
                                                                Sole Proprietor
                                                            </option>
                                                            <option value="trust"
                                                                {{ old('business_type', $coApplicantDetails->business_type ?? '') == 'trust' ? 'selected' : '' }}>
                                                                Trust
                                                            </option>
                                                        </select>
                                                        @if ($errors->has('business_type'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('business_type') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Business as per PAN
                                                            *</label>
                                                        <input type="text" class="form-control" id=""
                                                            placeholder="" name="name"
                                                            value={{ $coApplicantDetails->name ?? '' }}>
                                                        @if ($errors->has('name'))
                                                            <div class="text-danger">{{ $errors->first('name') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Email</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="email" placeholder=""
                                                            value={{ $coApplicantDetails->email ?? '' }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Mobile
                                                            Number *</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="number" placeholder=""
                                                            value={{ $coApplicantDetails->number ?? '' }}>
                                                        @if ($errors->has('number'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('number') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Business PAN</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="pan" placeholder=""
                                                            value={{ strtoupper($coApplicantDetails->pan ?? '') }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Date of
                                                            Incorporation</label>
                                                        <input type="date" class="form-control" id=""
                                                            name="incorporation_date" placeholder=""
                                                            value={{ $coApplicantDetails->incorporation_date ?? '' }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Vintage/ No. of years
                                                            in
                                                            business</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="no_of_years" placeholder=""
                                                            value={{ $coApplicantDetails->no_of_years ?? '' }}>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">
                                                            Business Profile</label>

                                                        <select class="form-control" id="business_profile"
                                                            name="business_profile">

                                                            <option value="manufacturer"
                                                                {{ old('business_profile', $coApplicantDetails->business_profile ?? '') == 'manufacturer' ? 'selected' : '' }}>
                                                                Business
                                                            </option>
                                                            <option value="trader"
                                                                {{ old('business_profile', $coApplicantDetails->business_profile ?? '') == 'trader' ? 'selected' : '' }}>
                                                                Trader
                                                            </option>
                                                            <option value="services"
                                                                {{ old('business_profile', $coApplicantDetails->business_profile ?? '') == 'services' ? 'selected' : '' }}>
                                                                Services
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--end::Table-->
                                                <!--begin::Accordion-->
                                                <div class="accordion accordion-icon-collapse" id="kt_accordion_3">
                                                    <!--begin::Item-->
                                                    <div class="mb-5">
                                                        <!--begin::Header-->
                                                        <div class="accordion-header py-3 d-flex"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_3_item_1">
                                                            <span class="accordion-icon">
                                                                <i
                                                                    class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span></i>
                                                                <i
                                                                    class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i>
                                                            </span>
                                                            <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                                Business Operational Address
                                                            </h3>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_3_item_1"
                                                            class="accordian-body fs-6 collapse show ps-10"
                                                            data-bs-parent="#kt_accordion_3">
                                                            <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">Pincode</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="pincode"
                                                                        value={{ $coApplicantDetails->pincode ?? '' }}>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label" for="">Address
                                                                        Line
                                                                        1</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="address"
                                                                        value={{ $coApplicantDetails->address ?? '' }}>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">City</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="city"
                                                                        value={{ $coApplicantDetails->city ?? '' }}>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">State</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="state"
                                                                        value={{ $coApplicantDetails->state ?? '' }}>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="country"
                                                                        value={{ $coApplicantDetails->country ?? '' }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="mb-5">
                                                        <!--begin::Header-->
                                                        <div class="accordion-header py-3 d-flex collapsed"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_3_item_2">
                                                            <span class="accordion-icon">
                                                                <i
                                                                    class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span></i>
                                                                <i
                                                                    class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span></i>
                                                            </span>
                                                            <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                                Registered Operational Address</h3>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_3_item_2"
                                                            class="accordian-body collapse fs-6 ps-10"
                                                            data-bs-parent="#kt_accordion_3">

                                                            <div class="row">
                                                                <div class="form-group form-check mb-3 float-right">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="exampleCheck1">
                                                                    <label class="form-label" for="exampleCheck1">Same
                                                                        as
                                                                        business address</label>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">Pincode</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder=""
                                                                        name="reg_pincode"
                                                                        value={{ $coApplicantDetails->reg_pincode ?? '' }}>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label" for="">Address
                                                                        Line
                                                                        1</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder=""
                                                                        name="reg_address"
                                                                        value={{ $coApplicantDetails->reg_address ?? '' }}>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">City</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder="" name="reg_city"
                                                                        value={{ $coApplicantDetails->reg_city ?? '' }}>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">State</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder=""
                                                                        name="reg_state"
                                                                        value={{ $coApplicantDetails->reg_state ?? '' }}>
                                                                </div>

                                                                <div class="col-md-6 form-group">
                                                                    <label class="form-label"
                                                                        for="">Country</label>
                                                                    <input type="text" class="form-control"
                                                                        id="" placeholder=""
                                                                        name="reg_country"
                                                                        value={{ $coApplicantDetails->reg_country ?? '' }}>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Item-->


                                                </div>
                                                <!--end::Accordion-->

                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Select
                                                            Disposition 1 </label>

                                                        <select class="form-control" id="disposition_1"
                                                            name="disposition_1">
                                                            <option value="">Select Disposition 1</option>
                                                            <option value="cross set - closer"
                                                                {{ old('disposition_1', $coApplicantDetails->disposition_1 ?? '') == 'cross set - closer' ? 'selected' : '' }}>
                                                                Cross Set - Closer
                                                            </option>
                                                            <option value="language barrier"
                                                                {{ old('disposition_1', $coApplicantDetails->disposition_1 ?? '') == 'language barrier' ? 'selected' : '' }}>
                                                                Language Barrier
                                                            </option>
                                                            <option value="not interested"
                                                                {{ old('disposition_1', $coApplicantDetails->disposition_1 ?? '') == 'not interested' ? 'selected' : '' }}>
                                                                Not Interested
                                                            </option>
                                                            <option value="not contactable"
                                                                {{ old('disposition_1', $coApplicantDetails->disposition_1 ?? '') == 'not contactable' ? 'selected' : '' }}>
                                                                Not Contactable
                                                            </option>
                                                            <option value="rejected"
                                                                {{ old('disposition_1', $coApplicantDetails->disposition_1 ?? '') == 'rejected' ? 'selected' : '' }}>
                                                                Rejected
                                                            </option>
                                                            <option value="follow up"
                                                                {{ old('disposition_1', $coApplicantDetails->disposition_1 ?? '') == 'follow up' ? 'selected' : '' }}>
                                                                Follow Up
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label" for="">Select
                                                            Disposition 2</label>
                                                        <select class="form-control" id=""
                                                            name="disposition_2">

                                                            <option value="sole"
                                                                {{ old('disposition_2', $coApplicantDetails->disposition_2 ?? '') == 'sole' ? 'selected' : '' }}>
                                                                Sole
                                                            </option>
                                                            <option value="joint"
                                                                {{ old('disposition_2', $coApplicantDetails->disposition_2 ?? '') == 'joint' ? 'selected' : '' }}>
                                                                Joint
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 form-group">

                                                        <textarea class="form-control" id="comment" name="comment" placeholder="Add comment here...">{{ old('comment', $coApplicantDetails->comment ?? '') }}</textarea>

                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--end::Table container-->


                                    </div>
                                    <!--end::Tap pane-->


                                </div>
                                <!--end::Tab Content-->



                            </div>
                            <!--end::Tap pane-->
                            <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_2">
                                @include('company.leads.documents')
                            </div>

                            <!--begin::Tap pane-->
                            <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_3">
                                <!--begin::Table container-->
                                <!--begin::Nav-->
                                <ul class="nav d-flex g-5 mb-3 mx-5 parent__ul">
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3">
                                        <!--begin::Link-->
                                        <a class="nav-link active" data-bs-toggle="tab" id="tabss_1"
                                            href="#contentss_1">

                                            HL Assisted Journey
                                        </a>
                                        <!--end::Link-->
                                    </li>

                                </ul>
                                <!--end::Nav-->

                                <!--begin::Tab Content-->
                                <div class="tab-content mt-5">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade active show" id="contentss_1">
                                        <div class="row align-items-center clearfix mb-5 mx-5">
                                            <div class="col-md-4">
                                                <h5>Decisioning/Lender Selection </h5>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control m-0" placeholder="Search">
                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-sm btn-primary">
                                                    Search</a>

                                            </div>
                                        </div>
                                        <div class="table-responsive clearfix mx-5 mt-5">
                                            <!--begin::Table-->
                                            <table
                                                class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="fs-7 fw-bold text-gray-500">

                                                        <th class="">Lender Name</th>
                                                        <th class="">Purpose </th>
                                                        <th class="">Gating Eligibility Passed
                                                        </th>
                                                        <th class="">Score </th>
                                                        <th class="">Max Loan Amount </th>
                                                        <th class="">Total EMI </th>
                                                        <th class="">Tenure (in years) </th>
                                                        <th class="">ROI % </th>
                                                        <th class="">Action</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->

                                                <!--begin::Table body-->
                                                <tbody>
                                                    @forelse ($lenderDetails as $index => $lenderDetail)
                                                        <tr>


                                                            <td>{{ ucfirst($lenderDetail->lender->name) }}</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            @php
                                                                $lead_id = $viewLeadDetails->id; // ensure lead_id is available
                                                            @endphp
                                                            <td>
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-sm btn-icon btn-bg-light assign-lender-btn {{ in_array($lenderDetail->id, $selectedLenderIds) ? 'lender-selected' : '' }}"
                                                                    data-lender-id="{{ $lenderDetail->id }}"
                                                                    data-lead-id="{{ $lead_id }}"
                                                                    title="Assign Lender">
                                                                    @if (in_array($lenderDetail->id, $selectedLenderIds))
                                                                        <i class="fa fa-lock text-primary"></i>
                                                                    @else
                                                                        <i class="fa fa-check-circle text-muted"></i>
                                                                    @endif
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="14">
                                                                <span class="text-danger">
                                                                    <strong>No Lender Found!</strong>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>

                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                        <div class="col-md-12 clearfix">
                                            <ul class="pagination mt-3 float-right">
                                                {{ $lenderDetails->links() }}
                                            </ul>
                                        </div>

                                    </div>
                                    <!--end::Tap pane-->


                                </div>
                                <!--end::Tab Content-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane-->
                            @php
                                $leadId = $viewLoanDetails->id;
                            @endphp

                            <div class="tab-pane fade mx-5" id="kt_charts_widget_35_tab_content_4">
                                <form id="loan-decision-form">
                                    <!-- Request details -->
                                    <div class="row align-items-center clearfix mb-5">
                                        <div class="col-md-2">
                                            <h5><strong>Request details:</strong></h5>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">Total Tentative Loan Amount</label>
                                            <input type="text" class="form-control m-0"
                                                value="{{ $viewLoanDetails->amount }}" disabled />
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">Total Sanctioned Loan Amount</label>
                                            <input type="text"
                                                class="form-control m-0 total-sanctioned-loan-amount"
                                                value="{{ $viewLoanDetails->sanctioned_amount ?? 0 }}" disabled />
                                        </div>
                                    </div>

                                    <!-- Lender decision row -->
                                    <div class="row align-items-center clearfix mb-5 lender-decision-row">
                                        <div class="col-md-2 fw-bold">{{ $selectedLenderNames->leadLender->lender->name ?? '' }}</div>

                                        <div class="col-md-2">
                                            <label class="form-label">Loan Status</label>
                                            <select class="form-select status-select" name="status">
                                                <option value="Sanctioned"
                                                    {{ old('Sanctioned', $viewLoanDetails->status ?? '') == 'Sanctioned' ? 'selected' : '' }}>
                                                    Sanctioned</option>
                                                <option value="Rejected"
                                                    {{ old('Rejected', $viewLoanDetails->status ?? '') == 'Rejected' ? 'selected' : '' }}>
                                                    Rejected</option>
                                                <option value="Withdrawn"
                                                    {{ old('Withdrawn', $viewLoanDetails->status ?? '') == 'Withdrawn' ? 'selected' : '' }}>
                                                    Withdrawn</option>
                                                <option value="Pendency"
                                                    {{ old('Pendency', $viewLoanDetails->status ?? '') == 'Pendency' ? 'selected' : '' }}>
                                                    Pendency</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 sanctioned-fields">
                                            <label class="form-label">* Interest rate %</label>
                                            <input type="number" class="form-control" name="interest_rate"
                                                value="{{ $viewLoanDetails->interest_rate ?? 0 }}" />
                                        </div>

                                        <div class="col-md-2 sanctioned-fields">
                                            <label class="form-label">* Amount</label>
                                            <input type="number" class="form-control m-0 sanctioned_amount_input"
                                                name="sanctioned_amount"
                                                value="{{ $viewLoanDetails->sanctioned_amount ?? 0 }}" />
                                        </div>

                                        <div class="col-md-3 sanctioned-fields">
                                            <label class="form-label">Sanctioned Date</label>
                                            <input type="date" class="form-control" name="sanctioned_date"
                                                value="{{ $viewLoanDetails->sanctioned_date ?? '' }}" />
                                        </div>

                                        <div class="col-md-4 reason-field d-none">
                                            <label class="form-label">Reason</label>
                                            <input type="text" class="form-control" name="reason"
                                                placeholder="Enter reason"
                                                value="{{ $viewLoanDetails->reason ?? '' }}" />
                                        </div>
                                    </div>

                                    <div class="border mt-3 mb-3"></div>

                                    <!-- Disposition -->
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="form-label">Select Disposition 1</label>
                                            <select class="form-control" id="disposition_1" name="disposition_1">
                                                <option value="">Select Disposition 1</option>
                                                <option value="cross set - closer"
                                                    {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'cross set - closer' ? 'selected' : '' }}>
                                                    Cross Set - Closer</option>
                                                <option value="language barrier"
                                                    {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'language barrier' ? 'selected' : '' }}>
                                                    Language Barrier</option>
                                                <option value="not interested"
                                                    {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'not interested' ? 'selected' : '' }}>
                                                    Not Interested</option>
                                                <option value="not contactable"
                                                    {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'not contactable' ? 'selected' : '' }}>
                                                    Not Contactable</option>
                                                <option value="rejected"
                                                    {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'rejected' ? 'selected' : '' }}>
                                                    Rejected</option>
                                                <option value="follow up"
                                                    {{ old('disposition_1', $viewLoanDetails->disposition_1 ?? '') == 'follow up' ? 'selected' : '' }}>
                                                    Follow Up</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="form-label">Select Disposition 2</label>
                                            <select class="form-control" name="disposition_2">
                                                <option value="sole"
                                                    {{ old('disposition_2', $viewLoanDetails->disposition_2 ?? '') == 'sole' ? 'selected' : '' }}>
                                                    Sole</option>
                                                <option value="joint"
                                                    {{ old('disposition_2', $viewLoanDetails->disposition_2 ?? '') == 'joint' ? 'selected' : '' }}>
                                                    Joint</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <textarea class="form-control" id="comment" name="comment" placeholder="Add comment here...">{{ old('comment', $viewLoanDetails->comment ?? '') }}</textarea>
                                        </div>

                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary submit-lender-decision">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!--end::Tap pane-->
                        <div class="border mt-3 mb-3"></div>
                        <div class="timeline">
                            @foreach ($leadStatusManageDetails as $leadStatusManageDetail)
                                @php
                                    $userName = $leadStatusManageDetail->user->name;
                                    $initials =
                                        strtoupper(substr($userName, 0, 1)) . strtoupper(substr($userName, 1, 1));
                                    $status = $leadStatusManageDetail->lead_state;
                                    $subStatus = $leadStatusManageDetail->lead_sub_state;
                                    $nextStatus = $leadStatusManageDetail->lead_next_sub_state;
                                    $createdAt = \Carbon\Carbon::parse($leadStatusManageDetail->created_at)->format(
                                        'd M Y h:i A',
                                    );
                                @endphp

                                <div style="display: flex; margin-bottom: 20px; align-items: flex-start;">
                                    <!-- Profile Initials Circle -->
                                    <div>
                                        <p class="history-logo"
                                            style="--bgColor: #273896; width: 40px; height: 40px; border-radius: 50%; background-color: var(--bgColor); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                            {{ $initials }}
                                        </p>
                                    </div>

                                    <!-- Details -->
                                    <div style="display: grid; width: 100%; margin-left: 10px;">
                                        <div class="history-header-name">
                                            <p style="font-size: 14px; margin-bottom: 4px;">
                                                {{ $userName }} changed the Status:
                                                <span
                                                    class="history-status-name fw-bold text-primary">{{ $status }}</span>
                                            </p>
                                            <div style="font-size: 12px; color: gray;">{{ $createdAt }}</div>
                                        </div>
                                        @if (!empty($nextStatus))
                                            @if ($status != 'LEAD' && $status != 'Prospect')
                                                <div>
                                                    <span class="tagss fw-bold me-1">Lender name - </span>
                                                    <span class="tagss fw-bold">{{ $selectedLenderNames->leadLender->lender->name }}</span>
                                                </div>
                                            @else
                                                <div class="maitag_div">
                                                    <span class="tagss">{{ $subStatus }}</span> <i
                                                        class="fa fa-arrow-right"></i>
                                                    <span class="tagss">{{ $nextStatus }}</span>
                                                </div>
                                            @endif
                                        @endif

                                        @if (!empty($leadStatusManageDetail->comment))
                                            <div style="margin-top: 6px;">
                                                <strong>Message :</strong>{!! nl2br(e($leadStatusManageDetail->comment)) !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                    <!--end::Tab Content-->

                    <div class="col-md-2">
                        <h5> Activity </h5>
                        <ul class="activity_plan">
                            <li><a href="#"> Documents</a></li>
                            <li><a onclick="document.getElementById('toggleDiv').style.display = 'block'">
                                    Close Case</a></li>
                            <li>
                                <a class=""
                                    onclick="document.getElementById('toggleDiv1').style.display = 'block'">
                                    VAS Output
                                </a>
                            </li>
                            <li>
                                <a class=""
                                    onclick="document.getElementById('toggleDiv2').style.display = 'block'">
                                    Bank Statement Analysis
                                </a>
                            </li>

                        </ul>
                    </div>


                </div>

                <!-- Toggleable Div -->
                <div id="toggleDiv" class="modalclosecase">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Select Reason for Close Case </h5>
                        <button class="btn btn-sm btn-danger"
                            onclick="document.getElementById('toggleDiv').style.display = 'none'"><i
                                class="fa fa-times"></i></button>
                    </div>
                    <div class=" ">
                        <form action="#" class="product-options">

                            <ul>
                                <li>
                                    <input type="radio" name="product" value="Fraud case">
                                    Fraud case
                                </li>

                                <li>
                                    <input type="radio" name="product" value="Login criteria not met">
                                    Login criteria not met
                                </li>

                                <li>
                                    <input type="radio" name="product" value="High obligations">
                                    High obligations
                                </li>

                                <li>
                                    <input type="radio" name="product" value="Incomplete documents">
                                    Incomplete documents
                                </li>

                                <li>
                                    <input type="radio" name="product" value="Profile issue">
                                    Profile issue
                                </li>

                                <li>
                                    <input type="radio" name="product" value="Bureau score issue">
                                    Bureau score issue
                                </li>

                                <li>
                                    <input type="radio" name="product" value="Out of geography limits">
                                    Out of geography limits
                                </li>

                                <li>
                                    <input type="radio" name="product" value="Withdrawn by customer">
                                    Withdrawn by customer
                                </li>

                                <li>
                                    <input type="radio" name="product"
                                        value="Customer already logged in with lenders">
                                    Customer already logged in with lenders
                                </li>

                                <li>
                                    <input type="radio" name="product" value="Not eligible">
                                    Not eligible
                                </li>

                                <li>
                                    <input type="radio" name="product" value="Duplicate">
                                    Duplicate
                                </li>
                                <li>
                                    <input type="radio" name="product" value="Language Barrier">
                                    Language Barrier
                                </li>
                            </ul>
                            <div class="mt-4">

                                <a href="#" class="btn btn-sm btn-primary">Submit</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="toggleDiv1" class="modalclosecase">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">VAS Output
                        </h5>
                        <button class="btn btn-sm btn-danger"
                            onclick="document.getElementById('toggleDiv1').style.display = 'none'"><i
                                class="fa fa-times"></i></button>
                    </div>
                    <div class=" ">
                        <table class="table">
                            <tr>
                                <th>VAS</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <th>Bank Statement Analysis </th>
                                <th><span class="text-danger"><i class="fa fa-close"></i>
                                        Incompleted</span> </th>
                            </tr>
                            <tr>
                                <th>Get Credit Analysis </th>
                                <th><span class="text-danger">Pan Not Found </span> </th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="toggleDiv2" class="modalclosecase">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Bank Statement Analysis </h5>
                        <button class="btn btn-sm btn-danger"
                            onclick="document.getElementById('toggleDiv2').style.display = 'none'"><i
                                class="fa fa-times"></i></button>
                    </div>
                    <div class=" ">
                        <!--begin::Nav-->
                        <ul class="nav d-flex g-5 mb-3 mx-5 parent__ul">
                            <!--begin::Item-->
                            <li class="nav-item mb-3">
                                <!--begin::Link-->
                                <a class="nav-link active" data-bs-toggle="tab" id="tabss_1" href="#contentss_1">

                                    Input
                                </a>
                                <!--end::Link-->
                            </li>
                            <!--begin::Item-->
                            <li class="nav-item mb-3">
                                <!--begin::Link-->
                                <a class="nav-link" data-bs-toggle="tab" id="tabss_2" href="#contentss_2">

                                    Output
                                </a>
                                <!--end::Link-->
                            </li>

                        </ul>
                        <!--end::Nav-->

                        <!--begin::Tab Content-->
                        <div class="tab-content mt-5">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade active show" id="contentss_1">

                                <div class="table-responsive clearfix mx-5 mt-5">
                                    <div class="mb-4">
                                        <a href="#" class="badge bg-warning"><i class="fa fa-upload"></i>
                                            Upload</a>
                                    </div>
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fs-7 fw-bold text-gray-500">
                                                <th class="">File Name </th>
                                                <th class="">Format</th>
                                                <th>File Size</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->

                                        <!--end::Table body-->
                                    </table>
                                    <a href="#" class="badge bg-primary mt-4 text-white"><i
                                            class="fa fa-upload"></i> Continue</a>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table container-->


                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane-->
                            <div class="tab-pane fade " id="contentss_2">

                                <div class="table-responsive clearfix mx-5 mt-5">

                                    <!--begin::Table-->
                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fs-7 fw-bold text-gray-500">
                                                <th class="">File Name </th>
                                                <th class="">File Used</th>
                                                <th>Banks Involved </th>
                                                <th>Duration (Months) </th>
                                                <th>BSA Run Date </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-center"> No Data
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>

                                    <!--end::Table-->
                                </div>
                                <!--end::Table container-->


                            </div>
                            <!--end::Tap pane-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<script>
    $(document).ready(function() {
        $('.status-select')
            .on('change', function() {
                const row = $(this).closest('.lender-decision-row');
                const status = $(this).val();

                if (status === 'Sanctioned') {
                    row.find('.sanctioned-fields').removeClass('d-none');
                    row.find('.reason-field').addClass('d-none');
                } else {
                    row.find('.sanctioned-fields').addClass('d-none');
                    row.find('.reason-field').removeClass('d-none');
                }
            })
            .trigger('change');

        $('#loan-decision-form').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const data = form.serializeArray();
            data.push({
                name: 'lead_id',
                value: '{{ $leadId }}'
            });

            $.ajax({
                url: '{{ route('lead.lender.decision') }}',
                type: 'POST',
                data: $.param(data),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if (res.success) {
                        $('.total-sanctioned-loan-amount').val(res
                            .total_sanctioned_amount ?? 0);
                        form.find('input, select, button, textarea').attr('disabled', true);
                    }
                },
                error: function(err) {
                    console.error(err);
                    alert('Error occurred during submission.');
                }
            });
        });
    });
</script>

<script>
    $(document).on('click', '.assign-lender-btn', function(e) {
        e.preventDefault();

        const button = $(this);

        if (button.hasClass('lender-selected')) return;

        const lenderId = button.data('lender-id');
        const leadId = button.data('lead-id');

        $.ajax({
            url: "{{ route('lead.lender') }}",
            type: "POST",
            data: {
                lender_id: lenderId,
                lead_id: leadId,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                button.addClass('lender-selected');
                const icon = button.find('i');
                icon.removeClass().addClass('fa fa-lock text-success');

                Swal.fire({
                    icon: 'success',
                    title: 'Lender Assigned!',
                    timer: 1000,
                    showConfirmButton: false
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error assigning lender',
                    text: xhr.responseJSON?.message || 'Please try again.'
                });
            }
        });
    });
</script>
@endsection
