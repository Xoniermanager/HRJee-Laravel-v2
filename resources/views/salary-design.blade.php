@extends('layouts.company.main')
@section('title', 'Salary Design')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="col-lg-12 col-xl-12 col-xxl-12">
                <!--begin::Timeline widget 3-->
                <div class="card h-md-100 p-0">
                    <!--begin::Header-->
                    {{-- Header --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold text-primary ml-10">
                            <i class="fa fa-sack-dollar me-1"></i> Monthly Salary Design
                        </h4>
                        <div>
                            <button class="btn btn-success shadow-sm my-8" type="button" onclick="openComponentModal()">
                                <i class="fa fa-plus-circle"></i> Add Component
                            </button>
                        </div>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div>
                        <form method="POST" action="{{ route('salary-components.store') }}">
                            @csrf

                            {{-- Component Lists --}}
                            <div class="row">
                                {{-- Earnings --}}
                                <div class="col-md-6 p-8">
                                    <div class="card shadow-sm border-0 rounded-3">
                                        <div
                                            class="card-header bg-success text-white fw-semibold d-flex align-items-center py-4">
                                            <i class="fa fa-coins me-2"></i> Earnings
                                        </div>
                                        <div class="card-body p-3" id="earnings-list">
                                            @foreach($earnings as $i => $e)
                                                <div class="row g-2 align-items-center mb-2 component-item">
                                                    <input type="hidden" name="earnings[{{ $i }}][id]"
                                                        value="{{ $e->id ?? '' }}">
                                                    <div class="col-7">
                                                        <input type="text" name="earnings[{{ $i }}][name]"
                                                            value="{{ strtoupper($e->name) }}"
                                                            class="form-control form-control-sm bg-light" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="number" name="earnings[{{ $i }}][value]"
                                                            value="{{ $e->value }}" class="form-control form-control-sm" min="0"
                                                            step="0.01" required>
                                                    </div>
                                                    <div class="col-1 text-end">
                                                        @if(!in_array(strtolower($e->name), ['basic', 'hra']))
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                onclick="deleteComponent(this, '{{ $e->id ?? '' }}')"><i
                                                                    class="fa fa-times"></i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Deductions --}}
                                <div class="col-md-6 p-8">
                                    <div class="card shadow-sm border-0 rounded-3">
                                        <div class="card-header bg-danger text-white fw-semibold d-flex align-items-center">
                                            <i class="fa fa-minus-circle me-2"></i> Deductions
                                        </div>
                                        <div class="card-body p-3" id="deductions-list">
                                            @foreach($deductions as $i => $d)
                                                <div class="row g-2 align-items-center mb-2 component-item">
                                                    <input type="hidden" name="deductions[{{ $i }}][id]"
                                                        value="{{ $d->id ?? '' }}">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <input type="text" name="deductions[{{ $i }}][name]"
                                                                value="{{ strtoupper($d->name) }}"
                                                                class="form-control form-control-sm bg-light" readonly>
                                                            @if(in_array(strtolower($d->name), ['pf', 'esi']))
                                                                <i class="fa fa-info-circle text-info ms-2 cursor-pointer"
                                                                   data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   title="Click for calculation details"
                                                                   onclick="show{{ ucfirst(strtolower($d->name)) }}Info()"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="number" name="deductions[{{ $i }}][value]"
                                                            value="{{ $d->value }}"
                                                            class="form-control form-control-sm {{ in_array(strtolower($d->name), ['pf', 'esi']) ? 'bg-light' : '' }}"
                                                            min="0" step="0.01" required
                                                            {{ in_array(strtolower($d->name), ['pf', 'esi']) ? 'readonly' : '' }}>
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        @if(!in_array(strtolower($d->name), ['pf', 'esi']))
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                onclick="deleteComponent(this, '{{ $d->id ?? '' }}')"><i
                                                                    class="fa fa-times"></i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Summary --}}
                            <hr class="my-4">
                            <div class="card border-0 rounded-4 overflow-hidden shadow-sm p-4 custom-summary-card">
                                <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
                                    <i class="fa fa-wallet me-2"></i>
                                    <span class="fw-semibold">Summary of Components</span>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="summary-box border rounded-4 p-3 h-100 bg-white shadow-sm">
                                                <h6 class="fw-semibold text-success mb-3 d-flex align-items-center">
                                                    <i class="fa fa-cash-register me-2"></i> Earnings
                                                </h6>
                                                <ul id="summary-earnings" class="list-group list-group-flush small mb-3"></ul>
                                                <div class="border-top pt-2 d-flex justify-content-between">
                                                    <span class="fw-semibold text-muted">Total Earnings:</span>
                                                    <span id="total-earnings" class="fw-bold text-success">0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="summary-box border rounded-4 p-3 h-100 bg-white shadow-sm">
                                                <h6 class="fw-semibold text-danger mb-3 d-flex align-items-center">
                                                    <i class="fa fa-credit-card me-2"></i> Deductions
                                                </h6>
                                                <ul id="summary-deductions" class="list-group list-group-flush small mb-3"></ul>
                                                <div class="border-top pt-2 d-flex justify-content-between">
                                                    <span class="fw-semibold text-muted">Total Deductions:</span>
                                                    <span id="total-deductions" class="fw-bold text-danger">0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="border rounded-4 p-4 bg-light shadow-sm text-center">
                                            <h6 class="fw-semibold text-primary mb-2 d-flex justify-content-center align-items-center">
                                                <i class="fa fa-equals me-2"></i> Overall Total
                                            </h6>
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <span class="fw-semibold text-muted">Total Earnings - Total Deductions:</span>
                                                <span id="overall-total" class="fs-5 fw-bold text-primary">0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="text-end m-4">
                                <button class="btn btn-success shadow-sm"><i class="fa fa-save"></i> Save
                                    Components</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Component List Modal --}}
    <div class="modal fade" id="componentListModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fa fa-list"></i> Select Components</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        {{-- Earnings --}}
                        <div class="col-md-6">
                            <h6 class="fw-semibold text-success">EARNINGS</h6>
                            <div class="list-group" id="earning-components">
                                @forelse($earningComponents as $c)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="component"
                                            data-type="earning" value="{{ $c }}"> {{ $c }}
                                    </label>
                                @empty
                                    <div class="text-muted small">No earnings found.</div>
                                @endforelse
                                {{-- Separator --}}
                                <div class="border-top my-2"></div>
                                {{-- Add new earning component --}}
                                <div class="input-group input-group-sm mb-2">
                                    <input type="text" id="newEarningComponent" class="form-control"
                                        placeholder="Add new earning component if not listed">
                                    <button class="btn btn-outline-success" type="button"
                                        onclick="addNewComponent('earning')">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Deductions --}}
                        <div class="col-md-6">
                            <h6 class="fw-semibold text-danger">DEDUCTIONS</h6>
                            <div class="list-group" id="deduction-components">
                                @forelse($deductionComponents as $c)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="component"
                                            data-type="deduction" value="{{ $c }}"> {{ $c }}
                                    </label>
                                @empty
                                    <div class="text-muted small">No deductions found.</div>
                                @endforelse
                                {{-- Separator --}}
                                <div class="border-top my-2"></div>
                                {{-- Add new deduction component --}}
                                <div class="input-group input-group-sm mb-2">
                                    <input type="text" id="newDeductionComponent" class="form-control"
                                        placeholder="Add new deduction component if not listed">
                                    <button class="btn btn-outline-danger" type="button"
                                        onclick="addNewComponent('deduction')">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="addSelectedComponents()">
                        <i class="fa fa-check"></i> Add Selected
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- PF Information Modal --}}
    <div class="modal fade" id="pfInfoModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title text-white"><i class="fa fa-info-circle me-2"></i>PF Calculation Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold text-primary">Provident Fund (PF) Calculation:</h6>
                    <ul class="list-unstyled">
                        <li><strong>Rate:</strong> 12% of Basic Salary</li>
                        {{-- <li><strong>Ceiling:</strong> Maximum Basic for PF calculation is ₹15,000</li> --}}
                        <li><strong>Current Basic:</strong> ₹<span id="currentBasic">0</span></li>
                        {{-- <li><strong>PF Applicable Basic:</strong> ₹<span id="pfApplicableBasic">0</span></li> --}}
                        <li><strong>PF Amount:</strong> ₹<span id="pfAmount">0</span></li>
                    </ul>
                    <div class="alert alert-info small">
                        <i class="fa fa-lightbulb me-1"></i>
                        <strong>Note:</strong> PF is calculated as 12% of Basic Salary, but the maximum Basic salary considered for PF calculation is ₹15,000 per month.
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ESI Information Modal --}}
    <div class="modal fade" id="esiInfoModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title"><i class="fa fa-info-circle me-2"></i>ESI Calculation Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold text-primary">Employee State Insurance (ESI) Calculation:</h6>
                    <ul class="list-unstyled">
                        <li><strong>Rate:</strong> 0.75% of Gross Salary</li>
                        <li><strong>Ceiling:</strong> Applicable only if monthly salary ≤ ₹21,000</li>
                        <li><strong>Current Total Earnings:</strong> ₹<span id="currentGross">0</span></li>
                        <li><strong>ESI Applicable:</strong> <span id="esiApplicable">No</span></li>
                        <li><strong>ESI Amount:</strong> ₹<span id="esiAmount">0</span></li>
                    </ul>
                    <div class="alert alert-warning small">
                        <i class="fa fa-lightbulb me-1"></i>
                        <strong>Note:</strong> ESI is applicable only if the total monthly salary is ₹21,000 or less. If applicable, ESI is calculated as 0.75% of gross salary.
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        let earningIndex = {{ count($earnings) }};
        let deductionIndex = {{ count($deductions) }};

        // Initialize tooltips
        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
            updateSummary();
        });

        function addNewComponent(type) {
            let inputId = type === 'earning' ? '#newEarningComponent' : '#newDeductionComponent';
            let val = $(inputId).val().trim();
            if (val) {
                let displayText = val.toUpperCase();
                let container = $(`#${type}-components`);

                if (container.find('.other-heading').length === 0) {
                    container.append(`<div class="fw-semibold small text-muted mt-2 other-heading">Non Existing Component</div>`);
                }

                let html = `
                    <label class="list-group-item">
                      <input class="form-check-input me-1" type="checkbox" name="component" data-type="${type}" value="${displayText}" checked>
                      ${displayText}
                    </label>`;

                container.append(html);
                $(inputId).val('');
            }
        }

        function openComponentModal() {
            document.querySelectorAll('#componentListModal input[name="component"]').forEach(cb => cb.checked = false);
            $('#earnings-list input[name*="[name]"]').each(function () {
                let name = $(this).val().toUpperCase();
                $('#componentListModal input[data-type="earning"]').each(function () {
                    if (this.value.toUpperCase() === name) { this.checked = true; }
                });
            });
            $('#deductions-list input[name*="[name]"]').each(function () {
                let name = $(this).val().toUpperCase();
                $('#componentListModal input[data-type="deduction"]').each(function () {
                    if (this.value.toUpperCase() === name) { this.checked = true; }
                });
            });
            $('#componentListModal').modal('show');
        }

        function addSelectedComponents() {
            document.querySelectorAll('#componentListModal input[name="component"]:checked').forEach(cb => {
                let type = cb.dataset.type, exists = false;
                $(`#${type}s-list input[name*="[name]"]`).each(function () {
                    if ($(this).val().toUpperCase() === cb.value.toUpperCase()) { exists = true; }
                });
                if (!exists) {
                    let index = type === 'earning' ? earningIndex++ : deductionIndex++;
                    let readonly = (cb.value.toUpperCase() === 'PF' || cb.value.toUpperCase() === 'ESI') ? 'readonly' : '';
                    let bgClass = (cb.value.toUpperCase() === 'PF' || cb.value.toUpperCase() === 'ESI') ? 'bg-light' : '';
                    let infoIcon = '';

                    if (cb.value.toUpperCase() === 'PF' || cb.value.toUpperCase() === 'ESI') {
                        infoIcon = `<i class="fa fa-info-circle text-info ms-2 cursor-pointer"
                                      data-bs-toggle="tooltip"
                                      data-bs-placement="top"
                                      title="Click for calculation details"
                                      onclick="show${cb.value.charAt(0).toUpperCase() + cb.value.slice(1).toLowerCase()}Info()"></i>`;
                    }

                    let html = `
                        <div class="row g-2 align-items-center mb-2 component-item">
                            <input type="hidden" name="${type}s[${index}][id]" value="">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <input type="text" name="${type}s[${index}][name]" value="${cb.value}" class="form-control form-control-sm bg-light" readonly>
                                    ${infoIcon}
                                </div>
                            </div>
                            <div class="col-4">
                                <input type="number" name="${type}s[${index}][value]" class="form-control form-control-sm ${bgClass}" min="0" step="0.01" required ${readonly}>
                            </div>
                            <div class="col-2 text-end">
                                ${(cb.value.toUpperCase() !== 'PF' && cb.value.toUpperCase() !== 'ESI') ?
                                    `<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteComponent(this)"><i class="fa fa-times"></i></button>` :
                                    ''}
                            </div>
                        </div>`;
                    $(`#${type}s-list`).append(html);
                }
            });
            $('#componentListModal').modal('hide');
            $('[data-bs-toggle="tooltip"]').tooltip();
            updateSummary();
        }

        function deleteComponent(btn, id = null) {
            if (id) {
                Swal.fire({ title: 'Are you sure?', showCancelButton: true }).then(res => {
                    if (res.isConfirmed) {
                        $.ajax({
                            url: '/salary-components/' + id, type: 'DELETE', data: { _token: '{{csrf_token()}}' },
                            success: () => { $(btn).closest('.component-item').remove(); updateSummary(); }
                        });
                    }
                });
            } else {
                $(btn).closest('.component-item').remove();
                updateSummary();
            }
        }

        function calculatePF() {
            let basic = 0;
            $('#earnings-list input[name*="[name]"]').each(function() {
                if ($(this).val().toUpperCase() === 'BASIC') {
                    basic = parseFloat($(this).closest('.component-item').find('input[name*="[value]"]').val()) || 0;
                }
            });
            // PF calculation: 12% of Basic, max Basic for PF is 15000
             let pfApplicableBasic = Math.min(basic);
            let pfAmount = pfApplicableBasic * 0.12;
            // Update PF field
            $('#deductions-list input[name*="[name]"]').each(function() {
                if ($(this).val().toUpperCase() === 'PF') {
                    $(this).closest('.component-item').find('input[name*="[value]"]').val(pfAmount.toFixed(2));
                }
            });

            return { basic, pfApplicableBasic, pfAmount };
        }

        function calculateESI() {
            let totalEarnings = 0;
            $('#earnings-list input[name*="[value]"]').each(function() {
                totalEarnings += parseFloat(this.value) || 0;
            });

            // ESI calculation: 0.75% of gross salary if gross <= 21000
            let esiAmount = 0;
            let esiApplicable = totalEarnings <= 21000;

            if (esiApplicable) {
                esiAmount = totalEarnings * 0.0075;
            }

            // Update ESI field
            $('#deductions-list input[name*="[name]"]').each(function() {
                if ($(this).val().toUpperCase() === 'ESI') {
                    $(this).closest('.component-item').find('input[name*="[value]"]').val(esiAmount.toFixed(2));
                }
            });

            return { totalEarnings, esiApplicable, esiAmount };
        }

        function updateSummary() {
            // Calculate PF and ESI first
            calculatePF();
            calculateESI();

            let e = 0, d = 0;
            $('#summary-earnings').empty();
            $('#earnings-list input[name*="[value]"]').each(function () {
                let v = parseFloat(this.value) || 0;
                e += v;
                $('#summary-earnings').append(`<li class="list-group-item d-flex justify-content-between">${$(this).closest('.component-item').find('input[name*="[name]"]').val()}<span>${v.toFixed(2)}</span></li>`);
            });

            $('#summary-deductions').empty();
            $('#deductions-list input[name*="[value]"]').each(function () {
                let v = parseFloat(this.value) || 0;
                d += v;
                $('#summary-deductions').append(`<li class="list-group-item d-flex justify-content-between">${$(this).closest('.component-item').find('input[name*="[name]"]').val()}<span>${v.toFixed(2)}</span></li>`);
            });

            $('#total-earnings').text(e.toFixed(2));
            $('#total-deductions').text(d.toFixed(2));

            let net = e - d;
            $('#overall-total').text(net.toFixed(2));
        }

        function showPfInfo() {
            let pfData = calculatePF();
            $('#currentBasic').text(pfData.basic.toFixed(2));
            $('#pfApplicableBasic').text(pfData.pfApplicableBasic.toFixed(2));
            $('#pfAmount').text(pfData.pfAmount.toFixed(2));
            $('#pfInfoModal').modal('show');
        }

        function showEsiInfo() {
            let esiData = calculateESI();
            $('#currentGross').text(esiData.totalEarnings.toFixed(2));
            $('#esiApplicable').text(esiData.esiApplicable ? 'Yes' : 'No');
            $('#esiAmount').text(esiData.esiAmount.toFixed(2));
            $('#esiInfoModal').modal('show');
        }

        // Event listeners
        $(document).on('input', 'input[name$="[value]"]', function() {
            // Don't allow manual editing of PF and ESI
            let componentName = $(this).closest('.component-item').find('input[name*="[name]"]').val().toUpperCase();
            if (componentName === 'PF' || componentName === 'ESI') {
                return false;
            }
            updateSummary();
        });

        $(document).ready(updateSummary);
    </script>

    {{-- Optional style --}}
    <style>
        .component-item:hover {
            background: rgba(0, 123, 255, 0.05);
            border-radius: .375rem;
        }

        .card-header {
            font-size: 1.1rem;
            text-transform: uppercase;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: #fff;
        }

        .card .card-header {
            min-height: 47px !important;
        }

        .summary-box {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #e7eaf0;
            border-radius: 0.75rem;
            background-color: #ffffff;
        }

        .summary-box:hover {
            background-color: #f9fafb;
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        }

        .bg-gradient-primary {
            background: linear-gradient(90deg, #0d6efd, #3b82f6);
        }

        .card-header {
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            border-bottom: none;
            padding: 0.75rem 1rem;
        }

        .list-group-item {
            padding: 0.4rem 0.6rem;
            border: none;
        }

        #overall-total {
            font-size: 1.4rem;
            color: #0d6efd;
        }

        .border-top {
            border-top: 1px solid #e7eaf0 !important;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .fa-info-circle:hover {
            color: #0d6efd !important;
        }
    </style>
@endsection
