<div class="card-body py-3" id="document_type_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Document Name</th>
                    <th>Description</th>
                    <th>Mandatory</th>
                    <th>Active/Inactive</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($allDocumentTypes as $key => $documentTypes)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td> <a href="#" data-bs-toggle="modal"
                                onClick="editDocuments('{{ $documentTypes->id }}', '{{ $documentTypes->name }}','{{ $documentTypes->description }}','{{ $documentTypes->is_mandatory }}')">
                                {{ $documentTypes->name }}</a></td>
                        <td>{{ $documentTypes->description }}</td>
                        <td>
                            <?php
                            $is_mandatory = '';
                            if ($documentTypes->is_mandatory == '1') {
                                $is_mandatory = 'Yes';
                            } 
                            if($documentTypes->is_mandatory == '0'){
                                $is_mandatory = 'No';
                            }
                            ?>
                            <span class="badge py-3 px-4 fs-7 badge-light-primary">
                                {{ $is_mandatory }}</span>
                        </td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" {{ $documentTypes->status == 1 ? 'checked' : '' }}
                                    onchange="handleStatus('{{ $documentTypes->id }}')" id="checked_value">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="editDocuments('{{ $documentTypes->id }}', '{{ $documentTypes->name }}','{{ $documentTypes->description }}','{{ $documentTypes->is_mandatory }}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $documentTypes->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Document Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
{{ $allDocumentTypes->links() }}
