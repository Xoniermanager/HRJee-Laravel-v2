<ul>
    @foreach ($children as $child)
        <li>
            <input type="checkbox" name="menu_ids[]" value="{{ $child->id}}"  class="child_{{ $child->parent_id }}" >
            {{ $child->title }}
            @if ($child->children->isNotEmpty())
                @include('admin.company.child_menu', ['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>