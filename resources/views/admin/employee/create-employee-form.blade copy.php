@extends('layouts.company.main')

@section('title', 'main')

@section('content')
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
					<!--begin::Container-->
					<div class="container-xxl" id="kt_content_container">
						<!--begin::Row-->
						<div class="row gy-5 g-xl-10">
							<!--begin::Col-->
						 <form method="post" action="{{ route('add.employee')}}" enctype="multipart/form-data">
                         @csrf
							<div class="card card-body mb-3"> 
								<div class="card-header p-4">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Personal Details
										</h3>
									</div>
									<!--end::Card title-->
								</div>
									<div class="card-body">
											<div class="row">
												<div class="col-md-6 form-group">
													<label for="">Full Name <span style="color: red;">*</span></label>
													<input class="form-control" type="text" name="full_name" value="{{isset($employee['user']->full_name)?$employee['user']->full_name:old('full_name')}}">
													@error('full_name')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
												<div class="col-md-6 form-group">
													<label for="">Email <span style="color: red;">*</span></label>
													<input class="form-control" type="email" name="email" value="{{isset($employee['user']->email)? $employee['user']->email : old('email')}}">
													@error('email')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
												<div class="col-md-6 form-group">
													<label for="">Password <span style="color: red;">*</span></label>
													<input class="form-control" type="password" name="password" value="{{old('password')}}">
													@error('password')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
												
												<div class="col-md-6 form-group">
													<label for="">Gaurdian's Name </label>
													<input class="form-control" type="text" name="father_name" value="{{isset($employee['user']['user_details']->gurdian_name)? $employee['user']['user_details']->gurdian_name : old('gurdian_name')}}">
													@error('father_name')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
												<div class="col-md-6 form-group">
													<label for="">Gender <span style="color: red;">*</span></label>
													<select class="form-control" name="gender">
														<option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
														<option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option> 
														<option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option> 
													</select>
													@error('gender')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
												<div class="col-md-6 form-group">
													<label for="">Date of Birth </label>
													<input class="form-control" name="date_of_birth" type="date" value="{{isset($employee['user']['user_details']->date_of_birth)? $employee['user']['user_details']->date_of_birth : old('date_of_birth')}}"> 
													@error('date_of_birth')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
												<div class="col-md-6 form-group">
													<label for="">Number <span style="color: red;">*</span></label>
													<input class="form-control" name="phone" type="number" value="{{old('phone')}}"> 
													@error('phone')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
												<div class="col-md-6 form-group">
													<label for="">Photo </label>
													<input class="form-control" type="file" name="profile_image" value="{{old('profile_image')}}">
													@error('profile_image')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
												<div class="col-md-6 form-group">
													<label for="">Family Contact Number </label>
													<input class="form-control" type="text" name="family_contact_number" value="{{old('family_contact_number')}}">
													@error('family_contact_number')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>
											 
											</div>								 
									</div>
							 
							</div>
							<div class="card card-body mb-3"> 
								<div class="card-header p-4">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Company Details
										</h3>
									</div>
									<!--end::Card title-->
								</div>
 
									<div class="card-body">
											<div class="row">											 
												<div class="col-md-6 form-group">
													<label for="">Branch <span style="color: red;">*</span></label>
													<select class="form-select mb-3" name="branch">
														<option value="">Select Branch</option>
														@foreach ($branches as $branch)
															<option value="{{ $branch->id }}" {{ old('branch') == $branch->id ? 'selected' : '' }}>
																{{ $branch->name }}
															</option>
														@endforeach
													</select>
													@error('branch')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>											 
												<div class="col-md-6 form-group">
													<label for="">Department <span style="color: red;">*</span></label>
													<select class="form-select mb-3" name="department_id">
														<option value="">Select department</option>
														@foreach ($departments as $department)
															<option value="{{ $department->id }}" {{ (old('department_id') == $department->id) ? 'selected' : '' }}>
																{{ $department->name }}
															</option>
														@endforeach
													</select>

													@error('department_id')
														<div class="text-danger">{{ $message }}</div>
													@enderror
												</div>				
																			 
												<div class="col-md-6 form-group">
													<label for="">Designation <span style="color: red;">*</span></label>
													<select class="form-select mb-3" name="designation_id">
														<option value="">Select Designation</option>
														@foreach ($designations as $designation)
															<option value="{{ $designation->id }}" {{ (old('designation_id') == $designation->id) ? 'selected' : '' }}>
																{{ $designation->name }}
															</option>
														@endforeach
													</select>

													@error('designation_id')
														<div class="text-danger">{{ $message }}</div>
													    @enderror
												</div>
												<div class="col-md-6 form-group">
													<label for="">Employee ID <span style="color: red;">*</span></label>
													<input class="form-control" name="employee_id" type="text"  value="{{old('employee_id')}}">
													@error('employee_id')
														<div class="text-danger">{{ $message }}</div>
													@enderror 
												</div>
												<div class="col-md-6 form-group">
													 <label for="">Manager ID <span style="color: red;">*</span></label>
													 <input class="form-control" type="number" name="manager_id"  value="{{old('manager_id')}}">
												  </div>	
												<div class="col-md-6 form-group">
													<label for="">Joining Date </label>
													<input class="form-control" type="date" name="joining_date" value="{{old('joining_date')}}">
												</div>
												<div class="col-md-6 form-group">
													<label for="">Basic Pay </label>
													<input class="form-control" type="text" name="basic_pay" value="{{old('basic_pay')}}">
												</div>
												<div class="col-md-6 form-group">
													<label for="">Rent Allowance </label>
													<input class="form-control" type="text" name="rent_allowance"  value="{{old('rent_allowance')}}">
												</div>
												<div class="col-md-6 form-group">
													<label for="">Medical Allowance </label>
													<input class="form-control" type="text" name="madical_allowance"  value="{{old('madical_allowance')}}">
												</div>
												<div class="col-md-6 form-group">
													<label for="">Travel Allowance </label>
													<input class="form-control" type="text" name="travel_allwance"  value="{{old('travel_allwance')}}">
												</div>
											 
											</div>								 
									</div>
							 
							</div>
							<div class="card card-body mb-3"> 
								<div class="card-header p-4">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Permanent Address 
										</h3>
									</div>
									<!--end::Card title-->
								</div>
 
									<div class="card-body">
											<div class="row">											 
												<div class="col-md-6 form-group">
													<label for="">Address  </label>
													<input class="form-control" type="text" name="permanent_address" value="{{old('permanent_address')}}">
												 </div>											 
												 <div class="col-md-6 form-group">
													 <label for="">City  </label>
													 <input class="form-control" type="text" name="permanent_city" value="{{old('permanent_city')}}">
												  </div>											 
												  <div class="col-md-6 form-group">
													  <label for="">State  </label>
													  <input class="form-control" type="text" name="permanent_state" value="{{old('permanent_state')}}">
												   </div>											 
												   <div class="col-md-6 form-group">
													   <label for="">Pincode  </label>
													   <input class="form-control" type="text" name="permanent_pincode" value="{{old('permanent_pincode')}}">
													</div>	 
											 
											</div>								 
									</div>
							 
							</div>
							<div class="card card-body mb-3"> 
								<div class="card-header p-4">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Temporary Address 
										</h3>
									</div>
									<!--end::Card title-->
								</div>
 
									<div class="card-body">
											<div class="row">											 
												<div class="col-md-6 form-group">
													<label for="">Address  </label>
													<input class="form-control" type="text" name="temporary_address" value="{{old('temporary_address')}}">
												 </div>											 
												 <div class="col-md-6 form-group">
													 <label for="">City  </label>
													 <input class="form-control" type="text" name="temporary_city" value="{{old('temporary_city')}}">
												  </div>											 
												  <div class="col-md-6 form-group">
													  <label for="">State  </label>
													  <input class="form-control" type="text" name="temporary_state" value="{{old('temporary_state')}}">
												   </div>											 
												   <div class="col-md-6 form-group">
													   <label for="">Pincode  </label>
													   <input class="form-control" type="text" name="temporary_pincode" value="{{old('temporary_pincode')}}">
													</div>	 
											 
											</div>								 
									</div>
							 
							</div>
							<div class="card card-body mb-3"> 
								<div class="card-header p-4">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Bank Account Details 
										</h3>
									</div>
									<!--end::Card title-->
								</div>
 
									<div class="card-body">
											<div class="row">											 
												<div class="col-md-6 form-group">
													<label for="">Account Holder Name </label>
													<input class="form-control" type="text" name="account_name"  value="{{old('temporary_pincode')}}">
												 </div>											 
												 <div class="col-md-6 form-group">
													 <label for="">Account Number </label>
													 <input class="form-control" type="number" name="account_number"  value="{{old('account_number')}}">
												  </div>											 
												  <div class="col-md-6 form-group">
													  <label for="">Bank Name </label>
													  <input class="form-control" type="text" name="bank_name"  value="{{old('bank_name')}}">
												   </div>											 
												   <div class="col-md-6 form-group">
													   <label for="">IFSC Code </label>
													   <input class="form-control" type="text" name="ifsc_code"  value="{{old('ifsc_code')}}" >
													</div>	 											 
													<div class="col-md-6 form-group">
														<label for="">PAN Number </label>
														<input class="form-control" type="text" name="pan_no"  value="{{old('pan_no')}}">
													 </div>												 
													 <div class="col-md-6 form-group">
														 <label for="">UAN</label>
														 <input class="form-control" type="text" name="uan_no"  value="{{old('uan_no')}}">
													  </div>	
													  <div class="col-md-6 form-group">
														 <label for="">Aadhar </label>
														 <input class="form-control" type="text" name="aadhar_no"  value="{{old('aadhar_no')}}">
													  </div>  
													  
											 
											</div>								 
									</div>
							 
							</div>
							<div class="card card-body mb-3"> 
								<div class="card-header p-4">
									<!--begin::Card title-->
									<div class="card-title m-0">
										<h3 class="fw-bold m-0"> Upload Documents </h3>
									</div>
									<!--end::Card title-->
								</div>
 
									<div class="card-body">
											<div class="row">											 
												<!-- <div class="col-md-6 form-group">
													<label for="">Resume </label>
													<input class="form-control" type="file" name="resume" value="{{old('resume')}}">
												 </div>											 
												 <div class="col-md-6 form-group">
													 <label for="">Offer Letter </label>
													 <input class="form-control" type="file" name="offer_letter" value="{{old('offer_letter')}}">
												  </div>											 
												  <div class="col-md-6 form-group">
													  <label for="">Joining Letter  </label>
													  <input class="form-control" type="file"  name="joining_letter" value="{{old('joining_letter')}}">
												   </div>											 
												   <div class="col-md-6 form-group">
													   <label for="">Other Document (Upload Multiple) </label>
													   <input class="form-control" type="file" name="other_document" value="{{old('other_document')}}">
													</div>	 
											  -->
											</div>
											<button class="btn btn-primary">Save</button>								 
									</div>
							 
							</div>
 							</form>
							<!--end::Col-->
						</div>
						<!--end::Row-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Content-->

@endsection
