@extends('layouts.employee.main')
@section('content')
@section('title', 'Apply Comp Off')
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

                        <form action="{{ route('employee.comp.off.store') }}" method="post" id="apply_comp_off_form">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label>Balance Comp Off</label>
                                        <input class="form-control" name="punch_in" type="text" disabled
                                            value="{{ $balanceCompOff }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="required">Start Date</label>
                                        <input class="form-control" name="start_date" type="date" value="{{ old('start_date') }}">
                                        @if ($errors->has('start_date'))
                                            <div class="text-danger">{{ $errors->first('start_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="required">End Date</label>
                                        <input class="form-control" name="end_date" type="date" value="{{ old('end_date') }}">
                                        @if ($errors->has('end_date'))
                                            <div class="text-danger">{{ $errors->first('end_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="required">Remark</label>
                                        <Textarea class="form-control" placeholder="Enter the remarks" name="user_remark">{{ old('user_remark') }}</Textarea>
                                        @if ($errors->has('user_remark'))
                                            <div class="text-danger">{{ $errors->first('user_remark') }}</div>
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
