@extends('layouts.employee.main')
@section('content')
@section('title')
Resignation
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0"> Applied Resign</h3>
                    
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="{{route('employee.apply.resignation')}}" class="btn btn-sm btn-primary align-self-center">
                        Apply</a>
                    <!--end::Action-->
                </div>

                <div class="mb-5 mb-xl-10">

                    <div class="">
                        <div class="">
                            <!--begin::Body-->
                            <div class="">
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fw-bold">
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Apply Date</th>
                                                    <th>Status</th>
                                                    
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="">
                                                <tr>
                                                    <td>1</td>
                                                    <td>Shibli Sone</td>
                                                    <td> Testing</td>
                                                    <td>March 27,2024 </td>
                                                    
                                                    <td>
                                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="" id="status" name="status" checked="checked">
                                                    </div>
                                                </td>
                                                    
                                                    <td>
                                                        <div class="d-flex justify-content-end flex-shrink-0">
                                                            <a href="view_resignation.html" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                <i class="fa fa-eye"></i>
                                                                <!--end::Svg Icon-->
                                                            </a>

                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->

                                </div>
                            </div>
                            <!--begin::Body-->

                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection