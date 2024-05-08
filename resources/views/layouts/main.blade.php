<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title> HRJEE </title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="robots" content="noindex,nofollow">
	<meta name="title" property='og:title' content='Xonier HRJEE' />
	<meta name="type" property='og:type' content='website' />
	<meta name="image" property='og:image' content="" />
	<meta name="url" property='og:url' content='' />
	<meta name="description" property='og:description' content='' />
	<meta name="author" content="Jyoti Mishra Web Designer at Xonier">
	<!--begin::Fonts(mandatory for all pages)-->
	{{-- <link rel="stylesheet" href="assets/css/mark-pro.css" /> --}}
	<!--end::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<!--end::Fonts-->
<!--begin::Vendor Stylesheets(used for this page only)-->
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->
<link rel="icon" type="image/png" href="{{ asset('assets/media/logos/favicon.png') }}">
<base href="https://demos.telerik.com/kendo-ui/dropdownlist/addnewitem">
<style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
<title></title>
<link href="https://kendo.cdn.telerik.com/themes/7.2.1/default/default-main.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://kendo.cdn.telerik.com/2024.1.319/js/kendo.all.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

	@notifyCss
	<style>.error {
		color: red;
	}
		</style>

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="sidebar-enabled">
	<!--begin::Theme mode setup on page load-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page flex-row flex-column-fluid">
			@include('layouts.sidebar')
			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<!--begin::Header-->
				@include('layouts.header')
				<!--end::Header-->
				<!--begin::Content-->
      			@yield('content')
	<!--end::Root-->
	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
					fill="currentColor" />
				<path
					d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
					fill="currentColor" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
    @include('layouts.footer')
</body>
<!--end::Body-->

</html>