@extends('layouts.company.main')

@section('content')

@section('title')
    Supports
@endsection

<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="card">
                    <div class="card-header align-items-center">
                        <h2> Support Management</h2>
                    </div>

                    <div class="mb-5 mb-xl-10">
                        @include('company.support.list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Ticket Modal -->
    <div class="modal fade" id="view_support" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-550px">
            <div class="modal-content" style="border-radius: 0.5rem; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);">
                <div class="modal-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                    <h5 class="modal-title" id="viewModalLabel">Support Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0;">
                    <div class="detail-row" style="display: flex; padding: 0.75rem 1rem; border-bottom: 1px solid #f0f0f0;">
                        <div class="detail-title" style="flex: 0 0 150px; font-weight: 600; color: #495057;">Subject</div>
                        <div class="detail-value" id="view_subject" style="flex: 1; color: #212529;"></div>
                    </div>
                    <div class="detail-row" style="display: flex; padding: 0.75rem 1rem; border-bottom: 1px solid #f0f0f0;">
                        <div class="detail-title" style="flex: 0 0 150px; font-weight: 600; color: #495057;">Message</div>
                        <div class="detail-value" id="view_comment" style="flex: 1; color: #212529;"></div>
                    </div>
                    <div class="detail-row" style="display: flex; padding: 0.75rem 1rem;">
                        <div class="detail-title" style="flex: 0 0 150px; font-weight: 600; color: #495057;">Status</div>
                        <div class="detail-value">
                            <span class="badge" id="view_status" style="padding: 0.5rem 0.75rem;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Ticket Modal -->
    <div class="modal" id="edit_support">
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Edit Support</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <form id="SupportEditForm">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="view_support_remark" class="form-label">Remark</label>
                            <input type="text" class="form-control" id="remark" placeholder="Enter support Remarks" name="remark">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function edit_support_details(id, type) {
            $('#id').val(id);
            $('#remark').val(type);
            jQuery('#edit_support').modal('show');
        }

        jQuery.noConflict();
        jQuery(document).ready(function($) {
            jQuery("#SupportEditForm").validate({
                rules: {
                    remark: "required"
                },
                messages: {
                    remark: "Please enter remarks",
                },
                submitHandler: function(form) {
                    var support_data = $(form).serialize();
                    $.ajax({
                        url: company_ajax_base_url + '/support/update',
                        type: 'post',
                        data: support_data,
                        success: function(response) {
                            jQuery('#edit_support').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            jQuery('#support_list').replaceWith(response.data);
                        },
                        error: function(error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                $(document).find('.' + error_key + '_error').remove();
                                $(document).find('[name=' + error_key + ']').after('<span id="' + error_key + '_error" class="text text-danger">' + errors[error_key] + '</span>');
                                setTimeout(function() {
                                    jQuery("#" + error_key + "_error").remove();
                                }, 4000);
                            }
                        }
                    });
                }
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
                        url: company_ajax_base_url + '/support/delete',
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was successfully deleted!", "success");
                            $('#support_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }

        function view_support_details(supportDetails) {
            $('#view_subject').text(supportDetails.subject);
            $('#view_status').text(supportDetails.status);
            $('#view_support_remark').text(supportDetails.remark);
            $('#view_support_id').text(supportDetails.id);
            const statusBadge = $('#view_status');
            statusBadge.removeClass('bg-success bg-danger bg-warning');

            if (supportDetails.status === "Open") {
                statusBadge.addClass('bg-warning text-dark');
            } else {
                statusBadge.addClass('bg-success');
            }
            $('#view_comment').text(supportDetails.comment);
            $('#view_support').modal('show');
        }
    </script>
</div>

@endsection