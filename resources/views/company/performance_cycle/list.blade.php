<div class="card-body py-3" id="leave_type_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    {{-- <th>Status</th> --}}
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($performanceCategories as $key => $cycle)
            <tbody class="">
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td> <a href="#">{{ $cycle->title }}</a></td>
                    <td> <a href="#">{{ $cycle->start_date }}</a></td>
                    <td> <a href="#">{{ $cycle->end_date }}</a></td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="{{ route('performance-cycle.edit',$cycle->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="javascript:void(0)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="deleteFunction('{{ $cycle->id }}')">
                                <i class="fa fa-trash"></i>
                            </a>

                        </div>
                    </td>
                </tr>
            </tbody>
            @empty
            <td colspan="3">
                <span class="text-danger">
                    <strong>No Cycle Found!</strong>
                </span>
            </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <div class="mt-3">
        {{ $performanceCategories->links() }}
    </div>
    <!--end::Table container-->
</div>
