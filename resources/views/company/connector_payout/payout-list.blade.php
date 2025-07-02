<div class="card card-flush h-md-100" id="connector_payout_list">
    <div class="card-body px-0">
        <!--begin::Nav-->
        <ul class="nav d-flex g-5 mb-3 mx-9" role="tablist">
            <!--begin::Item-->
            <li class="nav-item mb-3" role="presentation">
                <!--begin::Link-->
                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px active"
                    data-bs-toggle="tab" id="kt_charts_widget_35_tab_1" href="#kt_charts_widget_35_tab_content_1"
                    aria-selected="true" role="tab">

                    Case Disbursed
                </a>
                <!--end::Link-->
            </li> &nbsp;
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-3" role="presentation">
                <!--begin::Link-->
                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                    data-bs-toggle="tab" id="kt_charts_widget_35_tab_2" href="#kt_charts_widget_35_tab_content_2"
                    aria-selected="false" tabindex="-1" role="tab">

                    Payout Requested
                </a>
                <!--end::Link-->
            </li> &nbsp;
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-3" role="presentation">
                <!--begin::Link-->
                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                    data-bs-toggle="tab" id="kt_charts_widget_35_tab_3" href="#kt_charts_widget_35_tab_content_3"
                    aria-selected="false" tabindex="-1" role="tab">

                    Payout Approved
                </a>
                <!--end::Link-->
            </li>&nbsp;
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-3" role="presentation">
                <!--begin::Link-->
                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 h-35px "
                    data-bs-toggle="tab" id="kt_charts_widget_35_tab_4" href="#kt_charts_widget_35_tab_content_4"
                    aria-selected="false" tabindex="-1" role="tab">

                    Payout Completed
                </a>
                <!--end::Link-->
            </li>&nbsp;
            <!--end::Item-->



        </ul>
        <!--end::Nav-->

        <!--begin::Tab Content-->
        <div class="tab-content mt-5">


            <!--begin::Tap pane-->
            <div class="tab-pane fade active show" id="kt_charts_widget_35_tab_content_1" role="tabpanel"
                aria-labelledby="#kt_charts_widget_35_tab_1">

                <!--begin::Table container-->
                <div class="table-responsive mx-9 mt-n6">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500">

                                <th class="">Case ID</th>
                                <th class="">Disbursal ID </th>
                                <th class="">Connector Business Name </th>
                                <th class="">Connector Name </th>
                                <th class="">Borrower Name </th>
                                <th class="">Lender Name </th>
                                <th class="">Product </th>
                                <th>Disbursement Date</th>
                                <th class="">Disbursal Amount </th>
                                <th class="">Insurance Amount </th>
                                <th class="">Tentative Payout </th>
                                <th class="">Tentative Taxable Value </th>
                                <th class="">Rectify </th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @forelse ($caseDisbursedLists as $index => $caseDisbursedList)
                            @php
                                \Log::info($caseDisbursedList->lead->loan);
                                // dd($caseDisbursedList);
                            @endphp
                                <tr>
                                    <td>{{$caseDisbursedList->lead->case_id ?? ''}}</td>
                                    <td>CONN8585786157</td>
                                    <td>{{$caseDisbursedList->lead->connector->brand_name ?? ''}} </td>
                                    <td>{{$caseDisbursedList->lead->connector->connector_name ?? ''}} </td>
                                    <td>{{$caseDisbursedList->lead->loan->productName->type ?? ''}} </td>
                                    <td>{{$caseDisbursedList->lead->selectedLenders ?? ''}} </td>
                                    <td>{{$caseDisbursedList->lead->loan->productName->type ?? ''}} </td>

                                    {{-- <td>Feb 17 2025</td> --}}
                                    <td>{{$caseDisbursedList->lead->loan->sanctioned_date ?? ''}} </td>
                                    <td>{{$caseDisbursedList->lead->loan->sanctioned_amount ?? ''}} </td>

                                    {{-- <td>{{$caseDisbursedList->loan->amount}}</td> --}}
                                    {{-- <td>{{$caseDisbursedList->loan->disbursed_amount}}</td> --}}
                                    <td>0.2%</td>
                                    <td>Approved</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="16">
                                        <span class="text-danger">
                                            <strong>No Case Disbursed Found!</strong>
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
                        {{ $caseDisbursedLists->links() }}
                    </ul>
                </div>

            </div>
            <!--end::Tap pane-->


            <!--begin::Tap pane-->
            <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_2" role="tabpanel"
                aria-labelledby="#kt_charts_widget_35_tab_2">
                <!--begin::Table container-->
                <div class="table-responsive mx-9 mt-n6">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500">

                                <th class="">Case ID</th>
                                <th class="">Disbursal ID </th>
                                <th class="">Payout ID </th>
                                <th class="">Connector Business Name </th>
                                <th class="">Connector Name </th>
                                <th class="">Borrower Name </th>
                                <th class="">Lender Name </th>
                                <th class="">Product </th>
                                <th>Disbursement Date</th>
                                <th>Payout Req Date</th>
                                <th class="">Disbursal Amount </th>
                                <th class="">Tentative Payout </th>
                                <th class="">Status </th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>CONN8585786157</td>
                                <td>CONN8585786157</td>
                                <td>CONN8585786157</td>
                                <td>Testing Connector </td>
                                <td>Testing Connector </td>
                                <td>HL Case </td>
                                <td>ICICI Bank </td>
                                <td>Home Loan </td>
                                <td>Feb 17 2025</td>
                                <td>Feb 17 2025</td>
                                <td>Rs.45,00,000</td>
                                <td>0.2%</td>
                                <td>Approved</td>
                                <td>
                                    <a href="#"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa fa-eye"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="#"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa fa-edit"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <!--begin::Menu-->

                                </td>
                            </tr>

                        </tbody>
                        <!--end::Table body-->
                    </table>

                    <!--end::Table-->
                </div>
                <!--end::Table container-->


            </div>
            <!--end::Tap pane-->


            <!--begin::Tap pane-->
            <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_3" role="tabpanel"
                aria-labelledby="#kt_charts_widget_35_tab_3">
                <!--begin::Chart-->
                <!--begin::Table container-->
                <div class="table-responsive mx-9 mt-n6">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500">

                                <th class="">Case ID</th>
                                <th class="">Disbursal ID </th>
                                <th class="">Payout ID </th>
                                <th class="">Connector Business Name </th>
                                <th class="">Connector Name </th>
                                <th class="">Borrower Name </th>
                                <th class="">Lender Name </th>
                                <th class="">Product </th>
                                <th>Disbursement Date</th>
                                <th>Payout Req Date</th>
                                <th class="">Disbursal Amount </th>
                                <th class="">Tentative Payout </th>
                                <th class="">Status </th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>CONN8585786157</td>
                                <td>CONN8585786157</td>
                                <td>CONN8585786157</td>
                                <td>Testing Connector </td>
                                <td>Testing Connector </td>
                                <td>HL Case </td>
                                <td>ICICI Bank </td>
                                <td>Home Loan </td>
                                <td>Feb 17 2025</td>
                                <td>Feb 17 2025</td>
                                <td>Rs.45,00,000</td>
                                <td>0.2%</td>
                                <td>Approved</td>
                                <td>
                                    <a href="#"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa fa-eye"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="#"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa fa-edit"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <!--begin::Menu-->

                                </td>
                            </tr>

                        </tbody>
                        <!--end::Table body-->
                    </table>

                    <!--end::Table-->
                </div>
                <!--end::Table container-->

            </div>
            <!--end::Tap pane-->

            <!--begin::Tap pane-->
            <div class="tab-pane fade " id="kt_charts_widget_35_tab_content_4" role="tabpanel"
                aria-labelledby="#kt_charts_widget_35_tab_4">
                <!--begin::Chart-->
                <!--begin::Table container-->
                <div class="table-responsive mx-9 mt-n6">
                    <!--begin::Table-->
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0 text-nowrap">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500">

                                <th class="">Case ID</th>
                                <th class="">Disbursal ID </th>
                                <th class="">Payout ID </th>
                                <th class="">Connector Business Name </th>
                                <th class="">Connector Name </th>
                                <th class="">Borrower Name </th>
                                <th class="">Lender Name </th>
                                <th class="">Product </th>
                                <th>Disbursement Date</th>
                                <th>Payout Req Date</th>
                                <th class="">Disbursal Amount </th>
                                <th class="">Tentative Payout </th>
                                <th class="">Status </th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td>CONN8585786157</td>
                                <td>CONN8585786157</td>
                                <td>CONN8585786157</td>
                                <td>Testing Connector </td>
                                <td>Testing Connector </td>
                                <td>HL Case </td>
                                <td>ICICI Bank </td>
                                <td>Home Loan </td>
                                <td>Feb 17 2025</td>
                                <td>Feb 17 2025</td>
                                <td>Rs.45,00,000</td>
                                <td>0.2%</td>
                                <td>Approved</td>
                                <td>
                                    <a href="#"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa fa-eye"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="#"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="fa fa-edit"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <!--begin::Menu-->

                                </td>
                            </tr>

                        </tbody>
                        <!--end::Table body-->
                    </table>

                    <!--end::Table-->
                </div>
                <!--end::Table container-->
                <div class="col-md-12 clearfix">
                    <ul class="pagination mt-3 float-right">
                        <li class="page-item previous disabled"><a href="#" class="page-link"><i
                                    class="previous"></i></a></li>
                        <li class="page-item "><a href="#" class="page-link">1</a></li>
                        <li class="page-item active"><a href="#" class="page-link">2</a></li>
                        <li class="page-item "><a href="#" class="page-link">3</a></li>
                        <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a>
                        </li>
                    </ul>
                </div>

            </div>
            <!--end::Tap pane-->


        </div>
        <!--end::Tab Content-->
    </div>
</div>
