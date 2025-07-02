@extends('layouts.company.main')
@section('content')
@section('title')
    Payout Setting
@endsection

<div class="tab-pane fade active show" id="subcontent1" role="tabpanel" aria-labelledby="#subtab1">
    <div class="card-body">

        <form id="configurePayoutForm" action="{{ route('payout.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- LEFT HALF - Form Content -->
                <div class="col-md-6 pe-4">
                    <!-- 1) PRODUCT DROPDOWN -->
                    <div class="mb-4">
                        <label for="product" class="form-label">*
                            Product</label>
                        <select class="form-select" id="product" name="product_id" required>
                            <option value="">Select Product</option>
                            @foreach ($productDetails as $product)
                                <option value="{{ $product->id }}"
                                    {{ old('product') == $product->id ? 'selected' : '' }}>
                                    {{ $product->type }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_id'))
                            <div class="text-danger">
                                {{ $errors->first('product_id') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label for="lenderOption" class="form-label">
                            Select Lender</label>
                        <select class="form-select" id="lenderOption" name="lender_id">
                            <option value="">Select Lender</option>
                            @foreach ($lenderDetails as $lender)
                                <option value="{{ $lender->id }}"
                                    {{ old('lender_name') == $lender->id ? 'selected' : '' }}>
                                    {{ $lender->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>


                    <!-- 2) CHOOSE PAYOUT (Fixed vs Variable) - Horizontal Alignment -->
                    <div class="mb-4">
                        <label class="form-label">* Choose Payout</label>
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payout_type"
                                    id="payoutOptionVariable" value="VARIABLE" disabled>
                                <label class="form-check-label" for="payoutOptionVariable">
                                    Variable Payout
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payout_type" id="payoutFixed"
                                    value="FIXED" disabled>
                                <label class="form-check-label" for="payoutFixed">
                                    Fixed Payout
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- 3) VARIABLE PAYOUT STRUCTURE (hidden initially) - Horizontal Alignment -->
                    <div class="mb-4" id="variable-structure-block" style="display: none;">
                        <label class="form-label">* Choose Variable Payout
                            Structure</label>
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payout_structure"
                                    id="structureCase" value="CASE_LEVEL" disabled>
                                <label class="form-check-label" for="structureCase">
                                    Case Level
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payout_structure"
                                    id="structureSlab" value="SLAB_BASED" disabled>
                                <label class="form-check-label" for="structureSlab">
                                    Slab-Based
                                </label>
                            </div>
                        </div>

                        <!-- SLAB TABLE (hidden until "Slab-Based" is clicked) -->
                        <div id="slabTableContainer" class="mt-4" style="display: none;">
                            <label class="form-label fw-semibold">
                                * Payout Slab Configuration
                                <i class="bi bi-info-circle-fill text-secondary"
                                    title="Define payout for each slab range"></i>
                            </label>

                            <div class="table-responsive border payout-table rounded mt-2">
                                <table class="table mb-0 align-middle" style="table-layout: auto; min-width: 100%;">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="px-3 py-3">Min</th>
                                            <th class="px-3 py-3">Max</th>
                                            <th class="px-3 py-3">Payout As
                                            </th>
                                            <!-- Initially hidden -->
                                            <th id="amountHeader" class="px-3 py-3" style="display: none;">
                                                Amount
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="slabBody">
                                        <tr class="slab-row">
                                            <td class="px-3 py-3">
                                                <input type="number" class="form-control form-control-sm"
                                                    name="minimum_slab" min="0" placeholder="Min">
                                            </td>
                                            <td class="px-3 py-3">
                                                <input type="text" class="form-control form-control-sm text-muted"
                                                    name="maximum_slab" placeholder="Max">
                                            </td>
                                            <td class="px-3 py-3">
                                                <select class="form-select form-select-sm slabPayoutSelector"
                                                    name="payout_as">
                                                    <option value="" selected disabled>
                                                        Select Payout
                                                    </option>
                                                    <option value="FIXED">
                                                        Fixed Amount Per
                                                        Case
                                                        (₹)</option>
                                                    <option value="DISBURSEMENT">
                                                        Percentage of
                                                        Disbursement (%)
                                                    </option>
                                                </select>
                                            </td>
                                            <!-- Cell for “Amount” stays hidden until user selects a payout -->
                                            <td class="px-3 py-3 amountCell" style="display: none;">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text amt-prefix">₹</span>
                                                    <input type="number" class="form-control" name="amount"
                                                        min="0" placeholder="">
                                                    <span class="input-group-text unit-suffix"
                                                        style="display: none;">%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- 4) CHOOSE PAYOUT TYPE (hidden/disabled until appropriate) - Horizontal Alignment -->
                    <div class="mb-4">
                        <label class="form-label">* Choose Payout
                            Type</label>
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sub_payout_type"
                                    id="payoutTypeAmt" value="FIXED" disabled>
                                <label class="form-check-label" for="payoutTypeAmt">
                                    Fixed Amount Per Case (₹)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sub_payout_type"
                                    id="payoutTypePercent" value="DISBURSEMENT" disabled>
                                <label class="form-check-label" for="payoutTypePercent">
                                    Percentage of Disbursement %
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- 5) AMOUNT INPUT (₹ FIELD, hidden until needed) -->
                    <div class="mb-4" id="fixedAmountBlock" style="display: none;">
                        <input type="number" class="form-control" id="fixedAmountValue" name="fixed_amount"
                            placeholder="₹" min="0" disabled>
                    </div>

                    <!-- 6) EFFECTIVE FROM (Date Picker, disabled until Payout Type is chosen) -->
                    <div class="mb-4">
                        <label for="effectiveFrom" class="form-label">*
                            Effective From</label>
                        <input type="date" class="form-control" id="effectiveFrom" name="effective_from"
                            disabled>
                    </div>

                    <!-- 7) SAVE / CANCEL BUTTONS -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-outline-danger">Cancel</button>
                    </div>
                </div>

                <div class="col-md-6 ps-4">
                    @include('company.payout_setting.payout_list')
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    // // Disable payout options initially
    $('#lenderOption, #payoutFixed, #payoutOptionVariable').prop('disabled', true);

    $('#product').on('change', function() {
        const hasProduct = $(this).val();
        $('#lenderOption, #payoutFixed, #payoutOptionVariable')
            .prop('disabled', !hasProduct)
            .prop('checked', false);
    });

    function setDisabled($elements, disabled) {
        $elements.prop('disabled', disabled);
        if (disabled) $elements.prop('checked', false);
    }

    function hideAndClearSlab() {
        $('#slabTableContainer').hide();
        $('#slabBody').find('.slab-row:gt(0)').remove();
        let $first = $('#slabBody .slab-row').first();
        $first.find("input[name='minimum_slab'], input[name='maximum_slab']").val('');
        $first.find("select[name='payout_as']").val('');
        $first.find('.input-group').hide().find("input[name='amount']").val('');
    }

    $('#payoutFixed').on('change', function() {
        if (!this.checked) return;

        $('#variable-structure-block').hide();
        setDisabled($('#structureCase, #structureSlab'), true);
        hideAndClearSlab();

        setDisabled($('#payoutTypeAmt, #payoutTypePercent'), false);
        $('#fixedAmountBlock').hide();
        setDisabled($('#fixedAmountValue'), true);
        $('#effectiveFrom').prop('disabled', true);
    });

    $('#payoutOptionVariable').on('change', function() {
        if (!this.checked) return;

        $('#variable-structure-block').show();
        setDisabled($('#structureCase, #structureSlab'), false);

        setDisabled($('#payoutTypeAmt, #payoutTypePercent'), true);
        $('#fixedAmountBlock').hide();
        setDisabled($('#fixedAmountValue'), true);
        $('#effectiveFrom').prop('disabled', true);
    });

    $('#structureCase, #structureSlab').on('change', function() {
        if (this.checked) setDisabled($('#payoutTypeAmt, #payoutTypePercent'), false);
    });

    $('#structureSlab').on('change', function() {
        if (this.checked) $('#slabTableContainer').show();
    });

    $('#structureCase, #payoutFixed').on('change', hideAndClearSlab);

    $('#payoutTypeAmt').on('change', function() {
        if (this.checked) {
            $('#fixedAmountBlock').show();
            setDisabled($('#fixedAmountValue'), false);
            $('#effectiveFrom').prop('disabled', false);
        }
    });

    $('#payoutTypePercent').on('change', function() {
        if (this.checked) {
            $('#fixedAmountBlock').hide();
            setDisabled($('#fixedAmountValue'), true);
            $('#effectiveFrom').prop('disabled', false);
        }
    });

    $('#payoutFixed').on('change', function() {
        $('#structureCase, #structureSlab').prop('checked', false);
    });

    $('#payoutOptionVariable').on('change', function() {
        $('#payoutTypeAmt, #payoutTypePercent').prop('checked', false);
        $('#fixedAmountBlock').hide();
        setDisabled($('#fixedAmountValue'), true);
    });

    $('#slabBody').on('change', "select[name='payout_as']", function() {
        const $row = $(this).closest('.slab-row');
        const $inputGroup = $row.find('.input-group');
        const $prefix = $inputGroup.find('.amt-prefix');
        const $suffix = $inputGroup.find('.unit-suffix');

        if (this.value === 'FIXED') {
            $prefix.text('₹').show();
            $suffix.hide();
            $inputGroup.css('display', 'flex');
        } else if (this.value === 'DISBURSEMENT') {
            $prefix.text('').hide();
            $suffix.show();
            $inputGroup.css('display', 'flex');
        } else {
            $inputGroup.hide();
        }
    });

    $(document).on('change', '.slabPayoutSelector', function() {
        const $row = $(this).closest('.slab-row');
        const selectedValue = $(this).val();
        const $amountHdr = $('#amountHeader');
        const $amountCell = $row.find('.amountCell');
        const $prefixSpan = $amountCell.find('.amt-prefix');
        const $suffixSpan = $amountCell.find('.unit-suffix');

        $amountHdr.show();
        $amountCell.show();

        if (selectedValue === 'FIXED') {
            $prefixSpan.show();
            $suffixSpan.hide();
        } else if (selectedValue === 'DISBURSEMENT') {
            $prefixSpan.hide();
            $suffixSpan.show();
        }
    });

    $('#configurePayoutForm').validate({
        rules: {
            product_id: {
                required: true
            },
            payout_type: {
                required: true,
            },
            sub_payout_type: {
                required: true,
            },
            effective_from: {
                required: true,
            },
        },

        messages: {
            payout_type: {
                required: "Please choose payout"
            },
            sub_payout_type: {
                required: "Please choose sub payout"
            },
            product_id: {
                required: "Please select product",
            },
            effective_from: {
                required: "Please select effective date",
            },
        },

        submitHandler: function(form) {
            let formData = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    if (response) {
                        Swal.fire('Success', 'Payout configured!', 'success');
                        $('#payoutDetails').html(response);
                    } else {
                        Swal.fire('Warning', 'No data returned.', 'warning');
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                    let errorMsg = 'Something went wrong.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMsg, 'error');
                }
            });

            return false;
        }
    });
</script>
@endsection
