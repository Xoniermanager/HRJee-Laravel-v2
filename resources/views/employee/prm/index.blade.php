@extends('layouts.employee.main')
@section('content')
@section('title')
    PRM
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <!--begin::Col-->
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="{{ route('prm.add') }}" class="btn btn-sm btn-primary align-self-center">
                        Add PRM</a>
                    <!--end::Action-->
                </div>
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
                <div class="mb-5 mb-xl-10">
                    <div class="">
                        <div class="">
                            <!--begin::Body-->
                            <div class="">
                                <div class="card-body py-3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fw-bold">
                                                    <th>Sr. No.</th>
                                                    <th>Category</th>
                                                    <th>Amount</th>
                                                    <th>Remark</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="">
                                                @foreach ($allPRMs as $key => $prm)
                                                    <tr>
                                                        <td>{{ $key + 1 }} </td>
                                                        <td>{{ $prm->category->name }}</td>
                                                        <td>{{ $prm->amount }}</td>
                                                        <td>{{ $prm->remark }}</td>
                                                        <td>{{ $prm->bill_date }}</td>
                                                        <td>{{ $prm->status == 0 ? 'Pending' : ($prm->status == 1 ? 'Approved' : 'Rejected') }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <a href="{{ route('prm.view', $prm->id) }}"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                @if ($prm->status == 0)
                                                                    <a href="{{ route('prm.edit', $prm->id) }}"
                                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a href="#" onclick="deleteFunction('{{ $prm->id }}')"
                                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
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
                    url: "<?= route('prm.delete') ?>",
                    type: "get",
                    data: {
                        id: id,

                    },
                    success: function (res) {
                        Swal.fire("Done!", "It was succesfully deleted!", "success");
                        location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
        });
    }
</script>
@endsection
