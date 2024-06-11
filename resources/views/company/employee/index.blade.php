@extends('layouts.company.main')

@section('title', 'main')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <div class="card mb-4">
                <div class="card-header d-block cursor-pointer border-0">
                    <div class="row align-items-center mt-4">
                        <div class="col-md-2">
                            <select class="form-control form-control h-30px pt-0 pb-0">
                                <option value="">Gender</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                                <option value="">Other</option>
                            </select>
                        </div>

                        <a href="#" class="col-md-3 btn btn-sm btn-primary ms-3 align-self-center wt-space"
                            data-bs-toggle="modal" data-bs-target="#kt_modal_bulk_permission">
                            <i class="fa fa-upload"></i> Bulk Attendance Permission</a>
                        <a href="#" class="col-md-2 btn btn-sm btn-primary ms-3 align-self-center "
                            data-bs-toggle="modal" data-bs-target="#kt_modal_employee">
                            <i class="fa fa-upload"></i> Employee</a>
                        <!--begin::Menu toggle-->
                        <a href="{{ route('employee.add') }}"
                            class="col-md-2 btn btn-sm ms-3 btn-primary align-self-center wt-space">
                            Add Employee</a>
                        <!--begin::Menu toggle-->


                        <div class="col-md-2 me-0">
                            <button class="btn btn-sm btn-danger ms-3 align-self-center" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                Export
                            </button>
                            <!--begin::Menu 3-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-250px py-3"
                                data-kt-menu="true" style="">
                                <!--begin::Heading-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link flex-stack px-3">Employees List
                                        <i class="fa fa-download ms-2 fs-7"></i></a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link flex-stack px-3">Employees with Salary
                                        <i class="fa fa-download ms-2 fs-7"></i></a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link flex-stack px-3">Employees without Salary
                                        <i class="fa fa-download ms-2 fs-7"></i></a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link flex-stack px-3">Employees Salary details
                                        <i class="fa fa-download ms-2 fs-7"></i></a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link flex-stack px-3">Add Employees template
                                        <i class="fa fa-download ms-2 fs-7"></i></a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link flex-stack px-3">Bulk attendance permission
                                        <i class="fa fa-download ms-2 fs-7"></i></a>
                                </div>

                                <!--end::Heading-->

                            </div>
                            <!--end::Menu 3-->
                        </div>


                    </div>
                </div>
            </div>

            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="card card-body col-md-12">
                    <div class="card-header cursor-pointer d-block p-0 mb-3">
                        <!--begin::Card title-->
                        <!--begin::Action-->
                        <div class="row">
                            <div class="col-md-2 mb-1">
                                <select class="form-control">
                                    <option value="Emp Type">Emp Type</option>
                                    <option value="">Staff</option>
                                    <option value="">Training</option>
                                    <option value="">Permanent</option>
                                    <option>Full-Time</option>
                                    <option>Daily Wages</option>
                                    <option>Sales</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-1">
                                <select class="form-control">
                                    <option value="">Shift</option>
                                    <option value="">All</option>
                                    <option value="">9 TO 6</option>
                                    <option value="">Night Shift</option>
                                    <option value="">Day Shift</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-1">
                                <select class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="">Transfer</option>
                                    <option value="">All</option>
                                    <option value="">Current</option>
                                    <option value="">resigned</option>
                                    <option value="">Ex-employee</option>
                                    <option value="">Terminated</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-1">
                                <select class="form-control">
                                    <option value="">Site</option>
                                    <option value="">Head Office</option>

                                </select>
                            </div>
                            <div class="col-md-2 mb-1">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                rx="1" transform="rotate(45 17.0365 15.1223)" fill="black">
                                            </rect>
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input data-kt-patient-filter="search" class="form-control ps-14"
                                        placeholder="Search " type="text" id="SearchByPatientName"
                                        name="SearchByPatientName" value="">
                                    <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Action-->

                    <div class="mb-5 mb-xl-10">

                        <div class="">
                            <div class="">
                                <!--begin::Body-->
                                <div class="">
                                    <div class="card-body py-3">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table
                                                class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="fw-bold">
                                                        <th>Sr. No.</th>
                                                        <th>Employee ID</th>
                                                        <th>Name</th>
                                                        <th>Gender</th>
                                                        <th>Official Email</th>
                                                        <th>Email</th>
                                                        <th>Father Name</th>
                                                        <th>Mother Name</th>
                                                        <th>Employee Status</th>
                                                        <th class="float-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                @forelse ($allUserDetails as $key => $singleUserDetails)
                                                    <tbody class="">
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $singleUserDetails->emp_id }}</td>
                                                            <td>{{ $singleUserDetails->name }}</td>
                                                            @if ($singleUserDetails->gender == 'M')
                                                                <td>Male</td>
                                                            @else
                                                                <td>Female</td>
                                                            @endif
                                                            <td>{{ $singleUserDetails->official_email_id }}</td>
                                                            <td>{{ $singleUserDetails->email }}</td>
                                                            <td>{{ $singleUserDetails->father_name }}</td>
                                                            <td>{{ $singleUserDetails->mother_name }}</td>
                                                            <td>{{ $singleUserDetails->employeeStatus->name }}</td>
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
                                                                        <button
                                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                                                            data-kt-menu-trigger="click"
                                                                            data-kt-menu-placement="bottom-end">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                        <!--begin::Menu 3-->
                                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                                                            data-kt-menu="true">

                                                                            <!--begin::Menu item-->
                                                                            <div class="menu-item px-3"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#personal_details">
                                                                                <a href="#" class="menu-link px-3"
                                                                                    onclick="getPersonalDetails({{ $singleUserDetails->id }});">Personal
                                                                                    Details</a>
                                                                            </div>
                                                                            <!--end::Menu item-->
                                                                            <!--begin::Menu item-->
                                                                            <div class="menu-item px-3"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#company_details">
                                                                                <a href="#"
                                                                                    class="menu-link flex-stack px-3">Company
                                                                                    Details </a>
                                                                            </div>
                                                                            <!--end::Menu item-->
                                                                            <!--begin::Menu item-->
                                                                            <div class="menu-item px-3"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#address">
                                                                                <a href="#"
                                                                                    class="menu-link px-3">Address</a>
                                                                            </div>
                                                                            <!--end::Menu item-->

                                                                            <!--begin::Menu item-->
                                                                            <div class="menu-item px-3 my-1"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#bank_details">
                                                                                <a href="#"
                                                                                    class="menu-link px-3">Bank
                                                                                    Details</a>
                                                                            </div>
                                                                            <!--end::Menu item-->
                                                                            <!--begin::Menu item-->
                                                                            <div class="menu-item px-3 my-1"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#upload_documents">
                                                                                <a href="#"
                                                                                    class="menu-link px-3">Upload
                                                                                    Documents</a>
                                                                            </div>
                                                                            <!--end::Menu item-->
                                                                        </div>
                                                                        <!--end::Menu 3-->
                                                                    </div>
                                                                    <!--end::Menu-->

                                                                    <a href="#"
                                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                                        <i class="fa fa-trash"></i>
                                                                        <!--end::Svg Icon-->
                                                                    </a>
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
                                        <!--end::Table container-->

                                    </div>
                                </div>
                                <!--begin::Body-->

                            </div>
                            <!--begin::Body-->
                        </div>
                        <!--begin::Body-->
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <div class="modal fade" id="personal_details" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog mw-600px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0"> Personal Details </h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y p-4">
                        <div class="card-body">
                            <form id="basic_create_form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $singleUserDetails->id ?? '' }}">
                                <div class="row mb-6 m-0">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        Profile Photo
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url('/assets/media/user.jpg')">
                                            <!--begin::Preview existing avatar-->
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url({{ $singleUserDetails->profile_image ?? '/assets/media/user.jpg' }})">
                                            </div>
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                aria-label="Change avatar" data-bs-original-title="Change avatar"
                                                data-kt-initialized="1">
                                                <i class="fa fa-edit fs-7"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                                <!--begin::Inputs-->
                                                <input type="file" name="profile_image" accept=".png, .jpg, .jpeg">
                                                <input type="hidden">
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Cancel-->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                aria-label="Cancel avatar" data-bs-original-title="Cancel avatar"
                                                data-kt-initialized="1">
                                                <i class="fa fa-times fs-2"><span class="path1"></span><span
                                                        class="path2"></span></i> </span>
                                            <!--end::Cancel-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Full Name *</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $singleUserDetails->name ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Email *</label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $singleUserDetails->email ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Official Email *</label>
                                        <input class="form-control" type="email" name="official_email_id"
                                            value="{{ $singleUserDetails->official_email_id ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Password</label>
                                        <input class="form-control" type="password" name="password">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Father's Name</label>
                                        <input class="form-control" type="text" name="father_name"
                                            value="{{ $singleUserDetails->father_name ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Mother's Name</label>
                                        <input class="form-control" type="text" name="mother_name"
                                            value="{{ $singleUserDetails->mother_name ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Blood Group *</label>
                                        <select class="form-control" name="blood_group">
                                            <option value="">Select the Blood Group</option>
                                            <option
                                                {{ $singleUserDetails->blood_group ?? old('blood_group') == 'A-' ? 'selected' : '' }}
                                                value="A-">A-</option>
                                            <option
                                                {{ $singleUserDetails->blood_group ?? old('blood_group') == 'A+' ? 'selected' : '' }}
                                                value="A+">A+</option>
                                            <option
                                                {{ $singleUserDetails->blood_group ?? old('blood_group') == 'B+' ? 'selected' : '' }}
                                                value="B+">B+</option>
                                            <option
                                                {{ $singleUserDetails->blood_group ?? old('blood_group') == 'B-' ? 'selected' : '' }}
                                                value="B-">B-</option>
                                            <option
                                                {{ $singleUserDetails->blood_group ?? old('blood_group') == 'O+' ? 'selected' : '' }}
                                                value="O+">O+</option>
                                            <option
                                                {{ $singleUserDetails->blood_group ?? old('blood_group') == 'O-' ? 'selected' : '' }}
                                                value="O-">O</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Gender *</label>
                                        <select class="form-control" name="gender">
                                            <option value="">Select the Gender</option>
                                            <option
                                                {{ $singleUserDetails->gender ?? old('gender') == 'M' ? 'selected' : '' }}
                                                value="M">
                                                Male</option>
                                            <option
                                                {{ $singleUserDetails->gender ?? old('gender') == 'F' ? 'selected' : '' }}
                                                value="F">
                                                Female</option>
                                            <option
                                                {{ $singleUserDetails->gender ?? old('gender') == 'O' ? 'selected' : '' }}value="O">
                                                Other
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Marital Status *</label>
                                        <select class="form-control" name="marital_status">
                                            <option value="">Select the Marital Status</option>
                                            <option
                                                {{ $singleUserDetails->marital_status ?? old('marital_status') == 'M' ? 'selected' : '' }}
                                                value="M">Married</option>
                                            <option
                                                {{ $singleUserDetails->marital_status ?? old('marital_status') == 'S' ? 'selected' : '' }}
                                                value="S">Single</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Emp Status *</label>
                                        <select class="form-control" name="employee_status_id">
                                            <option value="">Select The Employee Status</option>
                                            @forelse ($allEmployeeStatus as $employeeStatus)
                                                <option
                                                    {{ $singleUserDetails->employee_status_id ?? old('employee_status_id') == $employeeStatus->id ? 'selected' : '' }}
                                                    value="{{ $employeeStatus->id }}">
                                                    {{ $employeeStatus->name }}</option>
                                            @empty
                                                <option value="">No Employee Status Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Date of Birth *</label>
                                        <input class="form-control" type="date" name="date_of_birth"
                                            value="{{ $singleUserDetails->date_of_birth ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Date of Joining *</label>
                                        <input class="form-control" type="date" name="joining_date"
                                            value="{{ $singleUserDetails->joining_date ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Phone Number *</label>
                                        <input class="form-control" type="number" name="phone"
                                            value="{{ $singleUserDetails->phone ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Employee Id *</label>
                                        <input class="form-control" type="text" name="emp_id"
                                            value="{{ $singleUserDetails->emp_id ?? '' }}">
                                    </div>
                                </div>
                                <button class="btn btn-primary" id="submit">Save &
                                    Continue</button>
                            </form>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - personal_details-->
        <!--begin::Modal - company_details-->
        <div class="modal fade" id="company_details" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog mw-600px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0"> Company Details </h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y p-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Branch *</label>
                                    <select class="form-control">
                                        <option value="">Delhi</option>
                                        <option value="">Noida</option>
                                        <option value="">Punjab</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Department *</label>
                                    <select class="form-control">
                                        <option value="">Development</option>
                                        <option value="">Management</option>
                                        <option value="">Marketing</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Designation *</label>
                                    <select class="form-control">
                                        <option value="">Laravel Developer</option>
                                        <option value="">Angular Developer</option>
                                        <option value="">React Developer</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Employee ID*</label>
                                    <input class="form-control" name="" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Manager ID *</label>
                                    <input class="form-control" name="" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Joining Date *</label>
                                    <input class="form-control" type="date" name="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Basic Pay *</label>
                                    <input class="form-control" type="text" name="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Rent Allowance *</label>
                                    <input class="form-control" type="text" name="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Medical Allowance *</label>
                                    <input class="form-control" type="text" name="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Travel Allowance *</label>
                                    <input class="form-control" type="text" name="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-primary">Update </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - company_details-->
        <!--begin::Modal - Address-->
        <div class="modal fade" id="address" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog mw-600px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0"> Address </h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y p-4">
                        <div class="w-100">
                            <div class="mb-3">


                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Address *</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">City *</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">State *</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Pincode *</label>
                                            <input class="form-control" type="text">
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="mb-3 border-top">
                                <div class="card-header p-4">
                                    <!--begin::Card title-->
                                    <div class="card-title m-0">
                                        <h4>
                                            <input type="checkbox">
                                            Temporary Address is same as Permanent Address
                                        </h4>
                                        <h3 class="fw-bold m-0">
                                            Temporary Address
                                        </h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Address *</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">City *</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">State *</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Pincode *</label>
                                            <input class="form-control" type="text">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <button type="submit" class="btn btn-primary">Update </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Address-->
        <!--begin::Modal - Bank Details-->
        <div class="modal fade" id="bank_details" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog mw-600px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0"> Bank Details </h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y p-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Account Holder Name *</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Account Number *</label>
                                    <input class="form-control" type="number">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Bank Name *</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">IFSC Code *</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">PAN Number *</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Branch *</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-primary">Update </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Bank Details-->
        <!--begin::Modal - Upload Documents-->
        <div class="modal fade" id="upload_documents" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog mw-600px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0"> Upload Documents </h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y p-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Resume *</label>
                                    <input class="form-control" type="file">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Offer Letter *</label>
                                    <input class="form-control" type="file">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Joining Letter *</label>
                                    <input class="form-control" type="file">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Other Document (Upload Multiple) </label>
                                    <input class="form-control" type="file">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-primary">Update </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Upload Documents-->

        <!--begin::Modal - Bulk attendance permission-->
        <div class="modal fade" id="kt_modal_bulk_permission" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-">
                        <!--begin::Close-->
                        <h2>Import Bulk Attendance</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y pt-0 pb-5 border-top">
                        <!--begin::Wrapper-->
                        <div class="mw-lg-600px mx-auto">
                            <!--begin::Input group-->
                            <div class="d-flex align-items-center mt-5">

                                <!--begin::Switch-->

                                <input class="form-control mb-5" type="file" />

                                </label>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                        <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Import</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Bulk attendance permission-->


        <!--begin::Modal - employee-->
        <div class="modal fade" id="kt_modal_employee" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-500px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <h2>Import Employee</h2>
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y pt-0 pb-5 border-top">
                        <!--begin::Wrapper-->
                        <div class="mw-lg-600px mx-auto">
                            <!--begin::Input group-->
                            <div class="d-flex align-items-center mt-5">

                                <!--begin::Switch-->

                                <input class="form-control mb-5" type="file" />

                                </label>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                        <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="kt_modal_upgrade_plan_btn">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Import</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <script>
            function getPersonalDetails(id) {
                $.ajax({
                    url: "{{ route('employee.personal.details',id) }}",
                    type: 'get',
                    success: function(response) {
                    },
                    error: function(error_messages) {
                    }
                });
            }
        </script>
    @endsection
