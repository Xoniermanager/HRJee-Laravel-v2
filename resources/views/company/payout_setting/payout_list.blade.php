<div id="payoutDetails" class="mt-4">

    @if ($payoutSettingData->count())
    <h6 class="fw-bold mb-3">Default Payouts</h6>
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="table table-striped table-hover align-middle text-nowrap mb-0" style="min-width: 900px;">
                <thead class="table-light">
                    <tr>
                        <th class="text-start px-3 py-2">Product Name</th>
                        <th class="text-start px-3 py-2">Lender Name</th>
                        <th class="text-start px-3 py-2">Effective Date</th>
                        <th class="text-start px-3 py-2">Slabs (Range)</th>
                        <th class="text-start px-3 py-2">Payout</th>
                        <th class="text-start px-3 py-2">Payout Type</th>
                        <th class="text-start px-3 py-2">Payout Sub Type</th>
                        <th class="text-start px-3 py-2">Configured Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payoutSettingData as $productDetails)
                    @php
                        \Log::info($productDetails);
                    @endphp
                        <tr style="border-bottom: 1px solid #dee2e6;">
                            <td class="text-start px-3 py-2">{{ $productDetails->product->type ?? '-' }}</td>
                            <td class="text-start px-3 py-2">{{ $productDetails->lender->name ?? '-' }}</td>
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
                                @if (strtoupper($productDetails->sub_payout_type) === 'FIXED')
                                    Amount
                                @elseif (strtoupper($productDetails->sub_payout_type) === 'DISBURSEMENT')
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
                {{ $payoutSettingData->links() }}
            </div>
        </div>
   
    @endif
</div>
