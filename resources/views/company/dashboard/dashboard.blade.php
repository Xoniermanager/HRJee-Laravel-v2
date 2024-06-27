@extends('layouts.company.main')

@section('title', 'Dashboard')

@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
					<!--begin::Container-->
					<div class="container-xxl" id="kt_content_container">
						<!--begin::Row-->
						<div class="row gy-5 g-xl-10">
							<!--begin::Col-->
							<div class="col-md-12">
								<div class="mb-5 mb-xl-10">
									<div class="row g-5 g-xl-10 mb-3">
										<div class="col-xl-3 col-sm-6">
											<!--begin::Card widget 3-->
											<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
												style="background-color: #1642b3;background-image:url('assets/media/wave-bg-purple.svg')">
												<!--begin::Header-->
												<div class="card-header pt-5 mb-3">
													<!--begin::Icon-->
													<div class="d-flex flex-center rounded-circle h-80px w-80px"
														style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
														<i class="fa fa-globe-asia text-white fs-2qx lh-0"></i>
													</div>
													<!--end::Icon-->
												</div>
												<!--end::Header-->
												<!--begin::Card footer-->
												<div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;">
													<!--begin::Progress-->
													<div class="fw-bold text-white py-2">
														<span class="fs-1 d-block">3</span>
														<span class="opacity-50">Total Offices
														</span>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Card footer-->
											</div>
											<!--end::Card widget 3-->
										</div>
										<div class="col-xl-3 col-sm-6">
											<!--begin::Card widget 3-->
											<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
												style="background-color: #1642b3;background-image:url('assets/media/wave-bg-purple.svg')">
												<!--begin::Header-->
												<div class="card-header pt-5 mb-3">
													<!--begin::Icon-->
													<div class="d-flex flex-center rounded-circle h-80px w-80px"
														style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
														<i class="fa fa-calendar-times text-white fs-2qx lh-0"></i>
													</div>
													<!--end::Icon-->
												</div>
												<!--end::Header-->

												<!--begin::Card footer-->
												<div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
												border-bottom-right-radius: 30px;">
													<!--begin::Progress-->
													<div class="fw-bold text-white py-2">
														<span class="fs-1 d-block">5</span>
														<span class="opacity-50">Leave Request</span>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Card footer-->
											</div>
											<!--end::Card widget 3-->
										</div>
										<div class="col-xl-3 col-sm-6">
											<!--begin::Card widget 3-->
											<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
												style="background-color: #1642b3;background-image:url('assets/media/wave-bg-purple.svg')">
												<!--begin::Header-->
												<div class="card-header pt-5 mb-3">
													<!--begin::Icon-->
													<div class="d-flex flex-center rounded-circle h-80px w-80px"
														style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
														<i class="fa fa-users-viewfinder text-white fs-2qx lh-0"></i>
													</div>
													<!--end::Icon-->
												</div>
												<!--end::Header-->
												<!--begin::Card footer-->
												<div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;">
													<!--begin::Progress-->
													<div class="fw-bold text-white py-2">
														<span class="fs-1 d-block">300</span>
														<span class="opacity-50">Active Employees </span>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Card footer-->
											</div>
											<!--end::Card widget 3-->
										</div>
										<div class="col-xl-3 col-sm-6">
											<!--begin::Card widget 3-->
											<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
												style="background-color: #1642b3;background-image:url('assets/media/wave-bg-purple.svg')">
												<!--begin::Header-->
												<div class="card-header pt-5 mb-3">
													<!--begin::Icon-->
													<div class="d-flex flex-center rounded-circle h-80px w-80px"
														style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #1642b3">
														<i class="fa fa-user-check text-white fs-2qx lh-0"></i>
													</div>
													<!--end::Icon-->
												</div>
												<!--end::Header-->

												<!--begin::Card footer-->
												<div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);    border-bottom-left-radius: 30px;
												border-bottom-right-radius: 30px;">
													<!--begin::Progress-->
													<div class="fw-bold text-white py-2">
														<span class="fs-1 d-block">295</span>
														<span class="opacity-50"> Total Present
														</span>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Card footer-->
											</div>
											<!--end::Card widget 3-->
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 mb-3">
											<!--begin::Chart widget 38-->
											<div class="card card-flush">
												<!--begin::Header-->
												<div class="card-header pt-7">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label fw-bold text-gray-800">Weekly On Time
															Punch In</span>
													</h3>
													<!--end::Title-->
													<!--begin::Toolbar-->
													<div class="card-toolbar">

													</div>
													<!--end::Toolbar-->
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
													<!--begin::Chart-->
													<div id="kt_charts_widget_38_chart"
														class="h-325px w-100 min-h-auto ps-4 pe-6"></div>
													<!--end::Chart-->
												</div>
												<!--end: Card Body-->
											</div>
											<!--end::Chart widget 38-->
										</div>
										<div class="col-md-6 mb-3">
											<!--begin::Chart widget 18-->
											<div class="card card-flush">
												<!--begin::Header-->
												<div class="card-header pt-7">
													<!--begin::Title-->
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label fw-bold text-gray-800">Overtime</span>
													</h3>
													<!--end::Title-->
													<!--begin::Toolbar-->
													<div class="card-toolbar">

													</div>
													<!--end::Toolbar-->
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
													<!--begin::Chart-->
													<div id="kt_charts_widget_18_chart"
														class="h-325px w-100 min-h-auto ps-4 pe-6"></div>
													<!--end::Chart-->
												</div>
												<!--end: Card Body-->
											</div>
											<!--end::Chart widget 18-->
										</div>

									</div>
									<div class="card card-body col-md-12 mb-3">
										<div class="card-header cursor-pointer p-0 align-items-center">
											<!--begin::Card title-->
											<h5>Attendance</h5>
											<div class="card-title m-0">
												<select class="w-200px form-control">
													<option value="" selected>Branch</option>
													<option value="">Noida</option>
													<option value="">New Delhi </option>
												</select>
												<div class="ml-2 d-flex align-items-center position-relative my-1">
													<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
													<span class="svg-icon svg-icon-1 position-absolute ms-4">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
															viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
																height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
																fill="black"></rect>
															<path
																d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
																fill="black"></path>
														</svg>
													</span>
													<!--end::Svg Icon-->
													<input data-kt-patient-filter="search"
														class="form-control form-control-solid ps-14"
														placeholder="Search keywords" type="text"
														id="SearchByPatientName" name="SearchByPatientName" value="">
													<button style="opacity: 0; display: none !important"
														id="table-search-btn"></button>
												</div>
											</div>
											<!--end::Card title-->

										</div>

										<div class="mb-5 mb-xl-10">
											<div class="card-body py-3">
												<!--begin::Table container-->
												<div class="table-responsive">
													<!--begin::Table-->
													<table
														class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
														<!--begin::Table head-->
														<thead>
															<tr class="fw-bold">
																<th>Sr. No.</th>
																<th>Employee</th>
																<th>Contact</th>
																<th>Attendance</th>
															</tr>
														</thead>
														<!--end::Table head-->
														<!--begin::Table body-->
														<tbody class="">
															<tr>
																<td>1</td>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="symbol symbol-45px me-5">
																			<img src="assets/media/user.jpg" alt="">
																		</div>
																		<div
																			class="d-flex justify-content-start flex-column">
																			<a href="#"
																				class="text-dark fw-bold text-hover-primary fs-6">Full
																				Name</a>
																			<span
																				class="text-muted fw-semibold text-muted d-block fs-7">
																				Software Developer</span>
																		</div>
																	</div>
																</td>
																<td><span
																		class="badge py-3 px-4 fs-7 badge-light-success">
																		<i class="fa fa-phone-flip"></i></span>
																	<span
																		class="badge py-3 px-4 fs-7 badge-light-success">
																		<i
																			class="fa fa-envelope-circle-check"></i></span>
																</td>
																<td> <span
																		class="badge py-3 px-4 fs-7 badge-light-danger">
																		Leave</span> </td>

															</tr>
															<tr>
																<td>2</td>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="symbol symbol-45px me-5">
																			<img src="assets/media/user.jpg" alt="">
																		</div>
																		<div
																			class="d-flex justify-content-start flex-column">
																			<a href="#"
																				class="text-dark fw-bold text-hover-primary fs-6">Full
																				Name</a>
																			<span
																				class="text-muted fw-semibold text-muted d-block fs-7">
																				Software Developer</span>
																		</div>
																	</div>
																</td>
																<td><span
																		class="badge py-3 px-4 fs-7 badge-light-success">
																		<i class="fa fa-phone-flip"></i></span>
																	<span
																		class="badge py-3 px-4 fs-7 badge-light-success">
																		<i
																			class="fa fa-envelope-circle-check"></i></span>
																</td>
																<td> <span
																		class="badge py-3 px-4 fs-7 badge-light-danger">
																		Leave</span> </td>

															</tr>
															<tr>
																<td>3</td>
																<td>
																	<div class="d-flex align-items-center">
																		<div class="symbol symbol-45px me-5">
																			<img src="assets/media/user.jpg" alt="">
																		</div>
																		<div
																			class="d-flex justify-content-start flex-column">
																			<a href="#"
																				class="text-dark fw-bold text-hover-primary fs-6">Full
																				Name</a>
																			<span
																				class="text-muted fw-semibold text-muted d-block fs-7">
																				Software Developer</span>
																		</div>
																	</div>
																</td>
																<td><span
																		class="badge py-3 px-4 fs-7 badge-light-success">
																		<i class="fa fa-phone-flip"></i></span>
																	<span
																		class="badge py-3 px-4 fs-7 badge-light-success">
																		<i
																			class="fa fa-envelope-circle-check"></i></span>
																</td>
																<td> <span
																		class="badge py-3 px-4 fs-7 badge-light-primary">
																		Present</span> </td>

															</tr>

														</tbody>
														<!--end::Table body-->
													</table>
													<!--end::Table-->
												</div>
												<!--end::Table container-->

											</div>

											<!--begin::Body-->
										</div>
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
				<!--end::Content-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
@endsection
