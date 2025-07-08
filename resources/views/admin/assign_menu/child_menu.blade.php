<ul>
    @foreach ($children as $child)
    @if($child->role == "company")
        <li>
            <input type="checkbox" name="menu_id[]" value="{{ $child->id}}" id="parentCheck_{{ $child->id }}"
                class="child_{{ $child->parent_id }} childCheckbox" data-parent-id="{{  $child->parent_id }}">
            {{ $child->title }}
            @if ($child->children->isNotEmpty())
            @include('admin.assign_menu.child_menu', ['children' => $child->children])
            @endif
        </li>
    @endif

    @endforeach
</ul>
