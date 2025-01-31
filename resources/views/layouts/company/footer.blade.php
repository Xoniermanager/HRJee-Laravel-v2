<!--end::Scrolltop-->
<!--begin::Javascript-->
<x-notify::notify />
@notifyJs

<script>
    var hostUrl = "{{ asset('assets/index.html') }}";
</script>

<!--begin::Global Javascript Bundle (mandatory for all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Vendors Javascript (used for this page only)-->
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript (used for this page only)-->
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/create-account.js') }}"></script>

<!-- CKEditor initialization -->
<script>
    // ClassicEditor.create(document.querySelector('#editor'))
    //     .catch(error => {
    //         console.error(error);
    //     });
</script>

<!-- Kendo UI Styles and Scripts (ensure no duplicate entries) -->
<link href="https://kendo.cdn.telerik.com/themes/7.2.1/default/default-main.css" rel="stylesheet" />
<script src="https://kendo.cdn.telerik.com/2024.1.319/js/kendo.all.min.js"></script>

<!-- jQuery UI Script (ensure this is before Kendo UI and other jQuery-dependent scripts) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- jQuery Validation (Ensure this is after jQuery and jQuery UI) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<!-- Custom Script -->
<script src="{{ asset('assets/js/custom-script.js') }}"></script>

<!-- Employee Validation Script -->
<script src="{{ asset('assets/js/add-employee-validation.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.searchableSelect.js') }}"></script>

<!-- Auto-hide alert after 4 seconds -->
<script>
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 4000);
</script>

<!--end::Custom Javascript-->
