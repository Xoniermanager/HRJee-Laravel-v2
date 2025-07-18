<div class="table-responsive">
    <!--begin::Table-->
    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
        <!--begin::Table head-->
        <thead>
            <tr class="fw-bold">
                <th>Sr. No.</th>
                <th>Employee Name</th>
                <th>Visit Address</th>
                <th>User End Status</th>
                <th>Final Status</th>
                <th class="float-right">Action</th>
            </tr>
        </thead>
        <tbody class="">
            @forelse ($allTaskDetails as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->user->name .' ('.$item->user->details->emp_id.')'}}</td>
                    <td>{{ $item->visit_address }}</td>
                    <td>{{ ucfirst($item->user_end_status) }}</td>
                    <td>{{  ucfirst($item->final_status) }}</td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="{{ route('location_visit.view_task_assign', $item->id) }}"
                                class="btn btn-dark btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-eye"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="{{ route('location_visit.edit_task_assign', $item->id) }}"
                                class="btn btn-primary btn-sm me-1 {{ $item->final_status == 'completed' ? 'disabled' : '' }}">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-danger btn-sm me-1 {{ $item->final_status == 'completed' ? 'disabled' : '' }}"
                                onclick="deleteFunction('{{ $item->id }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Task Assigned Available!</strong>
                    </span>
                </td>
            @endforelse
        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
    <div class="pagination">
        {{ $allTaskDetails->links() }}
    </div>
</div>
