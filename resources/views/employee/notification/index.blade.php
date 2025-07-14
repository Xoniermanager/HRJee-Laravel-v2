@extends('layouts.employee.main')
@section('content')
@section('title','Notifications')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-6">
                {{-- <div class="card-title d-flex mt-3 p-5 align-items-center">
                    <h3 class="fw-bold m-0 text-gray-800">Notifications</h3>
                </div> --}}
                <div class="cursor-pointer p-5" style="max-height: 400px; overflow-y: auto;">
                    <div class="timeline" id="timelineContainer">
                        @forelse($globalNotifications->take(5) as $index => $notification)
                            @php
                                $isUnread = $notification->status ?? false;
                                $iconColor = $isUnread ? 'text-success' : 'text-muted';
                                $dateText = $notification->created_at ? $notification->created_at->format('d M, l') : '';
                            @endphp
                            <div class="timeline-item">
                                <div class="timeline-line w-40px"></div>
                                <div class="timeline-icon symbol symbol-circle symbol-40px">
                                    <div class="symbol-label bg-light">
                                        <i class="fa fa-genderless {{ $iconColor }} fs-1"></i>
                                    </div>
                                </div>
                                <div class="timeline-content d-flex mb-10 mt-n2">
                                    <div class="symbol-35px me-3">
                                        <img src="{{ asset('assets/media/d22.png') }}" alt="">
                                    </div>
                                    <div class="overflow-auto pe-3">
                                        <div class="fs-5 fw-semibold mb-2">{{ $notification->title ?? 'Notification' }}</div>
                                        @if(!empty($notification->body))
                                            <span>{{ $notification->body }}</span>
                                        @endif
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <div class="text-muted me-2 fs-7">{{ $dateText }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-3">No notifications available</div>
                        @endforelse
                    </div>
                </div>

                @if($globalNotifications->count() > 5)
                    <div class="text-center mb-3">
                        <button id="loadMoreBtn" class="btn btn-sm btn-light-primary">Load More</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Nice scrollbar for the timeline scroll area */
.p-5::-webkit-scrollbar { width: 6px; }
.p-5::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,0.2);
    border-radius: 3px;
}
.p-5::-webkit-scrollbar-thumb:hover {
    background: rgba(0,0,0,0.3);
}

</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allNotifications = @json($globalNotifications);
        let shownCount = 5;

        const container = document.getElementById('timelineContainer');
        const loadMoreBtn = document.getElementById('loadMoreBtn');

        if(loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                const next = allNotifications.slice(shownCount, shownCount + 5);
                next.forEach(notification => {
                    const isUnread = notification.status ? true : false;
                    const iconColor = isUnread ? 'text-success' : 'text-muted';
                    const dateText = notification.created_at ? new Date(notification.created_at).toLocaleDateString('en-US', { day: '2-digit', month: 'short', weekday: 'long' }) : '';

                    const html = `
                        <div class="timeline-item">
                            <div class="timeline-line w-40px"></div>
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light">
                                    <i class="fa fa-genderless ${iconColor} fs-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content d-flex mb-10 mt-n2">
                                <div class="symbol-35px me-3">
                                    <img src="{{ asset('assets/media/d22.png') }}" alt="">
                                </div>
                                <div class="overflow-auto pe-3">
                                    <div class="fs-5 fw-semibold mb-2">${notification.title ?? 'Notification'}</div>
                                    ${notification.body ? `<span>${notification.body}</span>` : ''}
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <div class="text-muted me-2 fs-7">${dateText}</div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    container.insertAdjacentHTML('beforeend', html);
                });
                shownCount += next.length;
                if(shownCount >= allNotifications.length){
                    loadMoreBtn.style.display = 'none';
                }
            });
        }
    });
</script>

@endsection
