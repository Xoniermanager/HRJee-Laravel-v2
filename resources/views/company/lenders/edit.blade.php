@extends('layouts.company.main')
@section('content')
@section('title')
    Edit Lender
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
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

            <div class="col-md-12">
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="card card-flush h-md-100">
                        <div class="card-body">
                            <div class="">
                                <form class="row g-3" id="lenderEditForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $editLenderDetails->id }}">
                                    <h4 class="mb-4">Loan Gateway Form</h4>
                                    <!-- Lender Name -->
                                    <div class="col-md-12">
                                        <label for="lender_name" class="form-label">Lender
                                            Name*</label>
                                        <select class="form-select" id="lender_name" name="lender_name">
                                            <option disabled
                                                {{ is_null(old('lender_name', $editLenderDetails->lender_name)) ? 'selected' : '' }}>
                                                Please select Lender
                                            </option>
                                            @foreach ($allDefaultLenders as $allDefaultLender)
                                                <option value="{{ $allDefaultLender->id }}"
                                                    {{ old('lender_name', $editLenderDetails->lender_name) == $allDefaultLender->id ? 'selected' : '' }}>
                                                    {{ $allDefaultLender->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Product -->
                                    <div class="col-md-12">
                                        <label for="product_id" class="form-label">Product*</label>
                                        <select class="form-select" id="product_id" name="product_id">
                                            <option disabled
                                                {{ is_null(old('product_id', $editLenderDetails->product_id)) ? 'selected' : '' }}>
                                                Please select Product
                                            </option>
                                            @foreach ($allProducts as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ old('product_id', $editLenderDetails->product_id) == $product->id ? 'selected' : '' }}>
                                                    {{ $product->type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Consent -->
                                    <div class="col-md-12">
                                        <label class="form-label d-block">Consent</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="consent_type"
                                                id="consent_type_no_consent" value="No Consent"
                                                {{ old('consent_type', $editLenderDetails->consent_type) == 'No Consent' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="consent_type_no_consent">No
                                                Consent</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="consent_type"
                                                id="consent_type_global" value="Global"
                                                {{ old('consent_type', $editLenderDetails->consent_type) == 'Global' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="consent_type_global">Global</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="consent_type"
                                                id="consent_type_individual" value="Individual"
                                                {{ old('consent_type', $editLenderDetails->consent_type) == 'Individual' ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="consent_type_individual">Individual</label>
                                        </div>
                                    </div>
                                    <!-- Case Routing Mode -->
                                    <div class="col-md-12">
                                        <div class="">
                                            <label class="form-label">Select Case Routing Mode</label>
                                            <!-- Individual Case Routing -->
                                            <div class="col-12">
                                                <div class="form-check">
                                                    @php
                                                        $individualCaseChecked = !empty(
                                                            $editLenderDetails->individual_case_routing
                                                        );
                                                    @endphp
                                                    <input class="form-check-input" type="checkbox" id="individualCase"
                                                        onchange="toggleSection('individualOptions', this)"
                                                        {{ $individualCaseChecked ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-bold"
                                                        for="individualCase">Individual Case Routing</label>
                                                </div>
                                                <div id="individualOptions" class="nested-options mb-3"
                                                    style="{{ $individualCaseChecked ? 'display: block;' : 'display: none;' }}">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="individual_case_routing" id="indApi" value="API"
                                                            {{ old('individual_case_routing', $editLenderDetails->individual_case_routing) == 'API' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="indApi">API</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="individual_case_routing" id="indAutomation"
                                                            value="Automation"
                                                            {{ old('individual_case_routing', $editLenderDetails->individual_case_routing) == 'Automation' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="indAutomation">Automation</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input login-radio" type="radio"
                                                            name="individual_case_routing" id="indLogin" value="Login"
                                                            {{ old('individual_case_routing', $editLenderDetails->individual_case_routing) == 'Login' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="indLogin">Login</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="individual_case_routing" id="indWeblink"
                                                            value="Weblink"
                                                            {{ old('individual_case_routing', $editLenderDetails->individual_case_routing) == 'Weblink' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="indWeblink">Weblink</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bulk Case Routing -->
                                            <div class="col-12">
                                                <div class="form-check mb-3">
                                                    @php
                                                        $bulkCaseChecked = !empty(
                                                            $editLenderDetails->bulk_case_routing
                                                        );
                                                    @endphp
                                                    <input class="form-check-input" type="checkbox" id="bulkCase"
                                                        onchange="toggleSection('bulkOptions', this)"
                                                        {{ $bulkCaseChecked ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-bold" for="bulkCase">Bulk
                                                        Case Routing</label>
                                                </div>
                                                <div id="bulkOptions" class="nested-options"
                                                    style="{{ $bulkCaseChecked ? 'display: block;' : 'display: none;' }}">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="bulk_case_routing" id="bulkApi" value="API"
                                                            {{ old('bulk_case_routing', $editLenderDetails->bulk_case_routing) == 'API' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="bulkApi">API</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input login-radio" type="radio"
                                                            name="bulk_case_routing" id="bulkLogin" value="Login"
                                                            {{ old('bulk_case_routing', $editLenderDetails->bulk_case_routing) == 'Login' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="bulkLogin">Login</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Login-Only Fields -->
                                            <div id="loginFields" class="col-12 login-fields"
                                                style="{{ old('individual_case_routing', $editLenderDetails->individual_case_routing) == 'Login' || old('bulk_case_routing', $editLenderDetails->bulk_case_routing) == 'Login' ? 'display: block;' : 'display: none;' }}">
                                                <hr>
                                                <h5>Login Details</h5>
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <label for="hub" class="form-label">Hub</label>
                                                        <select class="form-select" id="hub" name="hub">
                                                            <option selected disabled>Please select Hub</option>
                                                            <option value="Hub 1"
                                                                {{ old('hub', $editLenderDetails->hub) == 'Hub 1' ? 'selected' : '' }}>
                                                                Hub 1</option>
                                                            <option value="Hub 2"
                                                                {{ old('hub', $editLenderDetails->hub) == 'Hub 2' ? 'selected' : '' }}>
                                                                Hub 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="pinCode" class="form-label">Pin Code</label>
                                                        <input type="text" class="form-control" id="pincode"
                                                            name="pincode" placeholder="Enter Pin Code"
                                                            value="{{ old('pincode', $editLenderDetails->pincode) }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="city" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="city"
                                                            name="city" placeholder="Enter City"
                                                            value="{{ old('city', $editLenderDetails->city) }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="lenderLink" class="form-label">Lender
                                                            Link</label>
                                                        <input type="url" class="form-control" id="lenderLink"
                                                            name="lender_link" placeholder="https://example.com"
                                                            value="{{ old('lender_link', $editLenderDetails->lender_link) }}">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <script>
                                            function toggleSection(id, checkbox) {
                                                document.getElementById(id).style.display = checkbox.checked ? 'block' : 'none';
                                            }

                                            const loginRadios = document.querySelectorAll('.login-radio');
                                            loginRadios.forEach(radio => {
                                                radio.addEventListener('change', () => {
                                                    // Show login fields if *either* individual or bulk is set to Login
                                                    const individualLogin = document.querySelector(
                                                        'input[name="individual_case_routing"]:checked')?.value === 'Login';
                                                    const bulkLogin = document.querySelector('input[name="bulk_case_routing"]:checked')
                                                        ?.value === 'Login';
                                                    document.getElementById('loginFields').style.display = (individualLogin || bulkLogin) ?
                                                        'block' : 'none';
                                                });
                                            });

                                            // Hide login fields initially
                                            document.addEventListener('DOMContentLoaded', () => {
                                                const individualLogin = document.querySelector('input[name="individual_case_routing"]:checked')
                                                    ?.value === 'Login';
                                                const bulkLogin = document.querySelector('input[name="bulk_case_routing"]:checked')?.value === 'Login';
                                                document.getElementById('loginFields').style.display = (individualLogin || bulkLogin) ? 'block' :
                                                'none';
                                            });

                                            function updateStatus(checkbox) {
                                                var statusInput = document.querySelector('input[name="status"]');
                                                statusInput.value = checkbox.checked ? "1" : "0";
                                            }
                                        </script>
                                    </div>

                                    <style>
                                        .nested-options {
                                            margin-left: 2rem;
                                            margin-top: 0.5rem;
                                        }

                                        .conditional-fields {
                                            display: none;
                                        }
                                    </style>

                                    <div class="col-md-12">
                                        <label for="Status" class="form-label">Status</label>
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            <input type="hidden" name="status" value="1">
                                            <input class="form-check-input w-45px h-30px" type="checkbox"
                                                id="allowmarketing" {{ $editLenderDetails->status ? 'checked' : '' }}
                                                onclick="updateStatus(this)">
                                            <label class="form-check-label" for="allowmarketing"></label>
                                        </div>

                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                </form>
                                <!--end::Table container-->

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $("#lenderEditForm").validate({
            rules: {
                lender_name: "required",
                product_id: "required"
            },
            messages: {
                lender_name: "Please enter lender name",
                product_id: "Please select a product"
            },
            submitHandler: function(form) {
                var lender_data = $(form).serialize();
                $.ajax({
                    url: "{{ route('lender.update') }}",
                    type: 'POST',
                    data: lender_data,
                    success: function(response) {
                        console.log(response);

                        jQuery("#lenderEditForm")[0].reset(); // Corrected form ID
                        swal.fire("Done!", response.message, "success");
                        $('#lender_list').html(response.data); // Assuming you have a lender list to update
                        window.location.href = response.redirect;

                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        console.log(errors);

                        for (var error_key in errors) {
                            $(document).find('#' + error_key + '_error').text(errors[
                                error_key]);
                        }
                    }
                });
            }
        });
    });
</script>

@endsection
