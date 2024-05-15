<div class="tab-pane fade" id="document_tab">
    <!--begin::Wrapper-->
    <input type="hidden" name="company_id" class="id">
    <div class="row">
        @forelse ($allDocumentTypeDetails as $item)
            <div class="col-md-4 form-group">
                <label for="">{{ $item->name }}
                    {{ $item->is_mandatory == '1' ? '*' : '' }}</label>
                <input class="form-control" type="file">
            </div>
        @empty
            <td colspan="3">
                <span class="text-danger">
                    <strong>No Document Found!</strong>
                </span>
            </td>
        @endforelse
    </div>
    <!--end::Wrapper-->
    <button onclick="show_next_tab('family_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>   Previous</button>
            {{-- <button onclick="save_data_show_next_tab('advance_details_tab')"
    class="btn btn-primary">Save & Continue</button> --}}
            <button class="btn btn-primary float-right">Save</button>
</div>
