<div id="request_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Date</th>
                    <th>Applied For</th>
                    <th>Remark</th>
                    {{-- <th>Admin's Remark</th> --}}
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allCompOffs as $key => $item)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ getFormattedDate($item->date) }}</td>
                        <td>{{ getFormattedDate($item->used_date) }}</td>
                        <td>{{ $item->user_remark }}</td>
                        {{-- <td>{{ $item->admin_remark }}</td> --}}
                        <td>
                            @if ($item->status == 'accepted')
                                <span class="btn btn-success btn sm">Accepted</span>
                            @elseif($item->status == 'rejected')
                                <span class="btn btn-danger btn sm">Rejected</span>
                            @else
                                <span class="btn btn-primary btn sm">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                @if($item->status && $item->status != "accepted" )
                                    <a href="#"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 {{ $item->status == 'accepted' || $item->status == 'rejected' ? 'disabled' : '' }}"
                                        onclick="deleteFunction('{{ $item->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @else
                                    N/A
                                @endif
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Applied Comp Off Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allCompOffs->links() }}
    <!--end::Table container-->
</div>
