<div id="assigned_permission_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Roles</th>
                    <th>Permission</th>
                </tr>
            </thead>
            @forelse ($roles as $key => $assignPermissionDetails)
            <tbody class="">
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $assignPermissionDetails->name }} </td>
                    <td>
                        @forelse ($assignPermissionDetails->permissions as $permission)
                        <span class="badge bg-primary">{{ ucfirst($permission->name) }}</span>
                        @empty
                        @endforelse
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
</div>
