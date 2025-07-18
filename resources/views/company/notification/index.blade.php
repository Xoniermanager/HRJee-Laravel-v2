@extends('layouts.company.main')
@section('title', 'Notifications')
@section('content')

<div class="content fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm rounded-4">
                    <div class="card-header bg-light px-5 py-4 d-flex justify-content-between align-items-center">
                        <h3 class="fw-bold text-gray-800 m-0">Notifications</h3>
                    </div>

                    <div class="card-body p-5" style="max-height: 400px; overflow-y: auto;">
                        <div class="timeline" id="timelineContainer">
                            @forelse($globalNotifications->take(5) as $index => $notification)
                                @php
                                    $isUnread = $notification->status ?? false;
                                    $iconColor = $isUnread ? 'text-success' : 'text-muted';
                                    $dateText = $notification->created_at ? $notification->created_at->format('d M, l') : '';
                                    $user = $notification->user;
                                    $empId = $user?->details?->emp_id ?? 'N/A';
                                    $userName = $user?->name ?? 'Unknown';
                                @endphp
                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light">
                                            <i class="fa fa-genderless {{ $iconColor }} fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content d-flex gap-3 mb-10 mt-n2 align-items-start">
                                        <div class="symbol-35px flex-shrink-0">
                                            <img src="{{ asset('assets/media/d22.png') }}" alt="avatar" class="rounded-circle" width="35">
                                        </div>
                                        <div class="overflow-hidden">
                                            <div class="fs-5 fw-semibold mb-1">{{ $notification->title ?? 'Notification' }}</div>
                                            @if(!empty($notification->body))
                                                <div class="text-muted">{{ $notification->body }}</div>
                                            @endif
                                            <div class="d-flex align-items-center mt-2 fs-7 text-muted">
                                                <span>{{ $dateText }}</span>
                                                @if($user)
                                                    <span class="mx-2">|</span>
                                                    <span>By: {{ $userName }} ({{ $empId }})</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-4">No notifications available</div>
                            @endforelse
                        </div>
                    </div>

                    @if($globalNotifications->count() > 5)
                        <div class="card-footer text-center">
                            <button id="loadMoreBtn" class="btn btn-sm btn-light-primary">Load More</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .p-5::-webkit-scrollbar {
        width: 6px;
    }
    .p-5::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }
    .p-5::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.3);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const allNotifications = @json($globalNotifications);
        let shownCount = 5;

        const container = document.getElementById('timelineContainer');
        const loadMoreBtn = document.getElementById('loadMoreBtn');

        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function () {
                const next = allNotifications.slice(shownCount, shownCount + 5);

                next.forEach(notification => {
                    const isUnread = notification.status ? true : false;
                    const iconColor = isUnread ? 'text-success' : 'text-muted';

                    const date = new Date(notification.created_at);
                    const dateText = date.toLocaleDateString('en-US', {
                        day: '2-digit',
                        month: 'short',
                        weekday: 'long'
                    });

                    const user = notification.user;
                    const userName = user?.name ?? 'Unknown';
                    const empId = user?.details?.emp_id ?? 'N/A';

                    const html = `
                        <div class="timeline-item">
                            <div class="timeline-line w-40px"></div>
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <i class="fa fa-genderless ${iconColor} fs-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content d-flex gap-3 mb-10 mt-n2 align-items-start">
                                <div class="symbol-35px flex-shrink-0">
                                    <img src="{{ asset('assets/media/d22.png') }}" alt="avatar" class="rounded-circle" width="35">
                                </div>
                                <div class="overflow-hidden">
                                    <div class="fs-5 fw-semibold mb-1">${notification.title ?? 'Notification'}</div>
                                    ${notification.body ? `<div class="text-muted">${notification.body}</div>` : ''}
                                    <div class="d-flex align-items-center mt-2 fs-7 text-muted">
                                        <span>${dateText}</span>
                                        ${user ? `<span class="mx-2">|</span><span>By: ${userName} (${empId})</span>` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', html);
                });

                shownCount += next.length;
                if (shownCount >= allNotifications.length) {
                    loadMoreBtn.style.display = 'none';
                }
            });
        }
    });
</script>

@endsection
