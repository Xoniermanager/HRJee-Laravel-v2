@php
    $leaveLogStatusDetails = $leaveDetails->leaveAction ?? collect();
    $leaveManagerDetails = $leaveDetails->managerAction ?? collect();

    // Final manager status: priority - cancelled > rejected > approved > pending
    if ($leaveManagerDetails->where('leave_status_id', 4)->isNotEmpty()) {
        $finalManagerStatus = 'CANCELLED';
    } elseif ($leaveManagerDetails->where('leave_status_id', 3)->isNotEmpty()) {
        $finalManagerStatus = 'REJECTED';
    } elseif ($leaveManagerDetails->where('leave_status_id', 2)->isNotEmpty()) {
        $finalManagerStatus = 'APPROVED';
    } else {
        $finalManagerStatus = 'PENDING';
    }

    $finalStatus = $leaveDetails->leaveStatus;

    // Split logs
    $managerLogs = $leaveLogStatusDetails->filter(fn($log) => $log->actionTakenBy->userRole->category === 'custom');
    $hrLogs = $leaveLogStatusDetails->filter(fn($log) => $log->actionTakenBy->userRole->name === 'HR');
@endphp

<div class="content fade-in-image">
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="timeline p-4 bg-white rounded shadow-sm">

                    {{-- Leave Applied --}}
                    <div class="timeline-item mb-4">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content p-3 rounded bg-light">
                            <span class="fs-8 fw-bolder text-info text-uppercase">Leave Applied</span>
                            <a class="fs-7 d-block text-hover-primary text-gray-800">
                                {{ getFormattedDate($leaveDetails->created_at ?? '') }}
                            </a>
                        </div>
                    </div>

                    {{-- Manager Final Status (clickable to view details) --}}
                    <div class="timeline-item mb-3">
                        <div class="timeline-marker
                            @if ($finalManagerStatus == 'APPROVED') bg-success
                            @elseif ($finalManagerStatus == 'REJECTED') bg-danger
                            @elseif ($finalManagerStatus == 'CANCELLED') bg-secondary
                            @else bg-warning @endif">
                        </div>
                        <div class="timeline-content p-3 rounded bg-light">
                            <a class="fs-8 fw-bolder text-uppercase d-block text-hover-primary" data-bs-toggle="collapse" href="#managerLogsCollapse" role="button" aria-expanded="false">
                                Manager Final Status: {{ $finalManagerStatus }} <small>(click to view details)</small>
                            </a>
                            <a class="fs-7 d-block text-hover-primary text-gray-800">
                                {{ getFormattedDate($leaveDetails->updated_at ?? '') }}
                            </a>
                        </div>
                    </div>

                    {{-- Manager Logs (collapse) --}}
                    <div class="collapse" id="managerLogsCollapse">
                        <div class="mt-2 mb-2">
                            <span class="fs-8 fw-bold text-gray-600 text-uppercase">All Manager Actions</span>
                        </div>

                        @forelse($leaveManagerDetails as $manager)
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker
                                    @if($manager->leave_status_id == 2) bg-success
                                    @elseif($manager->leave_status_id == 3) bg-danger
                                    @elseif($manager->leave_status_id == 4) bg-secondary
                                    @else bg-warning @endif">
                                </div>
                                <div class="timeline-content p-3 rounded bg-white shadow-sm">
                                    {{-- Status title --}}
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fs-8 fw-bolder text-uppercase
                                            @if($manager->leave_status_id == 2) text-success
                                            @elseif($manager->leave_status_id == 3) text-danger
                                            @elseif($manager->leave_status_id == 4) text-secondary
                                            @else text-warning @endif">
                                            {{ strtoupper(optional($manager->leaveStatus)->name ?? 'Pending') }}
                                        </span>
                                        <small class="text-muted">{{ getFormattedDate($manager->updated_at ?? '') }}</small>
                                    </div>

                                    {{-- Manager name and role --}}
                                    <div class="fw-semibold mb-1">
                                        — by <span class="text-dark">{{ optional($manager->manager)->name ?? '-' }}</span>
                                        <small class="text-muted">({{ optional($manager->manager->userRole)->name ?? '-' }})</small>
                                    </div>

                                    {{-- Remark if exists --}}
                                    @if($manager->remark)
                                        <div class="fw-normal text-gray-600 small">{{ $manager->remark }}</div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content p-3 rounded bg-light">
                                    <span class="fs-8 fw-bolder text-warning text-uppercase">Pending</span>
                                    <a class="fs-7 d-block text-hover-primary text-gray-800">
                                        {{ getFormattedDate($leaveDetails->created_at ?? '') }}
                                    </a>
                                </div>
                            </div>
                        @endforelse

                        {{-- HR Logs --}}
                        @if ($hrLogs->isNotEmpty())
                            <div class="mt-4 mb-2">
                                <span class="fs-8 fw-bold text-primary text-uppercase">HR Status</span>
                            </div>
                            @foreach ($hrLogs as $log)
                                <div class="timeline-item mb-3">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content p-3 rounded bg-white shadow-sm">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fs-8 fw-bolder text-uppercase text-primary">
                                                {{ strtoupper($log->leaveStatus->name) }}
                                            </span>
                                            <small class="text-muted">{{ getFormattedDate($log->created_at ?? '') }}</small>
                                        </div>

                                        <div class="fw-semibold mb-1">
                                            — by <span class="text-dark">{{ $log->actionTakenBy->name }}</span>
                                            <small class="text-muted">({{ $log->actionTakenBy->userRole->name ?? '-' }})</small>
                                        </div>

                                        @if($log->remarks)
                                            <div class="fw-normal text-gray-600 small">{{ $log->remarks }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    {{-- Final Leave Status by HR --}}
                    <div class="timeline-item mt-4 mb-2">
                        <div class="timeline-marker
                            @if($finalStatus?->name == 'APPROVED') bg-success
                            @elseif($finalStatus?->name == 'REJECTED') bg-danger
                            @elseif($finalStatus?->name == 'CANCELLED') bg-secondary
                            @else bg-warning
                            @endif">
                        </div>
                        <div class="timeline-content p-3 rounded bg-light">
                            <span class="fs-8 fw-bolder text-uppercase">
                                Final Leave Status: {{ $finalStatus?->name ?? 'PENDING' }}
                            </span>
                            <a class="fs-7 d-block text-hover-primary text-gray-800">
                                {{ getFormattedDate($leaveDetails->updated_at ?? $leaveDetails->created_at ?? '') }}
                            </a>
                        </div>
                    </div>


                </div> <!-- end::Timeline -->
            </div>
        </div>
    </div>
</div>
