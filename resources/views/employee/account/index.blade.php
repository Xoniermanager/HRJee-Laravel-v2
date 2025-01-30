@extends('layouts.employee.main')
@section('content')
@section('title')
	Profile
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
	<!--begin::Container-->
	<div class="container-xxl" id="kt_content_container">
		<!--begin::Row-->
		<div class="card mb-xl-10 mb-5">
			<div class="card-body pb-0 pt-9">
				<!--begin::Details-->
				<div class="d-flex flex-sm-nowrap mb-3 flex-wrap">
					<!--begin: Pic-->
					<div class="mb-4 me-7">
						<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
							<img src="{{ Auth::user()->profile_image ?? asset('employee/assets/media/user.jpg') }}" alt="image">

						</div>
					</div>
					<!--end::Pic-->
					<!--begin::Info-->
					<div class="flex-grow-1">
						<!--begin::Title-->
						<div class="d-flex justify-content-between align-items-start mb-2 flex-wrap">
							<!--begin::User-->
							<div class="d-flex flex-column">
								<!--begin::Name-->
								<div class="d-flex align-items-center mb-2">
									<a class="text-hover-primary fs-2 fw-bold me-1 text-gray-900">{{ Auth::user()->name }}</a>

								</div>
								<!--end::Name-->
								<!--begin::Info-->
								<div class="d-flex fw-semibold fs-6 mb-4 flex-wrap pe-2">
									<a href="#" class="d-flex align-items-center text-hover-primary mb-2 me-5 text-gray-400">
										<!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
										<span class="svg-icon svg-icon-4 me-1">
											<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3"
													d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
													fill="currentColor"></path>
												<path
													d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
													fill="currentColor"></path>
												<rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor">
												</rect>
											</svg>
										</span>
										<!--end::Svg Icon-->{{ Auth::user()->details->designation->name }}
									</a>
									<a href="#" class="d-flex align-items-center text-hover-primary mb-2 me-5 text-gray-400">
										<!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
										<span class="svg-icon svg-icon-4 me-1">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3"
													d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
													fill="currentColor"></path>
												<path
													d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
													fill="currentColor"></path>
											</svg>
										</span>
										<!--end::Svg Icon-->h-187, sec-63
									</a>
									<a href="#" class="d-flex align-items-center text-hover-primary mb-2 text-gray-400">
										<!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
										<span class="svg-icon svg-icon-4 me-1">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3"
													d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
													fill="currentColor"></path>
												<path
													d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
													fill="currentColor"></path>
											</svg>
										</span>
										<!--end::Svg Icon-->{{ Auth::user()->email }}
									</a>
								</div>
								<!--end::Info-->

								<div class="bg-light-info min-w-125px mb-3 me-6 rounded border border-dashed border-gray-300 px-4 py-3">
									<p class="fw-semibold fs-4 pt-1"><b>At work for:</b>{{ getWorkDateFromate(Auth::user()->joining_date) }}</p>
								</div>

							</div>
							<!--end::User-->
							<!--begin::Actions-->
							<div class="d-flex my-4">
								<a href="#" data-bs-toggle="modal" data-bs-target="#change_password_model"
									class="btn btn-sm btn-primary align-self-center">
									Change password</a>
							</div>
						</div>
						<!--end::Title-->
						<!--begin::Stats-->
						<div class="d-flex flex-stack flex-wrap">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column flex-grow-1 pe-8">
								<!--begin::Stats-->
								<div class="d-flex flex-wrap">
									<!--begin::Stat-->
									<div class="bg-light-warning min-w-125px mb-3 me-6 rounded border border-dashed border-gray-300 px-4 py-3">
										<!--begin::Number-->
										<div class="">

											<div class="fs-2 fw-bold text-center">3</div>
										</div>
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-semibold fs-6 text-center">Attendance</div>
										<!--end::Label-->
									</div>
									<!--end::Stat-->
									<!--begin::Stat-->
									<div class="bg-light-danger min-w-125px mb-3 me-6 rounded border border-dashed border-gray-300 px-4 py-3">
										<!--begin::Number-->
										<div class="">

											<div class="fs-2 fw-bold text-center">9/12</div>
										</div>
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-semibold fs-6 text-center">Leaves</div>
										<!--end::Label-->
									</div>
									<!--end::Stat-->
									<!--begin::Stat-->
									<div class="bg-light-success min-w-125px mb-3 me-6 rounded border border-dashed border-gray-300 px-4 py-3">
										<!--begin::Number-->
										<div class="">

											<div class="fs-2 fw-bold text-center">0</div>
										</div>
										<!--end::Number-->
										<!--begin::Label-->
										<div class="fw-semibold fs-6 text-center">Awards</div>
										<!--end::Label-->
									</div>
									<!--end::Stat-->
								</div>
								<!--end::Stats-->
							</div>
							<!--end::Wrapper-->

						</div>
						<!--end::Stats-->
					</div>
					<!--end::Info-->
				</div>
				<!--end::Details-->
				<ul class="nav nav-pills nav-pills-custom mb-3 mt-10" role="tablist">
					<!--begin::Item-->
					<li class="nav-item me-lg-6 me-3" role="presentation">
						<!--begin::Link-->
						<a class="nav-link d-flex justify-content-between flex-column flex-center h-55px active overflow-hidden py-4"
							data-bs-toggle="pill" href="#kt_profile_details_view" aria-selected="true" role="tab" tabindex="-1">

							<!--begin::Subtitle-->
							<span class="nav-text fw-bold fs-6 text-gray-700">Personal Details</span>
							<!--end::Subtitle-->
							<!--begin::Bullet-->
							<span class="bullet-custom position-absolute w-100 h-4px bg-primary bottom-0"></span>
							<!--end::Bullet-->

						</a>
						<!--end::Link-->
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="nav-item me-lg-6 me-3" role="presentation">
						<!--begin::Link-->
						<a class="nav-link d-flex justify-content-between flex-column flex-center h-55px overflow-hidden py-4"
							data-bs-toggle="pill" href="#company_detail" aria-selected="false" role="tab" tabindex="-1">

							<!--begin::Subtitle-->
							<span class="nav-text fw-bold fs-6 text-gray-700">Advance Details</span>
							<!--end::Subtitle-->
							<!--begin::Bullet-->
							<span class="bullet-custom position-absolute w-100 h-4px bg-primary bottom-0"></span>
							<!--end::Bullet-->

						</a>
						<!--end::Link-->
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="nav-item me-lg-6 me-3" role="presentation">
						<!--begin::Link-->
						<a class="nav-link d-flex justify-content-between flex-column flex-center h-55px overflow-hidden py-4"
							data-bs-toggle="pill" href="#account_detail" aria-selected="false" role="tab" tabindex="-1">

							<!--begin::Subtitle-->
							<span class="nav-text fw-bold fs-6 text-gray-600">Bank Account Details</span>
							<!--end::Subtitle-->
							<!--begin::Bullet-->
							<span class="bullet-custom position-absolute w-100 h-4px bg-primary bottom-0"></span>
							<!--end::Bullet-->
						</a>
						<!--end::Link-->
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="nav-item me-lg-6 me-3" role="presentation">
						<!--begin::Link-->
						<a class="nav-link d-flex justify-content-between flex-column flex-center h-55px overflow-hidden py-4"
							data-bs-toggle="pill" href="#address_tab" aria-selected="false" tabindex="-1" role="tab">

							<!--begin::Subtitle-->
							<span class="nav-text fw-bold fs-6 text-gray-600">My Address</span>
							<!--end::Subtitle-->
							<!--begin::Bullet-->
							<span class="bullet-custom position-absolute w-100 h-4px bg-primary bottom-0"></span>
							<!--end::Bullet-->

						</a>
						<!--end::Link-->
					</li>
					<!--end::Item-->

				</ul>

			</div>
		</div>
		<div class="col-md-12">
			@if (session('error'))
				<div class="alert alert-danger alert-dismissible">
					{{ session('error') }}
				</div>
			@endif
			@if (session('success'))
				<div class="alert alert-success alert-dismissible">
					{{ session('success') }}
				</div>
			@endif
		</div>
		<div class="tab-content">
			<div class="card tab-pane fade active show mb-xl-10 mb-5" id="kt_profile_details_view" role="tabpanel">
				<!--begin::Card header-->
				<div class="card-header cursor-pointer">
					<!--begin::Card title-->
					<div class="card-title m-0">
						<h3 class="fw-bold m-0">Personal Details</h3>
					</div>
					<!--end::Card title-->

				</div>
				<!--begin::Card header-->
				<!--begin::Card body-->
				<div class="card-body p-9">
					<form method="post" action="{{ route('update.basicDetails.employee') }}" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="">Profile Image </label>
								<input class="form-control" name="profile_image" type="file">
								@if ($errors->has('profile_image'))
									<div class="text-danger">{{ $errors->first('profile_image') }}</div>
								@endif
							</div>
							<div class="col-md-6 form-group">
								<label for="">Father's Name *</label>
								<input class="form-control" name="father_name" type="text" value="{{ Auth::user()->details->father_name }}">
								@if ($errors->has('father_name'))
									<div class="text-danger">{{ $errors->first('father_name') }}</div>
								@endif
							</div>

							<div class="col-md-6 form-group">
								<label for="">Mother Name *</label>
								<input class="form-control" name="mother_name" type="text" value="{{ Auth::user()->details->mother_name }}">
								@if ($errors->has('mother_name'))
									<div class="text-danger">{{ $errors->first('mother_name') }}</div>
								@endif
							</div>

							<div class="col-md-6 form-group">
								<label for="">DOB *</label>
								<input class="form-control" name="date_of_birth" type="date" value="{{ Auth::user()->details->date_of_birth }}">
								@if ($errors->has('date_of_birth'))
									<div class="text-danger">{{ $errors->first('date_of_birth') }}</div>
								@endif
							</div>
							<div class="col-md-6 form-group">
								<label for="">Gender *</label>
								<select class="form-control" name="gender">
									<option {{ Auth::user()->details->gender ?? old('gender') == 'M' ? 'selected' : '' }} value="M">
										Male</option>
									<option {{ Auth::user()->details->gender ?? old('gender') == 'F' ? 'selected' : '' }} value="F">
										Female</option>
									<option {{ Auth::user()->details->gender ?? old('gender') == 'O' ? 'selected' : '' }}value="O">
										Other
									</option>
								</select>
								@if ($errors->has('gender'))
									<div class="text-danger">{{ $errors->first('gender') }}</div>
								@endif
							</div>
							<div class="col-md-6 form-group">
								<label for="">Phone Number *</label>
								<input class="form-control" name="phone" type="number" value="{{ Auth::user()->details->phone }}">
								@if ($errors->has('phone'))
									<div class="text-danger">{{ $errors->first('phone') }}</div>
								@endif
							</div>
							<div class="col-md-6 form-group">
								<label for="">Marital Status *</label>
								<select class="form-control" name="marital_status">
									<option {{ Auth::user()->details->marital_status ?? old('marital_status') == 'M' ? 'selected' : '' }} value="M">
										Married</option>
									<option {{ Auth::user()->details->marital_status ?? old('marital_status') == 'S' ? 'selected' : '' }} value="S">
										Single</option>
								</select>
								@if ($errors->has('marital_status'))
									<div class="text-danger">{{ $errors->first('marital_status') }}</div>
								@endif
							</div>
							<div class="col-md-6 form-group">
								<label for="">Blood Group *</label>
								<select class="form-control" name="blood_group">
									<option {{ Auth::user()->details->blood_group ?? old('blood_group') == 'A-' ? 'selected' : '' }} value="A-">A-
									</option>
									<option {{ Auth::user()->details->blood_group ?? old('blood_group') == 'A+' ? 'selected' : '' }} value="A+">A+
									</option>
									<option {{ Auth::user()->details->blood_group ?? old('blood_group') == 'B+' ? 'selected' : '' }} value="B+">B+
									</option>
									<option {{ Auth::user()->details->blood_group ?? old('blood_group') == 'B-' ? 'selected' : '' }} value="B-">B-
									</option>
									<option {{ Auth::user()->details->blood_group ?? old('blood_group') == 'O+' ? 'selected' : '' }} value="O+">O+
									</option>
									<option {{ Auth::user()->details->blood_group ?? old('blood_group') == 'O-' ? 'selected' : '' }} value="O-">O-
									</option>
								</select>
								@if ($errors->has('blood_group'))
									<div class="text-danger">{{ $errors->first('blood_group') }}</div>
								@endif
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Update</button>
					</form>
				</div>
				<!--end::Card body-->
			</div>
			<!--end::details View-->

			<div class="card tab-pane fade mb-xl-10 mb-5" id="company_detail" role="tabpanel">
				<!--begin::Card header-->
				<div class="card-header cursor-pointer">
					<!--begin::Card title-->
					<div class="card-title m-0">
						<h3 class="fw-bold m-0">Office Details</h3>
					</div>
				</div>
				<!--begin::Card header-->
				<!--begin::Card body-->
				<div class="card-body p-9">
					<div class="row">
						<div class="col-md-6 form-group">
							<label for="">Employee Id </label>
							<input class="form-control" name="" type="text" value="{{ Auth::user()->emp_id }}" disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Company Branch </label>
							<input class="form-control" name="" type="text" value="{{ Auth::user()->companyBranch ? Auth::user()->companyBranch->name : 'N/A' }}"
								disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Department </label>
							<input class="form-control" name="" type="text" value="{{ Auth::user()->department ? Auth::user()->department->name : 'N/A' }}"
								disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Designation </label>
							<input class="form-control" name="" type="text"
								value="{{ Auth::user()->details->designation->name }}" disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Date of Joining</label>
							<input class="form-control" name="" type="date" value="{{ Auth::user()->joining_date }}" disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Official Email Id </label>
							<input class="form-control" name="" type="email" value="{{ Auth::user()->official_email_id }}"
								disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Offer Letter Id</label>
							<input class="form-control" name="" type="text" value="{{ Auth::user()->offer_letter_id }}"
								disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Official Phone Number</label>
							<input class="form-control" name="" type="text" value="{{ Auth::user()->official_mobile_no }}"
								disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Pan Card No.</label>
							<input class="form-control" name="" type="text"
								value="{{ Auth::user()->advanceDetails->aadhar_no }}" disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Aadhaar Card No.</label>
							<input class="form-control" name="" type="text" value="{{ Auth::user()->advanceDetails->pan_no }}"
								disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">UAN No.</label>
							<input class="form-control" name="" type="text" value="{{ Auth::user()->advanceDetails->uan_no }}"
								disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">ESIC No.</label>
							<input class="form-control" name="" type="text"
								value="{{ Auth::user()->advanceDetails->esic_no }}" disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">PF No.</label>
							<input class="form-control" name="" type="text" value="{{ Auth::user()->advanceDetails->pf_no }}"
								disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Insurance No.</label>
							<input class="form-control" name="" type="text"
								value="{{ Auth::user()->advanceDetails->insurance_no }}" disabled>
						</div>
						<div class="col-md-6 form-group">
							<label for="">Driving License No.</label>
							<input class="form-control" name="" type="text"
								value="{{ Auth::user()->advanceDetails->driving_licence_no }}" disabled>
						</div>
					</div>
				</div>
			</div>

			<div class="card tab-pane fade mb-xl-10 mb-5" id="account_detail" role="tabpanel">
				<!--begin::Card header-->
				<div class="card-header cursor-pointer">
					<!--begin::Card title-->
					<div class="card-title m-0">
						<h3 class="fw-bold m-0">Bank Account Details</h3>
					</div>
					<!--end::Card title-->

				</div>
				<!--begin::Card header-->
				<!--begin::Card body-->
				<div class="card-body p-9">
					<form method="post" action="{{ route('update.bankDetails.employee') }}">
						@csrf
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="">Account Holder Name*</label>
								<input class="form-control" name="account_name" type="text"
									value="{{ Auth::user()->bankDetails->account_name }}" required>
								@if ($errors->has('account_name'))
									<div class="text-danger">{{ $errors->first('account_name') }}</div>
								@endif
							</div>
							<div class="col-md-6 form-group">
								<label for="">Account No. *</label>
								<input class="form-control" name="account_number" type="text"
									value="{{ Auth::user()->bankDetails->account_number }}" required>
								@if ($errors->has('account_number'))
									<div class="text-danger">{{ $errors->first('account_number') }}</div>
								@endif
							</div>
							<div class="col-md-6 form-group">
								<label for="">IFSC Code *</label>
								<input class="form-control" name="ifsc_code" type="text"
									value="{{ Auth::user()->bankDetails->ifsc_code }}" required>
								@if ($errors->has('ifsc_code'))
									<div class="text-danger">{{ $errors->first('ifsc_code') }}</div>
								@endif
							</div>
							<div class="col-md-6 form-group">
								<label for="">Bank Name *</label>
								<input class="form-control" name="bank_name" type="text"
									value="{{ Auth::user()->bankDetails->bank_name }}" required>
								@if ($errors->has('bank_name'))
									<div class="text-danger">{{ $errors->first('bank_name') }}</div>
								@endif
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Update</a>
					</form>
				</div>
			</div>
			<div class="card tab-pane fade mb-xl-10 mb-5" id="address_tab" role="tabpanel">
				<!--begin::Card header-->
				<div class="card-header cursor-pointer">
					<!--begin::Card title-->
					<div class="card-title m-0">
						<h3 class="fw-bold m-0">My Address</h3>
					</div>
					<!--end::Card title-->

				</div>
				@php
					$local = [];
					$permanent = [];
					foreach ($userAddressDetails as $userAddress) {
					    if ($userAddress->address_type == 'local') {
					        $local = $userAddress;
					    }

					    if ($userAddress->address_type == 'permanent') {
					        $permanent = $userAddress;
					    }

					    if ($userAddress->address_type == 'both_same') {
					        $permanent = $userAddress;
					        $local = $userAddress;
					        $checkedbox = 'checked';
					        $inputDisabled = 'disabled';
					        $addressTypeValue = '1';
					    }
					}
				@endphp
				<div class="card-body p-9">
					<!--begin::Card header-->
					<!--begin::Card body-->
					<form id="address_Details_form" method="POST" action="{{ route('update.addressDetails.employee') }}">
						@csrf
						<input type="hidden" name="address_type" id="address_type" value="{{ $addressTypeValue ?? '0' }}">
						<div class="row">
							<div class="col-md-6">
								<h4>Present Address</h4>
								<div class="row">
									<div class="col-md-12 form-group">
										<label for="">Address *</label>
										<textarea class="form-control alldetails" type="text" name="l_address" id="l_address">{{ $local->address ?? '' }}</textarea>
									</div>
									<div class="col-md-6 form-group">
										<label for="">Country *</label>
										<select class="form-control alldetails" id="l_country_id" name="l_country_id">
											<option value="">Please Select Country</option>
											@forelse ($allCountries as $countriesDetails)
												<option {{ $local->country_id ?? old('l_country_id') == $countriesDetails->id ? 'selected' : '' }}
													value="{{ $countriesDetails->id }}">
													{{ $countriesDetails->name }}</option>
											@empty
												<option value="">No Country Found</option>
											@endforelse
										</select>
									</div>
									<div class="col-md-6 form-group">
										<label for="">State *</label>
										<select name="l_state_id" class="form-control alldetails" id="l_state_id">
										</select>
									</div>
									<div class="col-md-6 form-group">
										<label for="">City *</label>
										<input class="form-control alldetails" type="text" name="l_city" id="l_city"
											value="{{ $local->city ?? '' }}">
									</div>
									<div class="col-md-6 form-group">
										<label for="">Pincode *</label>
										<input class="form-control alldetails" type="text" name="l_pincode" id="l_pincode"
											value="{{ $local->pin_code ?? '' }}">
									</div>

								</div>
							</div>

							<div class="col-md-6">
								<h4>Permanent Address <input type="checkbox" onclick="get_all_present_address_details()" id="checkbox"
										{{ $checkedbox ?? '' }}>
									<small class="text-muted">Same as
										present address</small>
								</h4>
								<div class="row">
									<div class="col-md-12 form-group">
										<label for="">Address *</label>
										<textarea class="form-control" type="text" name="p_address" id="p_address" {{ $inputDisabled ?? '' }}> {{ $permanent->address ?? '' }}</textarea>
									</div>
									<div class="col-md-6 form-group">
										<label for="">Country *</label>
										<select class="form-control" id="p_country_id" name="p_country_id" {{ $inputDisabled ?? '' }}>
											<option value="">Please Select Country</option>
											@forelse ($allCountries as $countriesDetails)
												<option {{ $permanent->address ?? old('p_country_id') == $countriesDetails->id ? 'selected' : '' }}
													value="{{ $countriesDetails->id }}">
													{{ $countriesDetails->name }}</option>
											@empty
												<option value="">No Country Found</option>
											@endforelse
										</select>
									</div>
									<div class="col-md-6 form-group">
										<label for="">State *</label>
										<select name="p_state_id" class="form-control" id="p_state_id" {{ $inputDisabled ?? '' }}></select>
									</div>
									<div class="col-md-6 form-group">
										<label for="">City *</label>
										<input class="form-control" type="text" name="p_city" id="p_city"
											value="{{ $permanent->city ?? '' }}" {{ $inputDisabled ?? '' }}>
									</div>
									<div class="col-md-6 form-group">
										<label for="">Pincode *</label>
										<input class="form-control" type="text" name="p_pincode" id="p_pincode"
											value="{{ $permanent->pin_code ?? '' }}" {{ $inputDisabled ?? '' }}>
									</div>

								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Update</button>
					</form>
				</div>
			</div>

		</div>
		<!--end::Row-->
	</div>
	<!--end::Container-->
</div>
<div class="modal" id="change_password_model">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-500px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Close-->
				<h2>Change Password</h2>
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
					<span class="svg-icon svg-icon-1">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
								transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
							<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
								fill="currentColor"></rect>
						</svg>
					</span>
					<!--end::Svg Icon-->
				</div>
				<!--end::Close-->
			</div>
			<!--begin::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y border-top pb-5 pt-0">
				@include('employee.account.change_password')
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<script>
	jQuery(document).ready(function() {
		var l_div_id = 'l_state_id';
		let l_state_id = '{{ $local->state_id ?? '' }}';
		let l_country_id = '{{ $local->country_id ?? '' }}';
		if (l_state_id && l_country_id) {
			get_all_state_using_country_id(l_country_id, l_div_id, l_state_id);
		}

		var p_div_id = 'p_state_id';
		let p_state_id = '{{ $permanent->state_id ?? ' ' }}';
		let p_country_id = '{{ $permanent->country_id ?? ' ' }}';
		if (p_state_id && p_country_id) {
			get_all_state_using_country_id(p_country_id, p_div_id, p_state_id);
		}
	});
</script>
@endsection
