@extends('layouts.company.main')
@section('content')
@section('title','Add Salary Component')
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
                        <form action="{{ route('salary.component.store') }}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="required">Name</label>
                                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="required">Default Value</label>
                                        <input class="form-control" type="text" name="default_value" value="{{ old('default_value') }}" pattern="^[0-9]*\.?[0-9]+$">
                                        @if ($errors->has('default_value'))
                                            <div class="text-danger">{{ $errors->first('default_value') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="required">Value Type</label>
                                        <div class="mt-2">
                                            <input type="radio" name="value_type" value="fixed" class="ml-2" {{ old('value_type') == 'fixed' ? 'checked' : '' }}>
                                            <label class="ml-1">Fixed</label>
                                            <input type="radio" name="value_type" value="percentage" class="ml-1" {{ old('value_type') == 'percentage' ? 'checked' : '' }}>
                                            <label class="ml-2">Percentage</label>
                                        </div>
                                        @if ($errors->has('value_type'))
                                        <div class="text-danger">{{ $errors->first('value_type') }}</div>
                                    @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="">Parent Component</label>
                                        <select name="parent_component" id="" class="form-control">
                                            <option value="">Select Any Component</option>
                                            <option value="{{ $basicDetails->id }}" {{ old('parent_component') == $basicDetails->id ? 'selected' : '' }}>{{ $basicDetails->name }}</option>
                                        </select>
                                        @if ($errors->has('parent_component'))
                                            <div class="text-danger">{{ $errors->first('parent_component') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="required">Earning Or Deduction</label>
                                        <div class="mt-2">
                                            <input type="radio" name="earning_or_deduction" value="earning"  class="ml-1" {{ old('earning_or_deduction') == 'earning' ? 'checked' : '' }}><label class="ml-2">Earning</label>
                                            <input type="radio" name="earning_or_deduction" value="deduction" class="ml-1" {{ old('earning_or_deduction') == 'deduction' ? 'checked' : '' }}><label class="ml-2">Deduction</label>
                                        </div>
                                        @if ($errors->has('earning_or_deduction'))
                                        <div class="text-danger">{{ $errors->first('earning_or_deduction') }}
                                        </div>
                                    @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="required">Is Default</label>
                                        <div class="mt-2">
                                            <input type="radio" name="is_default" value="1" class="ml-2" {{ old('is_default') == '1' ? 'checked' : '' }}>
                                            <label class="ml-1">Yes</label>
                                            <input type="radio" name="is_default" value="0" class="ml-2" {{ old('is_default') == '0' ? 'checked' : '' }}>
                                            <label class="ml-1">No</label>
                                        </div>
                                          @if ($errors->has('is_default'))
                                                <div class="text-danger">{{ $errors->first('is_default') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                default_value: {
                    required: true,
                    pattern: /^[0-9]*\.?[0-9]+$/
                },
                value_type: {
                    required: true
                },
                earning_or_deduction: {
                    required: true
                },
                is_default: {
                    required: true
                },
                parent_component: {
                    required: function() {
                        // Make the parent_component field required if the value_type is "percentage"
                        return $('input[name="value_type"]:checked').val() === 'percentage';
                    }
                }
            },
            messages: {
                name: {
                    required: "Please enter a name.",
                    minlength: "Name must be at least 3 characters long."
                },
                default_value: {
                    required: "Please enter a default value.",
                    pattern: "Please enter a valid number."
                },
                value_type: {
                    required: "Please select a value type."
                },
                earning_or_deduction: {
                    required: "Please select whether it's earning or deduction."
                },
                is_default: {
                    required: "Please select whether it is default."
                },
                parent_component: {
                    required: "Please select a parent component when the value type is percentage."
                }
            },
            errorClass: "text-danger", // Custom class for error messages
            errorElement: "div", // Error messages will be in <div> elements
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error'); // Add class on error
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error'); // Remove class when valid
            }
        });
        $('input[name="value_type"]').on('change', function() {
            // Trigger re-validation on the parent_component field when value_type changes
            $("form").validate().element('select[name="parent_component"]');
        });
    });
</script>
@endsection
