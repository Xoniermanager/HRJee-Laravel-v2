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
                    <th>Punch In</th>
                    <th>Punch Out</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allAttendanceRequest as $key => $item)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ getFormattedDate($item->date) }}</td>
                        <td>{{ date('H:i A',strtotime($item->punch_in))}}</td>
                        <td>{{ date('H:i A',strtotime($item->punch_out)) }}</td>
                        <td>{{ $item->reason }}</td>
                        <td>@if ($item->status == 'approved')
                            <span class="btn btn-success btn sm">Approved</span>
                        @elseif($item->status == 'rejected')
                            <span class="btn btn-danger btn sm">Rejected</span>
                        @else
                            <span class="btn btn-primary btn sm">Pending</span>
                        @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="{{ route('employee.attendance.request.edit',$item->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 {{ ($item->status == 'approved' || $item->status == 'rejected') ? 'disabled' : '' }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 {{ ($item->status == 'approved' || $item->status == 'rejected') ? 'disabled' : '' }}" onclick="deleteFunction('{{ $item->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Request Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allAttendanceRequest->links() }}
    <!--end::Table container-->
</div>
