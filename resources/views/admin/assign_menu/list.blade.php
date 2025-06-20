<div id="assign_menu_list">
	<div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
		<div class="datatable-container">
			<table class="table" id="project-status">
				<thead>
					<tr>
						<th>
							<span class="f-light f-w-600">Sr No.</span>
						</th>
						<th>
							<span class="f-light f-w-600">Company</span>
						</th>
						<th>
							<span class="f-light f-w-600">Email</span>
						</th>
						<th>
							<p class="f-light">Menu Name</p>
						</th>
						<th>
							<p class="f-light">Action</p>
						</th>
					</tr>
				</thead>
				@forelse ($allCompanyDetails as $key => $companyDetails)
					<tr>
						<td>
							<p class="f-light">{{ $key + 1 }}</p>
						</td>

						<td>
							<p class="f-light">{{ $companyDetails->name }}</p>
						</td>
						<td>
							<p class="f-light">{{ $companyDetails->email }}</p>
						</td>
						<td>
							@forelse ($companyDetails->menus() as $menu)
								@if (!count($menu['children']))
									{{ ucfirst($menu['title']) }}
									@if (!$loop->last)
										,
									@endif
								@endif
							@empty
								No menu available
							@endforelse
						</td>
						<td>
							<a class="d-inline-flex" href="{{ route('admin.assign_menu.add') }}?id={{ $companyDetails->id }}">
								<div class="btn rounded-circle bg-blue text-white"
									style="width: 40px; height: 40px; padding: 8px; text-align: center;">
									<i class="fa fa-pencil"></i>
								</div>
							</a>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="6" class="text-danger text-center">No Company Menu Available</td>
					</tr>
				@endforelse
				</tbody>
			</table>
		</div>
		<div class="mt-3">
			{{ $allCompanyDetails->links('paginate') }}
		</div>
	</div>
</div>
