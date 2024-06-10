<div id="company_branch_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
					<tr class="fw-bold">
                        <th>Sr. No.</th>
                        <th>Branch Name</th>
                        <th>Branch Type</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        {{-- <th>Address</th> --}}
                        <th>Status</th>
                        <th class="float-right">Action</th>
                    </tr>
                </tr>
            </thead>
            @forelse ($branches as $key => $branch)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_company_branch_details('{{ $branch}}')">{{ $branch->name }}</a>
                        </td>

                        <td>{{ $branch->branch_type }}</td>
                        <td>{{ $branch->contact_no }}</td>
                        <td>{{ $branch->email }}</td>
                        {{-- <td>{{ $branch->address }}</td> --}}


                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $branch->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $branch->id }})" id="checked_value_{{ $branch->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_company_branch_details('{{ $branch }}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $branch->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Country Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
{{ $branches->links() }}
