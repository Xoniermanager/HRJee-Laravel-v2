<div class="table-responsive" id="employee_list">
    <!--begin::Table-->
    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
        <!--begin::Table head-->
        <thead>
            <tr class="fw-bold">
                <th>Sr. No.</th>
                <th class="min-w-150px">Name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Official Email</th>
                <th>Gender</th>
                <th class="min-w-150px">Marital Status</th>
                <th class="min-w-150px">Joining Date</th>
                <th class="min-w-150px">Employee Status</th>
                <th class="min-w-150px">Employee Type</th>
                <th class="min-w-150px">Shift</th>
                <th class="min-w-150px">Branch</th>
                <th class="">Action</th>
            </tr>
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        @forelse ($allUserDetails as $key => $singleUserDetails)
            <tbody class="">
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $singleUserDetails->name }}</td>
                    @if (isset($singleUserDetails['userDetails']))
                        <td>{{ $singleUserDetails['userDetails']->department->name }}</td>
                    @else
                        <td></td>
                    @endif
                    @if (isset($singleUserDetails['userDetails']))
                        <td>{{ $singleUserDetails['userDetails']->designation->name }}</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $singleUserDetails->official_email_id }}</td>
                    @if ($singleUserDetails->gender == 'M')
                        <td>Male</td>
                    @else
                        <td>Female</td>
                    @endif
                    @if ($singleUserDetails->marital_status == 'S')
                        <td>Single</td>
                    @else
                        <td>Married</td>
                    @endif
                    <td>{{ $singleUserDetails->joining_date }}</td>

                    <td>{{ $singleUserDetails->employeeStatus->name }}</td>
                    @if (isset($singleUserDetails['userDetails']))
                        <td>{{ $singleUserDetails['userDetails']->employeeTypes->name }}</td>
                    @else
                        <td></td>
                    @endif
                    @if (isset($singleUserDetails['userDetails']))
                        <td>{{ $singleUserDetails['userDetails']->officeShift->name }}</td>
                    @else
                        <td></td>
                    @endif
                    @if (isset($singleUserDetails['userDetails']))
                        <td>{{ $singleUserDetails['userDetails']->companyBranches->name }}</td>
                    @else
                        <td></td>
                    @endif
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="employee_view.html"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-eye"></i>
                                <!--end::Svg Icon-->
                            </a>
                            <!--begin::Menu-->
                            <div class="me-1">
                                <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!--begin::Menu 3-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                    data-kt-menu="true">

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-bs-toggle="modal"
                                        data-bs-target="#personal_details">
                                        <a href="#" class="menu-link px-3"
                                            onclick="getPersonalDetails({{ $singleUserDetails->id }});">Personal
                                            Details</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-bs-toggle="modal"
                                        data-bs-target="#advance_details">
                                        <a href="#" class="menu-link flex-stack px-3"
                                            onclick="getAdvanceDetails({{ $singleUserDetails->id }})">Advance
                                            Details </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-bs-toggle="modal" data-bs-target="#address"
                                        onclick="getAddressDetails({{ $singleUserDetails->id }})">
                                        <a href="#" class="menu-link px-3">Address</a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-1" data-bs-toggle="modal"
                                        data-bs-target="#bank_details">
                                        <a href="#" class="menu-link px-3"
                                            onclick="getBankDetails({{ $singleUserDetails->id }})">Bank
                                            Details</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-1" data-bs-toggle="modal"
                                        data-bs-target="#upload_documents">
                                        <a href="{{ route('employee.edit', $singleUserDetails->id) }}"
                                            class="menu-link px-3">
                                            Edit Employee Detail</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 3-->
                            </div>
                            <!--end::Menu-->

                            {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <i class="fa fa-trash"></i>
                                <!--end::Svg Icon-->
                            </a> --}}
                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="3">
                    <span class="text-danger">
                        <strong>No Employee Available!</strong>
                    </span>
                </td>
            </tbody>
        @endforelse
        <!--end::Table body-->
    </table>
    <!--end::Table-->
</div>
