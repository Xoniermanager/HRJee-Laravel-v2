<div id="disposition_code_list" class="card-body py-3">
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
            @forelse ($allDispositionCodeDetails as $key => $item)
            <tbody class="">
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="#" data-bs-toggle="modal"
                            onClick="edit_disposition_code_details('{{ $item->id }}', '{{ $item->name }}','{{ $item->description }}')">{{
                            $item->name }}</a>
                    </td>
                    <td>{{ $item->description ?? "N/A" }}</td>
                    <td data-order="Invalid date">
                        <label class="switch">
                            <input type="checkbox" <?=$item->status == '1' ? 'checked' : '' ?>
                            onchange="handleStatus({{ $item->id }})" id="checked_value_{{$item->id}}">
                            <span class="slider round"></span>
                        </label>
                    </td>

                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" data-bs-toggle="modal"
                                onClick="edit_disposition_code_details('{{ $item->id }}', '{{ $item->name }}','{{ $item->description }}')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                onclick="deleteFunction('{{ $item->id }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
            @empty
            <td colspan="3">
                <span class="text-danger">
                    <strong>No Dispositiion Code Found!</strong>
                </span>
            </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allDispositionCodeDetails->links() }}
    <!--end::Table container-->
</div>
