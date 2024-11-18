@extends('layouts.company.main')

@section('title', 'Employee Management')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <div class="card mb-4">
                <div class="card-header d-block cursor-pointer border-0">
                    <div class="row align-items-center mt-4">
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

                        <div class="col-md-4">
                            <div class="d-flex align-items-center position-relative">
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
                                <input data-kt-patient-filter="search" class="form-control ps-14" placeholder="Search"
                                    type="text" id="search">
                                <button style="opacity: 0; display: none !important" id="table-search-btn"></button>
                            </div>
                        </div>

                        <div class="col-md-6 me-0 d-flex">
                            <div class="mb-1   " data-bs-toggle="modal" data-bs-target="#export_popup">
                                <a href="#" class=" btn btn-sm btn-danger ms-3 align-self-center">Export Employee</a>
                            </div>
                            <div class="mb-1 " data-bs-toggle="modal" data-bs-target="#export_bank_details">
                                <a href="#" class="btn btn-sm btn-danger ms-3 align-self-center">Export Bank
                                    Details</a>
                            </div>
                            <div class="mb-1 " data-bs-toggle="modal" data-bs-target="#export_address_details">
                                <a href="#" class="btn btn-sm btn-danger ms-3 align-self-center">Export Address
                                    Details</a>
                            </div>
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
                        <div>
                            <form class="row" id="filter_id">
                                <div class="col-md-2 mb-1" id="gender_div">
                                    <select class="form-control filter_form" name="gender" id="gender">
                                        <option value="">Gender</option>
                                        <option value="M"
                                            {{ request()->get('gender') == 'M' || old('gender') == 'M' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option value="F"
                                            {{ request()->get('gender') == 'F' || old('gender') == 'F' ? 'selected' : '' }}>
                                            Female</option>
                                        <option value="O"
                                            {{ request()->get('gender') == 'O' || old('gender') == 'O' ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="emp_status_id_div">
                                    <select class="form-control filter_form" name="emp_status_id" id="emp_status_id">
                                        <option value="">Employee Status</option>
                                        @foreach ($allEmployeeStatus as $employeeStatus)
                                            <option
                                                {{ request()->get('emp_status_id') == $employeeStatus->id || old('emp_status_id') == $employeeStatus->id ? 'selected' : '' }}
                                                value="{{ $employeeStatus->id }}">{{ $employeeStatus->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="marital_status_div">
                                    <select class="form-control filter_form" name="marital_status" id="marital_status">
                                        <option value="">Marital Status</option>
                                        <option value="S"
                                            {{ request()->get('marital_status') == 'S' || old('marital_status') == 'S' ? 'selected' : '' }}>
                                            Single
                                        </option>
                                        <option value="M"
                                            {{ request()->get('marital_status') == 'M' || old('marital_status') == 'M' ? 'selected' : '' }}>
                                            Married</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="emp_type_div_id">
                                    <select class="form-control filter_form" name="emp_type_id" id="emp_type_id">
                                        <option value="">All Employee Type</option>
                                        @foreach ($allEmployeeType as $employeeType)
                                            <option
                                                {{ request()->get('emp_type_id') == $employeeType->id || old('emp_type_id') == $employeeType->id ? 'selected' : '' }}
                                                value="{{ $employeeType->id }}">{{ $employeeType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="department_div_id">
                                    <select class="form-control filter_form" name="department_id" id="department_id">
                                        <option value="">All Department</option>
                                        @foreach ($alldepartmentDetails as $departmentDetails)
                                            <option
                                                {{ request()->get('department_id') == $departmentDetails->id || old('department_id') == $departmentDetails->id ? 'selected' : '' }}
                                                value="{{ $departmentDetails->id }}">{{ $departmentDetails->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="shift_div_id" style="display: none">
                                    <select class="form-control filter_form" name="shift_id">
                                        <option value="">Shift</option>
                                        @foreach ($allShifts as $shiftDetail)
                                            <option
                                                {{ request()->get('shift_id') == $shiftDetail->id || old('shift_id') == $shiftDetail->id ? 'selected' : '' }}
                                                value="{{ $shiftDetail->id }}">{{ $shiftDetail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="branch_div_id" style="display: none">
                                    <select class="form-control filter_form" name="branch_id">
                                        <option value="">Branch</option>
                                        @foreach ($allBranches as $branchDetails)
                                            <option
                                                {{ request()->get('branch_id') == $branchDetails->id || old('branch_id') == $branchDetails->id ? 'selected' : '' }}
                                                value="{{ $branchDetails->id }}">{{ $branchDetails->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="qualification_div_id" style="display: none">
                                    <select class="form-control filter_form" name="qualification_id">
                                        <option value="">Qualification</option>
                                        @foreach ($allQualification as $qualificationDetails)
                                            <option
                                                {{ request()->get('qualification_id') == $qualificationDetails->id || old('qualification_id') == $qualificationDetails->id ? 'selected' : '' }}
                                                value="{{ $qualificationDetails->id }}">{{ $qualificationDetails->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" id="skill_div_id" style="display: none">
                                    <select class="form-control filter_form" name="skill_id">
                                        <option value="">Skills</option>
                                        @foreach ($allSkills as $skillsDetails)
                                            <option
                                                {{ request()->get('skill_id') == $skillsDetails->id || old('skill_id') == $skillsDetails->id ? 'selected' : '' }}
                                                value="{{ $skillsDetails->id }}">{{ $skillsDetails->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-1" data-bs-toggle="modal" data-bs-target="#filter_popup">
                                    <a href="#" class="btn btn-primary btn-sm">More Filter</a>
                                </div>
                            </form>

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
                                        @include('company.employee.list')
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
            @include('company.employee.popup_form.personal_detail')
        </div>
        <!--end::Modal - personal_details-->
        <!--begin::Modal - advance_details-->
        <div class="modal fade" id="advance_details" tabindex="-1" aria-hidden="true">
            @include('company.employee.popup_form.advance_detail')
        </div>
        <!--end::Modal - advance_details-->
        <!--begin::Modal - Address-->
        <div class="modal fade" id="address" tabindex="-1" aria-hidden="true">
            @include('company.employee.popup_form.address_detail')
        </div>
        <!--end::Modal - Address-->
        <!--begin::Modal - Bank Details-->
        <div class="modal fade" id="bank_details" tabindex="-1" aria-hidden="true">
            @include('company.employee.popup_form.bank_detail')
        </div>
        <!--end::Modal - Bank Details-->
        <div class="modal fade" id="filter_popup" tabindex="-1" aria-hidden="true">
            <div>
                <div class="modal-dialog mw-400px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header pb-0">
                            <!--begin::Close-->
                            <h3 class="fw-bold m-0">Apply More Filters</h3>
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                            rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
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
                            <div class="row w-100">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" value="gender_div"
                                            checked>
                                        <label for="gender">Gender</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            value="emp_status_id_div" checked>
                                        <label for="gender">Employee Status</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            value="marital_status_div" checked>
                                        <label for="gender">Marital Status</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            value="emp_type_div_id" checked>

                                        <label for="gender">Employee Type</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            value="department_div_id" checked>

                                        <label for="gender">Department</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" value="shift_div_id">

                                        <label for="gender">Sift</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            value="branch_div_id">

                                        <label for="gender">Branch</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            value="qualification_div_id">

                                        <label for="gender">Qualification</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" value="skill_div_id">

                                        <label for="gender">Skills</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="export_popup" tabindex="-1" aria-hidden="true">
            <div>
                <div class="modal-dialog mw-900px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header pb-0">
                            <!--begin::Close-->
                            <h3 class="fw-bold m-0">Export</h3>
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                            rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
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
                            <form action="{{ route('export.employee') }}" method="post" id="export_employee_form">
                                @csrf
                                <input type="hidden" name="gender_filter" class="export_gender">
                                <input type="hidden" name="emp_status_id" class="export_emp_status">
                                <input type="hidden" name="marital_status_filter" class="export_marital_status">
                                <input type="hidden" name="emp_type_id" class="export_emp_type_id">
                                <input type="hidden" name="depertment_id" class="export_depertment_id">

                                <div class="row w-100">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox" checked
                                                name="name">
                                            <label for="gender">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox"
                                                name="official_email_id" checked>
                                            <label for="gender">Official Email ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox" name="email"
                                                checked>
                                            <label for="gender">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox" name="gender"
                                                checked>

                                            <label for="gender">Gender</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox"
                                                name="marital_status" checked>

                                            <label for="gender">Marital Status</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox"
                                                name="joining_date" checked>

                                            <label for="gender">Joining Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox"
                                                name="date_of_birth" checked>

                                            <label for="gender">DOB</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox"
                                                name="blood_group" checked>

                                            <label for="gender">Blood Group</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox" name="phone"
                                                checked>

                                            <label for="gender">Phone</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox" name="branch"
                                                checked>

                                            <label for="gender">Branch</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox" name="department"
                                                checked>

                                            <label for="gender">Department</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox"
                                                name="designation" checked>

                                            <label for="gender">Designation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox"
                                                name="official_mobile_no" checked>

                                            <label for="gender">Official Mobile No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 filter" type="checkbox" name="shift"
                                                checked>

                                            <label for="gender">Shift</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <button class="btn btn-sm btn-danger ms-3 align-self-center" type="button"
                                                onclick="exportData('export_employee_form')">Export</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="export_bank_details" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog mw-900px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0">Export</h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <i class="fa fa-close"></i>
                            </span>
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body scroll-y p-4">
                        <form action="{{ route('export.employee.bank.details') }}" method="post"
                            id="export_bank_details_form">
                            @csrf
                            <input type="hidden" name="gender" class="export_gender">
                            <input type="hidden" name="emp_status_id" class="export_emp_status">
                            <input type="hidden" name="marital_status" class="export_marital_status">
                            <input type="hidden" name="emp_type_id" class="export_emp_type_id">
                            <input type="hidden" name="depertment_id" class="export_depertment_id">
                            <div class="row w-100">
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" checked
                                            name="name">
                                        <label for="gender">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="email"
                                            checked>
                                        <label for="gender">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="department"
                                            checked>
                                        <label for="gender">Department</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="designation"
                                            checked>
                                        <label for="gender">Designation</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="bank_name"
                                            checked>
                                        <label for="gender">Bank Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="account_name"
                                            checked>

                                        <label for="gender">Account Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="account_number"
                                            checked>

                                        <label for="gender">Account Number</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="ifsc_code"
                                            checked>

                                        <label for="gender">Ifsc Code</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <button class="btn btn-sm btn-danger ms-3 align-self-center" type="button"
                                        onclick="exportData('export_bank_details_form')">Export</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="export_address_details" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog mw-900px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0">
                        <!--begin::Close-->
                        <h3 class="fw-bold m-0">Export</h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <i class="fa fa-close"></i>
                            </span>
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body scroll-y p-4">
                        <form action="{{ route('export.employee.address.details') }}" method="post"
                            id="address_export_form">
                            @csrf
                            <input type="hidden" name="gender" class="export_gender">
                            <input type="hidden" name="emp_status_id" class="export_emp_status">
                            <input type="hidden" name="marital_status" class="export_marital_status">
                            <input type="hidden" name="emp_type_id" class="export_emp_type_id">
                            <input type="hidden" name="depertment_id" class="export_depertment_id">
                            <div class="row w-100">
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" checked
                                            name="name">
                                        <label for="gender">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="email"
                                            checked>
                                        <label for="gender">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="department"
                                            checked>
                                        <label for="gender">Department</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="designation"
                                            checked>
                                        <label for="gender">Designation</label>
                                    </div>
                                </div>
                                <h4>Permanent address</h4>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            name="permanent_country" checked>
                                        <label for="gender">Country</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            name="permanent_state" checked>

                                        <label for="gender">State</label>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox"
                                            name="permanent_address" checked>

                                        <label for="gender">Address</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="permanent_city"
                                            checked>
                                        <label for="gender">City</label>
                                    </div>
                                </div>
                                <h4>Local address</h4>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="local_country"
                                            checked>
                                        <label for="gender">Country</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="local_state"
                                            checked>

                                        <label for="gender">State</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="local_address"
                                            checked>

                                        <label for="gender">Address</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input me-3 filter" type="checkbox" name="local_city"
                                            checked>
                                        <label for="gender">City</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <button class="btn btn-sm btn-danger ms-3 align-self-center" type="button"
                                        onclick="exportData('address_export_form')">Export</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     

        <script>
            let submit_handler = false;
            $(".filter").on("click", function(event) {
                let filter_id = $(this).val();
                let selected_status = $(this).prop('checked');
                if (selected_status) {
                    jQuery('#' + filter_id).show();
                } else {
                    jQuery('#' + filter_id).hide();
                }
            });
            $('.filter_form').on('change', function() {
                var data = $('#filter_id').serialize();
                $.ajax({
                    method: 'GET',
                    url: company_ajax_base_url + '/employee/get/filter/list',
                    data: data,
                    success: function(response) {
                        $('#employee_list').replaceWith(response.data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {}
                });
            });

            function exportData(submit_form_id) {
                let data = queryStringToJSON($('#filter_id').serialize());
                $('.export_emp_status').val(data.emp_status_id);
                $('.export_marital_status').val(data.marital_status);
                $('.export_gender').val(data.gender);
                $('.export_emp_type_id').val(data.emp_type_id);
                $('.export_depertment_id').val(data.department_id);
                $(`#${submit_form_id}`).submit();
            };

            function queryStringToJSON(queryString) {
                // Remove leading '?' if it exists
                if (queryString.startsWith('?')) {
                    queryString = queryString.substring(1);
                }

                // Split the query string into key-value pairs
                const pairs = queryString.split('&');
                const result = {};

                // Iterate over each pair
                pairs.forEach(pair => {
                    const [key, value] = pair.split('=');
                    result[key] = value || ''; // Use empty string if value is undefined
                });

                return result;
            }
            $("#search").blur(function() {
                $.ajax({
                    type: 'GET',
                    url: company_ajax_base_url + '/employee/get/filter/list',
                    data: {
                        'search': $(this).val()
                    },
                    success: function(response) {
                        $('#employee_list').replaceWith(response.data);
                    }
                });
            });
        </script>
    @endsection
