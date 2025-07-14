
<li class="nav-item dropdown">
    <a class="nav-link position-relative" href="#" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell fs-5"></i>
        @if($globalNotifications->count() > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
                {{ $globalNotifications->count() }}
            </span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end p-0 shadow rounded-3" aria-labelledby="notificationDropdown" style="width: 340px;">
        <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom bg-light">
            <span class="fw-semibold text-dark">🔔 Notifications</span>
            <button id="clearAllNotifications" class="btn btn-sm btn-link text-danger text-decoration-none">Clear All</button>
        </div>
        <div id="notificationList" style="max-height: 340px; overflow-y: auto;">
            @forelse($globalNotifications as $notification)
                @php $isUnread = $notification->status ?? false; @endphp
                <div class="d-flex align-items-start gap-2 px-3 py-2 border-bottom notification-item {{ $isUnread ? 'bg-light fw-semibold' : '' }}"
                     data-id="{{ $notification->id }}" style="cursor: pointer; transition: background-color 0.2s;">
                    <div class="flex-shrink-0 mt-1 text-primary">
                        <i class="fas fa-circle fa-xs {{ $isUnread ? '' : 'invisible' }}"></i>
                    </div>
                    <div class="flex-grow-1 text-truncate">
                        <div class="small">{{ $notification->title ?? 'Notification' }}</div>
                        @if(!empty($notification->body))
                            <div class="small text-muted text-truncate">{{ $notification->body }}</div>
                        @endif
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    @if($isUnread)
                        <button class="btn btn-sm text-muted ms-1 mark-as-read-btn" title="Mark as read">
                            <i class="fas fa-times small"></i>
                        </button>
                    @endif
                </div>
            @empty
                <span class="dropdown-item text-center small text-muted py-3">No notifications</span>
            @endforelse
        </div>
    </div>
</li>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div id="notificationToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastBody">Notification updated</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
