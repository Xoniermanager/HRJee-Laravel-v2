<div id="department_list" class="card-body py-3">
	<!--begin::Table container-->
	<div class="table-responsive">
		<!--begin::Table-->
		<table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
			<!--begin::Table head-->
			<thead>
				<tr class="fw-bold">
					<th>Sr. No.</th>
					<th>Department Name</th>
					<th>Status</th>
					<th class="float-right">Action</th>
				</tr>
			</thead>
			@forelse ($allDepartmentDetails as $key => $departmentDetails)
				<tbody class="">
					<tr>
						<td>{{ $key + 1 }}</td>
						<td><a href="#" data-bs-toggle="modal"
								onClick="edit_department_details('{{ $departmentDetails->id }}', '{{ $departmentDetails->name }}')">{{ $departmentDetails->name }}</a>
						</td>
						<td data-order="Invalid date">
							<label class="switch">
								<input type="checkbox" <?= $departmentDetails->status == '1' ? 'checked' : '' ?>
									onchange="handleStatus({{ $departmentDetails->id }})" id="checked_value_{{ $departmentDetails->id }}">
								<span class="slider round"></span>
							</label>
						</td>

						<td>
							<div class="d-flex justify-content-end flex-shrink-0">
								<a href="#" data-bs-toggle="modal"
									onClick="edit_department_details('{{ $departmentDetails->id }}', '{{ $departmentDetails->name }}')"
									class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
									<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
									<i class="fa fa-edit"></i>
									<!--end::Svg Icon-->
								</a>
								<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
									onclick="deleteFunction('{{ $departmentDetails->id }}')">
									<i class="fa fa-trash"></i>
								</a>
							</div>
						</td>
					</tr>
				</tbody>
			@empty
				<td colspan="3">
					<span class="text-danger">
						<strong>No Department Found!</strong>
					</span>
				</td>
			@endforelse
			<!--end::Table body-->
		</table>
		{{ $allDepartmentDetails->links() }}
		<!--end::Table-->
	</div>
	<!--end::Table container-->

</div>
