<div class="row" id="user_asset_list">
    @foreach ($userAssetsDetails as $assetDetails)
        <div class="col-md-4">
            <div class="panel" id="apnd">
                <div class="panel-head">
                    <h4 class="">{{ $assetDetails->asset->name }}
                        <a href="#" class="btn btn-danger btn btn-sm float-right m-0"
                            onclick="get_details_for_deallocate_asset('{{ $assetDetails->asset->name }}','{{ $assetDetails->asset->asset_category_id }}','{{ $assetDetails->assigned_date }}','{{ $assetDetails->id }}')"><i
                                class="fa fa-trash"></i></a>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row form-group" id="apnd_1">
                        <label>Asset Manufacture : <span
                                class="float-right fw-normal fs-6">{{ $assetDetails->asset->assetManufacturers->name }}</span></label>
                        <label>Asset Category : <span
                                class="float-right fw-normal fs-6">{{ $assetDetails->asset->assetCategories->name }}</span></label>
                        <label>Model : <span
                                class="float-right fw-normal fs-6">{{ $assetDetails->asset->model }}</span></label>
                        <label>Serial No. : <span
                                class="float-right fw-normal fs-6">{{ $assetDetails->asset->serial_no }}</span></label>
                        <label>Invoice No. : <span
                                class="float-right fw-normal fs-6">{{ $assetDetails->asset->invoice_no }}</span></label>
                        <label>Assigned Date : <span
                                class="float-right fw-normal fs-6">{{ $assetDetails->assigned_date }}</span></label>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
