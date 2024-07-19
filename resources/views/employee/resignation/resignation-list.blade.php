<div id="company_resignation_list" class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Title</th>
                    {{-- <th>Designation</th> --}}
                    <th>Apply Date</th>
                    <th>Release Date</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($resignations as $key => $resignation)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td> {{ $resignation->title }} </td>
                        </td>
                        <td>{{ date('yy-M-d h:i A', strtotime($resignation->created_at)) }}</td>
                        <td>{{ !empty($resignation->release_date) ? date('yy-M-d', strtotime($resignation->release_date)) : '--' }}
                        </td>
                        <td>{{ $resignation->resignationStatus->name }}</td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0 ">
                                @if ($userType == 'Employee')
                                    <a href="#" data-bs-toggle="modal"
                                        onClick="edit_resignation('{{ $resignation }}')"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 {{ $resignation->resignation_status_id != 3 ? 'd-none' : '' }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 text-danger {{ $resignation->resignation_status_id == 3 ? '' : 'd-none' }}"
                                        onclick='deleteFunction(`{{ $resignation->id }}`)'>
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <a href="#" data-bs-toggle="modal"
                                        onClick="action_resignation('{{ $resignation }}')"
                                        class="btn btn-icon btn-bg-light text-danger btn-active-color-primary btn-sm me-1 {{$resignation->resignation_status_id==1?'d-none':''}} {{ $resignation->resignation_status_id == 3 || $resignation->resignation_status_id == 5 ? '' : 'disabled' }}">
                                        <i class="fa fa-times" aria-hidden="true"></i>

                                    </a>
                                @else
                                    <a href="#" data-bs-toggle="modal"
                                        onClick="action_resignation('{{ $resignation }}')"
                                        class="btn btn-icon btn-bg-light text-danger btn-active-color-primary btn-sm me-1 {{$resignation->resignation_status_id==1?'d-none':''}} {{ $resignation->resignation_status_id == 3 || $resignation->resignation_status_id == 5 ? '' : 'disabled' }}">
                                        <i class="fa fa-edit" aria-hidden="true"></i>

                                    </a>
                                @endif
                                <a href="{{ route('resignation.view', $resignation->id) }}"
                                    class="btn btn-icon btn-bg-light  btn-active-color-primary btn-sm me-1 ">
                                    <i class="fa fa-eye" aria-hidden="true"></i>

                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Resignation Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->

</div>
{{ $resignations->links() }}
