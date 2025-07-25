<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-3">
    <thead>
        <tr class="fw-bold">
            <th>Sr. No.</th>
            <th>Employee Name</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Contact</th>
            <th>Attendance</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($employees as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
                <a href="{{ route('employee.view', $item->id) }}">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-45px me-5">
                            <img src="{{ $item->details->profile_image ?? asset('employee/assets/media/user.jpg') }}" alt="photo">
                        </div>
                        <div class="d-flex justify-content-start flex-column">
                            <span class="text-dark fw-bold text-hover-primary fs-6">{{ $item->name }}</span>
                        </div>
                    </div>
                </a>
            </td>
            <td>{{ $item->details->department->name ?? ''}}</td>
            <td>{{ $item->details->designation->name ?? ''}}</td>
            <td>
                <a href="tel:{{ $item->details->phone }}" title="{{ $item->details->phone }}">
                    <span class="badge py-3 px-4 fs-7 badge-light-success"><i class="fa fa-phone-flip"></i></span>
                </a>
                <a href="mailto:{{ $item->details->official_email_id }}" title="{{ $item->details->official_email_id }}">
                    <span class="badge py-3 px-4 fs-7 badge-light-success"><i class="fa fa-envelope-circle-check"></i></span>
                </a>
            </td>
            <td>
                <span class="badge py-3 px-4 fs-7 badge-light-danger">
                    {{ $item->todaysLeave() ? 'Leave' : ($item->todaysAttendance() ? date('H:i A', strtotime($item->todaysAttendance()->punch_in)) : 'Absent') }}
                </span>
            </td>
        </tr>
        @empty
        <td colspan="4">
            <span class="text-danger text-center">
                <strong>No Employee Found!</strong>
            </span>
        </td>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center mt-4">
    {!! $employees->appends(request()->except('page'))->links() !!}
</div>
