<div class="">
	<!--begin::Table-->
	<table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
		<!--begin::Table head-->
		<thead>
			<tr class="fw-bold">
				<th><input type="checkbox" id="check_all"></th>
				<th> Sr. No.</th>
				<th class="min-w-150px"> Employee ID</th>
				<th class="min-w-150px">Name</th>
				{{-- <th>Department</th>
                <th>Designation</th> --}}
				{{-- <th>Email</th> --}}
				<th>Official Email</th>
				<th>Branch</th>
				{{-- <th>Gender</th> --}}
				{{-- <th class="min-w-150px">Marital Status</th> --}}
				{{-- <th class="min-w-100px">Joining Date</th> --}}
				{{-- <th class="min-w-150px">Employee Status</th> --}}
				{{-- <th class="min-w-150px">Employee Type</th> --}}
				{{-- <th class="min-w-150px">Shift</th> --}}
				<th class="">Status</th>
				@if (auth()->user()->companyDetails->allow_face_recognition == 1)
					<th class="">Allow Face Recognition</th>
				@endif
				<th class="">Action</th>
			</tr>
		</thead>
		<!--end::Table head-->
		<!--begin::Table body-->
		@forelse ($allUserDetails as $key => $singleUserDetails)
			<tbody class="">
				<tr>
					<td><input type="checkbox" name="user_id[]" value="{{ $singleUserDetails->id }}" class="item-checkbox"></td>
					<td>{{ $key + 1 }}</td>
					<td>{{ $singleUserDetails->details->emp_id ?? '' }}</td>
					<td>{{ $singleUserDetails->name }}</td>
					{{-- <td>{{ $singleUserDetails->department->name }}</td>
                <td>{{ $singleUserDetails->designation->name }}</td> --}}
					{{-- <td>{{ $singleUserDetails->email }}</td> --}}
					<td>{{ $singleUserDetails->details->official_email_id }}</td>
					<td>{{ $singleUserDetails?->details->companyBranch?->name }}</td>
					{{-- @if ($singleUserDetails->details->gender == 'M')
						<td>Male</td>
					@elseif($singleUserDetails->details->gender == 'N/A')
						<td>N/A</td>
					@else
						<td>Female</td>
					@endif --}}
					{{-- @if ($singleUserDetails->details->marital_status == 'S')
						<td>Single</td>
					@elseif($singleUserDetails->details->marital_status == 'N/A')
						<td>N/A</td>
					@else
						<td>Married</td>
					@endif --}}
					{{-- <td>{{ $singleUserDetails->details->joining_date }}</td> --}}

					{{-- <td>{{ $singleUserDetails->employeeStatus->name }}</td> --}}
					{{-- <td>{{ $singleUserDetails?->details->employeeType->name }}</td> --}}
					{{-- <td>{{ $singleUserDetails->officeShift->name }}</td> --}}
					<td data-order="Invalid date">
						<label class="switch">
							<input type="checkbox" <?= $singleUserDetails->status == '1' ? 'checked' : '' ?>
								onchange="handleStatus({{ $singleUserDetails->id }})" id="checked_value_{{ $singleUserDetails->id }}">
							<span class="slider round"></span>
						</label>
					</td>
					@if (auth()->user()->companyDetails->allow_face_recognition == 1)
						<td data-order="Invalid date">
							<label class="switch">
								<input type="checkbox" <?= $singleUserDetails->details->face_recognition == '1' ? 'checked' : '' ?>
									onchange="handleFaceRecognition({{ $singleUserDetails->id }})"
									id="checked_face_value_{{ $singleUserDetails->id }}">
								<span class="slider round"></span>
							</label>
						</td>
					@endif
					<td>
						<div class="d-flex justify-content-end flex-shrink-0">
							<a href="{{ route('employee.view', $singleUserDetails->id) }}"
								class="btn btn-dark btn-sm me-1">
								<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
								<i class="fa fa-eye"></i>
								<!--end::Svg Icon-->
							</a>
							<!--begin::Menu-->
							<div class="me-1">
								<button class="btn btn-primary btn-sm" data-kt-menu-trigger="click"
									data-kt-menu-placement="bottom-end">
									<i class="fa fa-edit"></i>
								</button>
								<!--begin::Menu 3-->
								<div
									class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
									data-kt-menu="true">

									<!--begin::Menu item-->
									<div class="menu-item px-3" data-bs-toggle="modal" data-bs-target="#personal_details">
										<a href="#" class="menu-link px-3" onclick="getPersonalDetails({{ $singleUserDetails->id }});">Personal
											Details</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3" data-bs-toggle="modal" data-bs-target="#advance_details">
										<a href="#" class="menu-link flex-stack px-3"
											onclick="getAdvanceDetails({{ $singleUserDetails->id }})">Advance
											Details </a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3" data-bs-toggle="modal" data-bs-target="#address"
										onclick="getAddressDetails({{ $singleUserDetails->id }})">
										<a href="#" class="menu-link px-3">Address</a>
									</div>
									<!--end::Menu item-->

									<!--begin::Menu item-->
									<div class="menu-item my-1 px-3" data-bs-toggle="modal" data-bs-target="#bank_details">
										<a href="#" class="menu-link px-3" onclick="getBankDetails({{ $singleUserDetails->id }})">Bank
											Details</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item my-1 px-3" data-bs-toggle="modal" data-bs-target="#upload_documents">
										<a href="{{ route('employee.edit', $singleUserDetails->id) }}" class="menu-link px-3">
											Edit Employee Detail</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu 3-->
							</div>
							<a href="#" class="btn btn-danger btn-sm me-1"
								onclick="deleteFunction('{{ $singleUserDetails->id }}')">
								<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
								<i class="fa fa-sign-out-alt"></i>
								<!--end::Svg Icon-->
							</a>
						</div>
					</td>
				</tr>
			@empty
				<td colspan="3">
					<span class="text-danger">
						<strong>No Employee Available!</strong>
					</span>
				</td>
			</tbody>
		@endforelse
		<!--end::Table body-->
	</table>
    <div class="paginate">
        {{ $allUserDetails->appends(request()->query())->links() }}
    </div>

