<li class="nav-item dropdown">
    <a class="nav-link position-relative" href="#" id="notificationDropdown" data-bs-toggle="dropdown"
        aria-expanded="false" style="padding: 10px; border-radius: 50px; background: #eaf4ff; transition: 0.3s;">
        <i class="fas fa-bell fs-5 text-primary" style="position: relative; animation: ring 4s .7s ease-in-out infinite;"></i>
        @if($globalNotifications->count() > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm"
                style="font-size: 12px; padding: 4px 6px;">
                {{ $globalNotifications->count() }}
            </span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-end p-0 shadow-lg rounded-4 border-0" aria-labelledby="notificationDropdown"
        style="width: 360px; overflow: hidden;">
        <div class="d-flex justify-content-between align-items-center px-4 py-3 bg-primary text-white">
            <span class="fw-semibold">🔔 Notifications</span>
            @if(Auth()->user()->type === 'user')
                <button id="clearAllNotifications" class="btn btn-sm btn-light text-danger">Clear All</button>
            @else
                <a href="{{ route('company.all_notification') }}" class="btn btn-sm btn-light">See all</a>
            @endif
        </div>

        <div id="notificationList" style="max-height: 360px; overflow-y: auto;" class="bg-white">
            @forelse($globalNotifications as $notification)
                @php
                    $isUnread = $notification->status ?? false;
                    $user = $notification->user;
                    $userDetails = $user?->details;
                @endphp

                <div class="d-flex align-items-start gap-3 px-4 py-3 border-bottom notification-item {{ $isUnread ? 'bg-light' : '' }}"
                    data-id="{{ $notification->id }}" style="cursor: pointer; transition: 0.3s;">
                    <div class="pt-1 text-primary">
                        <i class="fas fa-dot-circle fa-xs {{ $isUnread ? '' : 'invisible' }}"></i>
                    </div>

                    <div class="flex-grow-1 text-truncate">
                        <div class="fw-semibold small">{{ $notification->title ?? 'Notification' }}</div>

                        @if(!empty($notification->body))
                            <div class="small text-muted text-truncate">{{ $notification->body }}</div>
                        @endif

                        <small class="text-muted d-block mt-1">{{ $notification->created_at->diffForHumans() }}</small>

                        {{-- ✅ Show name & emp ID if current user is type company --}}
                        @if(Auth()->user()->type === 'company' && $user)
                            <div class="text-muted small mt-1">
                                <span class="fw-semibold text-dark">{{ $user->name }}</span>
                                    <span class="ms-1">| Emp ID: {{ $user->details->emp_id ?? ''}}</span>
                            </div>
                        @endif
                    </div>

                    @if(Auth()->user()->type === 'user' && $isUnread)
                        <button class="btn btn-sm text-muted ms-auto mark-as-read-btn" title="Mark as read">
                            <i class="fas fa-times small"></i>
                        </button>
                    @endif
                </div>
            @empty
                <div class="text-center py-4 text-muted small">No notifications found</div>
            @endforelse
        </div>
    </div>
</li>
