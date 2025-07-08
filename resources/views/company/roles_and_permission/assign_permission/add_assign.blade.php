@extends('layouts.company.main')
@section('title','Roles And Permissions')
@section('content')
<style>
    .menu-card {
        background: #ffffff;
        /* white card background */
        border: 1px solid #e2e8f0;
        /* subtle border */
        border-radius: 0.75rem;
        /* rounded corners */
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        /* soft shadow */
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .menu-card:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        /* stronger shadow on hover */
        transform: translateY(-2px);
        /* slight lift */
    }

    .child-menus {
        margin-top: 0.25rem;
    }

    .child-menus label {
        cursor: pointer;
    }

    .form-check-input {
        cursor: pointer;
    }

    /* Make child checkboxes smaller & lighter */
    .small-checkbox {
        width: 0.9rem;
        height: 0.9rem;
        accent-color: #6c757d;
        /* optional: gray tone when checked */
        cursor: pointer;
    }

    .child-menus label span {
        font-size: 0.85rem;
        color: #555;
    }

</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow rounded-4 border-0">
                    <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('assign_permission.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Select Role</label>
                                <select class="form-select shadow-sm" name="role_id">
                                    <option value="">Select Role</option>
                                    @forelse ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @empty
                                    <option value="">No Role Found</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('role_id'))
                                <div class="text-danger mt-1 small">{{ $errors->first('role_id') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-check-label fw-semibold">
                                    <input type="checkbox" id="allCheck" class="form-check-input me-2">
                                    Select All Permissions
                                </label>
                            </div>

                            <ul class="permission-tree list-unstyled">
                                <div class="row">
                                    @foreach ($allMenus as $menu)
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <div class="menu-card border rounded shadow-sm h-100 p-3">
                                            <label class="form-check-label d-flex align-items-center mb-2">
                                                <input type="checkbox" name="menu_id[]" value="{{ $menu->id }}" id="parentCheck_{{ $menu->id }}" class="parentCheckbox form-check-input me-2">
                                                <span class="fw-semibold">{{ $menu->title }}</span>
                                            </label>
                                            @if ($menu->children->isNotEmpty())
                                            <div class="child-menus ps-3">
                                                @foreach ($menu->children as $child)
                                                <label class="form-check-label d-flex align-items-center mb-1">
                                                    <input type="checkbox" class="childCheckbox form-check-input me-1 child_{{ $menu->id }} small-checkbox" data-parent-id="{{ $menu->id }}" name="menu_id[]" value="{{ $child->id }}" id="child_{{ $child->id }}">
                                                    <span class="small">{{ $child->title }}</span>
                                                </label>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </ul>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-sm rounded-3">
                                    <span>Submit</span>
                                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ✅ Script -->
<script>
    $(document).ready(function() {
        // Check/uncheck all
        $('#allCheck').on('change', function() {
            $('input[type="checkbox"]').prop('checked', this.checked);
        });

        // When parent is clicked, toggle all its children
        $(document).on('change', '.parentCheckbox', function() {
            let parentId = this.id.replace('parentCheck_', '');
            $('.child_' + parentId).prop('checked', this.checked);
        });

        // When any child is clicked
        $(document).on('change', '.childCheckbox', function() {
            let parentId = $(this).data('parent-id');
            let parent = $('#parentCheck_' + parentId);
            let allChildren = $('.child_' + parentId);
            let anyChecked = allChildren.is(':checked');
            parent.prop('checked', anyChecked);
        });

        // Load existing permissions when role is selected
        $('select[name="role_id"]').on('change', function() {
            let role_id = $(this).val();
            if (role_id) {
                getPermission(role_id);
            } else {
                $('input[name="menu_id[]"]').prop('checked', false);
            }
        });

        function getPermission(role_id) {
            $.ajax({
                url: "{{ route('assign_permission.assigned') }}",
                type: 'GET',
                data: {
                    role_id
                },
                success: function(response) {
                    $('input[name="menu_id[]"]').prop('checked', false); // uncheck all first

                    response.data.forEach(id => {
                        // check parent checkbox
                        $('#parentCheck_' + id).prop('checked', true);

                        // also check children of this parent
                        $('#child_' + id).prop('checked', true);
                    });
                }
            });
        }
    });

</script>

<style>
    .bottomspace {
        margin-bottom: 40px;
    }

    .disable {
        pointer-events: none;
        opacity: 0.7;
    }

</style>
@endsection
