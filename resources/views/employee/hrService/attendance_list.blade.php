<div id="attendance_list">
    <div class="table-responsive table_scroll1">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold bg-white">
                    <th>Sr No.</th>
                    <th>Date</th>
                    <th>Punch In</th>
                    <th>Punch Out</th>
                    <th>Hours</th>
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
                        <td>
                            @if (isset($attendanceDetails->punch_out))
                                {{ date('h:i A', strtotime($attendanceDetails->punch_out)) }}
                            @else
                                N A
                            @endif

                        </td>
                        <td>
                            @if (isset($attendanceDetails->punch_in) && isset($attendanceDetails->punch_out))
                                {{ getTotalHour($attendanceDetails->punch_in, $attendanceDetails->punch_out) }}
                            @else
                                N A
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No Attendance Available</td>
                        <td>
                            NA
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allAttendanceDetails->links() }}
</div>
<!--end::Table container-->
