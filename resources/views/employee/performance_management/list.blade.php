<div class="card-body py-3" id="leave_type_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Review Cycle</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    {{-- <th>Average Performance</th> --}}
                    {{-- <th>Last Updated Date</th> --}}
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($allPerformances as $key => $performance)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td> {{ $performance->cycle->title }}</td>
                        <td> {{ $performance->start_date }}</td>
                        <td> {{ $performance->end_date }}</td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="{{route('performance-management.view', $performance->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-eye"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                {{-- <a href="#"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="fa fa-trash"></i>
                                </a> --}}
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Record Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{-- <div class="mt-3">
        {{ $allPerformances->links('paginate') }}
    </div> --}}
    <!--end::Table container-->
</div>
