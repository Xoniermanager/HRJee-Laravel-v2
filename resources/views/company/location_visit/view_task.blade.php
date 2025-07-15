@extends('layouts.company.main')
@section('title', 'View Task Details')
@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <div class="card shadow-sm border rounded-4 p-4">

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @php
                    $formDetails = json_decode($taskdetails->response_data, true) ?? [];
                    $mapLat = $taskdetails->visit_address_latitude ?? $taskdetails->latitude;
                    $mapLng = $taskdetails->visit_address_longitude ?? $taskdetails->longitude;
                @endphp

                <h3 class="mb-4 fw-bold text-primary border-bottom pb-2">📋 Task Details Overview</h3>

                {{-- Main Task Info --}}
                <div class="mb-4">
                    <h5 class="fw-semibold bg-light p-2 rounded">📌 Main Task Information</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th class="w-25">Task ID</th>
                            <td><span class="badge bg-secondary">{{ $taskdetails->id }}</span></td>
                        </tr>
                        <tr>
                            <th>Employee ID</th>
                            <td>{{ $taskdetails->user->details->emp_id ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Employee Name</th>
                            <td>{{ $taskdetails->user->name ?? '-' }}</td>
                        </tr>
                        @if($taskdetails->disposition_code_id)
                        <tr>
                            <th>Disposition Code</th>
                            <td>{{ $taskdetails->dispositionCode->name ?? '-' }}</td>
                        </tr>
                        @endif
                        @if($taskdetails->remark)
                        <tr>
                            <th>Remark</th>
                            <td>{{ ucfirst($taskdetails->remark) }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                {{-- Location Info --}}
                <div class="mb-4">
                    <h5 class="fw-semibold bg-light p-2 rounded">📍 Location Information</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th>Visit Address</th>
                            <td>{{ $taskdetails->visit_address ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Visit Address Latitude</th>
                            <td>{{ $taskdetails->visit_address_latitude ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Visit Address Longitude</th>
                            <td>{{ $taskdetails->visit_address_longitude ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Latitude</th>
                            <td>{{ $taskdetails->latitude ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Longitude</th>
                            <td>{{ $taskdetails->longitude ?? '-' }}</td>
                        </tr>
                        @if($mapLat && $mapLng)
                        <tr>
                            <th>Map</th>
                            <td>
                                <a href="https://www.google.com/maps?q={{ $mapLat }},{{ $mapLng }}" target="_blank" class="btn btn-sm btn-info">
                                    View on Google Maps
                                </a>
                                <div class="small text-muted mt-1">Lat: {{ $mapLat }}, Lng: {{ $mapLng }}</div>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>

                {{-- Status & Meta Info --}}
                <div class="mb-4">
                    <h5 class="fw-semibold bg-light p-2 rounded">📊 Status & Meta Information</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th>User End Status</th>
                            <td>
                                <span class="badge bg-primary">{{ ucfirst($taskdetails->user_end_status) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Final Status</th>
                            <td>
                                <span class="badge bg-success">{{ ucfirst($taskdetails->final_status) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Completed At</th>
                            <td>{{ $taskdetails->completed_at ? \Carbon\Carbon::parse($taskdetails->completed_at)->format('d M Y H:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $taskdetails->created_at ? $taskdetails->created_at->format('d M Y H:i') : '-' }}</td>
                        </tr>
                    </table>
                </div>

                {{-- Media --}}
                <div class="mb-4">
                    <h5 class="fw-semibold bg-light p-2 rounded">🖼️ Media</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th>Image</th>
                            <td>
                                @if(!empty($taskdetails->image))
                                    <a href="{{ $taskdetails->image }}" target="_blank">
                                        <img src="{{ $taskdetails->image }}" alt="Task Image"
                                            style="max-width: 250px; border: 1px solid #ddd; border-radius: 6px; padding: 2px;">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Document</th>
                            <td>
                                @if(!empty($taskdetails->document))
                                    <a href="{{ $taskdetails->document }}" target="_blank" class="btn btn-sm btn-primary">
                                        View Document
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                {{-- Dynamic Fields --}}
                @if(count($formDetails))
                <div class="mb-2">
                    <h5 class="fw-semibold bg-light p-2 rounded">📦 Dynamic Fields (Response Data)</h5>
                    <table class="table table-borderless">
                        @foreach ($formDetails as $key => $value)
                        <tr>
                            <th>{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                            <td>{{ $value ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
