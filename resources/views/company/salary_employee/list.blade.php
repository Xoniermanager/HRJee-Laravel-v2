<div id="employee_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th class="float-right">Salary</th>
                </tr>
            </thead>
            @forelse ($allEmployeeDetails as $key => $item)
            <tbody class="">
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{$item->name}} </td>
                    <td>{{$item->email}} </td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="{{ route('employee_salary.viewSalary',getEncryptId($item->id)) }}"
                                class="btn btn-icon btn-primary btn-sm me-1">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
            @empty
            <td colspan="3">
                <span class="text-danger">
                    <strong>No Employee Found!</strong>
                </span>
            </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allEmployeeDetails->links() }}
</div>
