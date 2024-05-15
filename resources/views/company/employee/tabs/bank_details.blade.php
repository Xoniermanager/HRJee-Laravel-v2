<div class="tab-pane fade" id="bank_details_tab">
    <!--begin::Wrapper-->
    <input type="hidden" name="company_id" class="id">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Account Holder Name *</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Account Number *</label>
                        <input class="form-control" type="number">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Bank Name *</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">IFSC/RTGS Code *</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
            </div>
        </div>
        <button onclick="show_next_tab('address_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>   Previous</button>
                {{-- <button onclick="save_data_show_next_tab('advance_details_tab')"
    class="btn btn-primary">Save & Continue</button> --}}
                <button onclick="show_next_tab('qualification_tab')" class="btn btn-primary float-right">Next <i class="fa fa-arrow-right"></i>  </button>
    <!--end::Wrapper-->
</div>
