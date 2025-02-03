@extends('layouts.admin.main')
@section('title', 'Assign Menu')
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
                                    <input class="form-control-plaintext" type="text"
                                        placeholder="Search Company & Menu" id="search" oninput="search_company(this)">
                                </div>
                            </form>
                            <div class="flex-grow-1 text-end">
                                <a class="d-inline-flex" href="{{ route('admin.assign_menu.add') }}">
                                    <div class="btn bg-blue text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus-square">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="12" y1="8" x2="12" y2="16"></line>
                                            <line x1="8" y1="12" x2="16" y2="12"></line>
                                        </svg>Assign Menu
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
                        @include('admin.assign_menu.list')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<script>
    function search_company(ele) {
        $.ajax({
            url: "{{ route('admin.filter.company_menu') }}",
            type: 'get',
            data: {
                'searchKey': ele.value,
            },
            success: function(res) {
                jQuery('#assign_menu_list').replaceWith(res.data);
            }
        })
    }
</script>
@endsection
