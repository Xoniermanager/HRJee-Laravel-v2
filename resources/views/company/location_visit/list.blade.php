@extends('layouts.company.main')
@section('content')
@section('title', 'Task Management')
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
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                            transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input class="form-control form-control-solid ps-14 min-w-150px me-2" placeholder="Search "
                                    type="text" id="search">
                                <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                            </div>
                            <select class="form-control ml-2" id="user_id">
                                <option value="">Select Employee</option>
                                @foreach ($allEmployeeDetails as $item)
                                    <option value="{{ $item->id }}">{{ $item->name .' ('.$item->details->emp_id.')'}}</option>
                                @endforeach
                            </select>
                            <select class="form-control ml-2" id="final_status">
                                <option value="">Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            {{-- Download Template --}}
                            <a href="{{ route('location_visit.download_template') }}"
                                class="btn btn-sm btn-secondary d-flex align-items-center text-white">
                                <i class="fas fa-download me-2"></i> Template
                            </a>
                            {{-- Import button --}}
                            <form id="importForm" enctype="multipart/form-data" class="d-flex align-items-center mb-0">
                                @csrf
                                <label class="btn btn-sm btn-success d-flex align-items-center">
                                    <i class="fas fa-file-import"></i> Import
                                    <input type="file" name="import_file" accept=".csv,.xlsx,.xls" hidden>
                                </label>
                            </form>
                            {{-- Export button --}}
                            <a href="#" class="btn btn-sm btn-primary d-flex align-items-center" id="exportBtn">
                                <i class="fas fa-file-export me-2"></i> Export
                            </a>
                            <a href="{{ route('location_visit.add_task') }}"
                                class="btn btn-sm btn-primary align-self-center">
                                Assign Task</a>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Action-->

                        <!--end::Action-->
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
                        <div class="card-body py-3" id="task_list">
                            <!--begin::Table container-->
                            @include('company.location_visit.task_list')
                            <!--end::Table container-->
                        </div>
                    </div>
                    <!--begin::Body-->

                </div>
                <!--begin::Body-->
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
    </div>
    <script>
        function handleStatus(id) {
            var checked_value = $('#checked_value_' + id).prop('checked');
            let status;
            let status_name;
            if (checked_value == true) {
                status = 1;
                status_name = 'Active';
            } else {
                status = 0;
                status_name = 'Inactive';
            }
            $.ajax({
                url: "{{ route('news.statusUpdate') }}",
                type: 'get',
                data: {
                    'id': id,
                    'status': status,
                },
                success: function (res) {
                    if (res) {
                        swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                    } else {
                        swal.fire("Oops!", 'Something Went Wrong', "error");
                    }
                }
            })
        }

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
                        url: company_ajax_base_url + '/location-visit/task/delete/' + id,
                        type: "get",
                        success: function (res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#task_list').replaceWith(res.data);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
        jQuery("#search").on('input', function () {
            search_filter_results();
        });
        jQuery("#final_status").on('change', function () {
            search_filter_results();
        });
        jQuery("#user_id").on('change', function () {
            search_filter_results();
        });
        jQuery(document).on('click', '#task_list .paginate a', function (e) {
            e.preventDefault();
            var page_no = $(this).attr('href').split('page=')[1];
            search_filter_results(page_no);
        });
        function search_filter_results(page_no = 1) {
            jQuery.ajax({
                type: 'GET',
                url: company_ajax_base_url + '/location-visit/search/task?page=' + page_no,
                data: {
                    'final_status': jQuery('#final_status').val(),
                    'search': jQuery('#search').val(),
                    'user_id': jQuery('#user_id').val(),
                },
                success: function (response) {
                    jQuery('#task_list').replaceWith(response.data);
                }
            });
        }
        $('#exportBtn').click(function (e) {
            e.preventDefault();
            let btn = $(this);
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Exporting...');

            let params = $.param({
                final_status: $('#final_status').val(),
                search: $('#search').val(),
                user_id: $('#user_id').val()
            });
            window.location.href = "{{ route('location_visit.export_tasks') }}?" + params;

            setTimeout(() => {
                btn.prop('disabled', false).html('Export');
            }, 1500);
        });
    </script>
    <script>
        document.querySelector('input[name="import_file"]').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) {
                Swal.fire('Error', 'Please select a file before uploading.', 'warning');
                return;
            }

            const formData = new FormData(document.getElementById('importForm'));

            Swal.fire({
                title: 'Uploading...',
                html: 'Please wait while your file is being processed.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => Swal.showLoading()
            });

            fetch('{{ route('location_visit.import_tasks') }}', {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
                .then(async res => {
                    let data;
                    try {
                        data = await res.json();
                    } catch {
                        throw new Error('Invalid JSON response from server.');
                    }
                    Swal.close();
                    if (data.status === 'success') {
                        search_filter_results();

                        Swal.fire({
                            icon: 'success',
                            title: 'Import Successful!',
                            text: data.message,
                            timer: 3000
                        });
                    } else if (data.status === 'error' && data.errors) {
                        const maxToShow = 5;
                        const extraCount = data.errors.length - maxToShow;
                        let html = '<ul style="text-align:left;">';
                        data.errors.slice(0, maxToShow).forEach(e => {
                            html += `<li>${e}</li>`;
                        });
                        html += '</ul>';
                        if (extraCount > 0) {
                            html += `<p>...and ${extraCount} more errors.</p>`;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Import failed!',
                            html: html,
                            width: '600px'
                        });
                    } else {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    }
                })
                .catch(error => {
                    Swal.close();
                    Swal.fire('Error', 'Unexpected error occurred: ' + error.message, 'error');
                });
        });
    </script>
@endsection
