<div class="table-responsive" id="employee_list">
    <!--begin::Table-->
    <table class="table-row-dashed table-row-gray-300 gs-0 gy-4 table align-middle">
        <!--begin::Table head-->
        <thead>
            <tr class="fw-bold">
                <th>Sr. No.</th>
                <th class="min-w-150px">Name</th>
                <th>Email</th>
                <th>Branch</th>
                <th class="min-w-150px">Employee Type</th>
                <th class="min-w-150px">KYC Image</th>
                <th class="min-w-150px">Punch-In Image</th>
                <th class="min-w-150px">Action</th>
            </tr>
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        @forelse ($allUserDetails as $key => $singleUserDetails)
            <tbody class="">
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $singleUserDetails->name }}</td>
                    <td>{{ $singleUserDetails->email }}</td>
                    <td>{{ $singleUserDetails?->details->companyBranch?->name }}</td>
                    <td>{{ $singleUserDetails?->details->employeeType->name }}</td>
                    @if($singleUserDetails?->details->face_kyc)
                    	<td><img src="https://face-recoginition.s3.us-east-1.amazonaws.com/{{ $singleUserDetails?->details->face_kyc }}" width="60" height="60"></td>
                	@else
                    	<td>NA</td>
        			@endif
        			@if($singleUserDetails?->details->face_punchin_kyc)
						<td><img src="https://face-recoginition.s3.us-east-1.amazonaws.com/{{ $singleUserDetails?->details->face_punchin_kyc }}" width="60" height="60"></td>
    				@else
        				<td>NA</td>
        			@endif
					<td><a href="#"
						class="btn btn-danger btn-sm me-1"
						onclick="deleteFunction('{{ $singleUserDetails->id }}')">
						<i class="fa fa-trash"></i>
					</a></td>
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
