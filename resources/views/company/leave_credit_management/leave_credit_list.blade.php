<div id="leave_credit_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th class="min-w-150px">Branch Name</th>
                    <th class="min-w-150px">Employee Type</th>
                    <th class="min-w-150px">Leave Type</th>
                    <th class="min-w-150px">Repeat In Month</th>
                    <th class="min-w-100px">Credit Leave on Day</th>
                    <th class="min-w-100px">No. of Leaves</th>
                    <th class="min-w-100px">Status</th>
                    <th class="float-right">Action</th>
                </tr>
                </tr>
            </thead>
            @forelse ($allLeaveCreditDetails as $key => $leaveCreditDetails)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_leave_credit_management('{{ $leaveCreditDetails }}')">{{ $leaveCreditDetails->companyBranches->name }}</a>
                        </td>
                        <td>{{ $leaveCreditDetails->employeeTypes->name }}</td>
                        <td>{{ $leaveCreditDetails->leaveTypes->name }}</td>
                        @php
                        $repeatInMonth = '';
                        $credit_leave_on_day = '';
                        if($leaveCreditDetails->repeat_in_months == 1)
                        $repeatInMonth = "Every Month";
                        if($leaveCreditDetails->repeat_in_months == 2)
                        $repeatInMonth = "Every Two Month";
                        if($leaveCreditDetails->repeat_in_months == 3)
                        $repeatInMonth = "Every Three Month";
                        if($leaveCreditDetails->repeat_in_months == 4)
                        $repeatInMonth = "Every Four Month";
                        if($leaveCreditDetails->repeat_in_months == 5)
                        $repeatInMonth = "Every Five Month";
                        if($leaveCreditDetails->repeat_in_months == 6)
                        $repeatInMonth = "Every Six Month";
                        if($leaveCreditDetails->repeat_in_months == 7)
                        $repeatInMonth = "Every Seven Month";
                        if($leaveCreditDetails->repeat_in_months == 8)
                        $repeatInMonth = "Every Eight Month";
                        if($leaveCreditDetails->repeat_in_months == 9)
                        $repeatInMonth = "Every Nine Month";
                        if($leaveCreditDetails->repeat_in_months == 10)
                        $repeatInMonth = "Every Ten Month";
                        if($leaveCreditDetails->repeat_in_months == 11)
                        $repeatInMonth = "Every Eleven Month";
                        if($leaveCreditDetails->repeat_in_months == 12)
                        $repeatInMonth = "Every Year";
                        
                        if($leaveCreditDetails->credit_leave_on_day == 0)
                        $credit_leave_on_day = "End of Months";
                        if($leaveCreditDetails->credit_leave_on_day != 0)
                         $credit_leave_on_day = $leaveCreditDetails->credit_leave_on_day .' Day'
                        
                        @endphp
                        <td>{{$repeatInMonth}}</td>
                        <td>{{ $credit_leave_on_day }}</td>
                        <td>{{ $leaveCreditDetails->number_of_leaves }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $leaveCreditDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus('{{ $leaveCreditDetails->id }}')"
                                    id="checked_value_{{ $leaveCreditDetails->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_leave_credit_management('{{ $leaveCreditDetails }}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $leaveCreditDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Leave Credit Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
        {{ $allLeaveCreditDetails->links() }}
    </div>
    <!--end::Table container-->

</div>
