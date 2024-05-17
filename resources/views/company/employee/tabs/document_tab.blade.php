<div class="tab-pane fade" id="document_tab">
    <!--begin::Wrapper-->
    <form id="document_details">
        @csrf
        <input type="hidden" name="user_id" class="id" value="2">
        <div class="row">
            @forelse ($allDocumentTypeDetails as $key => $item)
                <div class="col-md-4 form-group">
                    <label for="">{{ $item->name }}
                        {{ $item->is_mandatory == '1' ? '*' : '' }}</label>
                    <input class="form-control" type="file" name="{{removingSpaceMakingName($item->name)}}">
                    <input class="form-control" type="hidden" name="document_{{removingSpaceMakingName($item->name)}}" value="{{$item->id}}">
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
    <button onclick="show_next_tab('family_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
        Previous</button>

    <button class="btn btn-primary float-right">Save</button>
</div>
<script>
    /** Basic Details created Ajax*/
    jQuery.noConflict();
        jQuery("#document_details").validate({
            rules: {
            },
            messages: {
            },
            submitHandler: function(form) {
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
                            $('.id').val(response.data);
                            jQuery('.nav-pills a[href="#advance_details_tab"]').tab('show');
                            $('#submit').hide();
                    },
                    error: function(error_messages) {
                        let errors = error_messages.responseJSON.error;
                        for (var error_key in errors) {
                            $(document).find('[name=' + error_key + ']').after(
                                '<span class="' + error_key +
                                '_error text text-danger">' + errors[
                                    error_key] + '</span>');
                            setTimeout(function() {
                                jQuery("." + error_key + "_error").remove();
                            }, 5000);
                        }
                    }
                });
            }
        });
</script>
