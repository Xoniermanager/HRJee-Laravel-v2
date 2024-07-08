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

<script>
    setTimeout(function() {
        jQuery(".alert-dismissible").remove();
    }, 3000);
</script>
<script type="text/javascript">
    var jQuery_1_7_0 = $.noConflict(true);  // <- this
</script>
<!--end::Custom Javascript-->
