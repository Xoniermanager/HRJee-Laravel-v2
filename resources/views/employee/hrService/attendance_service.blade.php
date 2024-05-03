@extends('layouts.employee.main')
@section('content')
@section('title')
Attendance
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="py-15 cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">From date</label>
                                <input type="date" class="form-control mb-3" name="">
                            </div>
                            <div class="col-md-5">
                                <label for="">To date</label>
                                <input type="date" class="form-control mb-3 " name="">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary mt-8 ">Send</button>
                            </div>
                        </div>
                    
                    </div>
                    <!--end::Card title-->
                    
                </div>
                <div class="separator  mb-9"></div>

                <div class="mb-5 mb-xl-10">
                    <h1 class="d-flex flex-column text-dark fs-2 fw-bold title-text">
                        Attendance Logs
                    </h1>

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
                                                    <th>Date</th>
                                                
                                                    <th>Hours</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="">
                                                <tr>
                                                    <td>March 28, 2024</td>
                                                    
                                                    <td>
                                                    NA
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>March 27, 2024</td>
                                                    
                                                    <td>
                                                    09:47
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>March 26, 2024</td>
                                                    
                                                    <td>
                                                    09:30
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>March 25, 2024</td>
                                                    
                                                    <td>
                                                    09:28
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>March 24, 2024</td>
                                                    
                                                    <td>
                                                    09:32
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
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection