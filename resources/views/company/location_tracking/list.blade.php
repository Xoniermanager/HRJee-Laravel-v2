<div id="tracking_list" class="card-body py-3">
	<!--begin::Table container-->
	<div class="table-responsive">
		<!--begin::Table-->
		<table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
			<!--begin::Table head-->
			<thead>
				<tr class="fw-bold">
					<th>Sr. No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Is Currently Active ?</th>
					<th>Assigned Status</th>
					<th class="float-right">Action</th>
				</tr>
			</thead>
			@forelse ($trackingEnabledEmployees as $key => $item)
				<tbody class="">
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->email }}</td>
						<td>
							@if ($item->details->live_location_active == true)
								<span class="badge badge-pill badge-success">Active</span>
							@else
								<span class="badge badge-pill badge-danger">Inactive</span>
							@endif
						</td>
						<td data-order="Invalid date">
							<label class="switch">
								<input type="checkbox" <?= $item->details->location_tracking === 1 ? 'checked' : '' ?>
									onchange="handleStatus({{ $item->id }})" id="checked_value_{{ $item->id }}">
								<span class="slider round"></span>
							</label>
						</td>
						<td>
							<div class="d-flex justify-content-end flex-shrink-0">
								<a href="{{ route('track-location',$item->details->user_id)}}" class="btn btn-bg-light btn-primary btn-sm me-1">
									View Details
								</a>
							</div>
						</td>
					</tr>
				</tbody>
			@empty
				<td colspan="3">
					<span class="text-danger">
						<strong>No Employee Found!</strong>
					</span>
				</td>
			@endforelse
		</table>
	</div>
	{{ $trackingEnabledEmployees->links() }}
</div>
