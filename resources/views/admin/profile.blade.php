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
                    <form action="{{ route('change.password') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-6 text-left">
                                <strong class="required">Old Password:</strong>
                            </div>
                            <div class="col-6 text-right">
                                <div class="input-group">
                                    <input type="password" name="old_password" class="form-control"
                                        placeholder="Enter the Old Password" value="{{ old('old_password') }}"
                                        autocomplete="on">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                </div>
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
                                <div class="input-group">
                                    <input type="password" name="new_password" class="form-control"
                                        placeholder="Enter the New Password" value="{{ old('new_password') }}"
                                        autocomplete="on" id="new_password">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="togglePasswordVisibility('new_password')">
                                            <i id="new_password_eye" class="fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
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
                                <div class="input-group">
                                    <input type="password" name="confirm_password" class="form-control"
                                        placeholder="Enter the Confirm Password" value="{{ old('confirm_password') }}"
                                        autocomplete="on" id="confirm_password">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="togglePasswordVisibility('confirm_password')">
                                            <i id="confirm_password_eye" class="fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
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
<script>
    function togglePasswordVisibility(fieldId) {
        var passwordField = document.getElementById(fieldId);
        var eyeIcon = document.getElementById(fieldId + '_eye');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.add("fa-eye");
            eyeIcon.classList.remove("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.add("fa-eye-slash");
            eyeIcon.classList.remove("fa-eye");
        }
    }
</script>
@endsection
