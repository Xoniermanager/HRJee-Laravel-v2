<div id="offer_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Offer</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allOfferDetails as $key => $offerDetails)
                    <tr>
                        <td><a href="{{$offerDetails->web_offer_image}}" target="_blank"><img src="{{ $offerDetails->web_offer_image ?? '' }}" class="offer_img" alt=""></a></td>
                        <td>{{ $offerDetails->title ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($offerDetails->created_at)->format('d-m-Y') ?? ''}}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" {{ $offerDetails->status == '1' ? 'checked' : '' }}
                                    id="checked_value_{{ $offerDetails->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="{{ route('offer.edit', $offerDetails->id) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $offerDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <span class="text-danger"><strong>No Offer Found!</strong></span>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-right">
                {{ $allOfferDetails->links() }}
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
                    url: "{{ route('offer.delete') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        Swal.fire("Done!", "It was successfully deleted!", "success");
                        $('#offer_list').replaceWith(res.data);
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
