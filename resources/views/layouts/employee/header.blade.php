<div id="kt_header" class="header">
	<!--begin::Container-->
	<div class="d-flex flex-stack container flex-wrap gap-2" id="kt_header_container">
		<!--begin::Page title-->
		<div class="page-title d-flex flex-column align-items-start justify-content-center me-lg-2 pb-lg-0 flex-wrap pb-5"
			data-kt-swapper="true" data-kt-swapper-mode="prepend"
			data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
			<!--begin::Heading-->
			<h1 class="d-flex flex-column text-dark fs-2x fw-bold title-text">
				@yield('title')
			</h1>
			<!--end::Heading-->
		</div>
		<div class="page-title d-flex flex-column align-items-start justify-content-center me-lg-2 pb-lg-0 flex-wrap pb-5"
			data-kt-swapper="true" data-kt-swapper-mode="prepend"
			data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
			<!--begin::Heading-->
			@if (Auth()->user()->userRole)
				<a href="/employee/impersonate" class="btn btn-sm btn-primary align-self-center">
					Switch as {{ Auth()->user()->userRole->name }}
				</a>
			@endif
			<!--end::Heading-->
		</div>
		<!--end::Page title=-->
		<!--begin::Wrapper-->
		<div class="d-flex d-lg-none align-items-center ms-n2">
			<!--begin::Aside mobile toggle-->
			<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
				<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
				<span class="svg-icon svg-icon-1 mt-1">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
							fill="currentColor"></path>
						<path opacity="0.3"
							d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
							fill="currentColor"></path>
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
			<!--end::Aside mobile toggle-->
			<!--begin::Logo-->
			<a href="index.html" class="d-flex align-items-center">
				<img alt="Logo" src="{{ asset('employee/assets/media/logos/logo.png') }}" class="theme-light-show h-20px">
				<img alt="Logo" src="{{ asset('employee/assets/media/logos/logo.png') }}" class="theme-dark-show h-20px">
			</a>
			<!--end::Logo-->
		</div>
		<!--end::Wrapper-->

	</div>
	<!--end::Container-->
</div>
