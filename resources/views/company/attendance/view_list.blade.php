<div id="view_list">
    <div class="col-md-12">
        <div class="row text-center clearfix" style="margin-top:20px;">
            <div class="row">
                <div class="col-4 col-md-3 col-xl-3">
                    <div class="blue-card card">
                        <div class="card-body ribbon">
                            <a href="#" class="my_sort_cut text-muted">
                                <h1><span id="persent">{{ $employeeDetail['totalPresent'] }}</span></h1>
                                <span>Total Present </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-xl-3">
                    <div class="blue-card card">
                        <div class="card-body ribbon">
                            <a href="#" class="my_sort_cut text-muted">
                                <h1><span id="onleave">{{ $employeeDetail['totalLeave'] }}</span></h1>
                                <span>Total Leave </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-xl-3">
                    <div class="blue-card card">
                        <div class="card-body ribbon">
                            <a href="#" class="my_sort_cut text-muted">
                                <h1><span id="absent">{{ $employeeDetail['totalAbsent'] }}</span></h1>
                                <span>Total Absent </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-xl-3">
                    <div class="blue-card card">
                        <div class="card-body">
                            <a href="#" class="my_sort_cut text-muted">
                                <h1><span id="holiday">{{ $employeeDetail['totalHoliday'] }}</span></h1>
                                <span> Total Holidays</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-xl-3">
                    <div class="blue-card card">
                        <div class="card-body">
                            <a href="#" class="my_sort_cut text-muted">
                                <h1><span id="shot_attendence" style="color:red;">{{
                                        $employeeDetail['shortAttendance'] }}</span></h1>
                                <span>Short Attendance</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="mb-5 mb-xl-10">
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <thead>
                    <tr class="fw-bold">
                        <th>Sr. No.</th>
                        <th>Date</th>
                        <th>Punch In</th>
                        <th>Punch Out</th>
                        <th>Working Hour</th>
                        <th>Leave</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = '1' @endphp
                    @foreach ($employeeDetail['allAttendanceDetails'] as $key => $item)
                    @php
                    $workingHour = '';
                    $punchIn = '';
                    $punchOut = '';
                    if(!empty($item->punch_in) && !empty($item->punch_out))
                    {
                    $workingHour = getTotalWorkingHour($item->punch_in,$item->punch_out);
                    $punchIn = date('h:i A',strtotime($item->punch_in));
                    $punchOut = date('h:i A',strtotime($item->punch_out));
                    }
                    @endphp
                    @if($item['weekend'] == true)
                    <tr class="weekend-row mb-2">
                        <td colspan="7" class="text-white bg-dark">{{ $key }} - Weekend </td>
                    </tr>
                    @else
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $key }}</td>
                        <td>{{$punchIn}}</td>
                        <td>{{$punchOut}}</td>
                        <td>{{$workingHour}}</td>
                        <td>N/A</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                onClick="edit_attendance('{{ isset($item->id) ? $item->id : '' }}', '{{ isset($item->punch_in) ? date('H:i', strtotime($item->punch_in)) : date('H:i') }}', '{{ isset($item->punch_out) ? date('H:i', strtotime($item->punch_out)) : date('H:i') }}', '{{ $key }}')"
                                data-bs-target="#edit_attendance_modal"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endif
                    @php
                    $i++
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
