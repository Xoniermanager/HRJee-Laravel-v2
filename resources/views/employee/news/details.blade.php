@extends('layouts.employee.main')
@section('content')
@section('title')
    News Details
@endsection
<!--begin::Header-->
<!--end::Header-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
								<div class="row g-10">
									<!--begin::Col-->
									<div class="col-md-12">
										<!--begin::Feature post-->
										<div class="card-xl-stretch me-md-6">
											<!--begin::Image-->
											<img src="{{asset('employee/assets/media/news/11.png')}}" class="card-rounded min-h-175px mb-5">
											
											<!--end::Image-->
											<!--begin::Body-->
											<div class="m-0">
												<!--begin::Title-->
												<a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">Scrum Meeting</a>
												<!--end::Title-->
												<!--begin::Text-->
												<div class="fw-semibold fs-5 text-gray-600 text-dark my-4">
													<i class="fa fa-calendar-days"></i> March 27,2024
												</div>
												<!--end::Text-->
												<div class="fw-semibold fs-5 text-gray-600 text-dark my-4">We’ve been focused on making a the from also not been afraid to and step away been focused create eye</div>
											
											</div>
											<!--end::Body-->
										</div>
										<!--end::Feature post-->
									</div>
									<!--end::Col-->
								
								
								</div>
							</div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::Content-->
</div>
@endsection
