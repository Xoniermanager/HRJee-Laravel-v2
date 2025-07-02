<div id="notice_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Notice</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allNoticeDetails as $key => $noticeDetails)
                    <tr>
                        <td>
                            @if($noticeDetails->attachment)
                                <a href="{{ $noticeDetails->attachment }}" target="_blank" class="text-blue-600 hover:underline">
                                    <i class="fas fa-file-pdf" style="font-size: 35px;"></i>
                                </a>
                            @else
                                <span class="text-gray-400">No Attachment</span>
                            @endif
                        </td>
                        {{-- <td><a href="{{$noticeDetails->attachment}}" target="_blank"><img src="{{ $noticeDetails->attachment ?? '' }}" class="offer_img" alt=""></a></td> --}}
                        <td>{{ $noticeDetails->title ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($noticeDetails->created_at)->format('d-m-Y') ?? ''}}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" {{ $noticeDetails->status == '1' ? 'checked' : '' }}
                                    id="checked_value_{{ $noticeDetails->id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="{{ route('notice.edit', $noticeDetails->id) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $noticeDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <span class="text-danger"><strong>No Notice Found!</strong></span>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <div class="col-md-12 clearfix">
            <ul class="pagination mt-3 float-right">
                {{ $allNoticeDetails->links() }}
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
                    url: "{{ route('notice.delete') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        Swal.fire("Done!", "It was successfully deleted!", "success");
                        $('#notice_list').replaceWith(res.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Deletion Error",
                            "Something wrong.",
                            "error");
                    }
                });
            }
        });
    }
</script>
