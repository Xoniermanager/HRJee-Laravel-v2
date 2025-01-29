<!--end::Scrolltop-->
<!--begin::Javascript-->
<script>
    var hostUrl = "{{ asset('employee/assets/index.html') }}";
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('employee/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('employee/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('employee/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('employee/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('employee/assets/js/widgets.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{ asset('employee/assets/js/employee_custom.js') }}"></script>
<script src="{{ asset('assets/js/add-employee-validation.js') }}"></script>
<script src="{{ asset('assets/js/custom-script.js') }}"></script>
<script>
    setTimeout(function() {
        jQuery(".alert-dismissible").remove();
    }, 3000);
</script>
<!--end::Custom Javascript-->
