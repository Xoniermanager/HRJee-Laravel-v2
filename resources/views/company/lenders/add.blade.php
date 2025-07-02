@extends('layouts.company.main')
@section('content')
@section('title')
    Add Lender
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
                                <form class="row g-3" id="lenderForm">
                                    @csrf
                                    <h4 class="mb-4">Loan Gateway Form</h4>
                                    <!-- Lender Name -->
                                    <div class="col-md-12">
                                        <label for="lender_name" class="form-label">Lender
                                            Name*</label>
                                        <select class="form-select" id="lender_name" name="lender_name">
                                            <option selected disabled>Please select Lender</option>
                                            @foreach ($allDefaultLenders as $allDefaultLender)
                                                <option value="{{ $allDefaultLender->id }}"
                                                    {{ old('lender_name') == $allDefaultLender->id ? 'selected' : '' }}>
                                                    {{ $allDefaultLender->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Product -->
                                    <div class="col-md-12">
                                        <label for="product_id" class="form-label">Product*</label>
                                        <select class="form-select" id="product_id" name="product_id">
                                            <option selected disabled>Please select Product</option>
                                            @foreach ($allProducts as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ old('product') == $product->id ? 'selected' : '' }}>
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
                                                id="consent_type" value="No Consent" select>
                                            <label class="form-check-label" for="consent_type">No
                                                Consent</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="consent_type"
                                                id="consent_type" value="Global">
                                            <label class="form-check-label" for="consent_type">Global</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="consent_type"
                                                id="consent_type" value="Individual">
                                            <label class="form-check-label" for="individual">Individual</label>
                                        </div>
                                    </div>
                                    <!-- Case Routing Mode -->
                                    <div class="col-md-12">
                                        <div class="">
                                            <label class="form-label">Select Case Routing Mode</label>
                                            <!-- Individual Case Routing -->
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="individualCase"
                                                        onchange="toggleSection('individualOptions', this)">
                                                    <label class="form-check-label fw-bold"
                                                        for="individualCase">Individual Case Routing</label>
                                                </div>
                                                <div id="individualOptions" class="nested-options mb-3">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="individual_case_routing" id="indApi"
                                                            value="API">
                                                        <label class="form-check-label" for="indApi">API</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="individual_case_routing" id="indAutomation"
                                                            value="Automation">
                                                        <label class="form-check-label"
                                                            for="indAutomation">Automation</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input login-radio" type="radio"
                                                            name="individual_case_routing" id="indLogin"
                                                            value="Login">
                                                        <label class="form-check-label" for="indLogin">Login</label>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="individual_case_routing" id="indWeblink"
                                                            value="Weblink">
                                                        <label class="form-check-label" for="indWeblink">Weblink</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bulk Case Routing -->
                                            <div class="col-12">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="bulkCase"
                                                        onchange="toggleSection('bulkOptions', this)">
                                                    <label class="form-check-label fw-bold" for="bulkCase">Bulk
                                                        Case Routing</label>
                                                </div>
                                                <div id="bulkOptions" class="nested-options">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio"
                                                            name="bulk_case_routing" id="bulkApi" value="API">
                                                        <label class="form-check-label" for="bulkApi">API</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input login-radio" type="radio"
                                                            name="bulk_case_routing" id="bulkLogin" value="Login">
                                                        <label class="form-check-label" for="bulkLogin">Login</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Login-Only Fields -->
                                            <div id="loginFields" class="col-12 login-fields">
                                                <hr>
                                                <h5>Login Details</h5>
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <label for="hub" class="form-label">Hub</label>
                                                        <select class="form-select" id="hub" name="hub">
                                                            <option selected disabled>Please select Hub</option>
                                                            <option value="Hub 1">Hub 1</option>
                                                            <option value="Hub 2">Hub 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="pinCode" class="form-label">Pin Code</label>
                                                        <input type="text" class="form-control" id="pincode"
                                                            name="pincode" placeholder="Enter Pin Code">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="city" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="city"
                                                            name="city" placeholder="Enter City">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="lenderLink" class="form-label">Lender
                                                            Link</label>
                                                        <input type="url" class="form-control" id="lenderLink"
                                                            name="lender_link" placeholder="https://example.com">
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
                                                    document.getElementById('loginFields').style.display = radio.checked ? 'block' : 'none';
                                                });
                                            });

                                            // Hide login fields initially
                                            document.addEventListener('DOMContentLoaded', () => {
                                                document.getElementById('loginFields').style.display = 'none';
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
                                                id="allowmarketing" checked="" onclick="updateStatus(this)">
                                            <label class="form-check-label" for="allowmarketing"></label>
                                        </div>

                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
        $("#lenderForm").validate({ 
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
                    url: "{{ route('lender.store') }}",
                    type: 'POST',
                    data: lender_data,
                    success: function(response) {
                        $("#lenderForm")[0].reset(); 
                        swal.fire("Done!", response.message, "success");
                        window.location.href = response.redirect; 
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        
                        $('.error').text('');

                        if (xhr.responseJSON && xhr.responseJSON.success === false) {
                            swal.fire("Error!", xhr.responseJSON.message, "error");
                        } else {
                            swal.fire("Error!", "An unexpected error occurred.", "error");
                        }
                    }
                });
            }
        });
    });
</script>


@endsection
