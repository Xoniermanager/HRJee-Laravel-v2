@extends('layouts.admin.main')

@section('title', 'Edit Menu')

@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Menu</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-xl-5 g-3 gy-5">
                            <div class="col-xxl-12 col-xl-8 box-col-8 position-relative">
                                <form enctype="multipart/form-data"
                                    action="{{route('admin.menu.update',$menuDetails->id)}}" method="post">
                                    @csrf

                                    <div class="row g-3 custom-input pb-5">
                                        <div class="col-12">
                                            <div class="row gx-xl-3 gx-md-2 gy-md-0 g-2">
                                                <div class="col-md-6 col-sm-6">
                                                    <label class="form-label required"
                                                        for="exampleFormControlInput1">Menu Name</label>
                                                    <input class="form-control" id="title" name="title" type="text"
                                                        placeholder="Menu Name" value="{{ $menuDetails->title }}">
                                                    @if ($errors->has('title'))
                                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                                    @endif
                                                </div>
                                                @php
                                                $companyPosition = strpos($menuDetails->slug, '/company/');
                                                $result = substr($menuDetails->slug, $companyPosition + strlen('/company/'));
                                                @endphp
                                                <div class="col-md-6 col-sm-6">
                                                    <label class="form-label required"
                                                        for="exampleFormControlInput1">URL</label>
                                                    <input class="form-control" name="slug" type="text"
                                                        placeholder="URL" value="{{ $result }}">
                                                    @if ($errors->has('slug'))
                                                    <div class="text-danger">{{ $errors->first('slug') }}</div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="row gx-xl-3 gx-md-2 gy-md-0 g-2">
                                                <div class="col-md-4 col-sm-6">
                                                    <label class="form-label" for="exampleFormControlInput1">Parent
                                                        Menu</label>
                                                    <select class="select2 form-control select-opt" name="parent_id">
                                                        <option value="">Select Menu</option>
                                                        @foreach ($allParentMenu as $header)
                                                        <option value="{{ $header->id }}" {{ $menuDetails->parent_id ==
                                                            $header->id ? 'selected' : ''}} >{{ $header->title }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('parent_id'))
                                                    <div class="text-danger">{{ $errors->first('parent_id') }}</div>
                                                    @endif

                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <label class="form-label required"
                                                        for="exampleFormControlInput1">Order No</label>
                                                    <input class="form-control" name="order_no" type="number"
                                                        placeholder="Order No" value="{{ $menuDetails->order_no }}">
                                                    @if ($errors->has('order_no'))
                                                    <div class="text-danger">{{ $errors->first('order_no') }}</div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label class="form-label required"
                                                        for="exampleFormControlInput1">Menu Icon</label>
                                                    <input class="form-control" name="icon" type="text"
                                                        placeholder="Menu Icon" value="{{ $menuDetails->icon }}">
                                                    @if ($errors->has('icon'))
                                                    <div class="text-danger">{{ $errors->first('icon') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-buttons">
                                        <button type="submit"
                                            class="companyAccountBtn btn d-flex align-items-center gap-sm-2 gap-1">Update
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="#000000"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<style>
    .bottomspace {
        margin-bottom: 40px;
    }

    a.companyAddressbtn.d-flex.align-items-center.gap-sm-2.gap-1 {
        color: white;
    }

    .disable {
        pointer-events: none;
        opacity: 0.7;
    }
</style>
@endsection
