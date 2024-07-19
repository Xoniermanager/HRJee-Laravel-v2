@extends('layouts.employee.main')
@section('content')
@section('title')
    HR Complain
@endsection
@if (session('error'))
    <div class="alert alert-danger alert-dismissible">
        {{ session('error') }}
    </div>
@endif
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header p-4">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Add Complain</h3>
                    </div>
                    <!--end::Card title-->
                </div>

                <div class="mb-5 mb-xl-10">
                    <div class="card-body">
                        <form method="post" action="{{ route('hr_complain.store') }}">
                            @csrf
                            <div class="col-md-6 form-group">
                                <label class="required">Complain Category</label>
                                <select name="complain_category_id" class="form-control">
                                    <option value="">Please Select the Complain Category</option>
                                    @foreach ($allComplainCategory as $complainCategory)
                                        <option
                                            {{ old('complain_category_id') == $complainCategory->id ? 'selected' : '' }}
                                            value="{{ $complainCategory->id }}">{{ $complainCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('complain_category_id'))
                                    <div class="text-danger">{{ $errors->first('complain_category_id') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="required">Description</label>
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                            @if ($errors->has('description'))
                                <div class="text-danger">{{ $errors->first('description') }}</div>
                            @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->
</div>

@endsection
