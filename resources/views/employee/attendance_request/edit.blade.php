@extends('layouts.employee.main')
@section('content')
@section('title','Edit Attendance Request')
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
                        <form action="{{ route('employee.attendance.request.update',$editDetails->id) }}" method="post" id="apply_leave_form">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="required">Date</label>
                                        <input class="form-control" name="date" type="date" max="{{ date('Y-m-d') }}"
                                            value="{{ $editDetails->date}}">
                                            @if ($errors->has('date'))
                                            <div class="text-danger">{{ $errors->first('date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="required">Punch In Time</label>
                                        <input class="form-control" name="punch_in" type="time"
                                            value="{{ date("H:i", strtotime($editDetails->punch_in)) }}">
                                            @if ($errors->has('punch_in'))
                                            <div class="text-danger">{{ $errors->first('punch_in') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="required">Punch Out Time</label>
                                        <input class="form-control" name="punch_out" type="time"
                                            value="{{ date("H:i", strtotime($editDetails->punch_out))}}">
                                            @if ($errors->has('punch_out'))
                                            <div class="text-danger">{{ $errors->first('punch_out') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="required">Reason</label>
                                        <Textarea class="form-control" placeholder="Enter the reason"
                                            name="reason">{{ $editDetails->reason }}</Textarea>
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

@endsection
