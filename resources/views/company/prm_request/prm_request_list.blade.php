<div id="prm_category_list" class="card-body py-3">
	<!--begin::Table container-->
	<div class="table-responsive">
		<!--begin::Table-->
		<table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
			<!--begin::Table head-->
			<thead>
				<tr class="fw-bold">
					<th>Sr. No.</th>
					<th>User Name</th>
					<th>Category</th>
					<th>Amount</th>
					<th>Bill Date</th>
					<th>Remark</th>
					<th>Attachment</th>
					<th>Status</th>
				</tr>
			</thead>
			@forelse ($allPRMRequestDetails as $key => $prmRequestDetails)
				<tbody class="">
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ $prmRequestDetails->user->name }}</td>
						<td>{{ $prmRequestDetails->category->name }}</td>
						<td>{{ $prmRequestDetails->amount }}</td>
						<td>{{ date('Y-m-d', strtotime($prmRequestDetails->bill_date)) }}</td>
						<td>{{ $prmRequestDetails->remark }}</td>
                        
						<td>
							@php
								$document = $prmRequestDetails->document;
							@endphp

							@if ($document)
								@php
									$extension = pathinfo($document, PATHINFO_EXTENSION);
								@endphp

								@if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
									<a href="{{ asset('storage/' . $document) }}" target="_blank">
										<img src="{{ asset('storage/' . $document) }}" alt="Document" style="max-width: 80px; max-height: 80px;" />
									</a>
								@elseif (strtolower($extension) === 'pdf')
									<a href="{{ asset('storage/' . $document) }}" target="_blank">
										📄 View PDF
									</a>
								@else
									<span>Unsupported file</span>
								@endif
							@else
								<span>No Attachment</span>
							@endif
						</td>

						<td data-order="Invalid date">
							@if ($prmRequestDetails->status == 0)
								<select name="status" class="form-control min-w-150px me-2" id="status_{{ $prmRequestDetails->id }}"
									onchange="handleStatus({{ $prmRequestDetails->id }})">
									<option value="0">Pending</option>
									<option value="1">Approved</option>
									<option value="2">Rejected</option>
								</select>
							@else
								{{ $prmRequestDetails->status == 1 ? 'Approved' : 'Rejected' }}
							@endif
						</td>
					</tr>
				</tbody>
			@empty
				<td colspan="3">
					<span class="text-danger">
						<strong>No PRM Request Found!</strong>
					</span>
				</td>
			@endforelse
			<!--end::Table body-->
		</table>
		<!--end::Table-->
		{{ $allPRMRequestDetails->links() }}
	</div>
	<!--end::Table container-->

</div>
