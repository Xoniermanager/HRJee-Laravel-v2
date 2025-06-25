@extends('layouts.company.main')
@section('content')
@section('title')
    Apply Leave
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            {{ session('error') }}
        </div>
        @endif
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        <form action="{{ route('leave.store') }}" method="post" id="apply_leave_form">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for=""  class="required">Leave Type</label>
                                        <select name="leave_type_id" class="form-control">
                                            <option value="">Please Select the Types</option>
                                            @foreach ($leaveTypes as $leaveType)
                                                <option value="{{ $leaveType->id }}" {{ old('leave_type_id') ==  $leaveType->id ? 'selected' : '' }}>{{ $leaveType->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('leave_type_id'))
                                            <div class="text-danger">{{ $errors->first('leave_type_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group pt-5">
                                        <input type="checkbox" name="leave_applied_by" id="behalf_checkbox"
                                            onclick="getEmployeeDetailsHtml()" value="1" {{ old('leave_applied_by') == '1' ? 'checked' : '' }}>
                                        <label for="">On Behalf Of Others</label>
                                        @if ($errors->has('leave_applied_by'))
                                            <div class="text-danger">{{ $errors->first('leave_applied_by') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group" style="display: none" id="employee_html">
                                        <label for="">Employee</label>
                                        <select name="user_id" class="form-control" id="employee_list">
                                            <option value="">Please Select the Employee</option>
                                            @foreach ($allEmployeeDetails as $employeeDetail)
                                                <option value="{{ $employeeDetail->id }}" {{ old('user_id') == $employeeDetail->id ? 'selected' : '' }}>{{ $employeeDetail->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <div class="text-danger">{{ $errors->first('user_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for=""  class="required">From</label>
                                        <input class="form-control" type="date" id="from"
                                            min="{{ date('Y-m-d') }}" name="from" value="{{ old('from')}}">
                                        @if ($errors->has('from'))
                                            <div class="text-danger">{{ $errors->first('from') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for=""  class="required">To</label>
                                        <input class="form-control" type="date" onchange="getDateValdation()"
                                            id="to" min="{{ date('Y-m-d') }}" name="to" value="{{ old('to')}}">
                                        @if ($errors->has('to'))
                                            <div class="text-danger">{{ $errors->first('to') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group pt-5">
                                        <input type="checkbox" id="half_day_checkbox" onclick="getHalfDayHtmlDetails()"
                                            name="is_half_day" value="1" {{ old('is_half_day') == '1' ? 'checked' : '' }}>
                                        <label for="">Is Half Day</label>
                                        @if ($errors->has('is_half_day'))
                                            <div class="text-danger">{{ $errors->first('is_half_day') }}</div>
                                        @endif
                                    </div>
                                    <div id="half_radio_button" style="display: none">
                                        <div id="from_to_day">
                                            <div class="col-md-4 form-group">
                                                <div class="col-md-12">
                                                    <label for="">From Half day</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="radio" name="from_half_day" value="first_half"
                                                        class="form-check-input me-2" {{ old('from_half_day') == 'first_half' ? 'checked' : '' }}>First half
                                                    <input type="radio" name="from_half_day" value="second_half"
                                                        class="form-check-input me-2" {{ old('from_half_day') == 'second_half' ? 'checked' : '' }}>Second half
                                                </div>
                                            </div>
                                            @if ($errors->has('from_half_day'))
                                                <div class="text-danger">{{ $errors->first('from_half_day') }}
                                                </div>
                                            @endif
                                            <div class="col-md-4 form-group">
                                                <div class="col-md-12">
                                                    <label for="">To Half day</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="radio" name="to_half_day" value="first_half"
                                                        class="form-check-input me-2" {{ old('to_half_day') == 'first_half' ? 'checked' : '' }}>First
                                                    half
                                                    <input type="radio" name="to_half_day" value="second_half"
                                                        class="form-check-input me-2" {{ old('to_half_day') == 'second_half' ? 'checked' : '' }}>Second
                                                    half
                                                </div>
                                            </div>
                                            @if ($errors->has('to_half_day'))
                                                <div class="text-danger">{{ $errors->first('to_half_day') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="one_day" style="display: none">
                                        <div class="col-md-4 form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="">Half Day</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <input class="form-check-input me-2" type="radio"
                                                        name="from_half_day" value="first_half" {{ old('from_half_day') == 'first_half' ? 'checked' : '' }}>First half
                                                    <input class="form-check-input me-2" type="radio"
                                                        name="from_half_day" value="second_half" {{ old('from_half_day') == 'second_half' ? 'checked' : '' }}>Second half
                                                </div>
                                            </div>
                                            @if ($errors->has('from_half_day'))
                                                <div class="text-danger">{{ $errors->first('from_half_day') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for=""  class="required">Reason</label>
                                        <textarea cols="55" name="reason" class="form-control">{{ old('reason') }}</textarea>
                                        @if ($errors->has('reason'))
                                            <div class="text-danger">{{ $errors->first('reason') }}</div>
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
        jQuery.validator.addMethod('required_if', function(value, element, required_ele) {
            let checked_applied_by = jQuery('#' + required_ele).is(':checked');
            if (checked_applied_by && !value) {
                return false;
            } else {
                return true;
            }
        }, 'Please enter some value');

        $('#employee_list').attr("disabled", "disabled");
        jQuery("#apply_leave_form").validate({
            rules: {
                leave_type_id: "required",
                from: "required",
                to: "required",
                reason: "required",
                user_id: {
                    required_if: 'behalf_checkbox'
                },
                from_half_day: {
                    required_if: 'half_day_checkbox'
                }
            },
            messages: {
                leave_type_id: "Please Select the Leave Type",
                from: "Please Select the date",
                to: "Please Select the date",
                reason: "Please enter the reason",
                user_id: {
                    required_if: "Please select the user for which leave is applied."
                },
                from_half_day: {
                    required_if: "Please select the Value"
                }
            },
        });
    });

    function getHalfDayHtmlDetails() {
        var checkbox = document.getElementById('half_day_checkbox');
        if (checkbox.checked != false) {
            $('#half_radio_button').show();
        } else {
            $('#half_radio_button').hide();
        }
    }

    function getEmployeeDetailsHtml() {
        var checkbox = document.getElementById('behalf_checkbox');
        if (checkbox.checked != false) {
            $('#employee_html').show();
            $('#employee_list').removeAttr("disabled");
        } else {
            $('#employee_list').attr("disabled", "disabled");
            $('#employee_html').hide();
        }
    }

    function getDateValdation() {
        let toDate = $('#to').val();
        let fromDate = $('#from').val();
        if (toDate == fromDate) {
            $('#one_day').show();
            $('#from_to_day').hide();
        }
        if (toDate != fromDate) {
            $('#one_day').hide();
            $('#from_to_day').show();
        }
        if (toDate < fromDate) {
            alert("Please Select the Date greater than from");
        }
    }
</script>
@endsection
