<div class="tab-pane fade" id="document_tab">
    <!--begin::Wrapper-->
    <form id="document_details">
        @csrf
        <input type="hidden" name="user_id"
            value="{{ $userdocumentDetails[0]['user_id'] ?? (Request::segment(4) ?? '11') }}">
        <div class="row">
            @forelse ($allDocumentTypeDetails as $key => $item)
                <div class="col-md-4 form-group">
                    <label for="">{{ $item->name }}
                        {{ $item->is_mandatory == '1' ? '*' : '' }}</label>
                    <input class="form-control" type="file" name="{{ removingSpaceMakingName($item->name) }}">
                    <input class="form-control" type="hidden"
                        name="document_{{ removingSpaceMakingName($item->name) }}" value="{{ $item->id }}">
                </div>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Document Found!</strong>
                    </span>
                </td>
            @endforelse
        </div>
        <button class="btn btn-primary">Save & Continue</button>
    </form>
    <!--end::Wrapper-->
    <div class="row">
        @foreach ($userdocumentDetails as $singledocumentDetail)
            <div class="col-md-3">
                <a class="position-relative" href="{{ $singledocumentDetail->document }}" target="_blank" download>
                    <div class="image-input-wrapper h-125px rounded border"
                        style="background-size:cover;background-image: url('{{ $singledocumentDetail->document }}')">
                    </div>
                    <p class="doc_button">Download to view</p>
                </a>
            </div>
        @endforeach
    </div>
    <button onclick="show_next_tab('family_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>
    <button class="btn btn-primary float-right" id="submit_all">Save All</button>
</div>
<script>
    /** Basic Details created Ajax*/
    jQuery(document).ready(function() {
        jQuery("#document_details").validate({
            rules: {},
            messages: {},
            submitHandler: function(form) {
                createDocumentDetails(form);
            }
        });
    });


    function createDocumentDetails(form) {
        var document_details_Data = new FormData(form);
        $.ajax({
            url: "{{ route('employee.document.details') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: document_details_Data,
            success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function() {
                    location.href = "/company/employee/index";
                }, 3000);
                // This variable is used on save all records button
                all_data_saved = true;
            },
            error: function(error_messages) {
                jQuery('.nav-pills a[href="#document_tab"]').tab('show');
                // This variable is used on save all records button
                all_data_saved = false;
                for (let [key, value] of Object.entries(error_messages.responseJSON.errors)) {
                    let error_key = 'input[name="' + key + '"]';
                    $(document).find(error_key).after(
                        '<span class="_error' + key + ' text text-danger">' + value + '</span>');
                    setTimeout(function() {
                        jQuery('._error' + key).remove();
                    }, 3000);
                }
            }
        });
    }
</script>
