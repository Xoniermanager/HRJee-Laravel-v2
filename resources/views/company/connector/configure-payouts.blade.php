<div id="payoutDetails" class="mt-4">

    @if ($configurePayoutData->count())
    <h6 class="fw-bold mb-3">Effective Payouts</h6>
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="table table-striped table-hover align-middle text-nowrap mb-0" style="min-width: 900px;">
                <thead class="table-light">
                    <tr>
                        <th class="text-start px-3 py-2">Product Name</th>
                        <th class="text-start px-3 py-2">Effective Date</th>
                        <th class="text-start px-3 py-2">Slabs (Range)</th>
                        <th class="text-start px-3 py-2">Payout</th>
                        <th class="text-start px-3 py-2">Payout Type</th>
                        <th class="text-start px-3 py-2">Payout Sub Type</th>
                        <th class="text-start px-3 py-2">Configured Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($configurePayoutData as $productDetails)
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td class="text-start px-3 py-2">{{ $productDetails->product->type ?? '-' }}</td>
                            <td class="text-start px-3 py-2">
                                {{ ($productDetails->effective_from ?? '-' )}}
                            </td>
                            <td class="text-start px-3 py-2">{{ $productDetails->slab_range ?? '-' }}</td>
                            <td class="text-start px-3 py-2">
                                {{ $productDetails->fixed_amount ?? '-' }}
                            </td>
                            <td class="text-start px-3 py-2">
                                @if (strtoupper($productDetails->payout_type) === 'FIXED')
                                    Fixed
                                @elseif (strtoupper($productDetails->payout_type) === 'VARIABLE')
                                    Variable
                                @else
                                    -
                                @endif
                            </td>
                            
                            <td class="text-start px-3 py-2">
                                @if (strtoupper($productDetails->payout_as) === 'FIXED')
                                    Amount
                                @elseif (strtoupper($productDetails->payout_as) === 'DISBURSEMENT')
                                    Percentage
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-start px-3 py-2">
                                {{ \Carbon\Carbon::parse($productDetails->created_at)->format('d-m-Y') ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-3">
                {{ $configurePayoutData->links() }}
            </div>
        </div>
    {{-- @else
        <div class="alert alert-secondary text-center py-3" role="alert">
            <strong>No payout data found.</strong>
        </div>
    @endif --}}
    @endif
</div>
