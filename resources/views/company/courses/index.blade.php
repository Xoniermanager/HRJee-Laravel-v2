@extends('layouts.company.main')

@section('title', 'Employee Management')

@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <div class="card mb-4">
            <div class="card-header d-block cursor-pointer border-0">
                <div class="row align-items-center mt-4">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center position-relative">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="black">
                                    </rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input data-kt-patient-filter="search" class="form-control ps-14" placeholder="Search"
                                type="text" id="search">
                            <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                        </div>
                    </div>
                    
                    <a href="{{ route('course.add') }}"
                        class="col-md-2 btn btn-sm ms-3 btn-primary align-self-center wt-space">
                        Add Course</a>
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @elseif (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer d-block p-0 mb-3">
                    <!--begin::Card title-->
                    <!--begin::Action-->
                    <div>
                        <form class="row" id="filter_id">
                            <div class="col-md-2 mb-1" id="department_div_id">
                                <select class="form-control filter_form" name="department_id" id="department_id">
                                    <option value="">All Department</option>
                                    @foreach ($alldepartmentDetails as $departmentDetails)
                                    <option {{ request()->get('department_id') == $departmentDetails->id ||
                                        old('department_id') == $departmentDetails->id
                                        ? 'selected'
                                        : '' }}
                                        value="{{ $departmentDetails->id }}">{{ $departmentDetails->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-1" data-bs-toggle="modal" data-bs-target="#filter_popup">
                                <a href="#" class="btn btn-primary btn-sm">More Filter</a>
                            </div>
                        </form>

                    </div>

                </div>
                <!--end::Action-->

                <div class="mb-5 mb-xl-10">

                    <div class="">
                        <div class="">
                            <!--begin::Body-->
                            <div class="">
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    @include('company.courses.list')
                                    <!--end::Table container-->

                                </div>
                            </div>
                            <!--begin::Body-->

                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    
    <script>
        let submit_handler = false;
            $(".filter").on("click", function(event) {
                let filter_id = $(this).val();
                let selected_status = $(this).prop('checked');
                if (selected_status) {
                    jQuery('#' + filter_id).show();
                } else {
                    jQuery('#' + filter_id).hide();
                }
            });
            $('.filter_form').on('change', function() {
                var data = $('#filter_id').serialize();
                $.ajax({
                    method: 'GET',
                    url: company_ajax_base_url + '/employee/get/filter/list',
                    data: data,
                    success: function(response) {
                        $('#employee_list').replaceWith(response.data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
            });

            function exportData(submit_form_id) {
                let data = queryStringToJSON($('#filter_id').serialize());
                $('.export_emp_status').val(data.emp_status_id);
                $('.export_marital_status').val(data.marital_status);
                $('.export_gender').val(data.gender);
                $('.export_emp_type_id').val(data.emp_type_id);
                $('.export_depertment_id').val(data.department_id);
                $(`#${submit_form_id}`).submit();
            };

            function queryStringToJSON(queryString) {
                // Remove leading '?' if it exists
                if (queryString.startsWith('?')) {
                    queryString = queryString.substring(1);
                }

                // Split the query string into key-value pairs
                const pairs = queryString.split('&');
                const result = {};

                // Iterate over each pair
                pairs.forEach(pair => {
                    const [key, value] = pair.split('=');
                    result[key] = value || ''; // Use empty string if value is undefined
                });

                return result;
            }
            $("#search").on('input',function() {
                $.ajax({
                    type: 'GET',
                    url: company_ajax_base_url + '/employee/get/filter/list',
                    data: {
                        'search': $(this).val()
                    },
                    success: function(response) {
                        $('#employee_list').replaceWith(response.data);
                    }
                });
            });

            function deleteFunction(id) {
                event.preventDefault();
                Swal.fire({
                    title: "Are you sure want to delete this course?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirm!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: company_ajax_base_url + '/employee/delete/' + id,
                            type: "get",
                            success: function(res) {
                                Swal.fire("Done!", "It was succesfully Exit!", "success");
                                $('#employee_list').replaceWith(res.data);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error deleting!", "Please try again", "error");
                            }
                        });
                    }
                });
            }

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
                    url: company_ajax_base_url + '/employee/status/update/' + id,
                    type: 'get',
                    data: {
                        'status': status,
                    },
                    success: function(res) {
                        if (res.status == true) {
                            swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        } else {
                            swal.fire("Oops!", 'Something Went Wrong', "error");
                        }
                    }
                })
            }

            function handleFaceRecognition(id) {
                var checked_value = $('#checked_face_value_' + id).prop('checked');
                let status;

                let status_name;
                console.log();
                if (checked_value == true) {
                    status = 1;
                    status_name = 'Active';
                } else {
                    status = 0;
                    status_name = 'Inactive';
                }
                $.ajax({
                    url: "{{ route('admin.company.facerecognitionUpdate') }}",
                    type: 'get',
                    data: {
                        'id': id,
                        'status': status,
                    },
                    success: function (res) {
                        console.log("res => ", res)
                        if (res) {
                            if(res.status == 200) {
                                swal.fire("Done!", '', "success");
                                jQuery('#company_branch_list').replaceWith(res.data);
                            } else {
                                swal.fire("", res.error, "error");
                            }
                            
                            
                        } else {
                            swal.fire("Oops!", 'Something Went Wrong', "error");
                        }
                    }
                })
            }


            jQuery('#export_button').on('click', function() {
                var filteredData = $('#filter_id').serialize();
                $.ajax({
                    type: 'get',
                    url: "{{ route('employee.export') }}",
                    data: filteredData,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Sucess',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        console.log("Export failed");
                    }
                });
            });
    </script>
    <script>
        $(document).ready(function() {
                // Handle the form submission via AJAX
                $('#importForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $('#errorMessage').hide();
                    $('#validationErrors').hide();

                    $.ajax({
                        url: '{{ route('upload.file') }}',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Sucess',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                                $('#employee_list').replaceWith(response.data);
                            } else if (response.status === 'error') {
                                if (response.errors) {
                                    let errorsHtml =
                                        '<ul style="color: red; list-style-type: none; padding-left: 20px; margin: 0;">';
                                    response.errors.forEach(function(error) {
                                        // Ensure you join multiple errors with commas if needed
                                        let errorMessages = Array.isArray(error.errors) ?
                                            error.errors.join(', ') : error.errors;
                                        errorsHtml +=
                                            '<li style="color: red; margin-bottom: 5px;">Row ' +
                                            error.row + ': ' + errorMessages + '</li>';
                                    });
                                    errorsHtml += '</ul>';

                                    Swal.fire({
                                        title: "The Error?",
                                        html: errorsHtml, // Use "html" for custom HTML content
                                        icon: "error", // "error" icon for SweetAlert
                                        customClass: {
                                            popup: 'swal-popup-error', // Custom class for the popup
                                            title: 'swal-title-error', // Optional: custom class for title
                                            content: 'swal-content-error' // Optional: custom class for content
                                        }
                                    });
                                } else {
                                    $('#errorMessage').text(response.message).show();
                                }
                            }
                        },
                        error: function(xhr) {
                            var response = xhr.responseJSON;
                            $('#errorMessage').text(response.message ||
                                'An unexpected error occurred.').show();
                        }
                    });
                });
            });
    </script>
    @endsection
