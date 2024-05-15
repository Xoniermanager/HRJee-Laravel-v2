<div class="tab-pane fade" id="family_details_tab">
    <!--begin::Wrapper-->
    <div class="">
    <input type="hidden" name="company_id" class="id">
        <div class="row align-items-center panel panel-body mb-3">
            <div class="col-md-3 form-group">
                <label for="">Relationship *</label>
                <input class="form-control" type="text">
            </div>
            <div class="col-md-3 form-group">
                <label for="">Name *</label>
                <input class="form-control" type="text">
            </div>
            <div class="col-md-2 form-group">
                <label for="">Number *</label>
                <input class="form-control" type="text">
            </div>
            <div class="col-md-2 form-group">
                <label for="">Date of birth *</label>
                <input class="form-control" type="date">
            </div>
            <div class="col-md-2 form-group mt-5">
                <input type="checkbox">
                <label for="">Nominee</label>
                <button class="btn btn-primary btn-sm float-right p2px" onclick="get_family_details_html()"><i
                        class="fa fa-plus btn btn-primary btn-sm float-right" style="line-height: 0.5;"></i></button>
            </div>
        </div>
    </div>
    <div id="family_details_html" class="">

    </div>
    <!--end::Wrapper-->
    <button onclick="show_next_tab('permission_tab')" class="btn btn-primary"><i class="fa fa-arrow-left"></i>   Previous</button>
            {{-- <button onclick="save_data_show_next_tab('advance_details_tab')"
    class="btn btn-primary">Save & Continue</button> --}}
            <button onclick="show_next_tab('asset_tab')" class="btn btn-primary float-right">Next <i class="fa fa-arrow-right"></i>  </button>
</div>
