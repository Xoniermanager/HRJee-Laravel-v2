<div class="card-body py-3" id="announcement_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Start Date & time</th>
                    <th>Description </th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($announcements as $key => $announcement)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $announcement->title }} </td>
                        <td><img src='{{ $announcement->announcement_image }}' height="50"></td>
                        <td>{{ date('Y-m-d h:i A', strtotime($announcement->start_date_time)) }}</td>
                        <td>{{ Str::of($announcement->description)->limit(10)}}</td>
                        <td> <label class="switch">
                            <input type="checkbox" <?= $announcement->status == 'active' ? 'checked' : '' ?>
                                onchange="handleStatus({{ $announcement->id }})" id="checked_value">
                            <span class="slider round"></span>
                        </label></td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                               

                                <a href="#" data-bs-toggle="modal"
                                onClick="edit_announcement_details('{{ $announcement }}')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-edit"></i>
                                <!--end::Svg Icon-->
                            </a>
                                <a href="{{route('announcement.view',$announcement->id)}}" 
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-eye"></i>
                                <!--end::Svg Icon-->
                            </a>
                         
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('announcement_list',`{{route('announcement.delete',$announcement->id)}}`)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Announcements Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->
</div>
{{ $announcements->links() }}
