@extends('layouts.company.main')

@section('content')

@section('title')
    Forecasting
@endsection

<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="card">
                    <div class="card-header align-items-center">
                        <h2> Sales Forecasting</h2>
                        <div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_ticket"
                                class="btn btn-sm btn-primary align-self-center">
                                Add Forecasting
                            </a>
                        </div>
                    </div>

                    <div class="mb-5 mb-xl-10">
                        @include('company.sales_forecasting.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Ticket Modal -->
    <div class="modal fade" id="view_ticket" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-550px">
            <div class="modal-content" style="border-radius: 0.5rem; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);">
                <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                    <h5 class="modal-title" id="viewModalLabel">Ticket Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0;">
                    <!-- Title-Value Pair 1 -->
                    <div class="detail-row"
                        style="display: flex; padding: 0.75rem 1rem; border-bottom: 1px solid #f0f0f0;">
                        <div class="detail-title" style="flex: 0 0 150px; font-weight: 600; color: #495057;">Subject
                        </div>
                        <div class="detail-value" id="view_subject" style="flex: 1; color: #212529;"></div>
                    </div>
                    <!-- Title-Value Pair 2 -->
                    <div class="detail-row"
                        style="display: flex; padding: 0.75rem 1rem; border-bottom: 1px solid #f0f0f0;">
                        <div class="detail-title" style="flex: 0 0 150px; font-weight: 600; color: #495057;">Category
                        </div>
                        <div class="detail-value" id="view_category" style="flex: 1; color: #212529;"></div>
                    </div>
                    <!-- Title-Value Pair 3 -->
                    <div class="detail-row"
                        style="display: flex; padding: 0.75rem 1rem; border-bottom: 1px solid #f0f0f0;">
                        <div class="detail-title" style="flex: 0 0 150px; font-weight: 600; color: #495057;">Message
                        </div>
                        <div class="detail-value" id="view_message" style="flex: 1; color: #212529;"></div>
                    </div>
                    <div class="detail-row"
                        style="display: flex; padding: 0.75rem 1rem;">
                        <div class="detail-title" style="flex: 0 0 150px; font-weight: 600; color: #495057;">Status
                        </div>
                        <div class="detail-value">
                            <span class="badge" id="view_status" style="padding: 0.5rem 0.75rem;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Ticket Modal -->
    <div class="modal" id="add_ticket">
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Create Support Ticket</h2>
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
                    <form id="ticketAddForm">
                        @csrf
                        <div class="mb-3">
                            <label for="ticketSubject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="ticketSubject"
                                placeholder="Enter ticket subject" name="subject">
                        </div>
                        <div class="mb-3">
                            <label for="ticketCategory" class="form-label">Category</label>
                            <select class="form-select" id="ticketCategory" name="category">
                                <option value="Technical">Technical</option>
                                <option value="Billing">Billing</option>
                                <option value="General">General</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ticketMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="ticketMessage" rows="4" placeholder="Describe your issue..."
                                name="message"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit
                                Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('#ticketAddForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= route('sales-forecasting.store') ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        jQuery('#add_ticket').modal('hide');
                        jQuery("#ticketAddForm")[0].reset();
                        Swal.fire("Success!", "Ticket added successfully!", "success");
                        $('#ticket_list').replaceWith(res.data);
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "There was an error adding the incentive.",
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
                        url: "<?= route('sales-forecasting.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was successfully deleted!", "success");
                            $('#ticket_list').replaceWith(res.data);
                        },
                        error: function(xhr) {
                            Swal.fire("Deletion Error", "This incentive cannot be deleted.", "error");
                        }
                    });
                }
            });
        }

        function view_ticket_details($ticketDetails) {
            $('#view_subject').text($ticketDetails.subject);
            $('#view_category').text($ticketDetails.category);
            $('#view_status').text($ticketDetails.status);
            const $statusBadge = $('#view_status');
            $statusBadge.removeClass('bg-success bg-danger bg-warning');

            if ($ticketDetails.status === "Open") {
                $statusBadge.addClass('bg-warning text-dark');
            } else {
                $statusBadge.addClass('bg-success');
            }
            $('#view_message').text($ticketDetails.message);
            jQuery('#view_ticket').modal('show');
        }
    </script>
</div>

@endsection
