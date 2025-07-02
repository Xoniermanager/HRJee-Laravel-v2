<div class="col-md-12" id="lead_list">
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-12">
@php
    $userType = Auth()->user()->userRole->name;
@endphp
            <!--begin::Chart Widget 35-->
            <div class="card card-flush h-md-100">

                <!--begin::Body-->
                <div class="card-body px-0">
                    <!--begin::Nav-->
                    <ul class="nav d-flex g-5 mb-3 mx-9 parent__ul" role="tablist">
                        <!--begin::Item-->
                        <li class="nav-item" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link active" data-bs-toggle="tab" id="kt_charts_widget_35_tab_1"
                                href="#kt_charts_widget_35_tab_content_1" aria-selected="true" role="tab">

                                Pre Lender
                            </a>
                            <!--end::Link-->
                        </li> &nbsp;
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link " data-bs-toggle="tab" id="kt_charts_widget_35_tab_2"
                                href="#kt_charts_widget_35_tab_content_2" aria-selected="false" tabindex="-1"
                                role="tab">

                                Post Lender
                            </a>
                            <!--end::Link-->
                        </li> &nbsp;
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item" role="presentation">
                            <!--begin::Link-->
                            <a class="nav-link " data-bs-toggle="tab" id="kt_charts_widget_35_tab_3"
                                href="#kt_charts_widget_35_tab_content_3" aria-selected="false" tabindex="-1"
                                role="tab">

                                Disbursements
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->


                    </ul>
                    <!--end::Nav-->

                    <!--begin::Tab Content-->
                    <div class="tab-content mt-5">


                        <!--begin::Tap pane-->
                        <div class="tab-pane fade active show" id="kt_charts_widget_35_tab_content_1" role="tabpanel"
                            aria-labelledby="#kt_charts_widget_35_tab_1">

                            <!--begin::Nav-->
                            <ul class="nav d-flex g-5 mb-3 mx-9" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px active"
                                        data-bs-toggle="tab" id="tab_1" href="#content_1" aria-selected="true"
                                        role="tab">

                                        All
                                    </a>
                                    <!--end::Link-->
                                </li> &nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tab_2" href="#content_2" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Lead
                                    </a>
                                    <!--end::Link-->
                                </li> &nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tab_3" href="#content_3" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Prospect
                                    </a>
                                    <!--end::Link-->
                                </li>&nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tab_4" href="#content_4" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Visit
                                    </a>
                                    <!--end::Link-->
                                </li>&nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tab_5" href="#content_5" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Documentation
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->


                            </ul>
                            <!--end::Nav-->

                            <!--begin::Tab Content-->
                            <div class="tab-content mt-5">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="content_1" role="tabpanel"
                                    aria-labelledby="#tab_1">

                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th><input type="checkbox" id="check_all"></th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Lender Current
                                                        Stage </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($allLeadDetails as $index => $leadDetails)
                                                    <tr>
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}" class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>

                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        @if (strtoupper($leadDetails->lead_sub_state) == 'DISBURSED')
                                                            <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="16">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $allLeadDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->


                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="content_2" role="tabpanel" aria-labelledby="#tab_2">
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($leadStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}" class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ $leadDetails->lead_sub_state }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $leadStatusDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->


                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="content_3" role="tabpanel" aria-labelledby="#tab_3">
                                    <!--begin::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($prospectStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}" class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $prospectStatusDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="content_4" role="tabpanel" aria-labelledby="#tab_4">
                                    <!--begin::Chart-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($visitStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}" class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $visitStatusDetails->links() }}
                                        </ul>
                                    </div>


                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="content_5" role="tabpanel" aria-labelledby="#tab_5">
                                    <!--begin::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($documentationStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}" class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $documentationStatusDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->



                            </div>
                            <!--end::Tab Content-->



                        </div>
                        <!--end::Tap pane-->


                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_2" role="tabpanel"
                            aria-labelledby="#kt_charts_widget_35_tab_2">
                            <!--begin::Nav-->
                            <ul class="nav d-flex g-5 mb-3 mx-9" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px active"
                                        data-bs-toggle="tab" id="tabs_1" href="#contents_1" aria-selected="true"
                                        role="tab">

                                        Lender Selection
                                    </a>
                                    <!--end::Link-->
                                </li> &nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tabs_2" href="#contents_2" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Log in
                                    </a>
                                    <!--end::Link-->
                                </li> &nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tabs_3" href="#contents_3" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Sanctioned
                                    </a>
                                    <!--end::Link-->
                                </li>&nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tabs_4" href="#contents_4" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Rejected
                                    </a>
                                    <!--end::Link-->
                                </li>&nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tabs_5" href="#contents_5" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Withdrawn
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tabs_6" href="#contents_6" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Pendency
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tabs_7" href="#contents_7" aria-selected="false"
                                        tabindex="-1" role="tab">

                                        Disbursed
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->


                            </ul>
                            <!--end::Nav-->

                            <!--begin::Tab Content-->
                            <div class="tab-content mt-5">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="contents_1" role="tabpanel"
                                    aria-labelledby="#tabs_1">

                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($lenderSelectionStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}" class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $lenderSelectionStatusDetails->links() }}
                                        </ul>
                                    </div>


                                </div>
                                <!--end::Tap pane-->


                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="contents_2" role="tabpanel"
                                    aria-labelledby="#tabs_2">
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($loggedStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $loggedStatusDetails->links() }}
                                        </ul>
                                    </div>



                                </div>
                                <!--end::Tap pane-->


                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="contents_3" role="tabpanel"
                                    aria-labelledby="#tabs_3">
                                    <!--begin::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($sanctionedStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $sanctionedStatusDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="contents_4" role="tabpanel"
                                    aria-labelledby="#tabs_4">
                                    <!--begin::Chart-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($rejectedStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $rejectedStatusDetails->links() }}
                                        </ul>
                                    </div>


                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="contents_5" role="tabpanel"
                                    aria-labelledby="#tabs_5">
                                    <!--begin::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($withdrawnStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $withdrawnStatusDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="contents_6" role="tabpanel"
                                    aria-labelledby="#tabs_6">
                                    <!--begin::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($pendencyStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $pendencyStatusDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="contents_7" role="tabpanel"
                                    aria-labelledby="#tabs_7">
                                    <!--begin::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($disbursedStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $disbursedStatusDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->



                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end::Tap pane-->


                        <!--begin::Tap pane-->
                        <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_3" role="tabpanel"
                            aria-labelledby="#kt_charts_widget_35_tab_3">
                            <!--begin::Table container-->
                            <!--begin::Nav-->
                            <ul class="nav d-flex g-5 mb-3 mx-9" role="tablist">
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px active"
                                        data-bs-toggle="tab" id="tabss_1" href="#contentss_1" aria-selected="true"
                                        role="tab">

                                        All
                                    </a>
                                    <!--end::Link-->
                                </li> &nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tabss_2" href="#contentss_2"
                                        aria-selected="false" tabindex="-1" role="tab">

                                        Complete
                                    </a>
                                    <!--end::Link-->
                                </li> &nbsp;
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3" role="presentation">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                                        data-bs-toggle="tab" id="tabss_3" href="#contentss_3"
                                        aria-selected="false" tabindex="-1" role="tab">

                                        Incomplete
                                    </a>
                                    <!--end::Link-->
                                </li>&nbsp;
                                <!--end::Item-->


                            </ul>
                            <!--end::Nav-->

                            <!--begin::Tab Content-->
                            <div class="tab-content mt-5">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="contentss_1" role="tabpanel"
                                    aria-labelledby="#tabss_1">

                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($disbursementAllDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $disbursementAllDetails->links() }}
                                        </ul>
                                    </div>


                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="contentss_2" role="tabpanel"
                                    aria-labelledby="#tabss_2">
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($completedStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $completedStatusDetails->links() }}
                                        </ul>
                                    </div>



                                </div>
                                <!--end::Tap pane-->


                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="contentss_3" role="tabpanel"
                                    aria-labelledby="#tabss_3">
                                    <!--begin::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500">
                                                    <th class=""><input type="checkbox" name=""
                                                            id="">
                                                    </th>
                                                    <th class="">Lead</th>
                                                    <th class="">Product Type </th>
                                                    <th class="">Lender Name </th>
                                                    <th class="">Drop Off Stage
                                                    </th>
                                                    <th class="">Case Stage </th>
                                                    <th class="">Pre-Qualified offer
                                                    </th>
                                                    <th class="">Pre-Qualified
                                                        Expiry Date
                                                    </th>
                                                    <th class="">Lead Originator
                                                    </th>
                                                    <th class="">Mobile Number </th>
                                                    <th class="">Case Created Date
                                                    </th>
                                                    <th class="">Days Open </th>
                                                    <th class="">Assign to Sales
                                                        User </th>
                                                    <th class="">Version</th>
                                                    <th class="">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>

                                                @forelse ($incompletedStatusDetails as $index => $leadDetails)
                                                    <tr>
                                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                                        <td><input type="checkbox" name="lead_id[]"
                                                                value="{{ $leadDetails->id }}"
                                                                class="item-checkbox">
                                                        </td>

                                                        <td>{{ ucfirst($leadDetails->customer_name) }}</td>
                                                        <td>{{ $leadDetails->loan->productName->type }}</td>
                                                        <td>
                                                            @if (
                                                                $leadDetails->selectedLenders &&
                                                                    $leadDetails->selectedLenders->leadLender &&
                                                                    $leadDetails->selectedLenders->leadLender->lender)
                                                                {{ ucfirst($leadDetails->selectedLenders->leadLender->lender->name) }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ $leadDetails->drop_off_stage }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_sub_state) }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_offer }}</td>
                                                        <td>{{ $leadDetails->pre_qualified_expiry }}</td>
                                                        <td>{{ strtoupper($leadDetails->lead_type) }}</td>
                                                        <td>{{ $leadDetails->customer_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->format('d M Y h:i A') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($leadDetails->created_at)->diffInDays(now()) }}
                                                        </td>
                                                        <td>{{ $leadDetails->user->name }}</td>
                                                        <td>{{ $leadDetails->version }} V2</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-eye"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                <a href="{{ route('lead.view', $leadDetails->case_id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                    <i class="fa fa-edit"></i>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                                @if ($userType != 'Banker')
                                                                    <a href="#"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                                    onclick="deleteFunction('{{ $leadDetails->id }}')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="14">
                                                            <span class="text-danger">
                                                                <strong>No Lead Found!</strong>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                    <div class="col-md-12 clearfix">
                                        <ul class="pagination mt-3 float-right">
                                            {{ $incompletedStatusDetails->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Tap pane-->


                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end::Tap pane-->
                        @if ($userType != 'Banker')
                            <div class="col-md-12 mt-4">
                            <div class="row align-items-center m-0 mb-4">
                                <div class="col-md-2">
                                    <label for="" class="fw-bold">Assign
                                        To:
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" name="assigned_user" id="assigned_user">
                                        @if (old('assigned_user'))
                                            <option value="{{ old('assigned_user') }}" selected>
                                                {{ old('assigned_user') }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a href="#" id="assign_button" class="btn btn-sm btn-primary">Assign</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart Widget 35-->
        </div>
        <!--end::Col-->


    </div>
    <!--end::Row-->
    <script>
        $(document).ready(function() {
            // Select2 initialization (existing code)
            $('#assigned_user').select2({
                placeholder: 'Select User',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('user.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return params.term && params.term.trim().length > 0 ? {
                            search: params.term
                        } : {};
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                    email: item.email,
                                    phone: item.details.phone,
                                };
                            })
                        };
                    },
                    cache: true
                },
                width: '100%',
                templateResult: formatAssignUserOption,
                templateSelection: formatConnectorSelection
            });

            function formatAssignUserOption(data) {
                if (!data.id) return data.text;

                return $(`
                <div style="display: flex; justify-content: space-between;">
                    <span>${data.text}</span>
                    <span class="text-muted">${data.phone}</span>
                </div>
            `);
            }

            function formatConnectorSelection(data) {
                return data.text;
            }

            // Handle "select all" checkbox behavior
            $('#check_all').on('change', function() {
                const isChecked = $(this).is(':checked');
                $('input[name="lead_id[]"]').prop('checked', isChecked);
            });

            // Sync master checkbox with individual checkboxes
            $('input[name="lead_id[]"]').on('change', function() {
                const total = $('input[name="lead_id[]"]').length;
                const checked = $('input[name="lead_id[]"]:checked').length;
                $('#check_all').prop('checked', total === checked);
            });

            // Update lead AJAX call
            function updateLead(leadId, assignedUser) {
                const url = '{{ route('lead.assign.update', ':id') }}'.replace(':id', leadId);

                return $.ajax({
                    url: url,
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        assigned_user: assignedUser
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }

            // Handle assign button click
            $('#assign_button').on('click', function(event) {
                event.preventDefault();

                const selectedLeadIds = $('input[name="lead_id[]"]:checked').map(function() {
                    return $(this).val();
                }).get();

                const assignedUser = $('#assigned_user').val();

                if (selectedLeadIds.length === 0) {
                    // alert('Please select at least one lead to assign.');
                    Swal.fire({
                        toast: true,
                        position: 'top',
                        icon: 'warning',
                        title: 'Please select at least one lead to assign.',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    return;
                }

                if (!assignedUser || assignedUser.trim() === '') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Please select an assigned user.',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    return;
                }

                $('#assign_button').prop('disabled', true).text('Assigning...');

                // Create an array of AJAX promises for all requests
                const requests = selectedLeadIds.map(id => updateLead(id, assignedUser));

                // Wait for all requests to complete
                $.when.apply($, requests)
                    .done(function() {
                        Swal.fire({
                            toast: true,
                            position: 'top',
                            icon: 'success',
                            title: 'All cases are updated',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });

                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        const errorMessage = jqXHR.responseJSON && jqXHR.responseJSON.errors ?
                            jqXHR.responseJSON.errors.join(', ') :
                            'An error occurred during assignment. Please try again.';
                        swal.fire(errorMessage);
                    })
                    .always(function() {
                        $('#assign_button').prop('disabled', false).text('Assign');
                        $('#check_all').prop('checked', false);
                        $('input[name="lead_id[]"]').prop('checked', false);
                    });
            });
        });
    </script>
</div>
