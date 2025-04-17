<li class="hierarchy-item">
    @if (!empty($user['employees']))
        @if(count($user['employees']) > 0)
            <span class="toggle-btn">▶</span>
        @endif
    @endif

    <span class="employee-name">
        {{ $user['name'] }}
        @if(!empty($user['role_name']))
            ({{ $user['role_name'] }})
        @elseif(!empty($user['designation_name']))
            ({{ $user['designation_name'] }})
        @endif
    </span>

    @if(!empty($user['employees']) && count($user['employees']) > 0)
        @if(!empty($user['role_name']))
        <span class="employee-count">
            {{ count($user['employees']) }} <i class="fa fa-users"></i>
        </span>
        @endif
    @endif
    @if (!empty($user['employees']) && count($user['employees']) > 0)
        <ul class="inner-hierarchy">
            @foreach ($user['employees'] as $employee)
                @include('company.hierarchy.item', ['user' => $employee])
            @endforeach
        </ul>
    @endif
</li>
