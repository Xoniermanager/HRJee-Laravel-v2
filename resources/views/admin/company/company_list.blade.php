<div class="list-product" id="company_list">
	<div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
		<div class="datatable-container">
			<table class="nowrap table" id="project-status">
				<thead>
					<tr>
						<th>
							<span class="f-light f-w-600">Sr No.</span>
						</th>
						<th>
							<span class="f-light f-w-600">Company Id</span>
						</th>
						<th>
							<span class="f-light f-w-600">Company Name</span>
						</th>
						<th>
							<p class="f-light">Onboarding Date</p>
						</th>
						<th>
							<span class="f-light f-w-600">Email</span>
						</th>
						<th>
							<span class="f-light f-w-600">Contact No.</span>
						</th>
						<th>
							<span class="f-light f-w-600">Address</span>
						</th>
						<th>
							<span class="f-light f-w-600">company size</span>
						</th>
						<th>
							<span class="f-light f-w-600">Status</span>
						</th>

						<th>
							<span class="f-light f-w-600">Action</span>
						</th>
					</tr>
				</thead>
				@forelse ($allCompaniesDetails as $key => $companiesDetails)
					<tr>
						<td>
							<p class="f-light">{{ $key + 1 }}</p>
						</td>

						<td>
							<p class="f-light">{{ $companiesDetails->id }}</p>
						</td>
						<td>
							<p class="f-light">{{ $companiesDetails->name }}</p>
						</td>
						<td>
							<p class="f-light">{{ getFormattedDate($companiesDetails->companyDetails->joining_date) }}</p>
						</td>
						<td>
							<p class="f-light">{{ $companiesDetails->email }}</p>
						</td>
						<td>
							<p class="f-light">{{ $companiesDetails->companyDetails->contact_no }}</p>
						</td>
						<td>
							<p class="f-light mb-0"
								style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block;"
								data-bs-toggle="tooltip" title="{{ $companiesDetails->companyDetails->company_address }}">
								{{ $companiesDetails->companyDetails->company_address }}
							</p>
						</td>
						<td>
							<span class="badge badge-primary p-2">{{ $companiesDetails->companyDetails->company_size }}</span>
						</td>
						<td>
							<div class="form-check form-switch form-check-inline">
								<input type="checkbox" <?= $companiesDetails->status == '1' ? 'checked' : '' ?>
									onchange="handleStatus({{ $companiesDetails->id }})" id="checked_value_{{ $companiesDetails->id }}"
									class="form-check-input switch-info check-size">
								<span class="slider round"></span>
							</div>
						</td>

						<td>
							<div class="product-action d-flex gap-2">
								<a href="javascript:void(0);" onclick="openResetPasswordModal('{{ $companiesDetails->id }}')"
									class="btn btn-sm btn-light border" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Password">
									<i class="fa fa-key"></i>
								</a>
								<a href="{{ route('admin.edit_company', ['id' => $companiesDetails->id]) }}"
									class="btn btn-sm btn-light border" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Company">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#" onclick="deleteFunction('{{ $companiesDetails->id }}')" class="btn btn-sm btn-light border"
									data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Company">
									<i class="fa fa-trash"></i>
								</a>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td class="text-danger text-center" colspan="7">No Company Available</td>
					</tr>
				@endforelse
				</tbody>
			</table>
		</div>
	</div>
	<div class="mt-3">
		{{ $allCompaniesDetails->links('paginate') }}
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		tooltipTriggerList.forEach(function(tooltipTriggerEl) {
			new bootstrap.Tooltip(tooltipTriggerEl)
		})
	});
</script>
