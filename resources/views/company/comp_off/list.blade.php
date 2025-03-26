<div id="comp_off_list" class="card-body py-3">
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
                    <th>Date</th>
                    <th>Remark</th>
                    {{-- <th>Admin's Remark</th> --}}
                    <th>Status</th>
                </tr>
            </thead>
            @forelse ($allCompOffsDetails as $key => $item)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ getFormattedDate($item->date) }}</td>
                        <td>{{ $item->user_remark }}</td>
                        {{-- <td>{{ $item->admin_remark }}</td> --}}
                        <td data-order="Invalid date">
                            @if($item->status == 'pending')
                                <select name="status" class="form-control min-w-150px me-2"
                                    onchange="handleStatus(this,{{ $item->id }})">
                                    <option value="">Pending</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            @else
                                    @if ($item->status == 'accepted')
                                    <span class="btn btn-success btn-sm">Accepted</span>
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
                        <strong>No Comp Off Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allCompOffsDetails->links() }}
    <!--end::Table container-->

</div>
