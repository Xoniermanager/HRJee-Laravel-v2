<div id="view_list">
    <div class="container-fluid">

        {{-- Summary Cards --}}
        <div class="row text-center mt-4 g-3">
            @php
                $cards = [
                    ['id' => 'persent', 'value' => $employeeDetail['totalPresent'], 'label' => 'Total Present', 'icon' => 'fa-user-check', 'bg' => 'bg-success'],
                    ['id' => 'onleave', 'value' => $employeeDetail['totalLeave'], 'label' => 'Total Leave', 'icon' => 'fa-plane-departure', 'bg' => 'bg-warning'],
                    ['id' => 'absent', 'value' => $employeeDetail['totalAbsent'], 'label' => 'Total Absent', 'icon' => 'fa-user-times', 'bg' => 'bg-danger'],
                    ['id' => 'holiday', 'value' => $employeeDetail['totalHoliday'], 'label' => 'Total Holidays', 'icon' => 'fa-calendar-day', 'bg' => 'bg-primary'],
                    ['id' => 'late', 'value' => $employeeDetail['totalLate'], 'label' => 'Total Late', 'icon' => 'fa-clock', 'bg' => 'bg-secondary'],
                    ['id' => 'short_attendence', 'value' => $employeeDetail['shortAttendance'], 'label' => 'Short Attendance', 'icon' => 'fa-hourglass-half', 'bg' => 'bg-info']
                ];
            @endphp

            <div class="row text-center g-4 my-4">
                @foreach ($cards as $card)
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="card shadow-sm rounded-4 border-0 {{ $card['bg'] }} text-white h-100">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                                <div class="mb-2">
                                    <i class="fa {{ $card['icon'] }} fa-2x"></i>
                                </div>
                                <h2 class="fw-bold mb-1">
                                    <span id="{{ $card['id'] }}" class="text-white">{{ $card['value'] }}</span>
                                </h2>
                                <span class="fw-semibold">{{ $card['label'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Attendance Table --}}
        <div class="table-responsive mt-5">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <thead class="fw-bold">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Date</th>
                        <th>Punch In</th>
                        <th>Punch Out</th>
                        <th>Working Hour</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($employeeDetail['allAttendanceDetails'] as $key => $item)
                        @php
                            $workingHour = '';
                            $punchIn = '';
                            $punchOut = '';
                            $status = 'Absent';
                            $statusColor = 'red';
                            $title = '';

                            if (!empty($item->punch_in)) {
                                $workingHour = getTotalWorkingHour($item->punch_in, $item->punch_out);
                                $punchIn = date('h:i A', strtotime($item->punch_in));
                                $punchOut = date('h:i A', strtotime($item->punch_out));
                                $status = $item->is_short_attendance ? 'Short Attendance' : ($item->late ? 'Late' : 'Present');
                                $statusColor = $item->leave ? 'red' : ($item->punch_in_by === 'Company' ? 'orange' : ($status === 'Present' ? 'green' : 'yellow'));
                                $title = "Punch In By " . $item->punch_in_by . " and reason is " . $item->remark;
                            }
                        @endphp

                        {{-- Weekend Row --}}
                        @if ($item['weekend'])
                            <tr class="bg-dark text-white fw-bold text-center">
                                <td colspan="7">
                                    <i class="fa fa-calendar-week me-2"></i> {{ $key }} - Weekend
                                </td>
                            </tr>
                        @endif

                        {{-- Holiday Row --}}
                        @if ($item['holiday'])
                            <tr class="bg-warning text-dark fw-bold text-center">
                                <td colspan="7">
                                    <i class="fa fa-gift me-2"></i> {{ $key }} - Holiday
                                </td>
                            </tr>
                        @endif

                        {{-- Regular Attendance Row (if not weekend or holiday) --}}
                        @if (!$item['weekend'] && !$item['holiday'])
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $key }}</td>
                                <td>{{ $item['leave'] ? 'N/A' : $punchIn }}</td>
                                <td>{{ $item['leave'] ? 'N/A' : $punchOut }}</td>
                                <td>{{ $item['leave'] ? 'N/A' : $workingHour }}</td>
                                <td title="{{ $title }}" style="color: {{ $statusColor }}; font-weight: 500;">
                                    {{ $item['leave'] ? 'Leave' : $status }}
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                       data-bs-toggle="modal"
                                       data-bs-target="#edit_attendance_modal"
                                       onclick="edit_attendance('{{ $item->id ?? '' }}', '{{ !empty($item->punch_in) ? date('H:i', strtotime($item->punch_in)) : '' }}', '{{ !empty($item->punch_out) ? date('H:i', strtotime($item->punch_out)) : '' }}', '{{ $key }}')">
                                       <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
