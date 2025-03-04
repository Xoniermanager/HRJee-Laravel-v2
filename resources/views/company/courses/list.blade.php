<div class="table-responsive" id="employee_list">
	<!--begin::Table-->
	<table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
		<!--begin::Table head-->
		<thead>
			<tr class="fw-bold">
				<th>Sr. No.</th>
				<th>Title</th>
				<th>Department</th>
                <th>Designation</th>
				<th>Type</th>
				<th>Link</th>
				<th>Action</th>
			</tr>
		</thead>
		<!--end::Table head-->
		<!--begin::Table body-->
		@forelse ($courses as $key => $course)
			<tbody class="">
				<tr>
					<td>{{ $key + 1 }}</td>
					<td>{{ $course->title }}</td>
					<td>{{ $course->department->name }}</td>
                    <td>{{ $course->designation->name }}</td>
					<td>{{ $course->video_type }}</td>
					<td><a href="{{ $course->video_type == "pdf" ? $course->pdf_file : $course->video_url }}" target="_blank">{{ $course->video_type == "pdf" ? $course->pdf_file : $course->video_url }}</a></td>
					<td>
						<div class="d-flex justify-content-end flex-shrink-0">
							<a href="{{ route('employee.view', $course->id) }}"
								class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
								<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
								<i class="fa fa-eye"></i>
								<!--end::Svg Icon-->
							</a>
							<!--begin::Menu-->
							<div class="me-1">
								<button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click"
									data-kt-menu-placement="bottom-end">
									<i class="fa fa-edit"></i>
								</button>
								<!--begin::Menu 3-->
								<div
									class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
									data-kt-menu="true">
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item my-1 px-3" data-bs-toggle="modal" data-bs-target="#upload_documents">
										<a href="{{ route('course.edit', $course->id) }}" class="menu-link px-3">
											Edit Detail</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu 3-->
							</div>
							<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
								onclick="deleteFunction('{{ $course->id }}')">
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
	<!--end::Table-->
</div>
