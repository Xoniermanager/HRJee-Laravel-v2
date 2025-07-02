@extends('layouts.company.main')
@section('content')
@section('title')
    View Connector
@endsection
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Left Column) -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar pt-3 px-0">
        </nav>

        <!-- Main Content (Right Column) -->
        <main style="" class="col-md-12 ms-sm-auto px-4" role="main">
            <!-- Page Title / Breadcrumb -->

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="connectorTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                        type="button" role="tab" aria-controls="basic" aria-selected="true">
                        Basic Details
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kyc-tab" data-bs-toggle="tab" data-bs-target="#kyc" type="button"
                        role="tab" aria-controls="kyc" aria-selected="false">
                        KYC Details
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payout-tab" data-bs-toggle="tab" data-bs-target="#payout"
                        type="button" role="tab" aria-controls="payout" aria-selected="false">
                        Payout Details
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="other-tab" data-bs-toggle="tab" data-bs-target="#other" type="button"
                        role="tab" aria-controls="other" aria-selected="false">
                        Other Details
                    </button>
                </li>
            </ul>

            <!-- Tab Panes -->
            <div class="tab-content pt-3" id="connectorTabContent">
                <!-- === Basic Details Tab (Active by Default) === -->
                <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                    <div class="row g-8">
                        <!-- Left Column -->
                        <div class="col-12 col-md-6">
                            <!-- Basic Details Section -->
                            <h6 class="fw-bold col-3 text-uppercase border-bottom pb-2 mb-3">Basic Details
                            </h6>
                            <div class="mb-3 row align-items-center">
                                <label class="col-4 col-form-label">Profession</label>
                                <div class="col-8">
                                    <div class="form-control-plaintext">{{ $viewConnectorDetails->profession }}</div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-4 col-form-label">Gender</label>
                                <div class="col-8">
                                    <div class="form-control-plaintext">{{ $viewConnectorDetails->gender }}</div>
                                </div>
                            </div>
                            <!-- Contact Details Section -->
                            <h6 class="fw-bold col-3 text-uppercase border-bottom pb-2 mb-3">Contact Details
                            </h6>
                            <div class="mb-3 row align-items-center">
                                <label class="col-4 col-form-label">Connector Name</label>
                                <div class="col-8">
                                    <div class="form-control-plaintext">{{ $viewConnectorDetails->connector_name }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-4 col-form-label">Email ID</label>
                                <div class="col-8">
                                    <div class="form-control-plaintext">{{ $viewConnectorDetails->email }}</div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-4 col-form-label">Phone Number</label>
                                <div class="col-8">
                                    <div class="form-control-plaintext">{{ $viewConnectorDetails->msisdn }}</div>
                                </div>
                            </div>
                            <!-- Business Details Section -->
                            <h6 class="fw-bold col-4 text-uppercase border-bottom pb-2 mb-3">Business Details
                            </h6>
                            <div class="mb-3 row align-items-center">
                                <label class="col-4 col-form-label">Business Name</label>
                                <div class="col-8">
                                    <div class="form-control-plaintext">{{ $viewConnectorDetails->brand_name }}</div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-4 col-form-label">Business ID</label>
                                <div class="col-8">
                                    <div class="form-control-plaintext">{{ $viewConnectorDetails->bussiness_id }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- Right Column -->
                        <div class="col-12 col-md-6">
                            <!-- Relationship Mapping Section -->
                            <h6 class="fw-bold col-5 text-uppercase border-bottom pb-2 mb-3">Relationship
                                Mapping</h6>
                            <!-- Assign To Sales User -->
                            <div class="fw-bold text-muted mb-2">Assign To Sales User</div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-8 col-form-label text-break">Sales Relationship Manager
                                    ID</label>
                                <div class="col-5 col-md-4">
                                    <div class="form-control-plaintext">
                                        {{ $viewConnectorDetails->user['details']->emp_id }}</div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-8 col-form-label text-break">Sales Relationship Manager
                                    Name</label>
                                <div class="col-5 col-md-4">
                                    <div class="form-control-plaintext">{{ $viewConnectorDetails->user->name }}</div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-8 col-form-label text-break">Sales Relationship Manager
                                    Mobile Number</label>
                                <div class="col-5 col-md-4">
                                    <div class="form-control-plaintext">
                                        {{ $viewConnectorDetails->user['details']->phone }}</div>
                                </div>
                            </div>
                            <!-- Channel Manager Details -->
                            <div class="fw-bold text-muted mt-4 mb-2">Channel Manager Details</div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-5 col-form-label text-break">Channel Manager ID</label>
                                <div class="col-5 col-md-7">
                                    <div class="form-control-plaintext text-muted"></div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-5 col-form-label text-break">Channel Manager Name</label>
                                <div class="col-5 col-md-7">
                                    <div class="form-control-plaintext text-muted"></div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-5 col-form-label text-break">Channel Manager Mobile
                                    Number</label>
                                <div class="col-5 col-md-7">
                                    <div class="form-control-plaintext text-muted"></div>
                                </div>
                            </div>
                            <!-- Referral Connector Details -->
                            <div class="fw-bold text-muted mt-4 mb-2">Referral Connector Details</div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-5 col-form-label text-break">Connector ID</label>
                                <div class="col-5 col-md-7">
                                    <div class="form-control-plaintext text-muted">
                                        {{ $viewConnectorDetails->connector_id }}</div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-5 col-form-label text-break">Connector Name</label>
                                <div class="col-5 col-md-7">
                                    <div class="form-control-plaintext text-muted">
                                        {{ $viewConnectorDetails->connector_name }}</div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-7 col-md-5 col-form-label text-break">Connector Mobile
                                    Number</label>
                                <div class="col-5 col-md-7">
                                    <div class="form-control-plaintext text-muted">{{ $viewConnectorDetails->msisdn }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- === KYC Details Tab === -->
                <div class="tab-pane fade" id="kyc" role="tabpanel" aria-labelledby="kyc-tab">
                    <div class="container-fluid">
                        <div class="row g-8">
                            <!-- LEFT COLUMN -->
                            <div class="col-12 col-md-6">
                                <!-- PAN DETAILS SECTION -->
                                <div class="mb-4">
                                    <h6 class="fw-bold col-3 text-uppercase border-bottom pb-2 mb-3">
                                        PAN Details
                                    </h6>
                                    <div class="row mb-3 align-items-center">
                                        <label for="pan" class="col-12 col-sm-4 col-form-label">PAN</label>
                                        <div class="col-12 col-sm-8">
                                            <div id="pan" class="form-control-plaintext">
                                                {{ $viewConnectorDetails->pan_number }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label for="panName" class="col-12 col-sm-4 col-form-label">Name (as per PAN
                                            Card)</label>
                                        <div class="col-12 col-sm-8">
                                            <div id="panName" class="form-control-plaintext">
                                                {{ $viewConnectorDetails->connector_name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ADDRESS PROOF SECTION -->
                                <div class="mb-4">
                                    <h6 class="fw-bold col-3 text-uppercase border-bottom pb-2 mb-3 ">
                                        Address Proof
                                    </h6>
                                    <div class="p-3 d-flex align-items-center mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                            style="width: 1.5rem; height: 1.5rem; fill: #6C757D;">
                                            <path d="M369.9 97.98l-83.88-83.88C271.1 5.119 260.5 0 248.9 0H48C21.49 0 0
                                                21.49 0 48v416c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49
                                                48-48V121.1C384 109.5 378.9 98.88 369.9 97.98zM256
                                                52.12L331.9 128H256V52.12zM336 464c0 8.822-7.178
                                                16-16 16H48c-8.822 0-16-7.178-16-16V48c0-8.822 7.178-16
                                                16-16h160v104c0 13.25 10.75 24 24 24h104v304z" />
                                        </svg>
                                        <span class="ms-2 fw-semibold">Uploaded Document</span>

                                        @if (
                                            !empty($viewConnectorDetails->address_proof) &&
                                                $viewConnectorDetails->address_proof !== 'http://127.0.0.1:8000/storage')
                                            <a href="{{ $viewConnectorDetails->address_proof }}" target="_blank"
                                                class="ms-3 text-primary fw-normal text-decoration-underline">
                                                View Document
                                            </a>
                                        @else
                                            <span class="ms-3 text-muted">No document uploaded</span>
                                        @endif
                                    </div>

                                    <div class="text-muted small">
                                        @if (
                                            !empty($viewConnectorDetails->address_proof) &&
                                                $viewConnectorDetails->address_proof !== 'http://127.0.0.1:8000/storage')
                                            Document Type: {{ $viewConnectorDetails->document_type }}
                                        @else
                                            Document Type: <span class="ms-3 text-muted">No document uploaded</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- RIGHT COLUMN -->
                            <div class="col-12 col-md-6">
                                <!-- CURRENT ADDRESS SECTION -->
                                <div class="mb-4">
                                    <h6 class="fw-bold col-4 text-uppercase border-bottom pb-2 mb-3 ">
                                        Current Address
                                    </h6>
                                    <div class="row mb-3 align-items-center">
                                        <label for="addrLine1" class="col-12 col-sm-4 col-form-label">Address Line
                                            1</label>
                                        <div class="col-12 col-sm-8">
                                            <div id="addrLine1" class="form-control-plaintext">
                                                {{ $viewConnectorDetails->address }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label for="pinCode" class="col-12 col-sm-4 col-form-label">Pin Code</label>
                                        <div class="col-12 col-sm-8">
                                            <div id="pinCode" class="form-control-plaintext">
                                                {{ $viewConnectorDetails->pincode }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label for="city" class="col-12 col-sm-4 col-form-label">City</label>
                                        <div class="col-12 col-sm-8">
                                            <div id="city" class="form-control-plaintext">
                                                {{ $viewConnectorDetails->city }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <label for="state" class="col-12 col-sm-4 col-form-label">State</label>
                                        <div class="col-12 col-sm-8">
                                            <div id="state" class="form-control-plaintext">
                                                {{ $viewConnectorDetails->state }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- ===== Payout Details Tab Pane ===== -->
                <div id="payout" class="tab-pane fade" role="tabpanel" aria-labelledby="payout-tab">
                    <!-- Sub‐tab navigation: Primary A/C | Set Payout | Pay Sub-Connectors -->
                    <ul class="nav nav-tabs mb-3" id="payoutSubtab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="primary-ac-tab" data-bs-toggle="tab"
                                data-bs-target="#primary-ac" type="button" role="tab"
                                aria-controls="primary-ac" aria-selected="true">
                                Primary A/C
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="set-payout-tab" data-bs-toggle="tab"
                                data-bs-target="#set-payout" type="button" role="tab"
                                aria-controls="set-payout" aria-selected="false">
                                Set Payout
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pay-subconnectors-tab" data-bs-toggle="tab"
                                data-bs-target="#pay-subconnectors" type="button" role="tab"
                                aria-controls="pay-subconnectors" aria-selected="false">
                                Pay Sub-Connectors
                            </button>
                        </li>
                    </ul>

                    <!-- Sub‐tab content panes -->
                    <div class="tab-content" id="payoutSubtabContent">
                        <!-- ===== Primary A/C Pane (Default Active) ===== -->
                        <div class="tab-pane fade show active" id="primary-ac" role="tabpanel"
                            aria-labelledby="primary-ac-tab">
                            <div class="d-flex align-items-center mb-4">
                                <h5 class="mb-0 col-3 fw-bold text-uppercase border-bottom fw-normal text-dark">Bank
                                    Account Details</h5>
                            </div>
                            <!-- Bank Details List -->
                            <!-- Bank Name -->
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="row align-items-center g-0">
                                    <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                        <span class="text-muted">Bank Name</span>
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="fw-normal">{{ $viewPayoutDetails->bank_name ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bank Branch -->
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="row align-items-center g-0">
                                    <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                        <span class="text-muted">Bank Branch</span>
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="fw-normal">{{ $viewPayoutDetails->branch_name ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Account Holder -->
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="row align-items-center g-0">
                                    <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                        <span class="text-muted">Account Holder</span>
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="fw-normal">{{ $viewPayoutDetails->account_holder ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Account Number -->
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="row align-items-center g-0">
                                    <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                        <span class="text-muted">Account Number</span>
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="fw-normal">{{ $viewPayoutDetails->account_number ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- IFSC Code -->
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="row align-items-center g-0">
                                    <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                        <span class="text-muted">IFSC Code</span>
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="fw-normal d-flex align-items-center">
                                            <span>{{ $viewPayoutDetails->ifsc_code ?? '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Cancelled Cheque Section -->
                            <div class="px-0 py-3 d-flex align-items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                    style="width: 1.5rem; height: 1.5rem; fill: #6C757D;">
                                    <path d="M369.9 97.98l-83.88-83.88C271.1 5.119 260.5 0 248.9 0H48C21.49 0 0
            21.49 0 48v416c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49
            48-48V121.1C384 109.5 378.9 98.88 369.9 97.98zM256
            52.12L331.9 128H256V52.12zM336 464c0 8.822-7.178
            16-16 16H48c-8.822 0-16-7.178-16-16V48c0-8.822 7.178-16
            16-16h160v104c0 13.25 10.75 24 24 24h104v304z" />
                                </svg>
                                <span class="ms-2 fw-semibold">Uploaded Document</span>
                                @if (!empty($viewPayoutDetails->cancel_cheque) && $viewPayoutDetails->cancel_cheque !== 'http://127.0.0.1:8000/storage')
                                    <a href="{{ $viewPayoutDetails->cancel_cheque }}" target="_blank"
                                        class="ms-3 text-primary fw-normal text-decoration-underline">
                                        View Document
                                    </a>
                                @else
                                    <span class="ms-3 text-muted">No document uploaded</span>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="set-payout" role="tabpanel" aria-labelledby="set-payout-tab">
                            <div class="table-responsive mx-4 mt-n6">
                                <!--begin::Table-->
                                <table class="table table-row-dashed align-middle gs-0 gy-3 my-2 text-nowrap">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th>Product Name</th>
                                            <th>Effective Date</th>
                                            <th>Slabs (Range)</th>
                                            <th>Payout</th>
                                            <th>Payout Type</th>
                                            <th>Payout Subtype</th>
                                            <th>Configured Date</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <tbody>
                                        @forelse ($viewConfigurePayoutDetails as $productDetails)
                                            <tr style="border-bottom: 1px solid #dee2e6;">
                                                <td class="text-start py-2">
                                                    {{ $productDetails->product->type ?? '-' }}
                                                </td>
                                                <td class="text-start py-2">
                                                    {{ $productDetails->effective_from ?? '-' }}
                                                </td>
                                                <td class="text-start py-2">
                                                    {{ $productDetails->slab_range ?? '-' }}
                                                </td>
                                                <td class="text-start py-2">
                                                    {{ $productDetails->fixed_amount ?? '-' }}
                                                </td>
                                                <td class="text-start py-2">
                                                    @if (strtoupper($productDetails->payout_type) === 'FIXED')
                                                        Fixed
                                                    @elseif (strtoupper($productDetails->payout_type) === 'VARIABLE')
                                                        Variable
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-start py-2">
                                                    @if (strtoupper($productDetails->payout_as) === 'FIXED')
                                                        Amount
                                                    @elseif (strtoupper($productDetails->payout_as) === 'DISBURSEMENT')
                                                        Percentage
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-start py-2">
                                                    {{ \Carbon\Carbon::parse($productDetails->created_date)->format('d-m-Y') ?? '-' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-danger py-3">
                                                    <strong>No Configured Payouts Found!</strong>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $viewConfigurePayoutDetails->links() }}
                                </div>
                                <!--end::Table-->
                            </div>
                        </div>


                        <div class="tab-pane fade" id="pay-subconnectors" role="tabpanel"
                            aria-labelledby="pay-subconnectors-tab">
                            <div class="table-responsive">
                                <table class="table table-row-dashed align-middle gs-0 gy-3 my-2 text-nowrap">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            {{-- <th scope="col"><input type="checkbox"></th> --}}
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Business ID</th>
                                            <th scope="col">Mobile</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-center text-danger py-3">
                                                <strong>No Pay Sub Connectors!</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                    <div class="container-fluid">
                        <div class="card-body">
                            <!-- Section: PAN Details -->
                            <div class="mb-4 pb-3">
                                <div class="text-muted fw-semibold">Connector Level</div>
                                <div class="fw-bold mb-3">{{ $viewConnectorDetails->connector_level }}</div>
                                <div class="text-muted">Current Status</div>
                                <div class="fw-bold mb-3">{{ $viewConnectorDetails->status }}</div>
                                <div class="text-muted">Show Decisioning Output</div>
                                <div class="fw-bold mb-3">{{ $viewConnectorDetails->status }}</div>
                                <div class="text-muted">Onboarding Status</div>
                                <div class="fw-bold">{{ $viewConnectorDetails->status }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>
</div>
@endsection
