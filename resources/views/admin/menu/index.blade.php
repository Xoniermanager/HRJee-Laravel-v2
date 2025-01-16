@extends('layouts.admin.main')

@section('title', 'Menu')

@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header file-content border-0 pb-0">
                        <div class="d-md-flex d-sm-block">
                            <form class="form-inline" action="#" method="get">
                                <div class="form-group d-flex align-items-center mb-0"> <i class="fa fa-search"></i>
                                    <input class="form-control-plaintext" type="text" placeholder="Search..."
                                        id="search">
                                </div>
                            </form>
                            <div class="flex-grow-1 text-end">
                                <a class="d-inline-flex" href="{{ route('admin.add_menu') }}">
                                    <div class="btn bg-blue text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus-square">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                        </svg>Add Menu
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
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
                        @include('admin.menu.menu-list')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<div class="modal fade" id="edit_department" tabindex="-1" aria-labelledby="edit_department" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dark-sign-up overflow-hidden">
            <div class="modal-body social-profile text-start">
                <div class="modal-toggle-wrapper">
                    <h4 class="text-dark">Edit Department</h4>
                    <p>
                        Fill in your information below to continue.</p>
                    <form class="row g-3" id="department_update_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" placeholder="Enter Your Department Name" name="name"
                                id="name">
                            @error('name')
                            <span class="text-denger">{{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteFunction(id) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= route('admin.menu.delete') ?>",
                        type: "get",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire("Done!", "It was succesfully deleted!", "success");
                            $('#menu_list').replaceWith(res.data);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error deleting!", "Please try again", "error");
                        }
                    });
                }
            });
        }


        $(document).on("input", "#search", function(e) {
            var key = $(this).val();
            search_company_branchs(key, status = null)
        });

        $('#filterByStatus').change(function() {
            var status = $(this).val();
            search_company_branchs(key = null, status)
        });

        function search_company_branchs(key, status) {
            $.ajax({
                url: "{{ route('admin.menu.search') }}",
                type: 'get',
                data: {
                    'key': key,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        jQuery('#menu_list').replaceWith(res.data);
                    }
                }
            })
        }

        function handleStatus(id) {
            var checked_value = $('#checked_value_' + id).prop('checked');
            let status;

            let status_name;
            if (checked_value == true) {
                status = 1;
                status_name = 'Active';
            } else {
                status = 0;
                status_name = 'Inactive';
            }
            console.log(status);
            $.ajax({
                url: "{{ route('admin.menu.statusUpdate') }}",
                type: 'get',
                data: {
                    'id': id,
                    'status': status,
                },
                success: function(res) {
                    if (res) {
                        swal.fire("Done!", 'Status ' + status_name + ' Update Successfully', "success");
                        //jQuery('#company_branch_list').replaceWith(res.data);
                    } else {
                        swal.fire("Oops!", 'Something Went Wrong', "error");
                    }
                }
            })
        }
</script>
@endsection
