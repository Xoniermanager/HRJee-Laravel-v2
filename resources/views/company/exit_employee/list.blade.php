<div id="list_employee">
	<div class="table-responsive">
		<!--begin::Table-->
		<table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
			<!--begin::Table head-->
			<thead>
				<tr class="fw-bold">
					<th>Sr. No.</th>
					<th>Employee Name</th>
					<th>Employee Id</th>
					<th>Official Email</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Joining Date</th>
					<th>Exit Date</th>
				</tr>
			</thead>
			@forelse ($allEmployeeExitDetails as $key => $employeeDetail)
				<tbody class="">
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ $employeeDetail->name }}</td>
						<td>{{ $employeeDetail->detail->emp_id }}</td>
						<td>{{ $employeeDetail->detail->official_email_id }}</td>
						<td>{{ $employeeDetail->email }}</td>
						<td>{{ $employeeDetail->detail->phone }}</td>
						<td>{{ getFormattedDate($employeeDetail->detail->joining_date) }}</td>
						<td>{{ getFormattedDate($employeeDetail->detail->exit_date) }}</td>
					</tr>
				</tbody>
			@empty
				<td colspan="3">
					<span class="text-danger">
						<strong>No Exit Employee Found!</strong>
					</span>
				</td>
			@endforelse
		</table>
		{{ $allEmployeeExitDetails->links() }}
	</div>
</div>
