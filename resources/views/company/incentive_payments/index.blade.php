@extends('layouts.company.main')

@section('content')

@section('title')
    Incentive
@endsection

<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="card">
                    <div class="card-header align-items-center">
                        <h2> Incentive Payments</h2>
                        <div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_incentive_payment"
                                class="btn btn-sm btn-primary align-self-center">
                                Add Incentive
                            </a>
                        </div>
                    </div>

                    <div class="mb-5 mb-xl-10">
                        @include('company.incentive_payments.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Incentive Modal -->
    <div class="modal" id="edit_incentive_payment">
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Edit Incentive</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <form id="incentiveEditForm">
                        @csrf
                        <input type="hidden" name="id" id="edit_incentive_id">
                        <div class="mb-3">
                            <label for="edit_connector_id" class="form-label">Select a Connector</label>
                            <select class="form-control mb-2 mt-3" name="connector_id" id="edit_connector_id" required>
                                <option value="">Select a Connector</option>
                                @foreach ($allConnectorDetails as $allConnectorDetail)
                                    <option value="{{ $allConnectorDetail->id }}">
                                        {{ $allConnectorDetail->connector_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_incentiveType" class="form-label">Incentive Type</label>
                            <select class="form-select" id="edit_incentive_type" name="incentive_type" required>
                                <option value="Performance Bonus">Performance Bonus</option>
                                <option value="Referral Bonus">Referral Bonus</option>
                                <option value="Target Achievement">Target Achievement</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_incentiveAmount" class="form-label">Amount (₹)</label>
                            <input type="number" class="form-control" id="edit_amount" placeholder="e.g. 1000"
                                name="amount">
                        </div>
                        <div class="mb-3">
                            <label for="edit_month" class="form-label">Month</label>
                            <input type="month" class="form-control" id="edit_month" name="month" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Incentive</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Incentive Modal -->
    <div class="modal" id="add_incentive_payment">
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Add Incentive</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <form id="incentiveAddForm">
                        @csrf
                        <div class="mb-3">
                            <select class="form-control mb-2 mt-3" name="connector_id" id="connectorSelect">
                                <option value="">Select a Connector</option>
                                @foreach ($allConnectorDetails as $allConnectorDetail)
                                    <option value="{{ $allConnectorDetail->id }}">
                                        {{ $allConnectorDetail->connector_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_incentiveType" class="form-label">Incentive Type</label>
                            <select class="form-select" id="add_incentiveType" name="incentive_type" required>
                                <option value="Performance Bonus">Performance Bonus</option>
                                <option value="Referral Bonus">Referral Bonus</option>
                                <option value="Target Achievement">Target Achievement</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_incentiveAmount" class="form-label">Amount (₹)</label>
                            <input type="number" class="form-control" id="add_incentiveAmount"
                                placeholder="e.g. 1000" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_month" class="form-label">Month</label>
                            <input type="month" class="form-control" id="add_month" name="month" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_status" class="form-label">Status</label>
                            <select class="form-select" id="add_status" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Incentive</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('#incentiveAddForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= route('incentive-payments.store') ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        jQuery('#add_incentive_payment').modal('hide');
                        jQuery("#incentiveAddForm")[0].reset();
                        Swal.fire("Success!", "Incentive added successfully!", "success");
                        $('#incentive_payments_list').replaceWith(res.data);
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "There was an error adding the incentive.",
                            "error");
                    }
                });
            });

            // Handle form submissions for editing incentives
            $('#incentiveEditForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= route('incentive-payments.update') ?>", // Adjust the route as necessary
                    type: "post",
                    data: $(this).serialize(),
                    success: function(res) {
                        jQuery('#edit_incentive_payment').modal('hide');
                        jQuery("#incentiveEditForm")[0].reset();
                        Swal.fire("Success!", "Incentive updated successfully!", "success");
                        $('#incentive_payments_list').replaceWith(res.data);
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "There was an error updating the incentive.",
                            "error");
                    }
                });
            });
        });

        function deleteFunction(id) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= route('incentive-payments.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was successfully deleted!", "success");
                            $('#incentive_payments_list').replaceWith(res.data);
                        },
                        error: function(xhr) {
                            Swal.fire("Deletion Error", "This incentive cannot be deleted.", "error");
                        }
                    });
                }
            });
        }

        function edit_incentive_details($allIncentivePaymentDetail) {

            $allIncentivePaymentDetail = JSON.parse($allIncentivePaymentDetail);
            $('#edit_incentive_id').val($allIncentivePaymentDetail.id);
            $('#edit_connector_id').val($allIncentivePaymentDetail.connector_id);
            $('#edit_incentive_type').val($allIncentivePaymentDetail.incentive_type);
            $('#edit_amount').val($allIncentivePaymentDetail.amount);
            $('#edit_month').val($allIncentivePaymentDetail.month);
            $('#edit_status').val($allIncentivePaymentDetail.status);

            jQuery('#edit_incentive_payment').modal('show');
        }
    </script>
</div>

@endsection
