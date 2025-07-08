<div id="office_time_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $key => $role)
                    <tr>
                        <td>{{ ($roles->currentPage() - 1) * $roles->perPage() + $key + 1 }}</td>
                        <td>
                            @if ($role->category === 'default')
                                {{ $role->name }}
                            @else
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_role_details('{{ $role->id }}', '{{ $role->name }}')">
                                    {{ $role->name }}
                                </a>
                            @endif
                        </td>
                        <td>
                            <label class="switch {{ $role->category === 'default' ? 'disabled-switch' : '' }}"
                                   title="{{ $role->category === 'default' ? 'Default role status cannot be changed' : '' }}">
                                <input type="checkbox"
                                    {{ $role->status == '1' ? 'checked' : '' }}
                                    id="checked_value_{{ $role->id }}"
                                    onchange="handleStatus({{ $role->id }})"
                                    {{ $role->category === 'default' ? 'disabled' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </td>


                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                @if ($role->category !== 'default')
                                    <a href="#" data-bs-toggle="modal"
                                        onClick="edit_role_details('{{ $role->id }}', '{{ $role->name }}')"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                        onclick="deleteFunction('{{ $role->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Default</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <span class="text-danger"><strong>No Role Found!</strong></span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

    <!-- Pagination -->
    <div class="mt-3 paginate">
        {!! $roles->links() !!}
    </div>
</div>
