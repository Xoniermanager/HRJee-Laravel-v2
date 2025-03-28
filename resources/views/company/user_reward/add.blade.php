@extends('layouts.company.main')
@section('content')
@section('title', 'Add Reward')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card h-md-100">
                    <!--begin::Header-->
                    <div class="card-header p-0 align-items-center">
                        <div class="card-body">
                            <form action="{{ route('reward.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="" class="required">Employee</label>
                                            <select name="user_id" class="form-control" id="employee_list">
                                                <option value="">Please Select the Employee</option>
                                                @foreach ($allEmployeeDetails as $employeeDetail)
                                                    <option value="{{ $employeeDetail->id }}" {{ old('user_id') == $employeeDetail->id ? 'selected' : ''}}>
                                                        {{ $employeeDetail->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('user_id'))
                                                <div class="text-danger">{{ $errors->first('user_id') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="required">Reward Name</label>
                                            <input class="form-control" type="text" name="reward_name" value="{{ old('reward_name') }}" placeholder="Enter the Reward Name">
                                            @if ($errors->has('reward_name'))
                                                <div class="text-danger">{{ $errors->first('reward_name') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="required">Date</label>
                                            <input class="form-control" type="date" name="date" value="{{ date('Y-m-d') }}"
                                                max="{{ date('Y-m-d') }}">
                                            @if ($errors->has('date'))
                                                <div class="text-danger">{{ $errors->first('date') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="" class="required">Description</label>
                                            <textarea class="form-control" type="file" name="description"
                                                placeholder="Enter the Description">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <div class="text-danger">{{ $errors->first('description') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <label for="" class="">Image/Certificate</label>
                                            <input class="form-control" type="file" name="image">
                                            @if ($errors->has('image'))
                                                <div class="text-danger">{{ $errors->first('image') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <label for="" class="">Document</label>
                                            <input class="form-control" type="file" name="document"
                                                accept="application/pdf">
                                            @if ($errors->has('document'))
                                                <div class="text-danger">{{ $errors->first('document') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
