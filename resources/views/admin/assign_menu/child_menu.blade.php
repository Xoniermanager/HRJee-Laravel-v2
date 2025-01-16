<ul>
    @foreach ($children as $child)
        <li>
            <input type="checkbox" name="menu_id[]" value="{{ $child->id}}"  id="parentCheck_{{ $child->id }}" >
            {{ $child->title }}
            @if ($child->children->isNotEmpty())
                @include('admin.company.child_menu', ['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
