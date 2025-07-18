<div id="office_time_list" class="">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Company Branch</th>
                    <th>Shift Hours</th>
                    <th>Half Day Hours</th>
                    <th>Min Shift Hours</th>
                    <th>Min Half Day Hours</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allOfficeTimeDetails as $key => $officeTimeDetail)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_office_time_details('{{ $officeTimeDetail->id }}', '{{ $officeTimeDetail->name }}','{{ $officeTimeDetail->company_branch_id }}','{{$officeTimeDetail->shift_hours}}','{{$officeTimeDetail->half_day_hours}}','{{$officeTimeDetail->min_shift_Hours}}','{{$officeTimeDetail->min_half_day_hours}}')">{{ $officeTimeDetail->name }}</a>
                        </td>
                        <td>{{$officeTimeDetail->companyBranch ? $officeTimeDetail->companyBranch->name : 'NA'}}</td>
                        <td>{{ isset($officeTimeDetail->shift_hours)? $officeTimeDetail->shift_hours .' hr':''}}</td>
                        <td>{{ isset($officeTimeDetail->half_day_hours)? $officeTimeDetail->half_day_hours .' hr':''}}</td>
                        <td>{{ isset($officeTimeDetail->min_shift_Hours)?$officeTimeDetail->min_shift_Hours  .' hr':''}}</td>
                        <td>{{ isset($officeTimeDetail->min_half_day_hours)?$officeTimeDetail->min_half_day_hours .' hr':''}}
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_office_time_details('{{ $officeTimeDetail->id }}', '{{ $officeTimeDetail->name }}','{{ $officeTimeDetail->company_branch_id }}','{{$officeTimeDetail->shift_hours}}','{{$officeTimeDetail->half_day_hours}}','{{$officeTimeDetail->min_shift_Hours}}','{{$officeTimeDetail->min_half_day_hours}}')"
                                    class="btn btn-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-danger btn-sm me-1"
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
{{ $allOfficeTimeDetails->links() }}
</div>
