<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
	<!--begin::Container-->
	<div class="container-xxl" id="kt_content_container">
		<!--begin::Row-->
		<div class="row gy-5 g-xl-10">
			<!--begin::Col-->
			<div class="mb-5">
				<div class="card">
					<div class="card-body w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">
						<!--begin::Card header-->
						<div class="card-header mb-3 p-0 pe-5" id="kt_drawer_chat_messenger_header">
							<!--begin::Title-->
							<div class="card-title">
								<!--begin::User-->
								<div class="d-flex justify-content-center flex-column me-3">
									{{-- <a class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1"> --}}
									{{-- {{ Auth()->user()->name }}</a> --}}

									<!--begin::Info-->
									{{-- <div class="mb-0 lh-1">
                                        Active
                                    </div>
                                    <!--end::Info--> --}}
								</div>
								<!--end::User-->
							</div>
							<!--end::Title-->
						</div>
						<!--end::Card header-->

						<!--begin::Card body-->
						<div class="" id="kt_drawer_chat_messenger_body">
							<!--begin::Messages-->
							<div class="scroll-y me-n5 pe-5">
								@include('employee_complain.chat_list')

							</div>
							<div class="chat-footer" id="kt_drawer_chat_messenger_footer">
								<form class="row" id="message_form" action="{{ route('send.message', Request::segment(4)) }}" method="post">
									@csrf
									<div class="col-md-10 form-group">
										<textarea name="message" class="form-control h-auto" placeholder="Enter your Message Here" id="message"
										 data-kt-element="input">{{ old('reply') }}</textarea>
									</div>
									<div class="col-md-2">
										<input type="hidden" name="to_id" value="{{ $toId }}">
										<input type="hidden" name="from_id" value="{{ $fromId }}">
										<button type="submit" class="btn btn-primary" disabled="disabled" id="send"
											data-kt-element="send">Send</button>
									</div>
								</form>
							</div>
							<!--end::Messages-->
						</div>
						<!--end::Card footer-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Col-->
	</div>
	<!--end::Row-->
</div>
<!--end::Container-->
<!--begin::Card footer-->
<script>
	$('#message').on('keyup', function() {
		if ($(this).val()) {
			$("#send").removeAttr('disabled', false);
		} else {
			$("#send").attr('disabled', true);
		}
	});
</script>
<script type="text/javascript">
	var frm = $('#message_form');
	frm.submit(function(e) {
		e.preventDefault();
		$.ajax({
			type: frm.attr('method'),
			url: frm.attr('action'),
			data: frm.serialize(),
			success: function(res) {
				$('#chat_list').replaceWith(res.data);
				$('.scroll-y').scrollTop(1000000);
				$('form')[0].reset();
			},
			error: function(data) {
				console.log(data.responseJSON.error);
			},
		});
	});

	jQuery(document).ready(function() {
		console.log('Tester');
		window.Echo.private('chat.1')
			.listen('MessageSent', (data) => {
				console.log(data);
			});
	});
</script>
