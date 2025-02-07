@extends('layouts.company.main')
@section('content')
@section('title', 'Edit Salary Structure')
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
</style>
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    @if ($errors->any())
     @foreach ($errors->all() as $error)
           <div class="alert alert-danger" role="alert">
                 {{ $error }}
           </div>
    @endforeach
    @endif
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <form action="{{ route('salary.update',$salariesDetails->id) }}" method="post">
            @csrf
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="required">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ $salariesDetails->name }}">
                                    @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group">
                                    <label >Description</label>
                                    <textarea class="form-control" name="description">{{ $salariesDetails->description }}</textarea>
                                    @if ($errors->has('description'))
                                    <div class="text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card h-md-100 mt-4">
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        {{-- {{ dd($allSalaryComponentDetails) }} --}}
                        <div class="col-md-12">
                            <div class="row">
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
                                            @foreach ($salariesDetails->salaryComponentAssignments as $salaryComponentAssignmentDetails)
                                            @php
                                            $checkbox = '';
                                            if ($salaryComponentAssignmentDetails->salaryComponent->name === 'Basic pay' || $salaryComponentAssignmentDetails->salaryComponent->name === 'Special allowance')
                                            $checkbox = 'readonly';
                                            @endphp
                                            <tr>
                                                <td>
                                                    @if ($salaryComponentAssignmentDetails->salaryComponent->name === 'Basic pay' || $salaryComponentAssignmentDetails->salaryComponent->name === 'Special allowance')
                                                    <div class="d-flex align-items-center gap-1">
                                                        <input type="hidden" name="componentDetails[{{ $salaryComponentAssignmentDetails->salaryComponent->id }}][id]" value="{{ $salaryComponentAssignmentDetails->salaryComponent->id }}">
                                                        {{ $salaryComponentAssignmentDetails->salaryComponent->name }}
                                                    </div>
                                                    @else
                                                    <div class="d-flex align-items-center gap-1">
                                                        <input type="checkbox" name="componentDetails[{{ $salaryComponentAssignmentDetails->salaryComponent->id }}][id]" value="{{ $salaryComponentAssignmentDetails->salaryComponent->id }}" class="h-25px w-25px" checked>
                                                        {{ $salaryComponentAssignmentDetails->salaryComponent->name }}
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" value="{{ $salaryComponentAssignmentDetails->value }}" name="componentDetails[{{ $salaryComponentAssignmentDetails->salaryComponent->id }}][value]">
                                                </td>
                                                <td>
                                                    <div class="mt-2">
                                                        <input type="radio" name="componentDetails[{{ $salaryComponentAssignmentDetails->salaryComponent->id }}][earning_or_deduction]" value="earning" class="ml-2" {{ $salaryComponentAssignmentDetails->earning_or_deduction == 'earning' ? 'checked' : '' }} {{ $checkbox }}>
                                                        <label class="ml-1">Earning</label>
                                                        <input type="radio" name="componentDetails[{{ $salaryComponentAssignmentDetails->salaryComponent->id }}][earning_or_deduction]" value="deduction" class="ml-2" {{ $salaryComponentAssignmentDetails->earning_or_deduction == 'deduction' ? 'checked' : '' }} {{ $checkbox }}>
                                                        <label class="ml-1">Deduction</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mt-2">
                                                        <input type="radio" name="componentDetails[{{ $salaryComponentAssignmentDetails->salaryComponent->id }}][value_type]" value="fixed" class="ml-2" {{ $salaryComponentAssignmentDetails->value_type == 'fixed' ? 'checked' : '' }} {{ $checkbox }}>
                                                        <label class="ml-1">Fixed</label>
                                                        <input type="radio" name="componentDetails[{{ $salaryComponentAssignmentDetails->salaryComponent->id }}][value_type]" value="percentage" class="ml-2" {{ $salaryComponentAssignmentDetails->value_type == 'percentage' ? 'checked' : '' }} {{ $checkbox }}>
                                                        <label class="ml-1">Percentage</label>
                                                    </div>
                                                </td>
                                                @if ($salaryComponentAssignmentDetails->salaryComponent->name !== 'Basic pay' && $salaryComponentAssignmentDetails->salaryComponent->name !== 'Special allowance')
                                                <td>
                                                    <select name="componentDetails[{{ $salaryComponentAssignmentDetails->salaryComponent->id }}][parent_component]" class="form-control">
                                                        <option value="">Select Parent Component</option>
                                                        <option value="{{ $basicDetails->id }}" {{ $salaryComponentAssignmentDetails->parent_component == $basicDetails->id ? 'selected' : '' }}>{{ $basicDetails->name }}</option>
                                                    </select>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                            @foreach ($allSalaryComponentDetails as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <input type="checkbox" name="componentDetails[{{ $item->id }}][id]" value="{{ $item->id }}" class="h-25px w-25px" checked>
                                                        {{ $item->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" value="{{ $item->default_value }}" name="componentDetails[{{ $item->id }}][value]">
                                                </td>
                                                <td>
                                                    <div class="mt-2">
                                                        <input type="radio" name="componentDetails[{{ $item->id }}][earning_or_deduction]" value="earning" class="ml-2" {{ $item->earning_or_deduction == 'earning' ? 'checked' : '' }}>
                                                        <label class="ml-1">Earning</label>
                                                        <input type="radio" name="componentDetails[{{ $item->id }}][earning_or_deduction]" value="deduction" class="ml-2" {{ $item->earning_or_deduction == 'deduction' ? 'checked' : '' }}>
                                                        <label class="ml-1">Deduction</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mt-2">
                                                        <input type="radio" name="componentDetails[{{ $item->id }}][value_type]" value="fixed" class="ml-2" {{ $item->value_type == 'fixed' ? 'checked' : '' }}>
                                                        <label class="ml-1">Fixed</label>
                                                        <input type="radio" name="componentDetails[{{ $item->id }}][value_type]" value="percentage" class="ml-2" {{ $item->value_type == 'percentage' ? 'checked' : '' }}>
                                                        <label class="ml-1">Percentage</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select name="componentDetails[{{ $item->id }}][parent_component]" class="form-control">
                                                        <option value="">Select Parent Component</option>
                                                        <option value="{{ $basicDetails->id }}" {{ $item->parent_component == $basicDetails->id ? 'selected' : '' }}>{{ $basicDetails->name }}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            </form>
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
                e.preventDefault();
            }
        });
    });
