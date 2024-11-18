@extends('layouts.company.main')
@section('content')
@section('title')
    Add Asset
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        <div class="container-xxl" id="kt_content_container">
                            <div class="row g-5 g-xl-10 mb-3">
                                <div class="col-md-12 text-right">
                                    <a href="{{route('asset.index')}}" class="fs-6 text-primary">See all</a>
                                </div>
                                <div class="col-md-7">
                                    <div class="row m-0">
                                        <div class="col-sm-4">
                                            <!--begin::Card widget 3-->
                                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                                style="background-color: rgb(71, 206, 142);">
                                                <!--begin::Header-->
                                                <div class="card-header pt-5 mb-3">
                                                    <!--begin::Icon-->
                                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: rgb(71, 206, 142)">
                                                        <img src="{{ asset('assets/images/logo/assets1.png') }}"
                                                            class="h-50px" alt="">
                                                    </div>
                                                    <!--end::Icon-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card footer-->
                                                <div class="card-footer"
                                                    style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15); border-bottom-left-radius: 30px;border-bottom-right-radius: 30px;">
                                                    <!--begin::Progress-->
                                                    <div class="fw-bold text-white py-2">
                                                        <span
                                                            class="fs-1 d-block">{{ $finalData['total_asset'] }}</span>
                                                        <span class="opacity-50">Total Assets
                                                        </span>
                                                    </div>
                                                    <!--end::Progress-->
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end::Card widget 3-->
                                        </div>
                                        <div class="col-sm-4">
                                            <!--begin::Card widget 3-->
                                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                                style="background-color: rgb(113, 208, 197);">
                                                <!--begin::Header-->
                                                <div class="card-header pt-5 mb-3">
                                                    <!--begin::Icon-->
                                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: rgb(113, 208, 197)">
                                                        <img src="{{ asset('assets/images/logo/assets2.png') }}"
                                                            class="h-50px" alt="">
                                                    </div>
                                                    <!--end::Icon-->
                                                </div>
                                                <!--end::Header-->

                                                <!--begin::Card footer-->
                                                <div class="card-footer"
                                                    style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px; border-bottom-right-radius: 30px;">
                                                    <!--begin::Progress-->
                                                    <div class="fw-bold text-white py-2">
                                                        <span
                                                            class="fs-1 d-block">{{ $finalData['total_availble'] }}</span>
                                                        <span class="opacity-50">Available Stock</span>
                                                    </div>
                                                    <!--end::Progress-->
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end::Card widget 3-->
                                        </div>
                                        <div class="col-sm-4">
                                            <!--begin::Card widget 3-->
                                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                                style="background-color: rgb(120, 75, 132);">
                                                <!--begin::Header-->
                                                <div class="card-header pt-5 mb-3">
                                                    <!--begin::Icon-->
                                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: rgb(120, 75, 132)">
                                                        <img src="{{ asset('assets/images/logo/assets3.png') }}"
                                                            class="h-50px" alt="">
                                                    </div>
                                                    <!--end::Icon-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card footer-->
                                                <div class="card-footer"
                                                    style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);  border-bottom-left-radius: 30px;border-bottom-right-radius: 30px;">
                                                    <!--begin::Progress-->
                                                    <div class="fw-bold text-white py-2">
                                                        <span
                                                            class="fs-1 d-block">{{ $finalData['total_allocated'] }}</span>
                                                        <span class="opacity-50">Allocated </span>
                                                    </div>
                                                    <!--end::Progress-->
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end::Card widget 3-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!--begin::Card widget 3-->
                                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                                style="background-color: rgb(0, 134, 139);">
                                                <!--begin::Header-->
                                                <div class="card-header pt-5 mb-3">
                                                    <!--begin::Icon-->
                                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: rgb(0, 134, 139)">
                                                        <img src="{{ asset('assets/images/logo/assets4.png') }}"
                                                            class="h-50px" alt="">
                                                    </div>
                                                    <!--end::Icon-->
                                                </div>
                                                <!--end::Header-->

                                                <!--begin::Card footer-->
                                                <div class="card-footer"
                                                    style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
                                                border-bottom-right-radius: 30px;">
                                                    <!--begin::Progress-->
                                                    <div class="fw-bold text-white py-2">
                                                        <span
                                                            class="fs-1 d-block">{{ $finalData['total_owned'] }}</span>
                                                        <span class="opacity-50"> Total Owned
                                                        </span>
                                                    </div>
                                                    <!--end::Progress-->
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end::Card widget 3-->
                                        </div>
                                        <div class="col-sm-6">
                                            <!--begin::Card widget 3-->
                                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                                                style="background-color: rgb(123, 104, 238);">
                                                <!--begin::Header-->
                                                <div class="card-header pt-5 mb-3">
                                                    <!--begin::Icon-->
                                                    <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: rgb(123, 104, 238)">
                                                        <img src="{{ asset('assets/images/logo/assets5.png') }}"
                                                            class="h-50px" alt="">
                                                    </div>
                                                    <!--end::Icon-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Card footer-->
                                                <div class="card-footer"
                                                    style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;">
                                                    <!--begin::Progress-->
                                                    <div class="fw-bold text-white py-2">
                                                        <span
                                                            class="fs-1 d-block">{{ $finalData['total_rented'] }}</span>
                                                        <span class="opacity-50">Rented </span>
                                                    </div>
                                                    <!--end::Progress-->
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end::Card widget 3-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <h5>Asset status based on category</h5>
                                    <canvas id="myChart" width="400" height="100"></canvas>
                                </div>
                                 
                            </div>
                            <!--end::Container-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var assetCategoryData = @json($assetCategoryData);
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: assetCategoryData.labels,
            datasets: [{
                    label: 'Total',
                    data: assetCategoryData.total, // Replace with your data
                    backgroundColor: 'rgba(7, 15, 157, 0.2)',
                    borderColor: 'rgba(7, 15, 157, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Available',
                    data: assetCategoryData.available, // Replace with your data
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Allocated',
                    data: assetCategoryData.allocated, // Replace with your data
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Asset Status Based on Category'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },

        }
    });
   
</script>

@endsection
