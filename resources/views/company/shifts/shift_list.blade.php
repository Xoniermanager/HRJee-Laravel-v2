<div id="department_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Start Time </th>
                    <th>End Time</th>
                    <th>Active</th>
                    <th>Default</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allshifts as $key => $allshift)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $allshift->name }}
                        </td>
                        <td>{{ $allshift->start_time }}</td>
                        <td>{{ $allshift->end_time }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $allshift->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $allshift->id }})" id="checked_value">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox"
                                    onchange="handleStatus({{ $allshift->id }})" id="checked_value">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                onClick="edit_department_details('{{$allshift}}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $allshift->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Shifts Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
{{ $allshifts->links() }}
