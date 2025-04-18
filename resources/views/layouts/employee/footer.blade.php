<!--end::Scrolltop-->
<!--begin::Javascript-->
<!-- JavaScript Initialization -->
<script>
    var hostUrl = "{{ asset('employee/assets/index.html') }}";
</script>

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('employee/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('employee/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Vendors Javascript (used for this page only)-->
<script src="{{ asset('employee/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('employee/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript (used for this page only)-->
<!-- Ensure jQuery is loaded first, if not already loaded via the main asset pipeline -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> <!-- jQuery (if not included earlier) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> <!-- jQuery UI (if needed) -->

<!-- Kendo UI Styles and Scripts -->
<link href="https://kendo.cdn.telerik.com/themes/7.2.1/default/default-main.css" rel="stylesheet" />
<script src="https://kendo.cdn.telerik.com/2024.1.319/js/kendo.all.min.js"></script>

<!-- Custom Scripts -->
<script src="{{ asset('employee/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('employee/assets/js/employee_custom.js') }}"></script>
<!--<script src="{{ asset('assets/js/add-employee-validation.js') }}"></script>-->
<script src="{{ asset('assets/js/custom-script.js') }}"></script>
<!--end::Custom Javascript-->

<script>
    setTimeout(function() {
        jQuery(".alert-dismissible").remove();
    }, 3000);
</script>
<!--end::Custom Javascript-->
