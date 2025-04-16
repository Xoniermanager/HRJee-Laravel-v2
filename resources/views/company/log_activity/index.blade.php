@extends('layouts.company.main')
@section('title', 'Log Activity')
@section('content')

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
                                    placeholder="Search " type="text" id="search" name="Search By Name" value="">
                                <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                            </div>

                        </div>
                        <!--end::Card title-->
                        <!--begin::Action-->
                    </div>

                    <div class="mb-5 mb-xl-10">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold">
                                        <th>Sr. No.</th>
                                        <th>URL</th>
                                        <th>Method</th>
                                        <th>Ip</th>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Request Body</th>
                                        <th>Response Code</th>
                                        {{-- <th>Response Body</th> --}}
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                @forelse ($allLogActivityDetails as $key => $item)
                                    <tbody class="">
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->url }}</td>
                                            <td>{{ $item->method }}</td>
                                            <td>{{ $item->ip }}</td>
                                            <td>{{ $item->user_id }}</td>
                                            <td>{{ $item->user_name }}</td>
                                            <td>{{ $item->request_body }}</td>
                                            <td>{{ $item->response_code }}</td>
                                            {{-- <td>{{ $item->response_body }}</td> --}}
                                            <td>{{$item->created_at }}</td>
                                        </tr>
                                    </tbody>
                                @empty
                                    <td colspan="3">
                                        <span class="text-danger">
                                            <strong>No Log Activity Found!</strong>
                                        </span>
                                    </td>
                                @endforelse
                            </table>
                            {{ $allLogActivityDetails->links() }}
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
@endsection
