<div id="attendance_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Emp Id</th>
                    <th>Employee Name</th>
                    <th>Total Present</th>
                    <th>Total Leave</th>
                    <th>Total Holiday</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allEmployeeDetails as $key => $employee)
            <tbody class="">
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $employee->details->emp_id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{$employee->totalPresent}}</td>
                    <td>{{$employee->totalLeave}}</td>
                    <td>{{$employee->totalHoliday}}</td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="{{ route('attendance.view.details',getEncryptId($employee->id)) }}"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="fa fa-eye"></i>
                            </a>
                            <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                @if($employee->totalPresent > 0)
                                class="btn"
                                @else
                                class="btn disabled"
                                disabled
                                @endif onclick="getExportData({{ $employee->id }})">
                                <i class="fa fa-download"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
            @empty
            <td colspan="3">
                <span class="text-danger">
                    <strong>No Attendance Found!</strong>
                </span>
            </td>
            @endforelse
        </table>
    </div>
    {{ $allEmployeeDetails->links() }}
</div>
