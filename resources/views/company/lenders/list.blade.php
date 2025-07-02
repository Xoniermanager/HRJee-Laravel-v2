@php
    $userRole = Auth()->user()->userRole;
@endphp
<div id="lender_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Bank Name</th>
                    <th>Hub</th>
                    <th>Product</th>
                    <th>Status</th>
                    @if ($userRole->name != 'Banker')
                        <th class="float-right">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($allLenderDetails as $key => $lenderDetails)
                    <tr>
                        <td>{{ $lenderDetails->lender->name ?? '' }}</td>
                        <td>{{ $lenderDetails->hub ?? '' }}</td>
                        <td>{{ $lenderDetails->product->type ?? '' }}</td>

                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" {{ $lenderDetails->status == '1' ? 'checked' : '' }}
                                    id="checked_value_{{ $lenderDetails->id }}"
                                    {{ $userRole->name == 'Banker' ? 'disabled' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                @if ($userRole->name != 'Banker')
                                    <a href="{{ route('lender.edit', $lenderDetails->id) }}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                        onclick="deleteFunction('{{ $lenderDetails->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <span class="text-danger"><strong>No Lender Found!</strong></span>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-right">
                {{ $allLenderDetails->links() }}
            </ul>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

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
                    url: "{{ route('lender.delete') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        Swal.fire("Done!", "It was successfully deleted!", "success");
                        $('#lender_list').replaceWith(res.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Deletion Error",
                            "This lender is assigned, so it cannot be deleted.",
                            "error");
                    }
                });
            }
        });
    }
</script>
