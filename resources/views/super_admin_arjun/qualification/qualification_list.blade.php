<div class="card-body py-3" id="qualification_list">
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Qualification</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            @forelse ($allQualificationDetails as $key => $qualificationDetails)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>  <a href="#" data-bs-toggle="modal"
                            onClick="edit_qualification('{{ $qualificationDetails->id }}', '{{ $qualificationDetails->name }}','{{ $qualificationDetails->description }}')">
                        {{ $qualificationDetails->name }}</a></td>
                        <td>{{ $qualificationDetails->description }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox"
                                    <?= $qualificationDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $qualificationDetails->id }})"
                                    id="checked_value">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_qualification('{{ $qualificationDetails->id }}', '{{ $qualificationDetails->name }}','{{ $qualificationDetails->description }}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $qualificationDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Qualification Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->
</div>
{{$allQualificationDetails->links()}}