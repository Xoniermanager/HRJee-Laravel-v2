@extends('layouts.employee.main')
@section('content')
@section('title')
    PRM
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
                        <h3 class="fw-bold m-0">PRM Details</h3>
                    </div>
                    <!--end::Card title-->
                </div>

                <div class="mb-5 mb-xl-10">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="required">Category</label>
                                <select name="category_id" class="form-control" disabled>
                                    <option value="">Please Select the Category</option>
                                    @foreach ($allCategories as $category)
                                        <option {{ $prmDetails->category_id == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="required">Date</label>
                                <input class="form-control" type="date" value="{{ $prmDetails->bill_date }}" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="required">Amount</label>
                                <input class="form-control" type="text" value="{{ $prmDetails->amount }}" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="col-form-label">Document</label>
                                <input type="file" class="form-control" name="document">
                                @if ($errors->has('document'))
                                    <div class="text-danger">{{ $errors->first('document') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="required">Remark</label>
                                <textarea name="remark" class="form-control" disabled>{{ $prmDetails->remark }}</textarea>
                            </div>
                            
                        </div>
                    </div>
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
