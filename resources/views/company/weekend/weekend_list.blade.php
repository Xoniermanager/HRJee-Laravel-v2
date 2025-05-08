<div id="weekend_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Company Branches</th>
                    <th>Department</th>
                    <th>WeekDays</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allWeekendDetails as $key => $weekendDetails)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_weekend_details('{{ $weekendDetails->id }}','{{ $weekendDetails->company_branch_id }}','{{ $weekendDetails->department_id }}','{{ json_encode($weekendDetails->weekend_dates) }}')">{{ $weekendDetails->companyBranch->name }}</a>
                        </td>
                        <td>
                            <span class="btn btn-primary btn-sm">{{ $weekendDetails->department->name }}</span>
                        </td>
                        <td>
                            @foreach ($weekendDetails->weekend_dates as $index => $weekday)
                                <span class="btn btn-primary btn-sm">{{ $weekday }}</span>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $weekendDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $weekendDetails->id }})"
                                    id="checked_value_{{ $weekendDetails->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" href="#"
                                    data-bs-toggle="modal"
                                    onClick="edit_weekend_details('{{ $weekendDetails->id }}','{{ $weekendDetails->company_branch_id }}','{{ $weekendDetails->department_id }}','{{ $weekendDetails->designation_id }}','{{ json_encode($weekendDetails->weekend_dates) }}')"><i
                                        class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $weekendDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Weekend Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
{{ $allWeekendDetails->links() }}
