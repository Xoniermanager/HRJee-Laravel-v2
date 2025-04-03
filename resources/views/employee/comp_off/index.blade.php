@extends('layouts.employee.main')
@section('content')
@section('title', 'Applied Comp Off')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <select name="status" class="form-control min-w-150px me-2" id="status">
                            <option value="">Status</option>
                            <option
                                {{ old('status') == 'pending' || request()->get('status') == 'pending' ? 'selected' : '' }}
                                value="pending">Pending</option>
                            <option
                                {{ old('status') == 'accepted' || request()->get('status') == 'accepted' ? 'selected' : '' }}
                                value="accepted">Accepted</option>
                            <option
                                {{ old('status') == 'rejected' || request()->get('status') == 'rejected' ? 'selected' : '' }}
                                value="rejected">Rejected</option>
                        </select>
                    </div>
                    <a href="{{ route('employee.comp.off.add') }}"
                        class="btn btn-sm btn-primary align-self-center">
                        Apply Comp Off</a>
                </div>
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
                <div class="mb-5 mb-xl-10">
                    @include('employee.comp_off.list')
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <script>
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
                        url: "<?= route('employee.comp.off.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#request_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
        jQuery("#status").on('change', function() {
            search_filter_results();
        });
        jQuery(document).on('click', '#request_list a', function(e) {
            e.preventDefault();
            var page_no = $(this).attr('href').split('page=')[1];
            search_filter_results(page_no);
        });

        function search_filter_results(page_no = 1) {
            $.ajax({
                type: 'GET',
                url: employee_ajax_base_url + '/comp-offs/search/filter?page=' + page_no,
                data: {
                    'status': $('#status').val(),
                },
                success: function(response) {
                    $('#request_list').replaceWith(response.data);
                }
            });
        }
    </script>
@endsection
