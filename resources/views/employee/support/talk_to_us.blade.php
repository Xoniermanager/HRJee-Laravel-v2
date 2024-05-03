@extends('layouts.employee.main')
@section('content')
@section('title')
Talk To Us
@endsection
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
                        <h3 class="fw-bold m-0">	Talk To Us</h3>
                    </div>
                    <!--end::Card title-->
                </div>

                <div class="mb-5 mb-xl-10">
                    <div class="card-body">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Select Employee *</label>
                                    <input class="form-control" name="" type="text"> 
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Email *</label>
                                    <input class="form-control" name="" type="email"> 
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Mobile Number *</label>
                                    <input class="form-control" name="" type="number"> 
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Subject *</label>
                                    <input class="form-control" name="" type="text"> 
                                </div>
                            
                                <div class="col-md-12 form-group">
                                    <label for="">Comment </label>
                                    <textarea type="text" class="form-control" name=""></textarea>
                                </div>
                                <p class="fw-bold">You will get an email after submission.</p>

                            </div>

                            <a href="#" class="btn btn-primary">Save</a>

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
