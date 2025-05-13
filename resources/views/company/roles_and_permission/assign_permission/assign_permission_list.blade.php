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
                    <th>Permissions</th>
                </tr>
            </thead>
            @forelse ($roles as $role) 
            <tbody class="">
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    
                    <td>{{ $role->name }} </td>
                    <td>
                        @forelse ($role->menus as $menu)
                            @if(!count($menu['children']))
                                {{ ucfirst($menu['title']) }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endif
                        @empty
                        No Permission available
                        @endforelse
                    </td>
                    
                </tr>
            </tbody>
            @empty
            <td colspan="3">
                <span class="text-danger">
                    <strong>No Permission Found!</strong>
                </span>
            </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
</div>
