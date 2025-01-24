<div id="holidays_list" class="card-body py-3">
    {{-- {{ dd($allHolidaysDetails) }} --}}
    <!--begin::Table container-->
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bold">
                    <th>Sr. No.</th>
                    <th>Holiday</th>
                    <th>Company Branches</th>
                    <th>Date</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th class="float-right">Action</th>
                </tr>
            </thead>
            @forelse ($allHolidaysDetails as $key => $holidaysDetails)
                <tbody class="">
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="#" data-bs-toggle="modal"
                                onClick="edit_holiday_details('{{ $holidaysDetails->id }}', '{{ $holidaysDetails->name }}','{{ $holidaysDetails->date }}','{{ $holidaysDetails->year }}','{{ $holidaysDetails->companyBranch->pluck('id') }}')">{{ $holidaysDetails->name }}</a>
                        </td>
                        <td>
                            @foreach ($holidaysDetails->companyBranch as $index => $companyBranch)
                                <span class="btn btn-primary btn-sm me-1">{{ $companyBranch->name }}</span>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $holidaysDetails->date }}</td>
                        <td>{{ $holidaysDetails->year }}</td>
                        <td data-order="Invalid date">
                            <label class="switch">
                                <input type="checkbox" <?= $holidaysDetails->status == '1' ? 'checked' : '' ?>
                                    onchange="handleStatus({{ $holidaysDetails->id }})" id="checked_value">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="#" data-bs-toggle="modal"
                                    onClick="edit_holiday_details('{{ $holidaysDetails->id }}', '{{ $holidaysDetails->name }}', '{{ $holidaysDetails->date }}', '{{ $holidaysDetails->year }}','{{ $holidaysDetails->companyBranch->pluck('id') }}')"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <i class="fa fa-edit"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    onclick="deleteFunction('{{ $holidaysDetails->id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Holidays Found!</strong>
                    </span>
                </td>
            @endforelse
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    {{ $allHolidaysDetails->links() }}
</div>
