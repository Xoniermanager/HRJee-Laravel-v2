<div class="card-body py-3" id="state_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>State</th>
                    <th>Country </th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($allStateDetails as $key => $stateDetails)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_state_details('{{ $stateDetails->id }}', '{{ $stateDetails->name }}','{{ $stateDetails->country_id }}')">{{ $stateDetails->name }}</a>
                        </td>
                        <td>{{ $stateDetails->countries->name }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $stateDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $stateDetails->id }})" id="checked_value_{{$stateDetails->id}}">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_state_details('{{ $stateDetails->id }}', '{{ $stateDetails->name }}','{{ $stateDetails->country_id }}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $stateDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No State Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
        {{ $allStateDetails->links() }}
    </div>
    <!--end::Table container-->
</div>
