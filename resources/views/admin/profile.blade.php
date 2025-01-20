@extends('layouts.admin.main')
@section('title', 'Profile')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6 text-left">
                                <strong>Name:</strong>
                            </div>
                            <div class="col-6 text-right">
                                {{ Auth()->guard('admin')->user()->name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-left">
                                <strong>Username:</strong>
                            </div>
                            <div class="col-6 text-right">
                                {{ Auth()->guard('admin')->user()->username }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-left">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-6 text-right">
                                {{ Auth()->guard('admin')->user()->email }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-left">
                                <strong>Contact No:</strong>
                            </div>
                            <div class="col-6 text-right">
                                {{ Auth()->guard('admin')->user()->contact_no }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Change Password</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ route('change.passowrd') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-6 text-left">
                                <strong class="required">Old Password:</strong>
                            </div>
                            <div class="col-6 text-right">
                                <input type="text" name="old_password" id="" class="form-control"
                                    placeholder="Enter the Old Password" value="{{ old('old_password') }}">
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-left">
                                <strong class="required">New Password:</strong>
                            </div>
                            <div class="col-6 text-right">
                                <input type="text" name="new_password" id="" class="form-control"
                                    placeholder="Enter the New Password" value="{{ old('new_password') }}">
                                @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-left">
                                <strong class="required">Confirm Password:</strong>
                            </div>
                            <div class="col-6 text-right">
                                <input type="text" name="confirm_password" id="" class="form-control"
                                    placeholder="Enter the Confirm Password" value="{{ old('confirm_password') }}">
                                @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-left">

                            </div>
                            <div class="col-6 text-right mt-3">
                                <button class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
