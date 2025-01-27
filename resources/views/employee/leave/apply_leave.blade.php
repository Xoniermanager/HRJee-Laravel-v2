@extends('layouts.employee.main')
@section('content')
@section('title')
    Apply Leave
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                    </div>
                @endif
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    
                    <div class="card-body">

                        <form action="{{ route('employee.apply.store') }}" method="post" id="apply_leave_form">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Leave Type</label>
                                        <select name="leave_type_id" class="form-control">
                                            <option value="">Please Select the Types</option>
                                            @foreach ($leaveTypes as $leaveType)
                                                <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('leave_type_id'))
                                            <div class="text-danger">{{ $errors->first('leave_type_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">From</label>
                                        <input class="form-control" type="date" id="from"
                                            min="{{ date('Y-m-d') }}" name="from">
                                        @if ($errors->has('from'))
                                            <div class="text-danger">{{ $errors->first('from') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">To</label>
                                        <input class="form-control" type="date" onchange="getDateValdation()"
                                            id="to" min="{{ date('Y-m-d') }}" name="to">
                                        @if ($errors->has('to'))
                                            <div class="text-danger">{{ $errors->first('to') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group pt-5">
                                        <input type="checkbox" id="half_day_checkbox" onclick="getHalfDayHtmlDetails()"
                                            name="is_half_day" value="1">
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
                                                        class="form-check-input me-2">First
                                                    half
                                                    <input type="radio" name="from_half_day" value="second_half"
                                                        class="form-check-input me-2">Second half
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
                                                        class="form-check-input me-2">First
                                                    half
                                                    <input type="radio" name="to_half_day" value="second_half"
                                                        class="form-check-input me-2">Second
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
                                                        name="from_half_day" value="first_half">First half
                                                    <input class="form-check-input me-2" type="radio"
                                                        name="from_half_day" value="second_half">Second half
                                                </div>
                                            </div>
                                            @if ($errors->has('from_half_day'))
                                                <div class="text-danger">{{ $errors->first('from_half_day') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Reason</label>
                                        <textarea cols="55" name="reason" class="form-control"></textarea>
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
        jQuery("#apply_leave_form").validate({
            rules: {
                leave_type_id: "required",
                from: "required",
                to: "required",
                reason: "required",
                from_half_day: {
                    required_if: 'half_day_checkbox'
                }
            },
            messages: {
                leave_type_id: "Please Select the Leave Type",
                from: "Please Select the date",
                to: "Please Select the date",
                reason: "Please enter the reason",
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
            $('#to').val('');
            return false;
        }
    }
</script>
@endsection
