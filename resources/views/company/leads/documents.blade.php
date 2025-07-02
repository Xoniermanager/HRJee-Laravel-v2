@php
    $uploaded = collect($leadDocuments)->groupBy('document_type');
    $documentStructure = [
        'Others' => [
            'Miscellaneous Documents',
            'Savings & Investment proof',
            'Letter from employer',
            'Trade Certificate',
        ],
        'Income Documents' => [
            'Letter from employer',
            'Relieving Letter of previous company',
            'Salary Slip',
            'Appointment Letter',
        ],
        'Business Registration proof' => [
            'Partnership deed',
            'Business Commencement Certificate',
            'Udyog Aadhar',
        ],
    ];
@endphp

<div id="kt_charts_widget_35_tab_content_2">
    <div class="p-4">
        <div class="row ">
            <div class="col-md-5">
                <input type="text" class="form-control m-0" placeholder="Search">
            </div>
            <div class="col-md-4">
                <a href="#" class="btn btn-sm btn-primary">Search</a>
            </div>
        </div>
        <table class="mt-4">
            <tr>
                <th class="w-250px">Name</th>
                <th class="w-150px">File Name</th>
                <th class="w-150px">Format</th>
                <th class="w-150px">Max Size</th>
                <th class="w-150px">Actions</th>
            </tr>
        </table>
        @foreach ($documentStructure as $docType => $subTypes)
            @php
                $uploadedCount = $uploaded->has($docType) ? $uploaded[$docType]->count() : 0;
                $uploadedBySubType = $uploaded->has($docType)
                    ? $uploaded[$docType]->groupBy('document_sub_type')->map(function ($docs) {
                        return basename($docs->first()->file);
                    })
                    : collect();
            @endphp
            <div class="accordion accordion-icon-toggle" id="kt_accordion_2">

                <!--begin::Item-->
                <div class="mb-5">
                    <!--begin::Header-->
                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                        data-bs-target="#kt_accordion_2_item_{{ $loop->index }}">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </span>

                        <table>
                            <tr>
                                <th class="w-250px">{{ $docType }}</th>
                                <th class="w-150px"></th>
                                <th class="w-150px">
                                    <span class="badge bg-warning uploaded-count" data-doc-category="{{ $docType }}">
                                        Uploaded: {{ $uploadedCount }}</span>
                                </th>
                                <th class="w-150px">Mandatory: 0/0</th>
                                <th class="w-150px"></th>
                            </tr>
                        </table>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div id="kt_accordion_2_item_{{ $loop->index }}" class="fs-6 collapse" data-bs-parent="#kt_accordion_2">
                        <div class="table-responsive">
                            <table class="customtable table table-row-dashed align-middle">
                                @foreach ($subTypes as $subType)
                                    <tr>
                                        <th class="w-250px">{{ $subType }}</th>
                                        <td class="filename-display w-150px">{{ $uploadedBySubType->get($subType, '') }}</td>
                                        <td class="w-150px">JPEG, PDF, XL</td>
                                        <td class="w-150px">10MB</td>
                                        <td class="w-150px">
                                            <label class="upload-icon-wrapper">
                                                <i class="fa fa-upload"></i>
                                                <input type="file" name="fileUpload" class="file-upload-input"
                                                    data-lead-id="{{ $viewLeadDetails->id }}"
                                                    data-document-type="{{ $docType }}"
                                                    data-document-sub-type="{{ $subType }}" />
                                            </label>
                                            &nbsp; <i class="fa fa-plus"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Item-->
            </div>
        @endforeach
    </div>
</div>


<script>
    $(document).ready(function() {
        $(document).on('change', '.file-upload-input', function() {
            let fileInput = $(this);
            let file = this.files[0];
            let leadId = fileInput.data('lead-id');
            let documentType = fileInput.data('document-type');
            let documentSubType = fileInput.data('document-sub-type');

            if (!file) return;

            let formData = new FormData();
            formData.append('file', file);
            formData.append('lead_id', leadId);
            formData.append('document_type', documentType);
            formData.append('document_sub_type', documentSubType);

            $.ajax({
                url: '{{ route('lead.loan.upload') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Find closest row and update filename display
                    console.log(response);

                    let row = fileInput.closest('tr');
                    row.find('.filename-display').text(response.filename || file.name);
                },
                error: function(xhr) {
                    alert("Upload failed. Please try again.");
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
