<div class="card-body py-3" id="tax_slab_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Income Range Start</th>
                    <th>Income Range End</th>
                    <th>Tax Rate</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($allTaxRateDetails as $key => $taxRateDetail)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_taxslab_details('{{ $taxRateDetail->id }}', '{{ $taxRateDetail->income_range_start }}','{{ $taxRateDetail->tax_rate }}','{{ $taxRateDetail->income_range_end }}')">{{ $taxRateDetail->income_range_start }}</a>
                        </td>
                        <td>{{ $taxRateDetail->income_range_end }}</td>
                        <td>{{ $taxRateDetail->tax_rate }} %</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $taxRateDetail->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $taxRateDetail->id }})" id="checked_value_status_{{$taxRateDetail->id}}">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                onClick="edit_taxslab_details('{{ $taxRateDetail->id }}', '{{ $taxRateDetail->income_range_start }}','{{ $taxRateDetail->tax_rate }}','{{ $taxRateDetail->income_range_end }}')"
                                    class="btn btn-icon btn-primary btn-sm me-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-danger btn-sm me-1"
                                    onclick="deleteFunction('{{ $taxRateDetail->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No TaxRate Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allTaxRateDetails->links() }}
</div>
