<!--end::Scrolltop-->
<!--begin::Javascript-->
<x-notify::notify />
@notifyJs
<script>var hostUrl = "{{ asset('assets/index.html') }}";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/create-account.js') }}"></script>

<base href="https://demos.telerik.com/kendo-ui/dropdownlist/addnewitem">
<style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
<title></title>
<link href="https://kendo.cdn.telerik.com/themes/7.2.1/default/default-main.css" rel="stylesheet" />
<script src="https://kendo.cdn.telerik.com/2024.1.319/js/kendo.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    setTimeout(function() {
        jQuery(".error").remove();
    }, 3000);
</script>
<script>
    setTimeout(function() {
        jQuery(".alert-dismissible").remove();
    }, 3000);
</script>

<!--end::Custom Javascript-->