</script>
<script>
   $("form").validate({
        rules: {
            // Validate name and description
            name: {
                required: true,
                minlength: 3
            },
            description: {
                required: false,
                minlength: 5
            },
            'componentDetails[][value]': {
                required: true,
                pattern: /^[0-9]*\.?[0-9]+$/, // Allows numbers and decimals
            },
            // Earning or Deduction radio buttons
            'componentDetails[][earning_or_deduction]': {
                required: true
            },
            // Value type radio buttons
            'componentDetails[][value_type]': {
                required: true
            },
            // Parent component dropdown
            'componentDetails[][parent_component]': {
                required: function (element) {
                    // Make the parent_component field required if value_type is "percentage"
                    return $('input[name="componentDetails[][value_type]"]:checked').val() === 'percentage';
                }
            }
        },
        messages: {
            // Custom error messages for name and description
            name: {
                required: "Please enter a name.",
                minlength: "Name must be at least 3 characters long."
            },
            description: {
                required: "Please enter a description.",
                minlength: "Description must be at least 5 characters long."
            },

            // Custom error messages for dynamic component details fields
            'componentDetails[][value]': {
                required: "Please enter a default value.",
                pattern: "Please enter a valid number."
            },
            'componentDetails[][earning_or_deduction]': {
                required: "Please select whether it's earning or deduction."
            },
            'componentDetails[][value_type]': {
                required: "Please select a value type."
            },
            'componentDetails[][parent_component]': {
                required: "Please select a parent component when the value type is percentage."
            }
        },
        errorClass: "text-danger", // Custom class for error messages
        errorElement: "div", // Error messages will be in <div> elements
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error'); // Add class on error
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error'); // Remove class when valid
        }
    });

    // Trigger re-validation for parent_component field when value_type changes
    $('input[name="componentDetails[][value_type]"]').on('change', function () {
        // Trigger re-validation on the parent_component field when value_type changes
        $("form").validate().element('select[name="componentDetails[][parent_component]"]');
    });
</script>
@endsection


