@php
function statusBadge($statusId, $statusName, $isDisabled = false) {
    if ($isDisabled) {
        return '<span class="final-status-disabled badge bg-success p-2 opacity-75 cursor-pointer"
                    data-current-status="'.$statusId.'"
                    title="Approved by you">
                    '.$statusName.'
                </span>';
    }

    switch ($statusId) {
        case 1: return '<span class="final-status-btn badge bg-warning text-dark p-2 cursor-pointer"
                            data-current-status="'.$statusId.'">'.$statusName.'</span>';
        case 2: return '<span class="badge bg-success p-2">'.$statusName.'</span>';
        case 3: return '<span class="badge bg-danger p-2">'.$statusName.'</span>';
        case 4: return '<span class="badge bg-dark p-2">'.$statusName.'</span>';
        default: return '<span class="badge bg-secondary p-2">'.$statusName.'</span>';
    }
}
@endphp



<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
    <thead>
        <tr class="fw-bold">
            <th>Sr. No.</th>
            <th>Employee Name</th>
            <th>From</th>
            <th>To</th>
            <th>Final Status</th>
            <th>Leave Tracking</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leaveStatusLogDetails as $index => $leave)
        @php
            $managerApproved = $leave->managerAction
                ->where('manager_id', auth()->id())
                ->where('leave_status_id', 2)
                ->isNotEmpty();
        @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                <a href="#" data-bs-toggle="modal"
                   onClick="getEmployeeLeaveDetails('{{ date('F jS, Y  h:i:s a', strtotime($leave->created_at)) }}','{{ $leave->from }}',
                     '{{ $leave->to }}','{{ $leave->is_half_day }}',
                     '{{ $leave->from_half_day }}','{{ $leave->to_half_day }}',
                     '{{$leave->leaveStatus->name}}')">{{ $leave->user->name }}</a>
            </td>
            <td>{{ $leave->from }}</td>
            <td>{{ $leave->to }}</td>
            <td>
                {!! statusBadge($leave->leaveStatus->id, $leave->leaveStatus->name, $managerApproved) !!}
            </td>
            <td>
                <a href="javascript:void(0);" class="leavetracking" data-id="{{ $leave->id }}">
                    <img src="https://cdn-icons-png.flaticon.com/512/3273/3273365.png" class="h-35px" alt="Leave Tracking">
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // For normal pending badge → show full form popup
    document.querySelectorAll('.final-status-btn').forEach(function(el) {
        el.addEventListener('click', function() {
            showLeaveStatusPopup(); // your existing SweetAlert popup function
        });
    });

    // For disabled badge → show simple info popup
    document.querySelectorAll('.final-status-disabled').forEach(function(el) {
        el.addEventListener('click', function() {
            Swal.fire({
                icon: 'info',
                title: '✅ Already approved',
                text: 'You have already approved this leave. Further changes are disabled.',
                confirmButtonColor: '#3b82f6'
            });
        });
    });
});

</script>
