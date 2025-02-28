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
                        <h3 class="fw-bold m-0">Add PRM</h3>
                    </div>
                    <!--end::Card title-->
                </div>

                <div class="mb-5 mb-xl-10">
                    <div class="card-body">
                        <form method="post" action="{{ route('prm.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="required">Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Please Select the Category</option>
                                        @foreach ($allCategories as $category)
                                            <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="text-danger">{{ $errors->first('category_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="required">Date</label>
                                    <input class="form-control" type="date" name="bill_date">
                                    @if ($errors->has('bill_date'))
                                        <div class="text-danger">{{ $errors->first('bill_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="required">Amount</label>
                                    <input class="form-control" type="text" name="amount">
                                    @if ($errors->has('amount'))
                                        <div class="text-danger">{{ $errors->first('amount') }}</div>
                                    @endif
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
                                    <textarea name="remark" class="form-control">{{ old('remark') }}</textarea>
                                    @if ($errors->has('remark'))
                                        <div class="text-danger">{{ $errors->first('remark') }}</div>
                                    @endif
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
