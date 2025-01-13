<div id="attendance_list">
    <div class="table-responsive table_scroll1">
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <thead>
                <tr class="fw-bold bg-white">
                    <th>Sr No.</th>
                    <th>Date</th>
                    <th>Punch In</th>
                    <th>Punch Out</th>
                    <th>Total Hours</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="">
                @forelse ($allAttendanceDetails as $key =>$attendanceDetails)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ date('j F, Y', strtotime($attendanceDetails->punch_in)) }}</td>
                    <td>{{ date('h:i A', strtotime($attendanceDetails->punch_in)) }}</td>
                    <td>{{ isset($attendanceDetails->punch_out) ?  date('h:i A', strtotime($attendanceDetails->punch_out)) : 'N A' }}</td>
                    <td>{{ (isset($attendanceDetails->punch_in) && isset($attendanceDetails->punch_out)) ? getTotalWorkingHour($attendanceDetails->punch_in, $attendanceDetails->punch_out) : 'N A'}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-danger text-center">No Attendance Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $allAttendanceDetails->links() }}
    </div>
</div>
