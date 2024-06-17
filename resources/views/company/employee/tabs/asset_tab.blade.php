<div class="tab-pane fade" id="asset_tab">
    <!--begin::Wrapper-->
    <input type="hidden" name="company_id" class="id">
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="">Asset Name *</label>
            <input class="form-control" name="" type="text">
        </div>
        <div class="col-md-6 form-group">
            <label for="">Picture (Multiple) *</label>
            <input class="form-control" name="" type="file">
        </div>

        <div class="panel" id="apnd">
            <div class="panel-head">
                <h4>Asset Details</h4>
            </div>
            <div class="panel-body">
                <div class="row form-group" id="apnd_1">
                    <label class="col-md-12 control-label" for="inputSuccess">Asset
                        item :</label>
                    <div class="col-md-5">
                        <input name="asset_level[]" class="form-control" placeholder="Level">
                    </div>
                    <div class="col-md-5">
                        <input name="asset_value[]" class="form-control" placeholder="Value">
                    </div>
                    <div class="col-md-2 text-right">
                        <button class="btn btn-primary" type="button" onclick="add_more();">Add</button>
                    </div>
                    <input type="hidden" name="type[]" value="1">
                </div>
            </div>
        </div>
        <div class="panel" id="apnd_access">
            <div class="panel-head">
                <h4>Asset accessories</h4>
            </div>

            <div class="panel-body">
                <div class="row form-group">
                    <label class="col-md-12 control-label" for="inputSuccess">Accessory
                        :</label>
                    <div class="col-md-5">
                        <input name="asset_level[]" class="form-control" placeholder="Level">
                    </div>
                    <div class="col-md-5">
                        <input name="asset_value[]" class="form-control" placeholder="Value">
                    </div>
                    <div class="col-md-2 text-right">
                        <button class="btn btn-primary" type="button" onclick="add_access_more();">Add</button>
                    </div>
                    <input type="hidden" name="type[]" value="2">
                </div>
            </div>
        </div>

    </div>
    <button onclick="show_next_tab('family_details_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>   Previous</button>
            {{-- <button onclick="save_data_show_next_tab('advance_details_tab')"
    class="btn btn-primary">Save & Continue</button> --}}
            <button onclick="show_next_tab('document_tab')" class="btn btn-primary float-right">Next <i class="fa fa-arrow-right"></i>  </button>
            <!--end::Wrapper-->
</div>
