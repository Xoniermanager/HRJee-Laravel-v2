<div id="ticket_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>#</th>
                    <th>Subject</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allTicketDetails as $key => $allTicketDetail)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $allTicketDetail->subject ?? 'N/A' }}</td>
                        <td>{{ $allTicketDetail->category }}</td>
                        <td>
                            @if ($allTicketDetail->status === 'Close')
                            <span class="badge bg-success text-white">{{ $allTicketDetail->status }}</span>
                            @else
                            <span class="badge bg-warning text-dark">{{ $allTicketDetail->status }}</span>
                            @endif
                        </td>
                        <td>{{ $allTicketDetail->created_at}}</td>
                        <td class="text-end">
    <a href="#" data-bs-toggle="modal"
        onClick="view_ticket_details({{ json_encode($allTicketDetail)}})"
        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
        <i class="fa fa-eye"></i>
        <!--end::Svg Icon-->
    </a>
    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
        onclick="deleteFunction({{ $allTicketDetail->id }})">
        <i class="fa fa-trash"></i>
    </a>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <span class="text-danger">
                                <strong>No Tickets Found!</strong>
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <!--end::Table body-->
        </table>
        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-end">
                {{ $allTicketDetails->links() }}
            </ul>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Table container-->
</div>
