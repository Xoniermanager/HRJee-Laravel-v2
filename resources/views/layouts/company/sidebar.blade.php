<div class="position-colps sidemenu-scroll float-left">
	<!--begin::Aside-->
	<a href="{{ route('company.dashboard') }}">
		<img src="{{  Auth::user()->companyDetails->logo ?? asset('assets/media/logos/logo.png') }}" class="brand-logo">
	</a>
	<div id="kt_aside" class="aside py-5" data-kt-drawer="true" data-kt-drawer-name="aside"
		data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
		data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
		data-kt-drawer-toggle="#kt_aside_toggle">

		<!--begin::Aside menu-->
		<div class="aside-menu flex-column-fluid pe-3 ps-5" id="kt_aside_menu">
			<!--begin::Aside Menu-->
			<div class="w-100 hover-scroll-overlay-y d-flex pe-2" id="kt_aside_menu_wrapper">
				<!--begin::Menu-->
				<div class="menu menu-column menu-rounded menu-sub-indention menu-active-bg fw-semibold my-auto" id="#kt_aside_menu"
					data-kt-menu="true">
					<div class="menudesign">
						<div class="menubox">
							<!--begin:Menu item-->
							<div class="menu-item" data-url="{{ route('company.dashboard') }}">
								<!--begin:Menu link-->
								<a class="menu-link" href="{{ route('company.dashboard') }}">
									<span class="menu-icon">
										<span class="svg-icon svg-icon-5">
											<i class="fa fa-dashboard"></i>
										</span>
										<!--end::Svg Icon-->
									</span>
									<span class="menu-title">Dashboard</span>
								</a>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							{!! getCompanyMenuHtml() !!}
                            <div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="{{ route('location.tracking.index') }}">
									<span class="menu-icon">
										<span class="svg-icon svg-icon-5">
											<i class="fa fa-map"></i>
										</span>
										<!--end::Svg Icon-->
									</span>
									<span class="menu-title">Location Tracking</span>
								</a>
							</div>
						</div>
						<!--end:Menu item-->
						<div class="aside-footer flex-column-auto" id="kt_aside_footer">
							<!--begin::User panel-->
							<div class="d-flex flex-stack">
								<!--begin::Wrapper-->
								<div class="d-flex align-items-center">
									<!--begin::Avatar-->
									<div class="symbol symbol-circle symbol-40px">
										<img src="{{ Auth::user()->companyDetails->logo ??  asset('employee/assets/media/user.jpg') }}" alt="photo">
									</div>
									<!--end::Avatar-->

									<!--begin::User info-->
									<div class="ms-2">
										<!--begin::Name-->
										<a class="text-hover-primary fs-6 fw-bold lh-1 text-gray-800">
											{{ Auth()->user()->name }}</a>
										<!--end::Name-->

										<!--begin::Major-->
										<span class="text-muted fw-semibold d-block fs-7 lh-1">
										</span>
										<!--end::Major-->
									</div>
									<!--end::User info-->
								</div>
								<!--end::Wrapper-->

								<!--begin::User menu-->
								<div class="ms-1">
									<div class="btn btn-sm btn-icon btn-active-color-primary position-relative me-n2"
										data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true"
										data-kt-menu-placement="top-end">
										<i class="fa fa-cog fs-1"><span class="path1"></span><span class="path2"></span></i>
									</div>
									<div
										class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-275px py-4"
										data-kt-menu="true" style="">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="{{  Auth::user()->companyDetails->logo ?? asset('assets/media/user.jpg') }}">
												</div>
												<!--end::Avatar-->

												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">
														{{ Auth()->user()->name }}
													</div>

													<a class="fw-semibold text-muted text-hover-primary fs-7">
													</a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<div class="menu-item px-5">
											<a href="{{ route('company.profile') }}" class="menu-link px-5">
												My Profile
											</a>
										</div>
										<!--end::Menu item-->

										<div class="menu-item px-5">
											<a href="{{ route('logout') }}" class="menu-link px-5">
												Sign Out
											</a>
										</div>
									</div>
								</div>
								<!--end::User menu-->
							</div>
							<!--end::User panel-->
						</div>
					</div>
				</div>
				<!--end::Menu-->
			</div>
			<!--end::Aside Menu-->
		</div>
	</div>
	<!--end::Aside-->
</div>
