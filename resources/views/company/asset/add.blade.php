@extends('layouts.company.main')
@section('content')
@section('title')
    Add Asset
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        <form action="{{ route('asset.store') }}" method="post" id="asset_create_form" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                        @if ($errors->has('reason'))
                                            <div class="text-danger">{{ $errors->first('reason') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Asset Category *</label>
                                        <select name="asset_category_id" class="form-control">
                                            <option value="">Please Select the Category</option>
                                            @foreach ($allAssetCategory as $assetCategory)
                                                <option {{old('asset_category_id') == $assetCategory->id ? 'selected' : ''}} value="{{ $assetCategory->id }}">
                                                    {{ $assetCategory->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('asset_category_id'))
                                            <div class="text-danger">{{ $errors->first('asset_category_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Asset Manufacturer *</label>
                                        <select class="form-control" name="asset_manufacturer_id">
                                            <option value="">Please Select the Manufacturer</option>
                                            @foreach ($allAssetManufacturer as $assetManufacturer)
                                                <option {{old('asset_manufacturer_id') == $assetManufacturer->id ? 'selected' : ''}} value="{{ $assetManufacturer->id }}">
                                                    {{ $assetManufacturer->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('asset_manufacturer_id'))
                                            <div class="text-danger">{{ $errors->first('asset_manufacturer_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Model *</label>
                                        <input type="text" name="model" id="" class="form-control" value="{{old('model')}}">
                                        @if ($errors->has('model'))
                                            <div class="text-danger">{{ $errors->first('model') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Purchase Value *</label>
                                        <input type="text" name="purchase_value" id="" class="form-control" value="{{old('purchase_value')}}">
                                        @if ($errors->has('purchase_value'))
                                            <div class="text-danger">{{ $errors->first('purchase_value') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Depreciation Interest/Year</label>
                                        <input type="text" name="depreciation_per_year" id="" class="form-control" value="{{old('name')}}">
                                        @if ($errors->has('depreciation_per_year'))
                                            <div class="text-danger">{{ $errors->first('depreciation_per_year') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Invoice No</label>
                                        <input type="text" name="invoice_no" id="" class="form-control" value="{{old('invoice_no')}}">
                                        @if ($errors->has('invoice_no'))
                                            <div class="text-danger">{{ $errors->first('invoice_no') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Invoice Date *</label>
                                        <input type="date" name="invoice_date" id="" class="form-control" value="{{old('invoice_date')}}">
                                        @if ($errors->has('invoice_date'))
                                            <div class="text-danger">{{ $errors->first('invoice_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Validation Upto *</label>
                                        <input type="date" name="validation_upto" id="" class="form-control" value="{{old('validation_upto')}}">
                                        @if ($errors->has('validation_upto'))
                                            <div class="text-danger">{{ $errors->first('validation_upto') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Serial No *</label>
                                        <input type="text" name="serial_no" id="" class="form-control" value="{{old('serial_no')}}">
                                        @if ($errors->has('serial_no'))
                                            <div class="text-danger">{{ $errors->first('serial_no') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Invoice file</label>
                                        <input type="file" name="invoice_file" class="form-control" value="{{old('invoice_file')}}">
                                        @if ($errors->has('invoice_file'))
                                            <div class="text-danger">{{ $errors->first('invoice_file') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group mt-5 pt-1">
                                        <div class="toggle">
                                            <input type="radio" name="ownership" value="owned" id="sizeWeight"
                                                checked="checked" {{old('ownership') == 'owned' ? 'checked' : ''}} />
                                            <label for="sizeWeight">Owned</label>
                                            <input type="radio" name="ownership" value="rented" id="sizeDimensions" {{old('ownership') == 'rented' ? 'checked' : ''}}/>
                                            <label for="sizeDimensions">Rented</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() 
    {
        jQuery("#asset_create_form").validate
        ({
            rules: {
                name: "required",
                asset_category_id : "required",
                asset_manufacturer_id : "required",
                model : "required",
                purchase_value : "required",
                invoice_date : "required",
                serial_no: "required",
                validation_upto: "required",
                serial_no : "required"
            },
            messages: {
                name: "Please Enter the Name",
                asset_category_id : "Please Select the Asset Category",
                asset_manufacturer_id : "Please Select the Asset Manufacturer",
                model : "Please Enter the Model",
                purchase_value : "Please Enter the Purchase Value",
                invoice_date : "Please Select the date",
                serial_no: "Please Enter the Serial Value",
                validation_upto: "Please Select the Validation Date",
                serial_no : "Please Enter the Serial No"
            },
        });
    }); 
</script>
@endsection
