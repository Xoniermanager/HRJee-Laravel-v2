<div id="company_resignation_list" class="card-body py-3">
	<!--begin::Table container-->
	<div class="table-responsive">
		<!--begin::Table-->
		<table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
			<!--begin::Table head-->
			<thead>
				<tr class="fw-bold">
					<th>Sr. No.</th>
					@if (Auth::guard('company')->id())
						<th class="min-w-150px">Employee Name</th>
					@endif
					<th>Apply Date</th>
					<th>Release Date</th>
					<th>Status</th>
					<th class="float-right">Action</th>
				</tr>
			</thead>
			@forelse ($resignations as $key => $resignation)
				<tbody class="">
					<tr>
						<td>{{ $key + 1 }}</td>
						@if (Auth::guard('company')->id())
							<td>
								<b>{{ $resignation->user->name }}</b>
							</td>
						@endif
						<td>{{ date('d-m-Y h:i A', strtotime($resignation->created_at)) }}</td>
						<td>{{ !empty($resignation->release_date) ? date('d-m-Y h:i A', strtotime($resignation->release_date)) : '--' }}
						</td>
						<td>
							@php
								$status = $resignation->status;
								if ($resignation->status == 'hold') {
								    $status = 'pending';
								}
								if ($resignation->status == 'approved') {
								    $status = 'completed';
								}
							@endphp
							<x-status-badge status="{{ $status }}" text="{{ $resignation->status }}" />
						</td>
						{{-- <td> --}}
						{{-- <div class="segment-control" id="statusSegment">
                                            <button data-status="pending">Pending</button>
                                            <button data-status="approved">approved</button>
                                            <button data-status="rejected">rejected</button>
                                            <button data-status="withdrawn">withdrawn</button>
                                            <button data-status="hold">hold</button>
                                        </div> --}}
						{{-- </td> --}}
						<td>
							<div class="d-flex justify-content-end flex-shrink-0">
								<a href="{{ route('resignation.view', $resignation->id) }}"
									class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>

								@if ($resignation->status == 'pending')
									@if (Auth::guard('employee')->id() == $resignation->user_id)
										<a href="#" data-bs-toggle="modal" onClick="edit_resignation('{{ $resignation }}')"
											class="btn btn-icon btn-bg-light text-danger btn-active-color-primary btn-sm me-1">
											<i class="fa fa-edit" aria-hidden="true"></i>
										</a>
									@endif
								@endif

								@if (Auth::guard('company')->id())
									<a href="#" data-bs-toggle="modal" onClick="action_resignation('{{ $resignation }}')"
										class="btn btn-icon btn-bg-light text-danger btn-active-color-primary btn-sm me-1">
										<i class="fas fa-sync-alt"></i>
									</a>
								@endif

								@if (
                                    ($resignation->status != 'withdrawn' && $resignation->status != 'approved') &&
                                    Auth::guard('employee')->id() == $resignation->user_id
                                )
									<a href="#" data-bs-toggle="modal" onClick="action_resignation('{{ $resignation }}', true)"
										class="btn btn-icon btn-bg-light text-danger btn-active-color-primary btn-sm me-1">
										<i class="fa fa-times" aria-hidden="true"></i>
									</a>
								@endif
							</div>
						</td>
					</tr>
				</tbody>
			@empty
				<td colspan="3">
					<span class="text-danger">
						<strong>No Resignation Found!</strong>
					</span>
				</td>
			@endforelse
			<!--end::Table body-->
		</table>
		<!--end::Table-->
	</div>
	<!--end::Table container-->

</div>

{{-- <script>
    const segmentControl = document.getElementById('statusSegment');
    
    segmentControl.addEventListener('click', (event) => {
        if (event.target.tagName === 'BUTTON') {
            segmentControl.querySelectorAll('button').forEach(button => {
                button.classList.remove('active');
            });
            
            event.target.classList.add('active');
            const newStatus = event.target.getAttribute('data-status');
        }
    });

    const statusSegmentButtons = document.querySelectorAll('#statusSegment button');
    
    function disableSegmentInput() {
        statusSegmentButtons.forEach(button => {
            button.disabled = true;
        });
    }

    disableSegmentInput()
    
    function enableSegmentInput() {
        statusSegmentButtons.forEach(button => {
            button.disabled = false;
        });
    }
</script> --}}

<style>
	.segment-control {
		display: inline-flex;
		border: 1px solid #ccc;
		border-radius: 8px;
		overflow: hidden;
		background-color: #f9f9f9;
	}

	.segment-control button {
		padding: 10px 20px;
		border: none;
		background: none;
		cursor: pointer;
		outline: none;
		font-size: 14px;
		transition: background-color 0.2s, color 0.2s;
	}

	.segment-control button.active {
		background-color: #007bff;
		color: white;
	}

	.segment-control button:disabled {
		background-color: #e0e0e0;
		color: #aaa;
		cursor: not-allowed;
	}

	.segment-control button.active:disabled {
		background-color: #0056b3;
		color: white;
	}

	.segment-control.disabled {
		pointer-events: none;
		opacity: 0.8;
	}
</style>

{{ $resignations->links() }}
