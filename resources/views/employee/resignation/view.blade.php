@extends(Auth::guard('company')->id() ? 'layouts.company.main' : 'layouts.employee.main')
@section('content')
@section('title')
	Resignation Detail
@endsection
<div class="card card-body col-md-12">
	<div class="mb-xl-10 mb-5">
		<div class="card-body">
			<div class="card-body py-3">
				<div class="table-responsive">
					<table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
						<tbody class="">
							@if (Auth::guard('company')->id())
								<tr>
									<th class="min-w-150px">Employee Name</th>
									<td>
										<b>{{ $resignation->user->name }}</b>
									</td>
								</tr>
							@endif
							<tr>
								<th class="min-w-150px">Remark</th>
								<td>{{ $resignation->remark }}</td>
							</tr>
							<tr>
								<th>Resignation Date & Time</th>
								<td>
									<span class="btn btn-success btn-sm me-1">
										{{ date('Y-m-d h:i A', strtotime($resignation->created_at)) }}
									</span>
								</td>
							</tr>
							<tr>
								<th>Release Date</th>
								<td>
									<span class="btn btn-success btn-sm me-1">
										{{ !empty($resignation->release_date) ? date('Y-m-d h:i A', strtotime($resignation->release_date)) : '--' }}
									</span>
								</td>
							</tr>
							<tr>
								<th>Resignation Status</th>
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
							</tr>

							<tr>
								<th colspan="2">Resignation Logs</th>
							</tr>

							@forelse ($resignation->resignationActionDetails as $row)
								<tr>
									<th>Action Taken By</th>
									<td> {{ $row->actionTakenBy->name }}</td>
									<th>Status</th>
									<td>
										@php
											$status = $row->status;
											if ($row->status == 'hold') {
											    $status = 'pending';
											}
											if ($row->status == 'approved') {
											    $status = 'completed';
											}
										@endphp
										<x-status-badge status="{{ $status }}" text="{{ $row->status }}" />
									</td>
									<th>Remark </th>
									<td> {{ $row->remark }}</td>
								</tr>
							@empty
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
