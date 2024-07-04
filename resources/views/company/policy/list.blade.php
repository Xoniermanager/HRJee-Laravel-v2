<div class="table-responsive" id="policy_list">
    <!--begin::Table-->
    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
        <!--begin::Table head-->
        <thead>
            <tr class="fw-bold">
                <th>Sr. No.</th>
                <th>Title</th>
                <th>Policy Catgeory</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th class="float-right">Action</th>
            </tr>
        </thead>
        <tbody class="">
            @forelse ($allPolicyDetails as $index => $policyDetails)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $policyDetails->title }}</td>
                    <td>{{ $policyDetails->policyCategories->name }}</td>
                    <td>{{ $policyDetails->start_date }}</td>
                    <td>{{ $policyDetails->end_date }}</td>
                    <td data-order="Invalid date">
                        <label class="switch">
                            <input type="checkbox" <?= $policyDetails->status == '1' ? 'checked' : '' ?>
                                onchange="handleStatus({{ $policyDetails->id }})"
                                id="checked_value_{{ $policyDetails->id }}">
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="{{ route('policy.view', $policyDetails->id) }}"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-eye"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="{{ route('policy.edit', $policyDetails->id) }}"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                onclick="deleteFunction('{{ $policyDetails->id }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Policy Found!</strong>
                    </span>
                </td>
            @endforelse
        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
</div>
{{ $allPolicyDetails->links() }}
