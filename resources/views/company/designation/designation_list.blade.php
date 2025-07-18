<div class="" id="designation_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Designation Name</th>
                    <th>Department </th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($allDesignationDetails as $key => $designationDetail)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_designation_details('{{ $designationDetail->id }}', '{{ $designationDetail->name }}','{{ $designationDetail->department_id }}')">{{ $designationDetail->name }}</a>
                        </td>
                        <td>{{ $designationDetail->departments->name }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $designationDetail->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $designationDetail->id }})" id="checked_value_{{$designationDetail->id}}">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_designation_details('{{ $designationDetail->id }}', '{{ $designationDetail->name }}','{{ $designationDetail->department_id }}')"
                                    class="btn btn-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-danger btn-sm me-1"
                                    onclick="deleteFunction('{{ $designationDetail->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Designation Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
        {{ $allDesignationDetails->links() }}
    </div>
    <!--end::Table container-->
</div>
