@extends('layouts.company.main')

@section('title', 'Add Asset')

@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <div class="card h-md-100">
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        <form action="{{ route('asset.store') }}" method="post" id="asset_create_form" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label>Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Asset Category *</label>
                                        <select name="asset_category_id" class="form-control">
                                            <option value="">Please Select the Category</option>
                                            @foreach ($allAssetCategory as $assetCategory)
                                                <option value="{{ $assetCategory->id }}" {{ old('asset_category_id') == $assetCategory->id ? 'selected' : '' }}>
                                                    {{ $assetCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('asset_category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Asset Manufacturer *</label>
                                        <select name="asset_manufacturer_id" class="form-control">
                                            <option value="">Please Select the Manufacturer</option>
                                            @foreach ($allAssetManufacturer as $assetManufacturer)
                                                <option value="{{ $assetManufacturer->id }}" {{ old('asset_manufacturer_id') == $assetManufacturer->id ? 'selected' : '' }}>
                                                    {{ $assetManufacturer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('asset_manufacturer_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Model *</label>
                                        <input type="text" name="model" class="form-control" value="{{ old('model') }}">
                                        @error('model')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Purchase Value *</label>
                                        <input type="number" name="purchase_value" class="form-control" value="{{ old('purchase_value') }}">
                                        @error('purchase_value')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Depreciation Interest/Year</label>
                                        <input type="text" name="depreciation_per_year" class="form-control" value="{{ old('depreciation_per_year') }}">
                                        @error('depreciation_per_year')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Invoice No</label>
                                        <input type="text" name="invoice_no" class="form-control" value="{{ old('invoice_no') }}">
                                        @error('invoice_no')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Invoice Date *</label>
                                        <input type="date" name="invoice_date" class="form-control" value="{{ old('invoice_date') }}">
                                        @error('invoice_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Validation Upto *</label>
                                        <input type="date" name="validation_upto" class="form-control" value="{{ old('validation_upto') }}">
                                        @error('validation_upto')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Serial No *</label>
                                        <input type="text" name="serial_no" class="form-control" value="{{ old('serial_no') }}">
                                        @error('serial_no')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Invoice file</label>
                                        <input type="file" name="invoice_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                                        @error('invoice_file')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group mt-5 pt-1">
                                        <div class="toggle">
                                            <input type="radio" name="ownership" value="owned" id="sizeWeight" {{ old('ownership', 'owned') == 'owned' ? 'checked' : '' }} />
                                            <label for="sizeWeight">Owned</label>
                                            <input type="radio" name="ownership" value="rented" id="sizeDimensions" {{ old('ownership') == 'rented' ? 'checked' : '' }} />
                                            <label for="sizeDimensions">Rented</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Add custom method for name validation (alpha and space only)
        $.validator.addMethod("alphaSpace", function (value, element) {
            return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
        }, "Name can only contain letters and spaces");

        $("#asset_create_form").validate({
            rules: {
                name: {
                    required: true,
                    alphaSpace: true
                },
                asset_category_id: "required",
                asset_manufacturer_id: "required",
                model: "required",
                purchase_value: "required",
                invoice_date: "required",
                serial_no: "required",
                validation_upto: "required",
            },
            messages: {
                name: {
                    required: "Please Enter the Name",
                    alphaSpace: "Name can only contain letters and spaces"
                },
                asset_category_id: "Please Select the Asset Category",
                asset_manufacturer_id: "Please Select the Asset Manufacturer",
                model: "Please Enter the Model",
                purchase_value: "Please Enter the Purchase Value",
                invoice_date: "Please Select the date",
                serial_no: "Please Enter the Serial Value",
                validation_upto: "Please Select the Validation Date",
            }
        });
    });
</script>
@endsection
