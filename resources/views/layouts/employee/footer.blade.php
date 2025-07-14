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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('notificationToast');
        const toastBody = document.getElementById('toastBody');
        let toast = bootstrap && bootstrap.Toast ? new bootstrap.Toast(toastEl, { delay: 3000 }) : null;

        // Mark single notification as read
        document.querySelectorAll('.mark-as-read-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                const parent = btn.closest('.notification-item');
                const notificationId = parent.dataset.id;

                fetch('{{ route('notifications.read', ':id') }}'.replace(':id', notificationId), {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                }).then(response => {
                    if(response.ok) {
                        parent.remove();

                        // Update badge
                        let badge = document.querySelector('.badge.bg-danger, .badge.rounded-pill.bg-danger');
                        if(badge) {
                            let count = parseInt(badge.innerText);
                            if(count > 1){
                                badge.innerText = count - 1;
                            } else {
                                badge.remove();
                            }
                        }

                        // Show toast
                        const title = parent.querySelector('.flex-grow-1 div')?.innerText || 'Notification marked as read';
                        if(toast && toastBody) {
                            toastBody.textContent = title;
                            toast.show();
                        }

                        // If list now empty
                        if(document.querySelectorAll('.notification-item').length === 0){
                            document.getElementById('notificationList').innerHTML =
                                '<span class="dropdown-item text-center small text-muted py-3">No notifications</span>';
                        }
                    }
                });
            });
        });

        // Clear all notifications
        const clearBtn = document.getElementById('clearAllNotifications');
        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                // if(!confirm('Are you sure you want to clear all notifications?')) return;

                fetch('{{ route('notifications.clearAll') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                }).then(response => {
                    if(response.ok) {
                        // Remove all notification items
                        document.querySelectorAll('.notification-item').forEach(item => item.remove());

                        // Add "No notifications" message
                        document.getElementById('notificationList').innerHTML =
                            '<span class="dropdown-item text-center small text-muted py-3">No notifications</span>';

                        // Remove badge
                        document.querySelector('.badge.bg-danger, .badge.rounded-pill.bg-danger')?.remove();

                        // Show toast
                        if(toast && toastBody) {
                            toastBody.textContent = 'All notifications cleared';
                            toast.show();
                        }
                    }
                });
            });
        }
    });
    </script>
<!--end::Custom Javascript-->
