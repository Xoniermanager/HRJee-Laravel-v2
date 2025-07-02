@extends('layouts.company.main')

@section('title', 'Add Connector')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
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
                <!--begin::Timeline widget 3-->
                <div class="card h-md-100">
                    <!--begin::Header-->
                    <div class="card-header p-0 align-items-center">
                        <!--begin::Nav-->
                        <ul
                            class="nav nav-stretch nav-pills nav-pills-custom nav-pills-active-custom d-flex justify-content-between b-5 px-3">
                            <li class="nav-item p-0 ms-0">
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger active"
                                    data-bs-toggle="tab" href="#basic_Details_tab">
                                    <span class="fs-7 fw-semibold">Connector Details</span>
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
                            <!--end::Tap pane-->

                            <div class="card card-flush h-md-100">

                                <!--begin::Body-->
                                <div class="card-body">
                                    <form action="{{ route('connector.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <h4>Select Profession</h4>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="profession"
                                                    id="builder" value="Builder"
                                                    {{ old('profession') == 'Builder' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="builder">Builder</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="profession"
                                                    id="ca" value="CA/Tax C"
                                                    {{ old('profession') == 'CA/Tax C' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="ca">CA/ Tax C</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="profession"
                                                    id="banker" value="Ex Banker"
                                                    {{ old('profession') == 'Ex Banker' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="banker">Ex Banker</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="profession"
                                                    id="freelancer" value="L Freelancer"
                                                    {{ old('profession') == 'L Freelancer' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="freelancer">L Freelancer</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="profession"
                                                    id="agent" value="Ins Agent"
                                                    {{ old('profession') == 'Ins Agent' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="agent">Ins Agent</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="profession"
                                                    id="broker" value="RE Broker"
                                                    {{ old('profession') == 'RE Broker' || empty(old('profession')) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="broker">RE Broker</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="profession"
                                                    id="otherProf" value="Other"
                                                    {{ old('profession') == 'Other' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="otherProf">Other</label>
                                            </div>
                                            @if ($errors->has('profession'))
                                                <div class="text-danger">{{ $errors->first('profession') }}</div>
                                            @endif
                                        </div>

                                        <h4>Select Gender</h4>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="Male"
                                                    {{ old('gender') == 'Male' || empty(old('gender')) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="otherGen" value="Other"
                                                    {{ old('gender') == 'Other' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="otherGen">Other</label>
                                            </div>
                                            @if ($errors->has('gender'))
                                                <div class="text-danger">{{ $errors->first('gender') }}</div>
                                            @endif
                                        </div>

                                        <h4>Basic Details</h4>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="connectorName" class="form-label">Connector Name*</label>
                                                <input type="text" class="form-control" id="connectorName"
                                                    name="connector_name" value="{{ old('connector_name') }}">
                                                @if ($errors->has('connector_name'))
                                                    <div class="text-danger">{{ $errors->first('connector_name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="brandName" class="form-label">Contact/Brand Name</label>
                                                <input type="text" class="form-control" id="brandName"
                                                    name="brand_name" value="{{ old('brand_name') }}">
                                                @if ($errors->has('brand_name'))
                                                    <div class="text-danger">{{ $errors->first('brand_name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email*</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">Phone Number*</label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" id="phone"
                                                        name="msisdn" value="{{ old('msisdn') }}">
                                                </div>
                                                @if ($errors->has('msisdn'))
                                                    <div class="text-danger">{{ $errors->first('msisdn') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <h4>Additional Details</h4>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="pan" class="form-label">PAN</label>
                                                <input type="text" class="form-control" id="pan"
                                                    name="pan_number" value="{{ old('pan_number') }}">
                                                @if ($errors->has('pan_number'))
                                                    <div class="text-danger">{{ $errors->first('pan_number') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="company" class="form-label">Company Name</label>
                                                <input type="text" class="form-control" id="company"
                                                    name="company_name" value="{{ old('company_name') }}">
                                                @if ($errors->has('company_name'))
                                                    <div class="text-danger">{{ $errors->first('company_name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="gstin" class="form-label">GSTIN</label>
                                                <input type="text" class="form-control" id="gstin" name="gst_in"
                                                    value="{{ old('gst_in') }}">
                                                @if ($errors->has('gst_in'))
                                                    <div class="text-danger">{{ $errors->first('gst_in') }}</div>
                                                @endif
                                            </div>

                                            <h4>Current Address</h4>
                                            <div class="col-md-6 mb-3">
                                                <label for="address1" class="form-label">Address Line 1</label>
                                                <input type="text" class="form-control" id="address1" name="address"
                                                    value="{{ old('address') }}">
                                                @if ($errors->has('address'))
                                                    <div class="text-danger">{{ $errors->first('address') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="pincode" class="form-label">Pin Code</label>
                                                <input type="text" class="form-control" id="pincode" name="pincode"
                                                    value="{{ old('pincode') }}">
                                                @if ($errors->has('pincode'))
                                                    <div class="text-danger">{{ $errors->first('pincode') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city"
                                                    value="{{ old('city') }}">
                                                @if ($errors->has('city'))
                                                    <div class="text-danger">{{ $errors->first('city') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="state" class="form-label">State</label>
                                                <input type="text" class="form-control" id="state" name="state"
                                                    value="{{ old('state') }}">
                                                @if ($errors->has('state'))
                                                    <div class="text-danger">{{ $errors->first('state') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label for="comment" class="form-label">Comment</label>
                                            <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="shortcode" class="form-label">Short Code Name</label>
                                                <input type="text" class="form-control" id="shortcode"
                                                    name="short_code_name" value="{{ old('short_code_name') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="assign" class="form-label">Assign To</label>
                                                <select id="assigned_to" name="assigned_to" class="form-select"
                                                    style="width: 100%">
                                                    @if (old('assigned_to'))
                                                        <option value="{{ old('assigned_to') }}" selected>
                                                            {{ old('assigned_to') }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    <!--end::Tab Content-->
                                </div>
                                <!--end::Body-->
                            </div>

                        </div>

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
        $(document).ready(function() {
            let hasOldValue = "{{ old('assigned_to') }}" !== "";

            // Initialize Select2 first
            $('#assigned_to').select2({
                placeholder: 'Select User',
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
                                    email: item.email,
                                    phone: item.details?.phone || '-'
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

            // Manually load first user from API and set as default (only if no old value)
            if (!hasOldValue) {
                $.ajax({
                    url: '{{ route('user.search') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const firstUser = data.data[0];
                        if (firstUser) {
                            const option = new Option(firstUser.name, firstUser.id, true, true);
                            $('#assigned_to').append(option).trigger('change');
                        }
                    }
                });
            }
        });
    </script>
@endsection
