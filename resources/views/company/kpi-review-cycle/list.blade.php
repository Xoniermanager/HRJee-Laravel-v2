<div class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cycles as $i => $cycle)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $cycle->type }}</td>
                    <td>{{ $cycle->start_date }}</td>
                    <td>{{ $cycle->end_date }}</td>
                    <td data-order="{{ $cycle->status ? '1' : '0' }}">
                        <label class="switch">
                            <input type="checkbox" {{ $cycle->status ? 'checked' : '' }} onchange="toggleStatus({{ $cycle->id }})" id="checked_value_{{ $cycle->id }}">
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" onclick="editCycle({{ $cycle->id }}, '{{ $cycle->type }}', '{{ $cycle->start_date }}', '{{ $cycle->end_date }}')" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="deleteCycle({{ $cycle->id }})">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No cycles found!</strong>
                    </span>
                </td>
                @endforelse
        </table>
        <!--end::Table-->
    </div>
    {{ $cycles->links() }}
    <!--end::Table container-->
</div>
