<div id="incentive_payments_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>#</th>
                    <th>Connector Name</th>
                    <th>Incentive Type</th>
                    <th>Amount (₹)</th>
                    <th>Month</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allIncentivePaymentDetails as $key => $allIncentivePaymentDetail)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $allIncentivePaymentDetail->connector->connector_name ?? 'N/A' }}</td>
                        <td>{{ $allIncentivePaymentDetail->incentive_type }}</td>
                        <td>{{ number_format($allIncentivePaymentDetail->amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($allIncentivePaymentDetail->month)->format('F Y') }}</td>
                        <td>
                            @if ($allIncentivePaymentDetail->status === 'Paid')
                                <span class="badge bg-success text-white">{{ $allIncentivePaymentDetail->status }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $allIncentivePaymentDetail->status }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="#" data-bs-toggle="modal"
                                onClick="edit_incentive_details('{{ $allIncentivePaymentDetail }}')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                onclick="deleteFunction({{ $allIncentivePaymentDetail->id }})">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <span class="text-danger">
                                <strong>No Incentive Payments Found!</strong>
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <!--end::Table body-->
        </table>
        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-end">
                {{ $allIncentivePaymentDetails->links() }}
            </ul>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Table container-->
</div>
