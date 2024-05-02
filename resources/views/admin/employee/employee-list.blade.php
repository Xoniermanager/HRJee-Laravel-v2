@extends('layouts.main')

@section('title', 'main')

@section('content')

    {{-- <div class="card card-body col-md-12">
        <div class="card-header cursor-pointer p-0">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input data-kt-patient-filter="search" class="form-control form-control-solid ps-14"
                        placeholder="Search " type="text" id="SearchByPatientName" name="SearchByPatientName"
                        value="">
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
                <a href="{{ route('create.employee') }}" class="btn btn-sm btn-primary align-self-center">
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
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold">
                                            <th>Sr. No.</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Emp. Details</th>
                                            <th>Status </th>
                                            <th class="float-right">Action</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="">

                                        @foreach ($employees as $index => $employee)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td> {{ $employee->employee_id }} </td>
                                                <td> {{ $employee->full_name }} </td>
                                                <td> N/A </td>
                                                <td><span class="badge py-3 px-4 fs-7 badge-light-danger">
                                                        <i class="fa fa-laptop"></i> </span></td>
                                                <td>
                                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="status" name="status" checked="checked">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <a href="{{ route('view.employee', ['id' => $employee->id]) }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <i class="fa fa-eye"></i>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        <a href="{{ route('edit.employee', ['id' => $employee->id]) }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                            <i class="fa fa-edit"></i>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        <a href="{{ route('delete.employee', ['id' => $employee->id]) }}"
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
    </div> --}}

	<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
		<!--begin::Container-->
		<div class="container-xxl" id="kt_content_container">
			<!--begin::Row-->
			<div class="row gy-5 g-xl-10">
				<!--begin::Col-->
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
													<tr>
														<td>1</td>
														<td> XO003</td>
														<td>Test User </td>
														<td>Human Resource	</td>
														<td><span
																class="badge py-3 px-4 fs-7 badge-light-danger">
															<i class="fa fa-laptop"></i>	</span></td>
														<td><div class="form-check form-switch form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="" id="status" name="status" checked="checked">
														  </div></td>
														<td>
															<div class="d-flex justify-content-end flex-shrink-0">
																<a href="employee_view.html"
																	class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																	<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																	<i class="fa fa-eye"></i>
																	<!--end::Svg Icon-->
																</a>
																<!--begin::Menu-->
										<div class="me-1">
											<button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
												<i class="fa fa-edit"></i>
											</button>
											<!--begin::Menu 3-->
											<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
												 
												<!--begin::Menu item-->
												<div class="menu-item px-3" data-bs-toggle="modal" data-bs-target="#personal_details">
													<a href="#" class="menu-link px-3">Personal Details</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3" data-bs-toggle="modal" data-bs-target="#company_details">
													<a href="#" class="menu-link flex-stack px-3">Company Details </a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3" data-bs-toggle="modal" data-bs-target="#address">
													<a href="#" class="menu-link px-3">Address</a>
												</div>
												<!--end::Menu item-->
												 
												<!--begin::Menu item-->
												<div class="menu-item px-3 my-1" data-bs-toggle="modal" data-bs-target="#bank_details">
													<a href="#" class="menu-link px-3">Bank Details</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3 my-1" data-bs-toggle="modal" data-bs-target="#upload_documents">
													<a href="#" class="menu-link px-3">Upload Documents</a>
												</div>
												<!--end::Menu item-->
											</div>
											<!--end::Menu 3-->
										</div>
										<!--end::Menu-->
																 
																<a href="#"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-trash"></i>
																<!--end::Svg Icon-->
															</a>
															</div>
														</td>
													</tr>
													<tr>
														<td>2</td>
														<td> XO003</td>
														<td>Test User </td>
														<td>Human Resource	</td>
														<td><span
																class="badge py-3 px-4 fs-7 badge-light-danger">
															<i class="fa fa-laptop"></i>	</span></td>
														<td><div class="form-check form-switch form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="" id="status" name="status" checked="checked">
														  </div></td>
														<td>
															<div class="d-flex justify-content-end flex-shrink-0">
																<a href="employee_view.html"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-eye"></i>
																<!--end::Svg Icon-->
															</a>
																<a href="#"
																	class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																	<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																	<i class="fa fa-edit"></i>
																	<!--end::Svg Icon-->
																</a>
																<a href="#"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-trash"></i>
																<!--end::Svg Icon-->
															</a>
															</div>
														</td>
													</tr>
													<tr>
														<td>3</td>
														<td> XO003</td>
														<td>Test User </td>
														<td>Human Resource	</td>
														<td><span
																class="badge py-3 px-4 fs-7 badge-light-danger">
															<i class="fa fa-laptop"></i>	</span></td>
														<td><div class="form-check form-switch form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="" id="status" name="status" checked="checked">
														  </div></td>
														<td>
															<div class="d-flex justify-content-end flex-shrink-0">
																<a href="employee_view.html"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-eye"></i>
																<!--end::Svg Icon-->
															</a>
																<a href="#"
																	class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																	<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																	<i class="fa fa-edit"></i>
																	<!--end::Svg Icon-->
																</a>
																<a href="#"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-trash"></i>
																<!--end::Svg Icon-->
															</a>
															</div>
														</td>
													</tr>
													<tr>
														<td>4</td>
														<td> XO003</td>
														<td>Test User </td>
														<td>Human Resource	</td>
														<td><span
																class="badge py-3 px-4 fs-7 badge-light-danger">
															<i class="fa fa-laptop"></i>	</span></td>
														<td><div class="form-check form-switch form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="" id="status" name="status" checked="checked">
														  </div></td>
														<td>
															<div class="d-flex justify-content-end flex-shrink-0">
																<a href="employee_view.html"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-eye"></i>
																<!--end::Svg Icon-->
															</a>
																<a href="#"
																	class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																	<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																	<i class="fa fa-edit"></i>
																	<!--end::Svg Icon-->
																</a>
																<a href="#"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-trash"></i>
																<!--end::Svg Icon-->
															</a>
															</div>
														</td>
													</tr>
													<tr>
														<td>5</td>
														<td> XO003</td>
														<td>Test User </td>
														<td>Human Resource	</td>
														<td><span
																class="badge py-3 px-4 fs-7 badge-light-danger">
															<i class="fa fa-laptop"></i>	</span></td>
														<td><div class="form-check form-switch form-check-custom form-check-solid">
															<input class="form-check-input" type="checkbox" value="" id="status" name="status" checked="checked">
														  </div></td>
														<td>
															<div class="d-flex justify-content-end flex-shrink-0">
																<a href="employee_view.html"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-eye"></i>
																<!--end::Svg Icon-->
															</a>
																<a href="#"
																	class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																	<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																	<i class="fa fa-edit"></i>
																	<!--end::Svg Icon-->
																</a>
																<a href="#"
																class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
																<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
																<i class="fa fa-trash"></i>
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
				<!--end::Col-->
			</div>
			<!--end::Row-->
		</div>
		<!--end::Container-->
	</div>

	<div class="modal fade" id="personal_details" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog mw-600px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header pb-0">
					<!--begin::Close-->
					<h3 class="fw-bold m-0"> Personal Details </h3>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						<span class="svg-icon svg-icon-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--begin::Modal header-->
				<!--begin::Modal body-->
				 <div class="modal-body scroll-y p-4"> 
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="">Full Name *</label>
								<input class="form-control" type="text" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Email *</label>
								<input class="form-control" type="email" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Password *</label>
								<input class="form-control" type="password" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Father's Name *</label>
								<input class="form-control" type="text" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Gender *</label>
								<select class="form-control">
									<option value="">Male</option>
									<option value="">Female</option> 
									<option value="">Other</option> 
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="">Date of Birth *</label>
								<input class="form-control" name="" type="date"> 
							</div>
							<div class="col-md-6 form-group">
								<label for="">Number *</label>
								<input class="form-control" name="" type="number"> 
							</div>
							<div class="col-md-6 form-group">
								<label for="">Photo *</label>
								<input class="form-control" type="file" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Family Contact Number *</label>
								<input class="form-control" type="text" name="">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" class="btn btn-primary">Update </button>
							</div>
						 
						</div>								 
				</div>
				 </div>
				<!--end::Modal body-->
			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
	<!--end::Modal - personal_details-->
	<!--begin::Modal - company_details-->
	<div class="modal fade" id="company_details" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog mw-600px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header pb-0">
					<!--begin::Close-->
					<h3 class="fw-bold m-0"> Company  Details </h3>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						<span class="svg-icon svg-icon-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--begin::Modal header-->
				<!--begin::Modal body-->
				 <div class="modal-body scroll-y p-4"> 
					<div class="card-body">
						<div class="row">											 
							<div class="col-md-6 form-group">
								<label for="">Branch *</label>
								<select class="form-control">
									<option value="">Delhi</option>
									<option value="">Noida</option> 
									<option value="">Punjab</option> 
								</select>
							</div>											 
							<div class="col-md-6 form-group">
								<label for="">Department *</label>
								<select class="form-control">
									<option value="">Development</option>
									<option value="">Management</option> 
									<option value="">Marketing</option> 
								</select>
							</div>											 
							<div class="col-md-6 form-group">
								<label for="">Designation *</label>
								<select class="form-control">
									<option value="">Laravel Developer</option>
									<option value="">Angular Developer</option> 
									<option value="">React Developer</option> 
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="">Employee ID*</label>
								<input class="form-control" name="" type="text"> 
							</div>
							<div class="col-md-6 form-group">
								<label for="">Manager ID *</label>
								<input class="form-control" name="" type="text"> 
							</div>
							<div class="col-md-6 form-group">
								<label for="">Joining Date *</label>
								<input class="form-control" type="date" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Basic Pay *</label>
								<input class="form-control" type="text" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Rent Allowance *</label>
								<input class="form-control" type="text" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Medical Allowance *</label>
								<input class="form-control" type="text" name="">
							</div>
							<div class="col-md-6 form-group">
								<label for="">Travel Allowance *</label>
								<input class="form-control" type="text" name="">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" class="btn btn-primary">Update </button>
							</div>
						</div>								 
				</div>
				 </div>
				<!--end::Modal body-->
			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
	<!--end::Modal - company_details-->
	<!--begin::Modal - Address-->
	<div class="modal fade" id="address" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog mw-600px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header pb-0">
					<!--begin::Close-->
					<h3 class="fw-bold m-0"> Address </h3>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						<span class="svg-icon svg-icon-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--begin::Modal header-->
				<!--begin::Modal body-->
				 <div class="modal-body scroll-y p-4"> 
					<div class="w-100">
						<div class="mb-3"> 
							
	
								<div class="card-body">
										<div class="row">											 
											<div class="col-md-6 form-group">
												<label for="">Address  *</label>
												<input class="form-control" type="text">
											 </div>											 
											 <div class="col-md-6 form-group">
												 <label for="">City  *</label>
												 <input class="form-control" type="text">
											  </div>											 
											  <div class="col-md-6 form-group">
												  <label for="">State  *</label>
												  <input class="form-control" type="text">
											   </div>											 
											   <div class="col-md-6 form-group">
												   <label for="">Pincode  *</label>
												   <input class="form-control" type="text">
												</div>	 
										 
										</div>								 
								</div>
						 
						</div>
						<div class="mb-3 border-top"> 
							<div class="card-header p-4">
								<!--begin::Card title-->
								<div class="card-title m-0">
									<h4>
										<input type="checkbox">
									Temporary Address  is same as Permanent Address
									</h4>
									<h3 class="fw-bold m-0"> 
										 Temporary Address 
									</h3>
								</div>
								<!--end::Card title-->
							</div>
	
								<div class="card-body">
										<div class="row">											 
											<div class="col-md-6 form-group">
												<label for="">Address  *</label>
												<input class="form-control" type="text">
											 </div>											 
											 <div class="col-md-6 form-group">
												 <label for="">City  *</label>
												 <input class="form-control" type="text">
											  </div>											 
											  <div class="col-md-6 form-group">
												  <label for="">State  *</label>
												  <input class="form-control" type="text">
											   </div>											 
											   <div class="col-md-6 form-group">
												   <label for="">Pincode  *</label>
												   <input class="form-control" type="text">
												</div>	 
	
												<div class="col-md-12 form-group">
													<button type="submit" class="btn btn-primary">Update </button>
												</div>
										</div>								 
								</div>
						 
						</div>
						</div>
				 </div>
				<!--end::Modal body-->
			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
	<!--end::Modal - Address-->
	<!--begin::Modal - Bank Details-->
	<div class="modal fade" id="bank_details" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog mw-600px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header pb-0">
					<!--begin::Close-->
					<h3 class="fw-bold m-0">   Bank Details   </h3>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						<span class="svg-icon svg-icon-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--begin::Modal header-->
				<!--begin::Modal body-->
				 <div class="modal-body scroll-y p-4"> 
					<div class="card-body">
						<div class="row">											 
							<div class="col-md-6 form-group">
								<label for="">Account Holder Name  *</label>
								<input class="form-control" type="text">
							 </div>											 
							 <div class="col-md-6 form-group">
								 <label for="">Account Number  *</label>
								 <input class="form-control" type="number">
							  </div>											 
							  <div class="col-md-6 form-group">
								  <label for="">Bank Name  *</label>
								  <input class="form-control" type="text">
							   </div>											 
							   <div class="col-md-6 form-group">
								   <label for="">IFSC Code  *</label>
								   <input class="form-control" type="text">
								</div>	 											 
								<div class="col-md-6 form-group">
									<label for="">PAN Number  *</label>
									<input class="form-control" type="text">
								 </div>												 
								 <div class="col-md-6 form-group">
									 <label for="">Branch *</label>
									 <input class="form-control" type="text">
								  </div>	  
								  <div class="col-md-12 form-group">
									<button type="submit" class="btn btn-primary">Update </button>
								</div>
						</div>								 
				</div>
				 </div>
				<!--end::Modal body-->
			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
	<!--end::Modal - Bank Details-->
	<!--begin::Modal - Upload Documents-->
	<div class="modal fade" id="upload_documents" tabindex="-1" aria-hidden="true">
		<!--begin::Modal dialog-->
		<div class="modal-dialog mw-600px">
			<!--begin::Modal content-->
			<div class="modal-content">
				<!--begin::Modal header-->
				<div class="modal-header pb-0">
					<!--begin::Close-->
					<h3 class="fw-bold m-0"> Upload Documents </h3>
					<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
						<span class="svg-icon svg-icon-1">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
							</svg>
						</span>
						<!--end::Svg Icon-->
					</div>
					<!--end::Close-->
				</div>
				<!--begin::Modal header-->
				<!--begin::Modal body-->
				 <div class="modal-body scroll-y p-4"> 
					<div class="card-body">
						<div class="row">											 
							<div class="col-md-6 form-group">
								<label for="">Resume *</label>
								<input class="form-control" type="file">
							 </div>											 
							 <div class="col-md-6 form-group">
								 <label for="">Offer Letter *</label>
								 <input class="form-control" type="file">
							  </div>											 
							  <div class="col-md-6 form-group">
								  <label for="">Joining Letter  *</label>
								  <input class="form-control" type="file">
							   </div>											 
							   <div class="col-md-6 form-group">
								   <label for="">Other Document (Upload Multiple) </label>
								   <input class="form-control" type="file">
								</div>	 
								<div class="col-md-12 form-group">
									<button type="submit" class="btn btn-primary">Update </button>
								</div>
						</div>
										  
				</div>
				 </div>
				<!--end::Modal body-->
			</div>
			<!--end::Modal content-->
		</div>
		<!--end::Modal dialog-->
	</div>
@endsection
