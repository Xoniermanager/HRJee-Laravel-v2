@extends('layouts.company.main')
@section('content')
@section('title', 'Rewards')
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
                                <input data-kt-patient-filter="search" class="form-control form-control-solid ps-14"
                                    placeholder="Search " type="text"
                                    id="search">
                                <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                            </div>
                            <div class="ml-2">
                                <input class="form-control"  type="date" name="date" value="{{ request()->get('date') }}" id="date">
                            </div>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Action-->
                        <a href="{{ route('reward.add') }}" class="btn btn-sm btn-primary align-self-center">
                            Add Reward</a>
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
                        @include('company.user_reward.list')
                </div>
                <!--begin::Body-->
                <!--end::Row-->
            </div>
            <!--end::Container-->
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
                        url: "<?= route('reward.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#reward_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }
        jQuery("#search").on('input', function() {
            search_filter_results();
        });
        jQuery("#date").on('change', function() {
            search_filter_results();
        });
        jQuery(document).on('click', '#paginate a', function(e) {
            e.preventDefault();
            var page_no = $(this).attr('href').split('page=')[1];
            search_filter_results(page_no);
        });
        function search_filter_results(page_no = 1) {
            $.ajax({
                type: 'GET',
                url: company_ajax_base_url + '/reward/search/filter?page=' + page_no,
                data: {
                    'search': $('#search').val(),
                    'date': $('#date').val()
                },
                success: function(response) {
                    $('#reward_list').replaceWith(response.data);
                }
            });
        }
    </script>
@endsection
