<div class="card-body py-3" id="announcement_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Announcement</th>
                    <th>Expire Date & time</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($announcement_assigns as $key => $row)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $row->announcement->title }} </td>
                        <td>{{ !empty($row->notification_schedule_time) ? date('Y-m-d h:i A', strtotime($row->notification_schedule_time)) : '--' }}
                        </td>
                        <td> <label class="switch">
                                <input type="checkbox" <?= $row->status == 'active' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $row->id }})" id="checked_value">
                                <span class="slider round"></span>
                            </label></td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">


                                <a href="{{ route('announcement.assign.edit', $row->id) }}"  
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="{{ route('announcement.assign.view', $row->id) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('announcement_list',`{{ route('announcement.assign.delete', $row->id) }}`)">
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
{{ $announcement_assigns->links() }}
