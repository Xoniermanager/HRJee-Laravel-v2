@extends('layouts.employee.main')
@section('content')
@section('title')
    Leave Application
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
                        <h3 class="fw-bold m-0">Apply Leave</h3>
                    </div>
                    <!--end::Card title-->
                </div>

                <div class="mb-5 mb-xl-10">
                    <div class="card-body">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Employee ID *</label>
                                    <input class="form-control" name="" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Employee Name *</label>
                                    <input class="form-control" name="" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Leave Type *</label>
                                    <select class="form-control">
                                        <option value="">Earned Leave</option>
                                        <option value=""> Casual Leave </option>
                                        <option value=""> Comp off Leave </option>
                                        <option value=""> Planned Leave </option>
                                        <option value=""> Emergency Leave </option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Leave Balance *</label>
                                    <input class="form-control" name="" type="text">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="">Half Day *</label>
                                    <div class="d-flex align-items-center mt-3">
                                        <!--begin::Option-->
                                        <span class="form-check form-check-custom form-check-solid pl-10">
                                            <input class="form-check-input mr-10" type="radio" name="category"
                                                value="1"> Morning
                                        </span>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <span class="form-check form-check-custom form-check-solid pl-10">
                                            <input class="form-check-input mr-10" type="radio" name="category"
                                                value="1"> Evening
                                        </span>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <span class="form-check form-check-custom form-check-solid pl-10">
                                            <input class="form-check-input mr-10" type="radio" name="category"
                                                value="1"> None
                                        </span>
                                        <!--end::Option-->
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Start Date</label>
                                    <input class="form-control" name="" type="date">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">End Date *</label>
                                    <input class="form-control" name="" type="date">
                                </div>



                                <h3 class="fw-bold ">Emergency Contacts</h3>

                                <div class="col-md-6 form-group">
                                    <label for=""> Name *</label>
                                    <input class="form-control" name="" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Phone Number *</label>
                                    <input class="form-control" name="" type="number">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Address *</label>
                                    <input class="form-control" name="" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Documents *</label>
                                    <input class="form-control" name="" type="file">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="">Comments</label>
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
