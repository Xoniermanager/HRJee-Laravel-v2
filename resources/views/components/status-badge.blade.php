@php
	$badgeClass = match ($status) {
	    'pending' => 'badge-warning',
	    'completed' => 'badge-success',
	    'rejected' => 'badge-danger',
	    default => 'badge-primary',
	};
@endphp

<span class="badge {{ $badgeClass }}">
	{{ ucfirst($text) }}
</span>
