@extends('layouts.company.main')
@section('content')
@section('title')
    Add Lead
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
                    <!-- Form A -->
                    <div class="col-md-6">
                        <div class="card card-flush h-md-100">
                            <div class="card-body">
                                <div class="">
                                    <h2 class="mb-4">Applicant Details</h2>
                                    <form id="formA" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="leadId" name="lead_id" value="">

                                        <!-- Selection -->
                                        <div class="mb-4">
                                            <label class="form-label d-block">Select*</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="lead_type"
                                                    id="selfOption" value="self"
                                                    {{ old('lead_type', 'self') == 'self' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="selfOption">Self</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="lead_type"
                                                    id="connectorOption" value="connector"
                                                    {{ old('lead_type') == 'connector' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="connectorOption">Connector</label>
                                            </div>
                                        </div>

                                        <!-- Connector Name Field (Initially Hidden) -->
                                        <div id="connectorNameField" class="mb-3" style="display: none;">
                                            <label class="form-label">Connector Name*</label>

                                            <select class="form-select" name="connector_name" id="connector_name">
                                                @if (old('connector_name'))
                                                    <option value="{{ old('connector_name') }}" selected>
                                                        {{ old('connector_name') }}</option>
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Common Fields -->
                                        <div class="mb-3">
                                            <label class="form-label">Applicant Type*</label>
                                            <select class="form-select" name="applicant_type">
                                                <option value="">Select Applicant Types</option>
                                                <option value="business"
                                                    {{ old('applicant_type') == 'business' ? 'selected' : '' }}>Business
                                                </option>
                                                <option value="individual"
                                                    {{ old('applicant_type') == 'individual' ? 'selected' : '' }}>
                                                    Individual</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" id="business_type_label">Business Type*</label>
                                            <select class="form-select" name="business_type">
                                                <option value="">Select Business Type</option>
                                                <option value="limited"
                                                    {{ old('business_type') == 'limited' ? 'selected' : '' }}>Limited
                                                </option>
                                                <option value="private limited"
                                                    {{ old('business_type') == 'private limited' ? 'selected' : '' }}>
                                                    Private Limited</option>
                                                <option value="partnership"
                                                    {{ old('business_type') == 'partnership' ? 'selected' : '' }}>
                                                    Partnership</option>
                                                <option value="limited liability partnership"
                                                    {{ old('business_type') == 'limited liability partnership' ? 'selected' : '' }}>
                                                    Limited Liability Partnership</option>
                                                <option value="hindu undivided family"
                                                    {{ old('business_type') == 'hindu undivided family' ? 'selected' : '' }}>
                                                    Hindu Undivided Family</option>
                                                <option value="sole proprietor"
                                                    {{ old('business_type') == 'sole proprietor' ? 'selected' : '' }}>
                                                    Sole Proprietor</option>
                                                <option value="trust"
                                                    {{ old('business_type') == 'trust' ? 'selected' : '' }}>Trust
                                                </option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Customer Mobile No*</label>
                                            <input type="text" class="form-control" name="customer_number"
                                                value="{{ old('customer_number') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Customer Name*</label>
                                            <input type="text" class="form-control" name="customer_name"
                                                value="{{ old('customer_name') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Assign to Sales User*</label>
                                            <select class="form-select" name="assigned_user" id="assigned_user">
                                                @if (old('assigned_user'))
                                                    <option value="{{ old('assigned_user') }}" selected>
                                                        {{ old('assigned_user') }}</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Assign to Back Office</label>
                                            <input type="text" class="form-control" name="assigned_back_office"
                                                placeholder="Search assign to back office"
                                                value="{{ old('assigned_back_office') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label d-block">Do I know my product?</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="know_product"
                                                    id="knowYes" value="yes"
                                                    {{ old('know_product', 'yes') == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="knowYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="know_product"
                                                    id="knowNo" value="no"
                                                    {{ old('know_product') == 'no' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="knowNo">No</label>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <a href="#" class="btn btn-sm btn-danger">Cancel</a>
                                            <button class="btn btn-sm btn-primary" type="submit"
                                                id="submitFormA">Continue</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-flush h-md-100">
                            <div class="card-body">
                                <h2 class="mb-4">Select Product</h2>
                                <form id="formB" class="product-options" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="lead_id" id="formBLeadId" value="">

                                    <ul style="list-style: none; padding: 0;">
                                        @foreach ($allProducts as $product)
                                            <li class="mb-2">
                                                <label class="form-check-label d-flex align-items-center">
                                                    <input type="radio" name="product"
                                                        value="{{ $product->id }}" class="form-check-input me-2"
                                                        {{ old('product') == $product->type ? 'checked' : '' }}>
                                                    {{ $product->type }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="mt-4">
                                        <a href="#" class="btn btn-sm btn-danger">Cancel</a>
                                        <button class="btn btn-sm btn-primary" type="submit"
                                            id="submitFormB">Continue</button>
                                    </div>
                                </form>
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

        let hasOldValue = "{{ old('assigned_user') }}" !== "";

            // Initialize Select2 first
            $('#assigned_user').select2({
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

            if (!hasOldValue) {
                $.ajax({
                    url: '{{ route('user.search') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const firstUser = data.data[0];
                        if (firstUser) {
                            const option = new Option(firstUser.name, firstUser.id, true, true);
                            $('#assigned_user').append(option).trigger('change');
                        }
                    }
                });
            }
        
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
                                id: item.connector_id,
                                text: item.connector_name,
                                msisdn: item.msisdn
                            };
                        })
                    };
                },
                cache: true
            },
            width: '100%',
            templateResult: formatConnectorOption,
            templateSelection: formatConnectorSelection
        });

        function formatConnectorOption(data) {
            if (!data.id) return data.text;

            return $(`
        <div style="display: flex; justify-content: space-between;">
            <span>${data.text}</span>
            <span class="text-muted">${data.msisdn}</span>
        </div>
    `);
        }

        function formatConnectorSelection(data) {
            return data.text;
        }

        // Disable both forms initially, then enable FormA
        disableFormA();
        disableFormB();
        enableFormA();

        $('select[name="applicant_type"]').change(function() {
            if ($(this).val() === 'individual') {
                $('#business_type_label').text('Individual Type*');
                $('select[name="business_type"]').html(individualOptions);
            } else {
                $('#business_type_label').text('Business Type*');
                $('select[name="business_type"]').html(businessOptions);
            }
        });

        // Initial check on page load (for old value)
        if ($('select[name="applicant_type"]').val() === 'individual') {
            $('#business_type_label').text('Individual Type*');
            $('select[name="business_type"]').html(individualOptions);
        }
        // Handle lead type change (self/connector)
        $('input[name="lead_type"]').change(function() {
            if ($(this).val() === 'connector') {
                $('#connectorNameField').show();
            } else {
                $('#connectorNameField').hide();
                $('select[name="connector_name"]').val('');
            }
        });

        // Check initial state for connector field
        if ($('input[name="lead_type"]:checked').val() === 'connector') {
            $('#connectorNameField').show();
        }
        // Form A submission
        $('#formA').on('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            clearFormErrors('#formA');

            const submitButton = $('#submitFormA');
            submitButton.prop('disabled', true).text('Submitting...');

            const formData = new FormData(this);

            $.ajax({
                url: '{{ route('lead.store') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', 'Lead saved successfully!');

                        // Set lead ID for both forms
                        $('#leadId').val(response.lead_id);
                        $('#formBLeadId').val(response.lead_id);

                        // Disable Form A and enable Form B
                        disableFormA();
                        enableFormB();
                    } else {
                        if (response.errors) {
                            displayValidationErrors('#formA', response.errors);
                        }
                        showAlert('error', response.message || 'An error occurred');
                        submitButton.prop('disabled', false).text('Continue');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        displayValidationErrors('#formA', xhr.responseJSON.errors);
                    } else {
                        let errorMessage = 'Submission failed. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showAlert('error', errorMessage);
                    }
                    submitButton.prop('disabled', false).text('Continue');
                }
            });
        });

        // Form B submission
        $('#formB').on('submit', function(e) {
            e.preventDefault();
            clearFormErrors('#formB');

            const submitButton = $('#submitFormB');
            submitButton.prop('disabled', true).text('Submitting...');

            const formData = new FormData(this);

            $.ajax({
                url: '{{ route('update.product') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect_url ||
                            '{{ route('leads') }}';
                    } else {
                        if (response.errors) {
                            displayValidationErrors('#formB', response.errors);
                        }
                        showAlert('error', response.message || 'An error occurred');
                        submitButton.prop('disabled', false).text('Continue');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        displayValidationErrors('#formB', xhr.responseJSON.errors);
                    } else {
                        let errorMessage = 'Submission failed. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showAlert('error', errorMessage);
                    }
                    submitButton.prop('disabled', false).text('Continue');
                }
            });
        });

        // Helper functions
        function disableFormA() {
            $('#formA input, #formA select, #formA textarea, #formA button').prop('disabled', true);
            $('#formA .btn').addClass('disabled');
            $('#assigned_user').prop('disabled', true).trigger('change');
        }

        function enableFormA() {
            $('#formA input, #formA select, #formA textarea, #formA button').prop('disabled', false);
            $('#formA .btn').removeClass('disabled');
            $('#assigned_user').prop('disabled', false);
        }

        function disableFormB() {
            $('#formB input, #formB select, #formB textarea, #formB button').prop('disabled', true);
            $('#formB .btn').addClass('disabled');
        }

        function enableFormB() {
            $('#formB input, #formB select, #formB textarea, #formB button').prop('disabled', false);
            $('#formB .btn').removeClass('disabled');
        }

        function clearFormErrors(formSelector) {
            $(formSelector + ' .text-danger').remove();
        }

        function displayValidationErrors(formSelector, errors) {
            $.each(errors, function(field, messages) {
                const errorMessage = Array.isArray(messages) ? messages[0] : messages;
                const fieldElement = $(formSelector + ' [name="' + field + '"]');

                if (fieldElement.length) {
                    if (fieldElement.is('input[type="radio"]')) {
                        fieldElement.closest('.mb-3, .mb-4').append('<div class="text-danger">' +
                            errorMessage + '</div>');
                    } else {

                        fieldElement.after('<div class="text-danger">' + errorMessage + '</div>');
                    }
                }
            });
        }

        function showAlert(type, message) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const alertHtml = `<div class="alert ${alertClass} alert-dismissible">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;

            $('.container-xxl').prepend(alertHtml);

            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);
        }
    });
</script>
@endsection
