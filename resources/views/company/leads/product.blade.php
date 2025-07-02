@extends('layouts.company.main')
@section('content')
@section('title')
    Add Lead
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mt-5">

            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-12">
                <!--begin::Row-->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <!--begin::Chart Widget 35-->
                        <div class="card card-flush h-md-100">
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
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Table container-->

                                <div class="">
                                    <h2 class="mb-4">Applicant Details</h2>
                                    <form action="#" class="product-options" id="formA">
                                        <!-- Selection -->
                                        <div class="mb-4">
                                            <label class="form-label d-block">Select</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="lead_type"
                                                    id="selfOption" value="self" checked="">
                                                <label class="form-check-label" for="selfOption">Self</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="lead_type"
                                                    id="connectorOption" value="connector">
                                                <label class="form-check-label" for="connectorOption">Connector</label>
                                            </div>
                                            @if ($errors->has('applicantSelection'))
                                                <div class="text-danger">{{ $errors->first('applicantSelection') }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Self Section -->
                                        <div id="selfSection" style="display: block;">
                                            <div class="mb-3">
                                                <label class="form-label">Applicant Type</label>
                                                <select class="form-select" name="applicant_type">
                                                    <option>Select Applicant Types</option>
                                                    <option value="business"
                                                        {{ old('applicant_type') == 'business' ? 'selected' : '' }}>
                                                        Business</option>
                                                    <option value="individual"
                                                        {{ old('applicant_type') == 'individual' ? 'selected' : '' }}>
                                                        Individual</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Business Type</label>
                                                <select class="form-select" name="business_type">
                                                    <option value="">Select Business Type</option>
                                                    <option value="limited"
                                                        {{ old('business_type') == 'limited' ? 'selected' : '' }}>
                                                        Limited</option>
                                                    <option value="private_limited"
                                                        {{ old('business_type') == 'private_limited' ? 'selected' : '' }}>
                                                        Private Limited</option>
                                                    <option value="partnership"
                                                        {{ old('business_type') == 'partnership' ? 'selected' : '' }}>
                                                        Partnership</option>
                                                    <option value="llp"
                                                        {{ old('business_type') == 'llp' ? 'selected' : '' }}>Limited
                                                        Liability Partnership</option>
                                                    <option value="huf"
                                                        {{ old('business_type') == 'huf' ? 'selected' : '' }}>Hindu
                                                        Undivided Family</option>
                                                    <option value="sole_proprietor"
                                                        {{ old('business_type') == 'sole_proprietor' ? 'selected' : '' }}>
                                                        Sole Proprietor</option>
                                                    <option value="trust"
                                                        {{ old('business_type') == 'trust' ? 'selected' : '' }}>Trust
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Customer Mobile
                                                    No</label>
                                                <input type="text" class="form-control" name="customer_number"
                                                    value="{{ old('customer_number') }}">
                                                @if ($errors->has('customer_number'))
                                                    <div class="text-danger">{{ $errors->first('customer_number') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Customer Name</label>
                                                <input type="text" class="form-control" name="customer_name"
                                                    value="{{ old('customer_name') }}">
                                                @if ($errors->has('customer_name'))
                                                    <div class="text-danger">{{ $errors->first('customer_name') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Assign to Sales
                                                    User</label>
                                                <input type="text" class="form-control" placeholder="Demo User"
                                                    name="assigned_user" value="{{ old('assigned_user') }}">
                                                @if ($errors->has('assigned_user'))
                                                    <div class="text-danger">{{ $errors->first('assigned_user') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Assign to Back
                                                    Office</label>
                                                <input type="text" class="form-control" name="assigned_back_office"
                                                    placeholder="Search assign to back office"
                                                    value="{{ old('assigned_back_office') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label d-block">Do I know my
                                                    product?</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="know_product"
                                                        id="knowYesSelf" value="yes">
                                                    <label class="form-check-label" for="knowYesSelf">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="know_product"
                                                        id="knowNoSelf" value="no">
                                                    <label class="form-check-label" for="knowNoSelf">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Connector Section -->
                                        <div id="connectorSection" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Connector Name</label>
                                                <input type="text" class="form-control" name="connector_name"
                                                    placeholder="Search connector">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Applicant Type</label>
                                                <select class="form-select">
                                                    <option>Select Applicant Types</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Business Type</label>
                                                <select class="form-select">
                                                    <option>Select Business Types</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Customer Mobile
                                                    No</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Customer Name</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Assign to Sales
                                                    User</label>
                                                <input type="text" class="form-control" placeholder="Demo User">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Assign to Back
                                                    Office</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Search assign to back office">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label d-block">Do I know my
                                                    product?</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="productKnowledgeConnector" id="knowYesConnector"
                                                        value="yes">
                                                    <label class="form-check-label" for="knowYesConnector">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="productKnowledgeConnector" id="knowNoConnector"
                                                        value="no">
                                                    <label class="form-check-label" for="knowNoConnector">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="#" class="btn btn-sm btn-danger">Cancel</a>
                                            <button class="btn btn-sm btn-primary" type="submit">Continue</button>

                                        </div>
                                    </form>
                                </div>

                                <!--end::Table container-->

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart Widget 35-->
                    </div>
                    <!--end::Col-->
                    <div class="col-md-6">
                        <!--begin::Chart Widget 35-->
                        <div class="card card-flush h-md-100">

                            <!--begin::Body-->
                            <div class="card-body">
                                <h2 class="mb-4">Select Product
                                </h2>


                                <form action="{{ route('lead.update', $editLeadDetails->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{-- <form action="#" class="product-options" id="formB"> --}}
                                    <ul>
                                        <li>
                                            <input type="radio" name="product" value="Business Installment Loan">
                                            Business Installment Loan
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Small Business Loan">
                                            Small Business Loan
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Home loan">
                                            Home loan
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Loan Against Property">
                                            Loan Against Property
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Loan Against Securities">
                                            Loan Against Securities
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Working Capital Overdraft">
                                            Working Capital Overdraft
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Unsecured Overdraft">
                                            Unsecured Overdraft
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Cross sell Life Insurance">
                                            Cross sell Life Insurance
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Cross sell Health Insurance">
                                            Cross sell Health Insurance
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Cross sell Motor Insurance">
                                            Cross sell Motor Insurance
                                        </li>

                                        <li>
                                            <input type="radio" name="product" value="Credit Card">
                                            Credit Card
                                        </li>
                                    </ul>
                                    <div class="mt-4">
                                        <a href="#" class="btn btn-sm btn-danger">Cancel</a>

                                        <a href="view" class="btn btn-sm btn-primary">Continue</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Col-->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#formA :input').prop('disabled', true);
        $('#formA a.btn').addClass('disabled').css({
            'pointer-events': 'none',
            'opacity': '0.6'
        });
    });
</script>

@endsection
