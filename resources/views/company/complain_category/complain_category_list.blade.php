<div id="complain_category_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allComplainCategoryDetails as $key => $complainCategoryDetails)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_complain_category_details('{{ $complainCategoryDetails->id }}', '{{ $complainCategoryDetails->name }}','{{ $complainCategoryDetails->description }}')">{{ $complainCategoryDetails->name }}</a>
                        </td>
                        <td>{{ $complainCategoryDetails->description }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $complainCategoryDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $complainCategoryDetails->id }})"
                                    id="checked_value_{{ $complainCategoryDetails->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_complain_category_details('{{ $complainCategoryDetails->id }}', '{{ $complainCategoryDetails->name }}','{{ $complainCategoryDetails->description }}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $complainCategoryDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Complain Category Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
        {{ $allComplainCategoryDetails->links() }}
    </div>
    <!--end::Table container-->

</div>
