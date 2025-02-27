<div id="prm_category_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>User Name</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Bill Date</th>
                    <th>Remark</th>
                    <th>Status</th>
                </tr>
            </thead>
            @forelse ($allPRMRequestDetails as $key => $prmRequestDetails)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $prmRequestDetails->user->name }}</td>
                        <td>{{ $prmRequestDetails->category->name }}</td>
                        <td>{{ $prmRequestDetails->amount }}</td>
                        <td>{{ date('Y-m-d',strtotime($prmRequestDetails->bill_date)) }}</td>
                        <td>{{ $prmRequestDetails->remark }}</td>
                        <td data-order="Invalid date">
                            @if($prmRequestDetails->status == 0)
                                <select name="status" class="form-control min-w-150px me-2" id="status_{{ $prmRequestDetails->id }}" onchange="handleStatus({{ $prmRequestDetails->id }})">
                                    <option value="0">Pending</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Rejected</option>
                                </select>
                            @else
                            {{ $prmRequestDetails->status == 1 ? "Approved" : "Rejected" }}
                            @endif

                            {{-- <label class="switch">
                                <input type="checkbox" <?= $prmRequestDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $prmRequestDetails->id }})" id="checked_value_{{ $prmRequestDetails->id }}">
                                <span class="slider round"></span>
                            </label> --}}
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No PRM Request Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>

{{ $allPRMRequestDetails->links() }}