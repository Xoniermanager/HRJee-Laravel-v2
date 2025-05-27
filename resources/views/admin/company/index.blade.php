@extends('layouts.admin.main')
@section('title', 'Company Management')
@section('content')
	<div class="page-body">
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header file-content border-0 pb-0">
							<div class="d-md-flex d-sm-block">
								<form class="form-inline" action="#" method="get">
									<div class="form-group d-flex align-items-center mb-0"> <i class="fa fa-search"></i>
										<input class="form-control-plaintext" type="text" placeholder="Search..." id="search">
									</div>
								</form>
								<div class="ml-10px" style="margin-left: 10px;">
									<select class="form-select h-50px" name="filterByStatus" id="filterByStatus">
										<option value="">Select Status</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
								<div class="ml-10px" style="margin-left: 10px;">
									<select class="form-select h-50px" name="filterByCompanyType" id="filterByCompanyType">
										<option value="">Select Company Type</option>
										@foreach ($allCompanyTypeDetails as $item)
											<option value="{{ $item->id }}">{{ $item->name }}</option>
										@endforeach
									</select>
								</div>
								<div style="margin: 12px">
									<input type="checkbox" id="filteredByDeletedAt" value="1">
									Deleted Company
								</div>
								<div class="flex-grow-1 text-end">
									<a class="d-inline-flex" href="{{ route('admin.add_company') }}">
										<div class="btn bg-blue text-white">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-plus-square">
												<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
												<line x1="12" y1="8" x2="12" y2="16"></line>
												<line x1="8" y1="12" x2="16" y2="12"></line>
											</svg>Add Company
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							@include('admin.company.company_list')
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
	</div>
	<div class="modal fade" id="edit_department" tabindex="-1" aria-labelledby="edit_department" aria-hidden="true"
		style="display: none;">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content dark-sign-up overflow-hidden">
				<div class="modal-body social-profile text-start">
					<div class="modal-toggle-wrapper">
						<h4 class="text-dark">Edit Department</h4>
						<p>
							Fill in your information below to continue.</p>
						<form class="row g-3" id="department_update_form">
							@csrf
							<input type="hidden" name="id" id="id">
							<div class="col-md-12">
								<label class="form-label">Name</label>
								<input class="form-control" type="text" placeholder="Enter Your Department Name" name="name"
									id="name">
								@error('name')
									<span class="text-denger">{{ $message }} </span>
								@enderror
							</div>
							<div class="col-12">
								<button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Reset Password Modal -->
	<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div id="resetPasswordMessage" class="d-none mb-3">
						<div class="alert" role="alert"></div>
					</div>
					<form id="resetPasswordForm">
						<input type="hidden" name="company_id" id="reset_company_id">

						<div class="mb-3">
							<label for="new_password" class="form-label">New Password</label>
							<input type="password" class="form-control" id="new_password" name="password" required>
						</div>

						<div class="mb-3">
							<label for="confirm_password" class="form-label">Confirm Password</label>
							<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
						</div>

						<div class="text-end">
							<button type="submit" class="btn btn-primary">Update Password</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		function deleteFunction(id) {
			event.preventDefault();
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!"
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "<?= route('admin.company.delete') ?>",
						type: "get",
						data: {
							id: id
						},
						success: function(res) {
							Swal.fire("Done!", "It was succesfully deleted!", "success");
							$('#company_list').replaceWith(res.data);
						},
						error: function(xhr, ajaxOptions, thrownError) {
							Swal.fire("Error deleting!", "Please try again", "error");
						}
					});
				}
			});
		}
		$(document).on("input", "#search", function(e) {
			searchCompanyFilter()
		});
		$('#filterByStatus').change(function() {
			searchCompanyFilter()
		});
		$('#filterByCompanyType').change(function() {
			searchCompanyFilter()
		});
		$('#filteredByDeletedAt').change(function() {
			if ($(this).is(':checked')) {
				searchCompanyFilter($(this).val())
			} else {
				searchCompanyFilter()
			}
		});

		function searchCompanyFilter(deletedAt = null) {
			$.ajax({
				url: "{{ route('admin.company.search') }}",
				type: 'get',
				data: {
					'key': $('#search').val(),
					'status': $('#filterByStatus').val(),
					'companyTypeId': $('#filterByCompanyType').val(),
					'deletedAt': deletedAt,
				},
				success: function(res) {
					if (res) {
						jQuery('#company_list').replaceWith(res.data);
					}
				}
			})
		}

		function handleStatus(id) {
			var checked_value = $('#checked_value_' + id).prop('checked');
			let status;

			let status_name;
			if (checked_value == true) {
				status = 1;
				status_name = 'Active';
			} else {
				status = 0;
				status_name = 'Inactive';
			}
			$.ajax({
				url: "{{ route('admin.company.statusUpdate') }}",
				type: 'get',
				data: {
					'id': id,
					'status': status,
				},
				success: function(res) {
					if (res) {
						swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
						jQuery('#company_branch_list').replaceWith(res.data);
					} else {
						swal.fire("Oops!", 'Something Went Wrong', "error");
					}
				}
			})
		}

		function openResetPasswordModal(companyId) {
			document.getElementById('reset_company_id').value = companyId;
			document.getElementById('resetPasswordForm').reset();
			hideResetPasswordMessage();
			const modal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
			modal.show();
		}

		function showResetPasswordMessage(message, type = 'danger') {
			const wrapper = document.getElementById('resetPasswordMessage');
			const alertBox = wrapper.querySelector('.alert');
			alertBox.className = 'alert alert-' + type;

			if (Array.isArray(message)) {
				alertBox.innerHTML = '<ul class="mb-0">' + message.map(msg => `<li>${msg}</li>`).join('') + '</ul>';
			} else {
				alertBox.textContent = message;
			}

			wrapper.classList.remove('d-none');
			alertBox.style.display = 'block';
		}

		function hideResetPasswordMessage() {
			const wrapper = document.getElementById('resetPasswordMessage');
			const alertBox = wrapper.querySelector('.alert');
			alertBox.textContent = '';
			alertBox.className = 'alert';
			wrapper.classList.add('d-none');
		}

		document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
			e.preventDefault();
			hideResetPasswordMessage();

			const form = e.target;
			const companyId = document.getElementById('reset_company_id').value;
			const password = document.getElementById('new_password').value;
			const confirmPassword = document.getElementById('confirm_password').value;

			if (password !== confirmPassword) {
				showResetPasswordMessage("Passwords do not match!", 'warning');
				return;
			}

			fetch('{{ route('admin.company.reset_password') }}', {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						company_id: companyId,
						password: password,
						password_confirmation: confirmPassword
					})
				})
				.then(response => {
					if (!response.ok) {
						if (response.status === 422) {
							return response.json().then(data => {
								const errors = Object.values(data.errors).flat().join('<br>');
								showResetPasswordMessage(errors, 'danger');
								throw new Error('Validation error');
							});
						}
						throw new Error('Network response was not ok');
					}
					return response.json();
				})
				.then(data => {
					if (data.success) {
						showResetPasswordMessage("Password reset successfully.", 'success');
						form.reset();

						const modalEl = document.getElementById('resetPasswordModal');
						const modal = bootstrap.Modal.getInstance(modalEl);
						if (modal) {
							modal.hide();
						}
					} else {
						showResetPasswordMessage(data.message || 'Something went wrong.', 'danger');
					}
				})
				.catch(error => {
					if (error.message !== 'Validation error') {
						console.error('Error:', error);
						showResetPasswordMessage('An error occurred while resetting the password.', 'danger');
					}
				});
		});
	</script>
@endsection
