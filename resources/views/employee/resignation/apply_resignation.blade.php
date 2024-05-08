@extends('layouts.employee.main')
@section('content')
@section('title')
Resignation Form
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="card-header p-4">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Apply Resignation</h3>
                    </div>
                    <!--end::Card title-->
                </div>

                <div class="mb-5 mb-xl-10">
                    <div class="card-body">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Employee Name *</label>
                                    <input class="form-control" name="" type="text"> 
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Employee Number *</label>
                                    <input class="form-control" name="" type="text"> 
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Designation *</label>
                                    <input class="form-control" name="" type="text"> 
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Submit Resignation Date *</label>
                                    <input class="form-control" name="" type="date"> 
                                </div>
                                
                            
                                <div class="col-md-12 form-group">
                                    <label for="">Reason For Resignation </label>
                                    <textarea type="text" class="form-control" name=""></textarea>
                                </div>

                            </div>

                            <a href="#" class="btn btn-primary">Save</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection
