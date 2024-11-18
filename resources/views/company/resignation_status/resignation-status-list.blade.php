<div id="company_resignation_status_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                <tr class="fw-bold">
                    <th>Sr.No.</th>
                    <th class="min-w-150px">Name</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
                </tr>
            </thead>
            @forelse ($AllResignationStatus as $key => $resignationStatus)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $resignationStatus->name }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $resignationStatus->status == 1 ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $resignationStatus->id }})" id="checked_value_{{ $resignationStatus->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_resignationStatus_details('{{ $resignationStatus }}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick='deleteFunction(`{{ $resignationStatus->id }}`)'>
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Resignation Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
{{ $AllResignationStatus->links() }}
