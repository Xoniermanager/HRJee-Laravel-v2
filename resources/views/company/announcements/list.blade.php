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
                    <th>Start Date & time</th>
                    <th>Expiry Date & time</th>
                    <th>Assignment</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($allAnnouncementDetails as $key => $announcementDetails)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $announcementDetails->title }} </td>
                        <td>{{ date('Y-m-d h:i A', strtotime($announcementDetails->start_date_time)) }}</td>
                        <td>{{ date('Y-m-d h:i A', strtotime($announcementDetails->expires_at_time)) }}</td>
                        @php
                            $button = '';
                            if ($announcementDetails->assign_announcement == 1) {
                                $button = 'Now';
                            } else {
                                $button = 'Later';
                            }
                        @endphp
                        <td>
                            <a href="#" data-bs-toggle="modal"
                                onclick="assign_announcement('{{ $announcementDetails->id }}','{{ $announcementDetails->assign_announcement }}',
                                    '{{ $announcementDetails->notification_schedule_time }}','{{ $announcementDetails->all_company_branch }}',
                                    '{{ $announcementDetails->all_department }}','{{ $announcementDetails->all_designation }}',
                                    '{{ $announcementDetails->companyBranches->pluck('id') }}','{{ $announcementDetails->departments->pluck('id') }}',
                                    '{{ $announcementDetails->designations->pluck('id') }}')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <span class="btn btn-primary btn-sm me-1">{{ $button }}</span>
                                <!--end::Svg Icon-->
                            </a>
                        </td>
                        <td> <label class="switch">
                                <input type="checkbox" <?= $announcementDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $announcementDetails->id }})"
                                    id="checked_value_{{ $announcementDetails->id }}">
                                <span class="slider round"></span>
                            </label></td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="{{ route('announcement.edit', $announcementDetails->id) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="{{ route('announcement.view', $announcementDetails->id) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-eye"></i>
                                    <!--end::Svg Icon-->
                                </a>

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $announcementDetails->id }}')">
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
{{ $allAnnouncementDetails->links() }}
