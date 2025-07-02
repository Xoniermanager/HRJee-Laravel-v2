@php
    $userType = Auth()->user()->userRole->name;
@endphp
@forelse ($connectors as $connector)
    <tr>
        <td>{{ $connector->connector_id ?? '' }}</td>
        <td>{{ $connector->connector_name ?? '' }}</td>
        <td>{{ $connector->profession ?? '' }}</td>
        <td>{{ $connector->email ?? '' }}</td>
        <td>{{ $connector->user->name ?? '' }}</td>
        <td>{{ $connector->msisdn ?? '' }}</td>
        <td>{{ $connector->company_name ?? '' }}</td>
        <td>{{ $connector->status ?? '' }}</td>
        <td>
            <div class="d-flex justify-content-end flex-shrink-0">
                <a href="{{ route('connector.view', $connector->connector_id) }}"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('connector.edit', $connector->connector_id) }}"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <i class="fa fa-edit"></i>
                </a>
                @if ($userType != 'Banker')
                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                        onclick="deleteFunction('{{ $connector->id }}')">
                        <i class="fa fa-trash"></i>
                    </a>
                @endif
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9"><span class="text-danger"><strong>No Connectors Found!</strong></span></td>
    </tr>
@endforelse
