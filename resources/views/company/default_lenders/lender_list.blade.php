<div id="default_lender_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Name</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allDefaultLenderDetails as $key => $allDefaultLenderDetail)
                <tbody class="">
                    <tr>
                       
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_lender_details('{{ $allDefaultLenderDetail->id }}', '{{ $allDefaultLenderDetail->name }}')">{{ $allDefaultLenderDetail->name }}</a>
                        </td>
                        
                        {{-- <td>{{ $key + 1 }}</td> --}}
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $allDefaultLenderDetail->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $allDefaultLenderDetail->id }})"
                                    id="checked_value_{{ $allDefaultLenderDetail->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                    <a href="#" data-bs-toggle="modal"
                                        onClick="edit_lender_details('{{ $allDefaultLenderDetail->id }}', '{{ $allDefaultLenderDetail->name }}')"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <i class="fa fa-edit"></i>
                                        <!--end::Svg Icon-->
                                    </a>

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $allDefaultLenderDetail->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Lender Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-right">
                {{ $allDefaultLenderDetails->links() }}
            </ul>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
