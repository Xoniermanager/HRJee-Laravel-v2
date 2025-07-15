<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #555; padding: 8px; text-align: left; }
        th { background-color: #3498db; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        a.map-link, a.doc-link { color: #2980b9; text-decoration: none; }
        a.map-link:hover, a.doc-link:hover { text-decoration: underline; }
        .img-thumb { width: 60px; height: auto; border: 1px solid #ddd; border-radius: 4px; }
    </style>
</head>
<body>
<h2>Task Export Report - {{ now()->format('d M Y H:i') }}</h2>

<table>
    <thead>
        <tr>
            <th>Sr No.</th>
            <th>Task ID</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Visit Address</th>
            <th>Visit Addr Lat</th>
            <th>Visit Addr Lng</th>
            <th>Lat</th>
            <th>Lng</th>
            <th>Map Link</th>
            <th>Document</th>
            <th>Image</th>
            <th>Remark</th>
            <th>Disposition Code</th>
            <th>Completed At</th>
            <th>Final Status</th>
            <th>User End Status</th>
            @foreach($dynamicFields as $field)
                <th>{{ ucwords(str_replace('_', ' ', $field)) }}</th>
            @endforeach
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allTaskDetails as $task)
            @php
                $responseData = json_decode($task->response_data, true) ?? [];
                $mapLat = $task->visit_address_latitude ?? $task->latitude;
                $mapLng = $task->visit_address_longitude ?? $task->longitude;
                $mapUrl = ($mapLat && $mapLng) ? "https://www.google.com/maps?q={$mapLat},{$mapLng}" : null;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td> {{-- Sr No --}}
                <td>{{ $task->id }}</td>
                <td>{{ $task->user->details->emp_id ?? '-' }}</td>
                <td>{{ $task->user->name ?? '-' }}</td>
                <td>{{ $task->visit_address ?? '-' }}</td>
                <td>{{ $task->visit_address_latitude ?? '-' }}</td>
                <td>{{ $task->visit_address_longitude ?? '-' }}</td>
                <td>{{ $task->latitude ?? '-' }}</td>
                <td>{{ $task->longitude ?? '-' }}</td>
                <td>
                    @if($mapUrl)
                        <a href="{{ $mapUrl }}" class="map-link" target="_blank">View Map</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($task->document)
                        <a href="{{ $task->document }}" class="doc-link" target="_blank">View Doc</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($task->image)
                        <a href="{{ $task->image }}" target="_blank">
                            <img src="{{ $task->image }}" class="img-thumb" alt="Image">
                        </a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $task->remark ?? '-' }}</td>
                <td>{{ $task->dispositionCode->name ?? '-' }}</td>
                <td>{{ $task->completed_at ? \Carbon\Carbon::parse($task->completed_at)->format('Y-m-d H:i') : 'Pending' }}</td>
                <td>{{ ucfirst($task->final_status) }}</td>
                <td>{{ ucfirst($task->user_end_status) }}</td>
                @foreach($dynamicFields as $field)
                    <td>{{ $responseData[$field] ?? '-' }}</td>
                @endforeach
                <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
