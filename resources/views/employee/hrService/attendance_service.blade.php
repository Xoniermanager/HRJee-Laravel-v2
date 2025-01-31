@extends('layouts.employee.main')
@section('content')
@section('title')
	Attendance
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
	<!--begin::Container-->
	<div class="container-xxl" id="kt_content_container">
		<!--begin::Row-->
		<div class="row gy-5 g-xl-10">
			<!--begin::Col-->
			<div class="card card-body col-md-12">
				<div class="py-15 cursor-pointer p-0">
					<!--begin::Card title-->
					<div class="card-title m-0">
						<div class="row">
							<div class="col-md-4">
								<label for="">From date</label>
								<input type="date" value="{{ date('Y-m-01') ?? old('from_date') }}" class="form-control date mb-3"
									id="from_date">
							</div>
							<div class="col-md-4">
								<label for="">To date</label>
								<input type="date" value="{{ date('Y-m-d') ?? old('to_date') }}" class="form-control date mb-3"
									id="to_date">
							</div>
							<div class="col-md-4 mt-5">
								<button class="btn btn-sm btn-primary" id="export_button"> Export Attendance</button>
							</div>
						</div>
					</div>
				</div>
				<div class="separator mb-9"></div>

				<div class="mb-xl-10 mb-5">
					<h1 class="d-flex flex-column text-dark fs-2 fw-bold title-text">
						Attendance Details
					</h1>
					<div class="">
						<div class="">
							<!--begin::Body-->
							<div class="">
								<div class="card-body py-3">
									@include('employee.hrService.attendance_list')
								</div>
							</div>
							<!--begin::Body-->
						</div>
						<!--begin::Body-->
					</div>
					<!--begin::Body-->
				</div>
			</div>
			<!--end::Col-->
		</div>
		<!--end::Row-->
	</div>
	<!--end::Container-->
</div>
<script>
	jQuery(".date").on('change', function() {
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		if (from_date && to_date) {
			search_filter_results()
		} else {
			return false;
		}
	});
	$('#export_button').on('click', function() {
		let empId = {{ Auth()->user()->id }};
		exportAttendanceByUserIdByToDateFromDate(empId, $('#to_date').val(), $('#from_date').val())
	});
	$(document).on('click', '#attendance_list a', function(e) {
		e.preventDefault();
		var page_no = $(this).attr('href').split('page=')[1];
		search_filter_results(page_no);
	});

	function search_filter_results(page_no = 1) {
		$.ajax({
			type: 'GET',
			url: employee_ajax_base_url + "/search/filter/date?page=" + page_no,
			data: {
				'from_date': $('#from_date').val(),
				'to_date': $('#to_date').val()
			},
			success: function(response) {
				$('#attendance_list').replaceWith(response.data);
			}
		});
	}
</script>
@endsection
