@extends('layouts.company.main')

@section('title', 'Face Recognition Management')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="card custom-table p-0">
                    <!--end::Action-->
                    <div class="mb-5 mb-xl-10">
                        <div class="">
                            <div class="">
                                <!--begin::Body-->
                                <div class="">
                                    <div class="card-body py-3">
                                        <!--begin::Table container-->
                                        @include('company.face_recognition.list')
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
    @endsection

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
                        url: "<?= route('face-recognition.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#employee_list').replaceWith(res.data);
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
        jQuery(document).on('click', '#employee_list a', function(e) {
            e.preventDefault();
            var page_no = $(this).attr('href').split('page=')[1];
            search_filter_results(page_no);
        });


    </script>
