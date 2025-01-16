<div class="list-product" id="menu_list">
    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">

        <div class="datatable-container">
            <table class="table nowrap" id="project-status">
                <thead>
                    <tr>
                        <th>
                            <span class="f-light f-w-600">Sr No.</span>
                        </th>
                        <th>
                            <span class="f-light f-w-600">Menu Name</span>
                        </th>
                        <th>
                            <p class="f-light">Slug</p>
                        </th>
                        <th>
                            <span class="f-light f-w-600">Parent Menu</span>
                        </th>
                        <th>
                            <span class="f-light f-w-600">Order No</span>
                        </th>
                        <th>
                            <span class="f-light f-w-600">Status</span>
                        </th>
                        <th>
                            <span class="f-light f-w-600">Action</span>
                        </th>
                    </tr>
                </thead>
                @forelse ($allMenuDetails as $key => $menuDetails)
                <tr>
                    <td>
                        <p class="f-light">{{ $key + 1 }}</p>
                    </td>

                    <td>
                        <p class="f-light">{{ $menuDetails->title }}</p>
                    </td>

                    <td>
                        <p class="f-light">{{ $menuDetails->slug }}</p>
                    </td>

                    <td>
                        @if (isset($menuDetails->parent) && !empty($menuDetails->parent))
                        {{ $menuDetails->parent->title }}
                        @else
                        NA
                        @endif
                    </td>

                    <td>
                        <p class="f-light">{{ $menuDetails->order_no }}</p>
                    </td>

                    <td>
                        <div class="form-check form-switch form-check-inline">
                            <input type="checkbox" <?=$menuDetails->status == '1' ? 'checked' : '' ?>
                            onchange="handleStatus({{ $menuDetails->id }})"
                            id="checked_value_{{ $menuDetails->id }}"
                            class="form-check-input switch-info check-size">
                            <span class="slider round"></span>
                        </div>
                    </td>
                    <td>
                        <div class="product-action">
                            <a href="{{ route('admin.edit_menu', ['id' => $menuDetails->id]) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            {{-- <a href="#" onclick="deleteFunction('{{ $menuDetails->id }}')">
                                <i class="fa fa-trash"></i>
                            </a> --}}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-danger text-center">No Menu Available</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        {{ $allMenuDetails->links('paginate') }}
    </div>
</div>
