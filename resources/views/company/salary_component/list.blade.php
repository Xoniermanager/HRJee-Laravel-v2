<div id="salary_component_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Default Value</th>
                    <th>Value Type</th>
                    <th>Parent Component</th>
                    <th>Earning/Deduction</th>
                    <th>Default</th>
                    {{-- <th>Status</th> --}}
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allSalaryComponent as $key => $item)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->default_value }}</td>
                        <td>{{ ucfirst($item->value_type) }}</td>
                        <td>{{ $item->parentSalaryComponent->name ?? ''}}</td>
                        <td>{{ ucfirst($item->earning_or_deduction) }}</td>
                        <td>
                            @if ($item->is_default == '1')
                                <span class="btn btn-success btn-sm">Yes</span>
                            @else
                                <span class="btn btn-danger btn-sm">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('salary.component.edit', $item->id) }}"
                                class="btn btn-primary btn-sm me-1">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Salary Component Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allSalaryComponent->links() }}
</div>
