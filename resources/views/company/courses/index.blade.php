@extends('layouts.company.main')
@section('title', 'Course Management')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <div class="card custom-table p-0">
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
                    </div>
                </div>
                <!--begin::Row-->
                <div class="row gy-5 g-xl-10">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                    @endif
                    <!--begin::Col-->
                    <div class="card-body col-md-12">
                        <div class="mb-5 mb-xl-10">
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                @include('company.courses.list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                            url: "<?= route('course.delete') ?>",
                            type: "get",
                            data: {
                                courseId: id
                            },
                            success: function (res) {
                                Swal.fire("Done!", "It was succesfully deleted!", "success");
                                $('#course_list').replaceWith(res.data);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
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
                    url: "{{ route('course.statusUpdate') }}",
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
        </script>
@endsection
