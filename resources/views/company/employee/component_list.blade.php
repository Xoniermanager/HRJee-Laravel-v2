<style>
    input[type="checkbox"][readonly] {
        pointer-events: none;
    }
    input[type="radio"][readonly] {
        pointer-events: none;
    }
   select[readonly] {
        pointer-events: none;
    }
    .header_box {
    background: #ecf6f9 !important;
    border-radius: 20px !important;
    margin-bottom: 20px;
    border: 1px soliD #8edaf3 !important;
    }
    .ttilte_textt {
    background: #d2edf5 !important;
    border: 1px solid #6bceef;
    margin-top: -30px;
    border-radius: 15px !important;
}
</style>
<div class="card h-md-100 mt-4">
    <!--begin::Header-->
    <div class="card-header p-0 align-items-center header_box">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-auto text-center">
                        <h4 class="ttilte_textt"> Salary Component Structure</h4>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 text-center">
                            <thead>
                                <tr>
                                    <th>Salary Component</th>
                                    <th> Value</th>
                                    <th>Earning Or Deduction</th>
                                    <th>Value Type</th>
                                    <th> Parent Component</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allSalaryComponentDetails as $key => $item)
                                @php
                                $checkbox = '';
                                if ($item->salaryComponent->name === 'Basic pay' || $item->salaryComponent->name === 'Special allowance')
                                $checkbox = 'readonly';
                                @endphp
                                @if (isset($item->user_ctc_history_id) && !empty(isset($item->user_ctc_history_id)))
                                <tr>
                                    <td>
                                        @if ($item->salaryComponent->name === 'Basic pay' || $item->salaryComponent->name === 'Special allowance')
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="hidden" name="componentDetails[{{ $item->salary_component_id }}][salary_component_id]" value="{{ $item->salary_component_id }}">
                                            {{ $item->salaryComponent->name }}
                                        </div>
                                        @else
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="checkbox" name="componentDetails[{{ $item->salary_component_id }}][salary_component_id]" value="{{ $item->salary_component_id }}" class="h-25px w-25px" checked>
                                            {{ $item->salaryComponent->name }}
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" value="{{ $item->value }}" name="componentDetails[{{ $item->salary_component_id }}][value]">
                                    </td>
                                    <td>
                                        <div class="mt-2">
                                            <input type="radio" name="componentDetails[{{ $item->salary_component_id }}][earning_or_deduction]" value="earning" class="ml-2" {{ $item->earning_or_deduction == 'earning' ? 'checked' : '' }} {{ $checkbox }}>
                                            <label class="ml-1">Earning</label>
                                            <input type="radio" name="componentDetails[{{ $item->salary_component_id }}][earning_or_deduction]" value="deduction" class="ml-2" {{ $item->earning_or_deduction == 'deduction' ? 'checked' : '' }} {{ $checkbox }}>
                                            <label class="ml-1">Deduction</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mt-2">
                                            <input type="radio" name="componentDetails[{{ $item->salary_component_id }}][value_type]" value="fixed" class="ml-2" {{ $item->value_type == 'fixed' ? 'checked' : '' }} {{ $checkbox }}>
                                            <label class="ml-1">Fixed</label>
                                            <input type="radio" name="componentDetails[{{ $item->salary_component_id }}][value_type]" value="percentage" class="ml-2" {{ $item->value_type == 'percentage' ? 'checked' : '' }} {{ $checkbox }}>
                                            <label class="ml-1">Percentage</label>
                                        </div>
                                    </td>
                                    @if ($item->salaryComponent->name !== 'Basic pay' && $item->salaryComponent->name !== 'Special allowance')
                                    <td>
                                        <select name="componentDetails[{{ $item->salary_component_id }}][parent_component]" class="form-control">
                                            <option value="">Select Parent Component</option>
                                            <option value="{{ $basicDetails->id }}" {{ $item->parent_component == $basicDetails->id ? 'selected' : '' }}>{{ $basicDetails->name }}</option>
                                        </select>
                                    </td>
                                    @endif
                                </tr>
                                @else
                                <tr>
                                    <td>
                                        @if ($item->salaryComponent->name === 'Basic pay' || $item->salaryComponent->name === 'Special allowance')
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="hidden" name="componentDetails[{{ $item->salary_component_id }}][salary_component_id]" value="{{ $item->salary_component_id }}">
                                            {{ $item->salaryComponent->name }}
                                        </div>
                                        @else
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="checkbox" name="componentDetails[{{ $item->salary_component_id }}][salary_component_id]" value="{{ $item->salary_component_id }}" class="h-25px w-25px" checked>
                                            {{ $item->salaryComponent->name }}
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" value="{{ $item->value }}" name="componentDetails[{{ $item->salary_component_id }}][value]">
                                    </td>
                                    <td>
                                        <div class="mt-2">
                                            <input type="radio" name="componentDetails[{{ $item->salary_component_id }}][earning_or_deduction]" value="earning" class="ml-2" {{ $item->earning_or_deduction == 'earning' ? 'checked' : '' }} {{ $checkbox }}>
                                            <label class="ml-1">Earning</label>
                                            <input type="radio" name="componentDetails[{{ $item->salary_component_id }}][earning_or_deduction]" value="deduction" class="ml-2" {{ $item->earning_or_deduction == 'deduction' ? 'checked' : '' }} {{ $checkbox }}>
                                            <label class="ml-1">Deduction</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mt-2">
                                            <input type="radio" name="componentDetails[{{ $item->salary_component_id }}][value_type]" value="fixed" class="ml-2" {{ $item->value_type == 'fixed' ? 'checked' : '' }} {{ $checkbox }}>
                                            <label class="ml-1">Fixed</label>
                                            <input type="radio" name="componentDetails[{{ $item->salary_component_id }}][value_type]" value="percentage" class="ml-2" {{ $item->value_type == 'percentage' ? 'checked' : '' }} {{ $checkbox }}>
                                            <label class="ml-1">Percentage</label>
                                        </div>
                                    </td>
                                    @if ($item->salaryComponent->name !== 'Basic pay' && $item->salaryComponent->name !== 'Special allowance')
                                    <td>
                                        <select name="componentDetails[{{ $item->salary_component_id }}][parent_component]" class="form-control">
                                            <option value="">Select Parent Component</option>
                                            <option value="{{ $basicDetails->id }}" {{ $item->parent_component == $basicDetails->id ? 'selected' : '' }}>{{ $basicDetails->name }}</option>
                                        </select>
                                    </td>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').on('change', function() {
            var row = $(this).closest('tr');
            if ($(this).prop('checked')) {
                row.find('input[type="number"], input[type="radio"], select').attr('required', 'required');
                row.find('input[type="number"], input[type="radio"], select').prop('disabled', false);
            } else {
                row.find('input[type="number"], input[type="radio"], select').removeAttr('required');
                row.find('input[type="number"], input[type="radio"], select').prop('disabled', true);
            }
        });
        $('#salaryForm').on('submit', function(e) {
            var valid = true;
            $('input[required], select[required]').each(function() {
                if ($(this).val() === '') {
                    valid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!valid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });
</script>
