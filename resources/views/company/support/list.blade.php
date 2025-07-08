<div id="support_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>#</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allSupports as $key => $allSupport)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $allSupport->subject ?? 'N/A' }}</td>
                        <td>
                            @if ($allSupport->status === 'Close')
                                <span class="badge bg-success text-white">{{ $allSupport->status }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $allSupport->status }}</span>
                            @endif
                        </td>
                        <td>{{ $allSupport->user->name }}</td>
                        {{-- <td>{{ $allSupport->created_at ?? 'N/A' }}</td> --}}
                        <td class="text-end">
                            <a href="#" data-bs-toggle="modal"
                               onClick="view_support_details({{ json_encode($allSupport) }})"
                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="#" data-bs-toggle="modal"
                                        onClick="edit_support_details('{{ $allSupport->id }}', '{{ $allSupport->remark }}')"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <i class="fa fa-edit"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                               onclick="deleteFunction({{ $allSupport->id }})">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <span class="text-danger">
                                <strong>No Support Found!</strong>
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <!--end::Table body-->
        </table>
        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-end">
                {{ $allSupports->links() }}
            </ul>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Table container-->
</div>