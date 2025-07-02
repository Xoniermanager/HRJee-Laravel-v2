@extends('layouts.company.main')
@section('content')
@section('title')
    Connector Payout Requests
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <div class="min-w-200px me-2 d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input class="form-control form-control-solid ps-16" placeholder="Search " type="text"
                                value="{{ request()->get('search') }}" id="search_connector_payout">
                        </div>

                    </div>

                </div>
                <div class="mb-5 mb-xl-10">
                    @include('company.connector_payout.payout-list')
                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery("#search_connector_payout").on('input', function() {
            search_filter_results();
        });

        function search_filter_results() {
            $.ajax({
                type: 'GET',
                url: "<?= route('connector-payouts.search') ?>",
                data: {
                    'search': $('#search_connector_payout').val(),
                },
                success: function(response) {
                    console.log(response);
                    $('#connector_payout_list').replaceWith(response.data);
                }
            });
        }
    </script>
@endsection
