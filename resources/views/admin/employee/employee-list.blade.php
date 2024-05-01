@extends('layouts.main')

@section('title', 'main')

@section('content')

<div class="card card-body col-md-12">
								<div class="card-header cursor-pointer p-0">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<div class="d-flex align-items-center position-relative my-1">
											<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
											<span class="svg-icon svg-icon-1 position-absolute ms-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
												</svg>
											</span>
											<!--end::Svg Icon-->
											<input data-kt-patient-filter="search" class="form-control form-control-solid ps-14" placeholder="Search " type="text" id="SearchByPatientName" name="SearchByPatientName" value="">
											<button style="opacity: 0; display: none !important" id="table-search-btn"></button>
										</div>
									</div>
									<!--end::Card title-->
									<!--begin::Action-->
									<div>
										
									<a href="#" class="btn btn-sm btn-danger align-self-center">
										Export Data</a>
										<a href="#" class="btn btn-sm btn-success align-self-center">
											Import Data</a>
									<a href="{{ route('create.employee')}}" class="btn btn-sm btn-primary align-self-center">
											Add Employee</a>
									</div>
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
														<table
															class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
															<!--begin::Table head-->
															<thead>
																<tr class="fw-bold">
																	<th>Sr. No.</th>
																	<th>Employee ID</th>
																	<th>Name</th>
																	<th>Designation</th>
																	<th>Emp. Details</th>
																	<th>Status   </th>
																	<th class="float-right">Action</th>
																</tr>
															</thead>
															<!--end::Table head-->
															<!--begin::Table body-->
															<tbody class="">

															@foreach ($employees as $index => $employee)
																<tr>
																<td>{{$index+1}}</td>
																	<td> {{$employee->employee_id}}	</td>
																	<td> {{$employee->full_name}}  </td>
																	<td> N/A </td>
																	<td><span
																			class="badge py-3 px-4 fs-7 badge-light-danger">
																		<i class="fa fa-laptop"></i>	</span></td>
																	<td><div class="form-check form-switch form-check-custom form-check-solid">
																		<input class="form-check-input" type="checkbox" value="" id="status" name="status" checked="checked">
																	  </div></td>
																	<td>
																		<div class="d-flex justify-content-end flex-shrink-0">
																			<a href="{{ route('view.employee', ['id'=> $employee->id ]) }}"
																				class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																				<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																				<i class="fa fa-eye"></i>
																				<!--end::Svg Icon-->
																			</a>
																			<a href="{{ route('edit.employee', ['id'=> $employee->id ]) }}"
																				class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																				<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																				<i class="fa fa-edit"></i>
																				<!--end::Svg Icon-->
																			</a>
																			<a href="{{ route('delete.employee', ['id'=> $employee->id ]) }}"
																			class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																			<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																			<i class="fa fa-trash"></i>
																			<!--end::Svg Icon-->
																		</a>
																		</div>
																	</td>
																</tr>
																@endforeach
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
@endsection
