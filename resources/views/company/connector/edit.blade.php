@extends('layouts.company.main')
@section('content')
@section('title')
    Edit Connector
@endsection

<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <!--begin::Timeline widget 3-->
            <div class="card card-flush h-md-100 mb-5" id="company_connector_list">

                <!--begin::Body-->
                <div class="card-body px-0">
                    <!--begin::Nav-->
                    <ul class="nav d-flex g-5 mx-9" role="tablist">
                        <!--begin::Item-->
                        <li class="nav-item" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px active"
                                data-bs-toggle="tab" id="kt_charts_widget_35_tab_1"
                                href="#kt_charts_widget_35_tab_content_1" aria-selected="true" role="tab">
                                Basic Details

                            </a>
                            <!--end::Link-->
                        </li> &nbsp;
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                data-bs-toggle="tab" id="kt_charts_widget_35_tab_2"
                                href="#kt_charts_widget_35_tab_content_2" aria-selected="false" tabindex="-1"
                                role="tab">

                                KYC Details
                            </a>
                            <!--end::Link-->
                        </li> &nbsp;
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                data-bs-toggle="tab" id="kt_charts_widget_35_tab_3"
                                href="#kt_charts_widget_35_tab_content_3" aria-selected="false" tabindex="-1"
                                role="tab">

                                Payout Details
                            </a>
                            <!--end::Link-->
                        </li>&nbsp;
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                data-bs-toggle="tab" id="kt_charts_widget_35_tab_4"
                                href="#kt_charts_widget_35_tab_content_4" aria-selected="false" tabindex="-1"
                                role="tab">

                                Other Details
                            </a>
                            <!--end::Link-->
                        </li>&nbsp;
                        <!--end::Item-->

                    </ul>
                    <!--end::Nav-->

                    <!--begin::Tab Content-->
                    <div class="tab-content">

                        <!--begin::Tap pane-->
                        <div class="tab-pane fade active show" id="kt_charts_widget_35_tab_content_1" role="tabpanel"
                            aria-labelledby="#kt_charts_widget_35_tab_1">

                            <div class="card-body">

                                <form action="{{ route('connector.update', $editConnectorDetails->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row gx-4 gy-5">

                                        <!-- ---------------------- LEFT COLUMN ---------------------- -->
                                        <div class="col-12">
                                            <!-- Profession radios -->
                                            <label class="form-label fw-medium">Select Profession</label>
                                            <div class="d-flex flex-wrap gap-4">
                                                <!-- Builder -->

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="profession"
                                                        id="builder" value="Builder"
                                                        {{ $editConnectorDetails->profession == 'Builder' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="builder">Builder</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="profession"
                                                        id="ca" value="CA/Tax C"
                                                        {{ $editConnectorDetails->profession == 'CA/Tax C' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="ca">CA/ Tax C</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="profession"
                                                        id="banker" value="Ex Banker"
                                                        {{ $editConnectorDetails->profession == 'Ex Banker' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="banker">Ex Banker</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="profession"
                                                        id="freelancer" value="L Freelancer"
                                                        {{ $editConnectorDetails->profession == 'L Freelancer' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="freelancer">L
                                                        Freelancer</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="profession"
                                                        id="agent" value="Ins Agent"
                                                        {{ $editConnectorDetails->profession == 'Ins Agent' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="agent">Ins Agent</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="profession"
                                                        id="broker" value="RE Broker"
                                                        {{ $editConnectorDetails->profession == 'RE Broker' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="broker">RE Broker</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="profession"
                                                        id="otherProf" value="Other"
                                                        {{ $editConnectorDetails->profession == 'Other' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="otherProf">Other</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <!-- Gender radios -->

                                            <label class="form-label fw-medium">Select Gender</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="male" value="MALE"
                                                    {{ $editConnectorDetails->gender == 'MALE' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gender">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="female" value="FEMALE"
                                                    {{ $editConnectorDetails->gender == 'FEMALE' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">

                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="otherGen" value="OTHER"
                                                    {{ $editConnectorDetails->gender == 'OTHER' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gender">Other</label>
                                            </div>
                                        </div>

                                        <!-- LEFT HALF: Contact & Business Details -->
                                        <div class="col-lg-6">

                                            <!-- Connector Name -->
                                            <div class="mb-4">
                                                <label for="connectorName" class="form-label">Connector Name
                                                    <span class="text-danger">*</span></label>
                                                <input class="form-control" name="connector_name" type="text"
                                                    id="connectorName"
                                                    value="{{ $editConnectorDetails->connector_name }}">
                                                @if ($errors->has('title'))
                                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>

                                            <!-- Contact / Brand Name -->
                                            <div class="mb-4">
                                                <label for="brandName" class="form-label">Contact / Brand
                                                    Name</label>
                                                <input type="text" class="form-control" id="brandName"
                                                    name="brand_name"
                                                    value="{{ $editConnectorDetails->brand_name }}">
                                                @if ($errors->has('brand'))
                                                    <div class="text-danger">{{ $errors->first('brand') }}</div>
                                                @endif
                                            </div>

                                            <!-- Email ID -->
                                            <div class="mb-4">
                                                <label for="emailId" class="form-label">Email ID <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email"
                                                    name="email" value="{{ $editConnectorDetails->email }}">
                                                @if ($errors->has('email'))
                                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>

                                            <!-- Phone Number -->
                                            <div class="mb-4">
                                                <label for="phoneNumber" class="form-label">Phone Number <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" id="phone"
                                                        name="msisdn" value="{{ $editConnectorDetails->msisdn }}">
                                                    @if ($errors->has('msisdn'))
                                                        <div class="text-danger">{{ $errors->first('msisdn') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Short Code Name -->
                                            <div class="mb-4">
                                                <label for="shortCodeName" class="form-label">Short Code Name <i
                                                        class="fa fa-info-circle"
                                                        title="Please enter Short Code Name"></i></label>
                                                <input type="text" class="form-control" id="shortcode"
                                                    name="short_code_name"
                                                    value="{{ $editConnectorDetails->short_code }}">
                                                @if ($errors->has('short_code'))
                                                    <div class="text-danger">{{ $errors->first('short_code') }}</div>
                                                @endif
                                            </div>
                                            <!-- Business Details Header -->
                                            <label class="form-label fw-bold">Business Details</label>
                                            <!-- Business Name -->
                                            <div class="mb-4">
                                                <label for="businessName" class="form-label">Business
                                                    Name</label>
                                                <input class="form-control" name="connector_name" type="text"
                                                    id="connectorName"
                                                    value="{{ $editConnectorDetails->connector_name }}" disabled>
                                                @if ($errors->has('title'))
                                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>

                                            <!-- Business ID -->
                                            <div class="mb-4 position-relative">
                                                <label for="businessId" class="form-label">Business ID</label>

                                                <div class="position-relative">
                                                    <input type="text" class="form-control pe-5" id="businessId"
                                                        name="bussiness_id" placeholder="Enter Business ID" readonly
                                                        value="{{ old('bussiness_id', $editConnectorDetails->bussiness_id ?? '') }}">

                                                    <span id="editBusinessId"
                                                        class="position-absolute top-50 end-0 translate-middle-y me-3"
                                                        style="cursor: pointer;">
                                                        <i class="fa fa-pencil-square"></i>
                                                    </span>
                                                </div>
                                            </div>


                                        </div> <!-- /col-lg-6 -->

                                        <!-- ---------------------- RIGHT COLUMN ---------------------- -->
                                        <div class="col-lg-6">

                                            <!-- GSTIN -->
                                            <div class="mb-4">
                                                <label for="gstin" class="form-label">GSTIN</label>
                                                <input type="text" class="form-control" id="gst_in"
                                                    name="gst_in" value="{{ $editConnectorDetails->gst_in }}">
                                                @if ($errors->has('gst_in'))
                                                    <div class="text-danger">{{ $errors->first('gst_in') }}</div>
                                                @endif
                                            </div>

                                            <!-- Relationship Mapping Header -->
                                            <label class="form-label fw-bold">Relationship Mapping</label>

                                            <!-- Assign to Sales User: Sales Relationship Manager ID -->
                                            <div class="mb-4">

                                                <h6> Assign to Sales User</h6>
                                                <hr>
                                                <label for="salesUserId" class="form-label fs-6">Sales Relationship
                                                    Manager ID</label>
                                                <input type="text" class="form-control" id="salesUserName"
                                                    disabled
                                                    value="{{ $editConnectorDetails->user['details']->emp_id ?? '' }}">

                                            </div>

                                            <!-- Sales Relationship Manager Name -->

                                            <div class="mb-4">
                                                <label for="assign" class="form-label">Sales Relationship
                                                    Manager Name</label>
                                                <select id="assigned_to" name="assigned_to" class="form-select"
                                                    style="width: 100%">
                                                    @if (old('assigned_to'))
                                                        <option value="{{ old('assigned_to') }}" selected>
                                                            {{ old('assigned_to') }}</option>
                                                    @elseif ($editConnectorDetails?->user)
                                                        <option value="{{ $editConnectorDetails->user->id }}"
                                                            selected>{{ $editConnectorDetails->user->name }}</option>
                                                    @endif
                                                </select>


                                            </div>
                                            <!-- Sales Relationship Manager Mobile Number -->
                                            <div class="mb-4">
                                                <label for="salesUserMobile" class="form-label">Sales
                                                    Relationship Manager Mobile Number</label>
                                                <input type="text" class="form-control" id="salesUserMobile"
                                                    disabled
                                                    value="{{ $editConnectorDetails->user['details']->phone ?? '' }}">

                                            </div>

                                            <!-- Channel Manager Details Header -->
                                            <label class="form-label fw-bold">Channel Manager Details</label>

                                            <!-- Channel Manager ID -->
                                            <div class="mb-4">
                                                <label for="channelManagerId" class="form-label">Channel Manager
                                                    ID</label>
                                                <input type="text" class="form-control" id="channelManagerId"
                                                    name="channelManagerId"
                                                    placeholder="Please enter Channel Manager ID"
                                                    value="{{ $editConnectorDetails->gst_in }}" disabled>
                                            </div>

                                            <!-- Channel Manager Name -->
                                            <div class="mb-4">

                                                <label for="assigned_to" class="form-label">Channel Manager
                                                    Name</label>
                                                <select id="assigned_to" name="assigned_to" class="form-select"
                                                    style="width: 100%">
                                                    <option value="{{ $editConnectorDetails->assigned_to }}" selected>
                                                        {{ $editConnectorDetails->assigned_to_name ?? 'Select Channel Manager' }}
                                                    </option>
                                                </select>

                                            </div>

                                            <!-- Channel Manager Mobile Number -->
                                            <div class="mb-4">
                                                <label for="channelManagerMobile" class="form-label">Channel
                                                    Manager Mobile Number</label>
                                                <input type="text" class="form-control" id="channelManagerMobile"
                                                    name="channelManagerMobile" placeholder="Enter Mobile Number"
                                                    value="{{ $editConnectorDetails->gst_in }}" disabled>
                                            </div>

                                            <!-- Referral Connector Details Header -->
                                            <label class="form-label fw-bold">Referral Connector
                                                Details</label>

                                            <!-- Referral Connector ID -->
                                            <div class="mb-3">
                                                <label for="refConnectorId" class="form-label">Connector
                                                    ID</label>

                                                <input type="text" class="form-control" id="refConnectorId"
                                                    name="refConnectorId"
                                                    value="{{ $editConnectorDetails->connector_id }}" disabled>
                                            </div>

                                            <!-- Referral Connector Name -->
                                            <div class="mb-3">
                                                <label for="refConnectorName" class="form-label">Connector
                                                    Name</label>

                                                <select id="connector_name" name="connector_name" class="form-select"
                                                    style="width: 100%">
                                                    @if ($editConnectorDetails && $editConnectorDetails->connector_name)
                                                        <option value="{{ $editConnectorDetails->connector_name }}"
                                                            selected data-msisdn="{{ $editConnectorDetails->msisdn }}"
                                                            data-connector-id="{{ $editConnectorDetails->connector_id }}">
                                                            {{ $editConnectorDetails->connector_name }}
                                                        </option>
                                                    @endif
                                                </select>

                                            </div>

                                            <!-- Referral Connector Mobile Number -->
                                            <div class="mb-3">
                                                <label for="refConnectorMobile" class="form-label">Connector
                                                    Mobile Number</label>
                                                <input type="text" class="form-control" id="refConnectorMobile"
                                                    name="refConnectorMobile" placeholder="Please enter Mobile Number"
                                                    value="{{ $editConnectorDetails->msisdn }}" disabled>
                                            </div>

                                        </div> <!-- /col-lg-6 -->

                                    </div> <!-- /row -->
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </form>

                                <!--end::Tab Content-->
                            </div>

                        </div>
                        <!--end::Tap pane-->

                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_2" role="tabpanel"
                            aria-labelledby="#kt_charts_widget_35_tab_2">
                            <div class="tab-content bg-white px-9 py-6" id="connectorTabContent">
                                <form action="{{ route('kyc.update', $editConnectorDetails->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row gx-4 gy-5">
                                        <!-- Left column: PAN & Address -->
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="pan_number" class="form-label">PAN</label>
                                                <input type="text" class="form-control" id="pan_number"
                                                    name="pan_number" placeholder="Please enter PAN number"
                                                    value="{{ $editConnectorDetails->pan_number }}">
                                            </div>
                                            <div class="mb-4">
                                                <label for="connector_name" class="form-label">Name as per PAN
                                                    Card</label>
                                                <input type="text" class="form-control" id="connector_name"
                                                    name="connector_name"
                                                    value="{{ $editConnectorDetails->connector_name }}" disabled>
                                            </div>
                                            <div class="mb-4">
                                                <label for="address" class="form-label">Current
                                                    Address</label>
                                                <input type="text" class="form-control" id="address"
                                                    name="address" placeholder="Please enter Address Line 1"
                                                    value="{{ $editConnectorDetails->address }}">
                                            </div>
                                            <div class="flex">
                                                <div class="w-24">
                                                    <label for="pincode" class="form-label">Pin Code</label>
                                                    <input type="text" class="form-control" id="pincode"
                                                        name="pincode" placeholder="Please enter Pin Code"
                                                        value="{{ $editConnectorDetails->pincode }}">
                                                </div>
                                                <div class="w-24">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city"
                                                        name="city" placeholder="Please enter City"
                                                        value="{{ $editConnectorDetails->city }}">
                                                </div>
                                                <div class="w-24">
                                                    <label for="state" class="form-label">State</label>
                                                    <input type="text" class="form-control" id="state"
                                                        name="state" placeholder="Please enter State"
                                                        value="{{ $editConnectorDetails->state }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right column: Address Proof upload -->
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label">Address Proof</label>
                                                <input type="file" class="form-control" name="address_proof"
                                                    accept=".png, .jpg, .jpeg, .pdf">
                                                @if ($errors->has('address_proof'))
                                                    <div class="text-danger">{{ $errors->first('address_proof') }}
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="mb-4">
                                                <label for="document_type" class="form-label">Document Type</label>
                                                <select class="form-select" id="document_type" name="document_type">
                                                    <option value="AADHAR"
                                                        {{ old('document_type', $editConnectorDetails->document_type ?? '') == 'AADHAR' ? 'selected' : '' }}>
                                                        Aadhar Card</option>
                                                    <option value="DRIVING"
                                                        {{ old('document_type', $editConnectorDetails->document_type ?? '') == 'DRIVING' ? 'selected' : '' }}>
                                                        Driving License</option>
                                                    <option value="PASSPORT"
                                                        {{ old('document_type', $editConnectorDetails->document_type ?? '') == 'PASSPORT' ? 'selected' : '' }}>
                                                        Passport</option>
                                                </select>
                                            </div>

                                            {{-- Uploaded Files Display --}}
                                            <div>
                                                <label class="form-label">Uploaded Files</label>
                                                <ul class="list-group" id="addressProofFilesList">

                                                    @if (
                                                        !empty($editConnectorDetails->address_proof) &&
                                                            $editConnectorDetails->address_proof !== 'http://127.0.0.1:8000/storage')
                                                        <li class="list-group-item">

                                                            <a href="{{ $editConnectorDetails->address_proof }}"
                                                                target="_blank">
                                                                {{ $editConnectorDetails->address_proof }}
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="list-group-item text-dark">No files uploaded
                                                            yet.</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <!-- end KYC Details -->
                            </div>
                        </div>
                        <!--end::Tap pane-->

                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_3" role="tabpanel"
                            aria-labelledby="#kt_charts_widget_35_tab_3">
                            <!--begin::Chart-->
                            <!--begin::Nav-->
                            <ul class="nav d-flex g-5 mx-9" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px active"
                                        data-bs-toggle="tab" id="tab1" href="#content1" aria-selected="true"
                                        role="tab">
                                        Primary Account

                                    </a>
                                    <!--end::Link-->
                                </li> &nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tab2" href="#content2" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Set Payout
                                    </a>
                                    <!--end::Link-->
                                </li> &nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tab3" href="#content3" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Pay Sub-Connector
                                    </a>
                                    <!--end::Link-->
                                </li>&nbsp;
                                <!--end::Item-->

                            </ul>
                            <!--end::Nav-->

                            <!--begin::Tab Content-->
                            <div class="tab-content">

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="content1" role="tabpanel"
                                    aria-labelledby="#tab1">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Left half: the form -->
                                            <div class="col-md-6">
                                                <form id="payoutForm" action="{{ route('payout.update') }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="connector_id"
                                                        value="{{ $editConnectorDetails->connector_id }}">
                                                    <div class="mb-4">
                                                        <label class="form-label">Upload Cancel Cheque</label>
                                                        <input type="file" class="form-control"
                                                            name="cancel_cheque" accept=".png, .jpg, .jpeg, .pdf">
                                                        @if ($errors->has('cancel_cheque'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('cancel_cheque') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="bank_name" class="form-label">Bank Name</label>
                                                        <input type="text" class="form-control" id="bank_name"
                                                            name="bank_name" placeholder="Enter Bank Name"
                                                            value="{{ $editPayoutDetails->bank_name ?? '' }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="branch_name" class="form-label">Bank
                                                            Branch</label>
                                                        <input type="text" class="form-control" id="branch_name"
                                                            name="branch_name" placeholder="Enter Bank Branch"
                                                            value="{{ $editPayoutDetails->branch_name ?? '' }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="account_holder" class="form-label">Account
                                                            Holder Name</label>
                                                        <input type="text" class="form-control"
                                                            id="account_holder" name="account_holder"
                                                            placeholder="Enter Account Holder Name"
                                                            value="{{ $editPayoutDetails->account_holder ?? '' }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="account_number" class="form-label">Account
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            id="account_number" name="account_number"
                                                            placeholder="Enter Account Number"
                                                            value="{{ $editPayoutDetails->account_number ?? '' }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="ifsc_code" class="form-label">IFSC
                                                            Code</label>
                                                        <input type="text" class="form-control" id="ifsc_code"
                                                            name="ifsc_code" placeholder="Enter Account Number"
                                                            value="{{ $editPayoutDetails->account_number ?? '' }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                            <!-- Right half: kept empty intentionally -->
                                            <div class="col-md-6"></div>

                                        </div>
                                    </div>
                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="content2" role="tabpanel" aria-labelledby="#tab2">
                                    <div class="card-body pt-0">
                                        <!--begin::Nav-->
                                        <ul class="nav d-flex g-5 mx-9" role="tablist">
                                            <!--begin::Item-->
                                            <li class="nav-item" role="presentation">
                                                <!--begin::Link-->
                                                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px active"
                                                    data-bs-toggle="tab" id="subtab1" href="#subcontent1"
                                                    aria-selected="true" role="tab">
                                                    Configure Payout

                                                </a>
                                                <!--end::Link-->
                                            </li> &nbsp;
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="nav-item" role="presentation">
                                                <!--begin::Link-->
                                                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                                    data-bs-toggle="tab" id="subtab2" href="#subcontent2"
                                                    aria-selected="false" tabindex="-1" role="tab">

                                                    Payout History
                                                </a>
                                                <!--end::Link-->
                                            </li> &nbsp;
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Nav-->
                                        <!--begin::Tab Content-->
                                        <div class="tab-content">
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade active show" id="subcontent1" role="tabpanel"
                                                aria-labelledby="#subtab1">



                                                {{-- @include('company.connector.configure-payouts') --}}

                                                <div class="card-body">

                                                    <form id="configurePayoutForm"
                                                        action="{{ route('configure-payout.store') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="connector_id"
                                                            value="{{ $editConnectorDetails->connector_id }}">
                                                        <div class="row">
                                                            <!-- LEFT HALF - Form Content -->
                                                            <div class="col-md-6 pe-4">
                                                                <!-- 1) PRODUCT DROPDOWN -->
                                                                <div class="mb-4">
                                                                    <label for="product" class="form-label">*
                                                                        Product</label>
                                                                    <select class="form-select" id="product"
                                                                        name="product_id" required>
                                                                        <option value="">Select Product</option>
                                                                        @foreach ($productDetails as $product)
                                                                            <option value="{{ $product->id }}"
                                                                                {{ old('product') == $product->id ? 'selected' : '' }}>
                                                                                {{ $product->type }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('product_id'))
                                                                        <div class="text-danger">
                                                                            {{ $errors->first('product_id') }}
                                                                        </div>
                                                                    @endif
                                                                </div>


                                                                <!-- 2) CHOOSE PAYOUT (Fixed vs Variable) - Horizontal Alignment -->
                                                                <div class="mb-4">
                                                                    <label class="form-label">* Choose Payout</label>
                                                                    <div class="d-flex gap-4 mt-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="payout_type"
                                                                                id="payoutOptionVariable"
                                                                                value="VARIABLE" disabled>
                                                                            <label class="form-check-label"
                                                                                for="payoutOptionVariable">
                                                                                Variable Payout
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="payout_type"
                                                                                id="payoutFixed" value="FIXED"
                                                                                disabled>
                                                                            <label class="form-check-label"
                                                                                for="payoutFixed">
                                                                                Fixed Payout
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- 3) VARIABLE PAYOUT STRUCTURE (hidden initially) - Horizontal Alignment -->
                                                                <div class="mb-4" id="variable-structure-block"
                                                                    style="display: none;">
                                                                    <label class="form-label">* Choose Variable Payout
                                                                        Structure</label>
                                                                    <div class="d-flex gap-4 mt-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="payout_structure"
                                                                                id="structureCase" value="CASE_LEVEL"
                                                                                disabled>
                                                                            <label class="form-check-label"
                                                                                for="structureCase">
                                                                                Case Level
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="payout_structure"
                                                                                id="structureSlab" value="SLAB_BASED"
                                                                                disabled>
                                                                            <label class="form-check-label"
                                                                                for="structureSlab">
                                                                                Slab-Based
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <!-- SLAB TABLE (hidden until "Slab-Based" is clicked) -->
                                                                    <div id="slabTableContainer" class="mt-4"
                                                                        style="display: none;">
                                                                        <label class="form-label fw-semibold">
                                                                            * Payout Slab Configuration
                                                                            <i class="bi bi-info-circle-fill text-secondary"
                                                                                title="Define payout for each slab range"></i>
                                                                        </label>

                                                                        <div
                                                                            class="table-responsive border payout-table rounded mt-2">
                                                                            <table class="table mb-0 align-middle"
                                                                                style="table-layout: auto; min-width: 100%;">
                                                                                <thead class="bg-light">
                                                                                    <tr>
                                                                                        <th class="px-3 py-3">Min</th>
                                                                                        <th class="px-3 py-3">Max</th>
                                                                                        <th class="px-3 py-3">Payout As
                                                                                        </th>
                                                                                        <!-- Initially hidden -->
                                                                                        <th id="amountHeader"
                                                                                            class="px-3 py-3"
                                                                                            style="display: none;">
                                                                                            Amount
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody id="slabBody">
                                                                                    <tr class="slab-row">
                                                                                        <td class="px-3 py-3">
                                                                                            <input type="number"
                                                                                                class="form-control form-control-sm"
                                                                                                name="minimum_slab"
                                                                                                min="0"
                                                                                                placeholder="Min">
                                                                                        </td>
                                                                                        <td class="px-3 py-3">
                                                                                            <input type="text"
                                                                                                class="form-control form-control-sm text-muted"
                                                                                                name="maximum_slab"
                                                                                                placeholder="Max">
                                                                                        </td>
                                                                                        <td class="px-3 py-3">
                                                                                            <select
                                                                                                class="form-select form-select-sm slabPayoutSelector"
                                                                                                name="payout_as">
                                                                                                <option value=""
                                                                                                    selected disabled>
                                                                                                    Select Payout
                                                                                                </option>
                                                                                                <option value="FIXED">
                                                                                                    Fixed Amount Per
                                                                                                    Case
                                                                                                    (₹)</option>
                                                                                                <option
                                                                                                    value="DISBURSEMENT">
                                                                                                    Percentage of
                                                                                                    Disbursement (%)
                                                                                                </option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <!-- Cell for “Amount” stays hidden until user selects a payout -->
                                                                                        <td class="px-3 py-3 amountCell"
                                                                                            style="display: none;">
                                                                                            <div
                                                                                                class="input-group input-group-sm">
                                                                                                <span
                                                                                                    class="input-group-text amt-prefix">₹</span>
                                                                                                <input type="number"
                                                                                                    class="form-control"
                                                                                                    name="amount"
                                                                                                    min="0"
                                                                                                    placeholder="">
                                                                                                <span
                                                                                                    class="input-group-text unit-suffix"
                                                                                                    style="display: none;">%</span>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <!-- 4) CHOOSE PAYOUT TYPE (hidden/disabled until appropriate) - Horizontal Alignment -->
                                                                <div class="mb-4">
                                                                    <label class="form-label">* Choose Payout
                                                                        Type</label>
                                                                    <div class="d-flex gap-4 mt-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="sub_payout_type"
                                                                                id="payoutTypeAmt" value="FIXED"
                                                                                disabled>
                                                                            <label class="form-check-label"
                                                                                for="payoutTypeAmt">
                                                                                Fixed Amount Per Case (₹)
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="sub_payout_type"
                                                                                id="payoutTypePercent"
                                                                                value="DISBURSEMENT" disabled>
                                                                            <label class="form-check-label"
                                                                                for="payoutTypePercent">
                                                                                Percentage of Disbursement %
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- 5) AMOUNT INPUT (₹ FIELD, hidden until needed) -->
                                                                <div class="mb-4" id="fixedAmountBlock"
                                                                    style="display: none;">
                                                                    <input type="number" class="form-control"
                                                                        id="fixedAmountValue" name="fixed_amount"
                                                                        placeholder="₹" min="0" disabled>
                                                                </div>

                                                                <!-- 6) EFFECTIVE FROM (Date Picker, disabled until Payout Type is chosen) -->
                                                                <div class="mb-4">
                                                                    <label for="effectiveFrom" class="form-label">*
                                                                        Effective From</label>
                                                                    <input type="date" class="form-control"
                                                                        id="effectiveFrom" name="effective_from"
                                                                        disabled>
                                                                </div>

                                                                <!-- 7) SAVE / CANCEL BUTTONS -->
                                                                <div class="d-flex gap-2">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger">Cancel</button>
                                                                </div>
                                                            </div>
                                                            <!-- RIGHT HALF - Reserved for future use -->
                                                            <div class="col-md-6 ps-4">
                                                                @include('company.connector.configure-payouts')

                                                                <!-- This space is intentionally left empty for your future content -->
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--end::Tap pane-->


                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade " id="subcontent2" role="tabpanel"
                                                aria-labelledby="#subtab2">
                                                <div class="card-body">
                                                    <div class="text-muted small">No payout history available.</div>
                                                </div>

                                            </div>
                                            <!--end::Tap pane-->

                                        </div>
                                    </div>

                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="content3" role="tabpanel" aria-labelledby="#tab3">
                                    <!--begin::Chart-->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col"><input type="checkbox"></th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Business ID</th>
                                                        <th scope="col">Mobile</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-secondary py-5">
                                                            No Data</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Tap pane-->


                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end::Tap pane-->

                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_4" role="tabpanel"
                            aria-labelledby="#kt_charts_widget_35_tab_4">
                            <!--begin::Chart-->

                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                        @php
                                            $isApproved = ($editConnectorDetails->status ?? '') === 'APPROVED';
                                        @endphp

                                        <form id="connectorForm"
                                            action="{{ route('connector.update', $editConnectorDetails->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="connector_name"
                                                value="{{ $editConnectorDetails->connector_name }}">
                                            <input type="hidden" name="msisdn"
                                                value="{{ $editConnectorDetails->msisdn }}">

                                            <div class="row form-grid">
                                                <!-- Select Connector Level -->
                                                <div class="col-md-12">
                                                    <label for="connectorLevel" class="form-label">Select Connector
                                                        Level</label>
                                                    <select class="form-select" id="connector_level"
                                                        name="connector_level">
                                                        <option value="">Select Connector Level</option>
                                                        <option value="SILVER"
                                                            {{ (old('connector_level') ?? $editConnectorDetails->connector_level) == 'SILVER' ? 'selected' : '' }}>
                                                            SILVER</option>
                                                        <option value="GOLD"
                                                            {{ (old('connector_level') ?? $editConnectorDetails->connector_level) == 'GOLD' ? 'selected' : '' }}>
                                                            GOLD</option>
                                                        <option value="PLATINUM"
                                                            {{ (old('connector_level') ?? $editConnectorDetails->connector_level) == 'PLATINUM' ? 'selected' : '' }}>
                                                            PLATINUM</option>
                                                    </select>
                                                </div>

                                                <!-- Current Status Toggle -->
                                                <div class="col-md-12 d-flex align-items-center mt-3">
                                                    <label for="status" class="form-label me-3 mb-0">Current
                                                        Status</label>
                                                    <label class="toggle-switch mb-0">
                                                        <input type="hidden" name="status" value="REJECTED">
                                                        <input type="checkbox" id="status" name="status"
                                                            value="APPROVED" {{ $isApproved ? 'checked' : '' }}>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>

                                                <!-- Show Decisioning Output -->
                                                <div class="col-md-12 d-flex align-items-center mt-3">
                                                    <label for="decisionOutput" class="form-label me-3 mb-0">Show
                                                        Decisioning Output</label>
                                                    <label class="toggle-switch mb-0">
                                                        <input type="checkbox" id="decisionOutput"
                                                            name="decisionOutput" />
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>

                                                <!-- Onboarding Status Badge -->
                                                <div class="col-12 d-flex align-items-center mt-3">
                                                    <label class="form-label fw-semibold mb-0 me-2">Onboarding
                                                        Status</label>
                                                    <span
                                                        class="badge onboarding-status-badge {{ $isApproved ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $isApproved ? '✓ Verified' : '✗ Unverified' }}
                                                    </span>
                                                </div>

                                                <!-- Bureau Request Tracking -->
                                                <div class="col-md-12 mt-3">
                                                    <label for="currentMonthLimit" class="form-label">Bureau Request
                                                        Tracking</label>
                                                    <input type="number" class="form-control" id="currentMonthLimit"
                                                        name="currentMonthLimit" placeholder="Current Month Limit" />
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-lg-6"></div>
                                </div>
                            </div>

                        </div>
                        <!--end::Tap pane-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $(document).ready(function() {
            const assignedToSelect = $('#assigned_to');
            const empIdField = $('#salesUserName');
            const mobileField = $('#salesUserMobile');

            const currentAssignedId =
                "{{ old('assigned_to') ?? ($editConnectorDetails->user->id ?? '') }}";

            assignedToSelect.select2({
                placeholder: 'Select Connector',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('user.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return params.term && params.term.trim().length > 0 ? {
                            search: params.term
                        } : {};
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                    phone: item.details?.phone || '',
                                    emp_id: item.details?.emp_id || ''
                                };
                            })
                        };
                    },
                    cache: true
                },
                width: '100%',
                templateResult: formatAssignUserOption,
                templateSelection: formatAssignUserSelection
            });

            function formatAssignUserOption(data) {
                if (!data.id) return data.text;
                return $(`
            <div style="display: flex; justify-content: space-between;">
                <span>${data.text}</span>
                <span class="text-muted">${data.phone}</span>
            </div>
        `);
            }

            function formatAssignUserSelection(data) {
                return data.text;
            }
            assignedToSelect.on('select2:select', function(e) {
                const selected = e.params.data;
                empIdField.val(selected.emp_id || '');
                mobileField.val(selected.phone || '');
            });

            if (currentAssignedId) {
                $.ajax({
                    url: '{{ route('user.search') }}',
                    data: {
                        search: currentAssignedId
                    },
                    dataType: 'json',
                    success: function(data) {
                        const user = data.data.find(u => u.id == currentAssignedId);
                        if (user) {
                            const option = new Option(user.name, user.id, true, true);
                            assignedToSelect.append(option).trigger('change');
                            empIdField.val(user.details?.emp_id || '');
                            mobileField.val(user.details?.phone || '');
                        }
                    }
                });
            }
        });

        $('#connector_name').select2({
            placeholder: 'Select Connector',
            minimumInputLength: 0,
            ajax: {
                url: '{{ route('connectors.search') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return params.term && params.term.trim().length > 0 ? {
                        search: params.term
                    } : {};
                },
                processResults: function(data) {
                    return {
                        results: data.data.map(function(item) {
                            return {
                                id: item.connector_name,
                                text: item.connector_name,
                                msisdn: item.msisdn,
                                connector_id: item.connector_id
                            };
                        })
                    };
                },
                cache: true
            },
            templateResult: formatConnectorOption,
            templateSelection: formatConnectorSelection,
            width: '100%'
        });

        function formatConnectorOption(data) {
            if (!data.id) return data.text;
            return $(`
        <div style="display: flex; justify-content: space-between;">
            <span>${data.text}</span>
            <span class="text-muted">${data.msisdn || ''}</span>
        </div>
    `);
        }

        function formatConnectorSelection(data) {
            return data.text;
        }

        // ⏬ Update related fields on connector change
        $('#connector_name').on('select2:select', function(e) {
            const data = e.params.data;
            $('#refConnectorMobile').val(data.msisdn || '');
            $('#refConnectorId').val(data.connector_id || '');
        });

        $('#editBusinessId').on('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to edit the Business ID?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, edit it',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#businessId').removeAttr('readonly').focus();
                }
            });
        });

        $('#payoutForm').on('submit', function(e) {
            e.preventDefault();
            let form = this;
            let formData = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function() {
                    Swal.fire('Updated!', 'payout updated.', 'success');
                },
                error: function() {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            });
        });

        // // Disable payout options initially
        $('#payoutFixed, #payoutOptionVariable').prop('disabled', true);

        $('#product').on('change', function() {
            const hasProduct = $(this).val();
            $('#payoutFixed, #payoutOptionVariable')
                .prop('disabled', !hasProduct)
                .prop('checked', false);
        });

        function setDisabled($elements, disabled) {
            $elements.prop('disabled', disabled);
            if (disabled) $elements.prop('checked', false);
        }

        function hideAndClearSlab() {
            $('#slabTableContainer').hide();
            $('#slabBody').find('.slab-row:gt(0)').remove();
            let $first = $('#slabBody .slab-row').first();
            $first.find("input[name='minimum_slab'], input[name='maximum_slab']").val('');
            $first.find("select[name='payout_as']").val('');
            $first.find('.input-group').hide().find("input[name='amount']").val('');
        }

        $('#payoutFixed').on('change', function() {
            if (!this.checked) return;

            $('#variable-structure-block').hide();
            setDisabled($('#structureCase, #structureSlab'), true);
            hideAndClearSlab();

            setDisabled($('#payoutTypeAmt, #payoutTypePercent'), false);
            $('#fixedAmountBlock').hide();
            setDisabled($('#fixedAmountValue'), true);
            $('#effectiveFrom').prop('disabled', true);
        });

        $('#payoutOptionVariable').on('change', function() {
            if (!this.checked) return;

            $('#variable-structure-block').show();
            setDisabled($('#structureCase, #structureSlab'), false);

            setDisabled($('#payoutTypeAmt, #payoutTypePercent'), true);
            $('#fixedAmountBlock').hide();
            setDisabled($('#fixedAmountValue'), true);
            $('#effectiveFrom').prop('disabled', true);
        });

        $('#structureCase, #structureSlab').on('change', function() {
            if (this.checked) setDisabled($('#payoutTypeAmt, #payoutTypePercent'), false);
        });

        $('#structureSlab').on('change', function() {
            if (this.checked) $('#slabTableContainer').show();
        });

        $('#structureCase, #payoutFixed').on('change', hideAndClearSlab);

        $('#payoutTypeAmt').on('change', function() {
            if (this.checked) {
                $('#fixedAmountBlock').show();
                setDisabled($('#fixedAmountValue'), false);
                $('#effectiveFrom').prop('disabled', false);
            }
        });

        $('#payoutTypePercent').on('change', function() {
            if (this.checked) {
                $('#fixedAmountBlock').hide();
                setDisabled($('#fixedAmountValue'), true);
                $('#effectiveFrom').prop('disabled', false);
            }
        });

        $('#payoutFixed').on('change', function() {
            $('#structureCase, #structureSlab').prop('checked', false);
        });

        $('#payoutOptionVariable').on('change', function() {
            $('#payoutTypeAmt, #payoutTypePercent').prop('checked', false);
            $('#fixedAmountBlock').hide();
            setDisabled($('#fixedAmountValue'), true);
        });

        $('#slabBody').on('change', "select[name='payout_as']", function() {
            const $row = $(this).closest('.slab-row');
            const $inputGroup = $row.find('.input-group');
            const $prefix = $inputGroup.find('.amt-prefix');
            const $suffix = $inputGroup.find('.unit-suffix');

            if (this.value === 'FIXED') {
                $prefix.text('₹').show();
                $suffix.hide();
                $inputGroup.css('display', 'flex');
            } else if (this.value === 'DISBURSEMENT') {
                $prefix.text('').hide();
                $suffix.show();
                $inputGroup.css('display', 'flex');
            } else {
                $inputGroup.hide();
            }
        });

        $(document).on('change', '.slabPayoutSelector', function() {
            const $row = $(this).closest('.slab-row');
            const selectedValue = $(this).val();
            const $amountHdr = $('#amountHeader');
            const $amountCell = $row.find('.amountCell');
            const $prefixSpan = $amountCell.find('.amt-prefix');
            const $suffixSpan = $amountCell.find('.unit-suffix');

            $amountHdr.show();
            $amountCell.show();

            if (selectedValue === 'FIXED') {
                $prefixSpan.show();
                $suffixSpan.hide();
            } else if (selectedValue === 'DISBURSEMENT') {
                $prefixSpan.hide();
                $suffixSpan.show();
            }
        });

        $('#configurePayoutForm').validate({
            rules: {
                product_id: {
                    required: true
                },
                payout_type: {
                    required: true,
                },
                sub_payout_type: {
                    required: true,
                },
                effective_from: {
                    required: true,
                },
            },

            messages: {
                payout_type: {
                    required: "Please choose payout"
                },
                sub_payout_type: {
                    required: "Please choose sub payout"
                },
                product_id: {
                    required: "Please select product",
                },
                effective_from: {
                    required: "Please select effective date",
                },
            },

            submitHandler: function(form) {
                let formData = new FormData(form);

                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            Swal.fire('Success', 'Payout configured!', 'success');
                            $('#payoutDetails').html(response);
                        } else {
                            Swal.fire('Warning', 'No data returned.', 'warning');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        let errorMsg = 'Something went wrong.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        Swal.fire('Error', errorMsg, 'error');
                    }
                });

                return false;
            }
        });

        $('#status').on('change', function() {
            const isChecked = $(this).is(':checked');
            const badge = $('.onboarding-status-badge');

            if (isChecked) {
                badge.removeClass('bg-danger').addClass('bg-success').html('✓ Verified');
            } else {
                badge.removeClass('bg-success').addClass('bg-danger').html('✗ Unverified');
            }
        });

        $('#connectorForm').on('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);
            let url = $(form).attr('action');
            let method = $(form).attr('method');

            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Connector updated successfully.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please check the inputs.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>

@endsection
