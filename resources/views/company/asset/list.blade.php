<div class="table-responsive" id="asset_list">
    <!--begin::Table-->
    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
        <!--begin::Table head-->
        <thead>
            <tr class="fw-bold">
                <th>Sr. No.</th>
                <th>Name</th>
                <th>Asset Category</th>
                <th>Asset Manufacturer</th>
                <th>Model</th>
                <th>Serial No</th>
                <th>Invoice No</th>
                <th>Allocation Status</th>
                <th>OwnerShip</th>
                <th class="float-right">Action</th>
            </tr>
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="">
            @forelse ($allAssetDetails as $index => $singleAssetDetails)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $singleAssetDetails->name }}</td>
                <td>{{ $singleAssetDetails->assetCategories->name }}</td>
                <td>{{ $singleAssetDetails->assetManufacturers->name }}</td>
                <td>{{ $singleAssetDetails->model }}</td>
                <td>{{ $singleAssetDetails->serial_no }}</td>
                <td>{{ $singleAssetDetails->invoice_no }}</td>
                <td>{{ $singleAssetDetails->allocation_status }}</td>
                <td>{{ $singleAssetDetails->ownership }}</td>
                <td>
                    <div class="d-flex justify-content-end flex-shrink-0">
                        <a href="{{ route('asset.edit', $singleAssetDetails->id) }}"
                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                            <i class="fa fa-edit"></i>
                            <!--end::Svg Icon-->
                        </a>
                        <a href="#"
                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                            onclick="deleteFunction('{{ $singleAssetDetails->id }}')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <td colspan="3">
                <span class="text-danger">
                    <strong>No Asset Found!</strong>
                </span>
            </td>
            @endforelse
        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
</div>