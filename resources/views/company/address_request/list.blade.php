<div id="address_request_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Address</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            @forelse ($allAddressRequest as $key => $item)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->reason }}</td>
                        <td data-order="Invalid date">
                            @if($item->status == 'pending')
                                <select name="status" class="form-control min-w-150px me-2"
                                    onchange="handleStatus(this,{{ $item->id }})">
                                    <option value="">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            @else
                                    @if ($item->status == 'approved')
                                    <span class="btn btn-success btn-sm">Approved</span>
                                    @else
                                    <span class="btn btn-danger btn-sm">Rejected</span>
                                    @endif
                            @endif
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Addresss Request Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allAddressRequest->links() }}
    <!--end::Table container-->

</div>
