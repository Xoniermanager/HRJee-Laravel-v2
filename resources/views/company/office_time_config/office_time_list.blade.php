<div id="office_time_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Shift_Hours</th>
                    <th>Half_day_hours</th>
                    <th>Min_shift_Hours</th>
                    <th>Min_half_day_hours</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allOfficeTimeDetails as $key => $officeTimeDetail)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_department_details('{{ $officeTimeDetail->id }}', '{{ $officeTimeDetail->name }}')">{{ $officeTimeDetail->name }}</a>
                        </td>
                        <td>{{ isset($officeTimeDetail->shift_hours)? $officeTimeDetail->shift_hours:''}}</td>
                        <td>{{ isset($officeTimeDetail->half_day_hours)? $officeTimeDetail->half_day_hours:''}}</td>
                        <td>{{ isset($officeTimeDetail->min_shift_Hours)?$officeTimeDetail->min_shift_Hours :''}}</td>
                        <td>{{ isset($officeTimeDetail->min_half_day_hours)?$officeTimeDetail->min_half_day_hours:''}}
                        </td>
                        {{-- <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $officeTimeDetail->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $departmentDetails->id }})" id="checked_value">
                                <span class="slider round"></span>
                            </label>
                        </td> --}}

                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_department_details('{{ $officeTimeDetail->id }}', '{{ $officeTimeDetail->name }}','{{ $officeTimeDetail->company_branch }}','{{$officeTimeDetail->shift_hours}}','{{$officeTimeDetail->half_day_hours}}','{{$officeTimeDetail->min_shift_Hours}}','{{$officeTimeDetail->min_half_day_hours}}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $officeTimeDetail->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Office Time Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
{{-- {{ $allDepartmentDetails->links() }} --}}
