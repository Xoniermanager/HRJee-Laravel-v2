@extends('layouts.company.main')
@section('content')
@section('title')
    Leave Management
@endsection
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
                        <form action="{{ route('leave.status.log.create') }}" method="post" id="leave_management">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label for="" class="required">Employee Leave</label>
                                        <select name="leave_id" class="form-control"
                                            onchange="get_details_using_leave_id()" id="leave_details">
                                            <option value="">Please Select Employee</option>
                                            @if (auth()->user()->type == 'company')
                                                @foreach ($allLeaveDetails as $leaveDetails)
                                                    <option value="{{ $leaveDetails->id }}">
                                                        {{ $leaveDetails->user->name }} ( {{ $leaveDetails->from }} To
                                                        {{ $leaveDetails->to }})</option>
                                                @endforeach
                                            @else
                                                @foreach ($allLeaveDetails as $leaveDetails)
                                                    @if(in_array(auth()->user()->id, $leaveDetails->user->managers->pluck('manager_id')->toArray()))
                                                    <option value="{{ $leaveDetails->id }}">
                                                        {{ $leaveDetails->user->name }} ( {{ $leaveDetails->from }} To
                                                        {{ $leaveDetails->to }})</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('leave_type_id'))
                                            <div class="text-danger">{{ $errors->first('leave_type_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-7" id="leave_applied_html">
                                    </div>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="" class="required">Leave Status </label>
                                    <select name="leave_status_id" class="form-control">
                                        <option value="">Please Select the Status</option>
                                        @foreach ($allLeaveStatusDetails as $leaveStatusDetails)
                                            <option value="{{ $leaveStatusDetails->id }}">
                                                {{ $leaveStatusDetails->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('leave_type_id'))
                                        <div class="text-danger">{{ $errors->first('leave_type_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="" class="required" >Remark </label>
                                    <textarea cols="55" name="remarks" class="form-control"></textarea>
                                    @if ($errors->has('reason'))
                                        <div class="text-danger">{{ $errors->first('reason') }}</div>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        jQuery("#leave_management").validate({
            rules: {
                leave_id: "required",
                leave_status_id: "required",
                remarks: "required",
            },
            messages: {
                leave_id: "Please Select the Employee Leave",
                leave_status_id: "Please Select the Leave Status",
                remarks: "Please enter the remark",
            },
        });

    });

    function get_details_using_leave_id() {
        var leaveID = $('#leave_details').find(':selected').val();
        if (leaveID) {
            $.ajax({
                url: "{{ route('leave.applied.details') }}",
                type: "GET",
                data: {
                    'leaveID': leaveID
                },
                success: function(response) {
                    $('#leave_applied_html').html('');
                    $('#leave_applied_html').append(response);
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Somethiong went Wrong!! Please try again"
                    });
                    return false;
                }
            });
        }
    }
</script>
@endsection
