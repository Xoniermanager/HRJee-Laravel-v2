@extends('layouts.company.main')
@section('content')
@section('title','Roles And Permissions')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="row g-xl-5 g-3 gy-5">
                                <div class="col-xxl-12 col-xl-12 box-col-12 position-relative">
                                    <form method="POST" class="feature-form"
                                        action="{{ route('assign_permission.store') }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <select class="form-control" name="role_id">
                                                    <option value="">Select Role</option>

                                                    @forelse ($roles as $role)
                                                        <option value="{{ $role->id }}">
                                                            {{ $role->name }}
                                                        </option>
                                                        @empty
                                                        <option value="">No Role Found</option>
                                                    @endforelse
                                                </select>
                                                @if ($errors->has('role_id'))
                                                    <div class="text-danger">{{ $errors->first('role_id') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <ul>
                                                <li>
                                                    <input type="checkbox" id="allCheck" id="checkAll">
                                                    All
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach ($allMenus as $menu)
                                                        <li>
                                                            <input type="checkbox" name="menu_id[]"
                                                                value="{{ $menu->id }}"
                                                                id="parentCheck_{{ $menu->id }}"
                                                                onclick="selectChild('{{ $menu->id }}')">
                                                            {{ $menu->title }}
                                                            @if ($menu->children->isNotEmpty())
                                                                @include('admin.assign_menu.child_menu', [
                                                                    'children' => $menu->children,
                                                                ])
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit"
                                                    class="companyDetailbtn float-right btn btn-primary d-flex align-items-center gap-sm-2 gap-1 text-white">
                                                    Submit
                                                    <svg viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="#ffffff"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.querySelectorAll('.childCheckbox').forEach(childCheckbox => {
            childCheckbox.addEventListener('change', function() {
                let parentId = this.getAttribute('data-parent-id');
                let parentCheckbox = $('#parentCheck_' + parentId);
                let allChildren = document.querySelectorAll(`.childCheckbox[data-parent-id="${parentId}"]`);
                let allChecked = Array.from(allChildren).every(child => child.checked);
                parentCheckbox.prop('checked', allChecked);
                if (!allChecked) {
                    parentCheckbox.prop('checked', false);
                }
            });
        });

        function selectChild(id) {
            if ($("#parentCheck_" + id).prop('checked') == true) {
                //do something
                let inputs = document.querySelectorAll('.child_' + id);
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].checked = true;
                }
            } else {
                let inputs = document.querySelectorAll('.child_' + id);
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].checked = false;
                }
            }
        }

        function getPermission(value) {
            const role_id = value;
            $.ajax({
                url: "<?= route('assign_permission.assigned') ?>", // Ensure this route is correct
                type: 'GET',
                data: {
                    role_id: role_id
                },
                success: function(response) {
                    $('input[name="menu_id[]"]').prop('checked', false);
                    const permissions = response.data;
                    permissions.forEach(element => {
                        $('#parentCheck_' + element).prop('checked', true);
                    });
                }
            });
        }
        $(document).ready(function() {
            $("#allCheck").on('click', function() {
                // Toggle all checkboxes based on the state of the #checkAll checkbox
                $("input:checkbox").prop('checked', $(this).prop('checked'));
            });
        })
    </script>
    <style>
        .bottomspace {
            margin-bottom: 40px;
        }

        a.companyAddressbtn.d-flex.align-items-center.gap-sm-2.gap-1 {
            color: white;
        }

        .disable {
            pointer-events: none;
            opacity: 0.7;
        }
    </style>
    <script>
        $(function() {
            $('select').searchableSelect({
                afterSelectItem: function() {
                    // Fetch the value directly from the original select element
                    const selectedValue = $('select').val();

                    if (selectedValue) {
                        getPermission(selectedValue);
                    } else {
                        $("input:checkbox").prop('checked',false);
                    }
                }
            });
        });
    </script>
@endsection
