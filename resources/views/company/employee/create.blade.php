@extends('layouts.company.main')

@section('title', 'Add Employee')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
                <!--begin::Timeline widget 3-->
                <div class="card h-md-100">
                    <!--begin::Header-->
                    <div class="card-header p-0 align-items-center">
                        <!--begin::Nav-->
                        <ul
                            class="nav nav-stretch nav-pills nav-pills-custom nav-pills-active-custom d-flex justify-content-between b-5 px-3">
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger active"
                                    data-bs-toggle="tab" href="#basic_Details_tab">
                                    <span class="fs-7 fw-semibold">Basic Details</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#advance_details_tab">
                                    <span class="fs-7 fw-semibold">Advance Details</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#address_tab">
                                    <span class="fs-7 fw-semibold">Address</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#bank_details_tab">
                                    <span class="fs-7 fw-semibold">Bank Details</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#qualification_tab">
                                    <span class="fs-7 fw-semibold">Qualification</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#past_work_tab">
                                    <span class="fs-7 fw-semibold">Past work</span>

                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#permission_tab">
                                    <span class="fs-7 fw-semibold">Permissions</span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#family_details_tab">
                                    <span class="fs-7 fw-semibold">Family Details</span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#asset_tab">
                                    <span class="fs-7 fw-semibold">Asset </span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item p-0 ms-0">
                                <!--begin::Date-->
                                <a class="nav-link btn d-flex flex-column flex-center px-3 btn-active-danger"
                                    data-bs-toggle="tab" href="#document_tab">
                                    <span class="fs-7 fw-semibold">Documents</span>
                                </a>
                                <!--end::Date-->
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--end::Nav-->

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-7 px-0">

                        <!--begin::Tab Content (ishlamayabdi)-->
                        <div class="tab-content mb-2 px-9">
                            <!--begin::Tap pane Basic Details-->
                            <div class="tab-pane fade show active" id="basic_Details_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Full Name *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Email *</label>
                                        <input class="form-control" type="email" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Official Email *</label>
                                        <input class="form-control" type="email" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Password *</label>
                                        <input class="form-control" type="password" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Father's Name</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Mother's Name</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Blood Group *</label>
                                        <select class="form-control">
                                            <option value="">Select the Blood Group</option>
                                            <option value="">A</option>
                                            <option value="">A+</option>
                                            <option value="">B</option>
                                            <option value="">O</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Gender *</label>
                                        <select class="form-control">
                                            <option value="">Select the Gender</option>
                                            <option value="">Male</option>
                                            <option value="">Female</option>
                                            <option value="">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Marital Status *</label>
                                        <select class="form-control">
                                            <option value="">Select the Marital Status</option>
                                            <option value="">Married</option>
                                            <option value="">Unmarried</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Emp Status *</label>
                                        <select class="form-control">
                                            <option value="">Transfer</option>
                                            <option value="">Current</option>
                                            <option value="">Resigned</option>
                                            <option value="">Ex-employee</option>
                                            <option value="">Terminated</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Date of Birth *</label>
                                        <input class="form-control" name="" type="date">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Date of Joining *</label>
                                        <input class="form-control" name="" type="date">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Phone Number *</label>
                                        <input class="form-control" name="" type="number">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Employee Id *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="row mb-6 m-0">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            Profile Photo *
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                                style="background-image: url('/assets/media/user.jpg')">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px"
                                                    style="background-image: url('/assets/media/user.jpg')">
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
                                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                                    <input type="hidden" name="avatar_remove">
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
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Advance Details-->
                            <div class="tab-pane fade" id="advance_details_tab">
                                <!--begin::Wrapper-->

                                <div class="row">

                                    <div class="col-md-4 form-group">
                                        <label for="">UAN No*</label>
                                        <input class="form-control" name="" type="text">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">ESIC Number *</label>
                                        <input class="form-control" name="" type="text">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">PAN Number *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Aadhar Number *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Insurance Number *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Driving Licence No. *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="">PF Number *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">CTC Monthly (In Probation) *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Probation Period (Days) *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="">CTC Monthly (After Probation) *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Address Tab-->
                            <div class="tab-pane fade" id="address_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Present Address</h4>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="">Address *</label>
                                                <textarea class="form-control" type="text"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Country *</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">State *</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">City *</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pincode *</label>
                                                <input class="form-control" type="text">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h4>Permanent Address <input type="checkbox"> <small class="text-muted">Same as
                                                present address</small></h4>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="">Address *</label>
                                                <textarea class="form-control" type="text"></textarea>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Country *</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">State *</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">City *</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Pincode *</label>
                                                <input class="form-control" type="text">
                                            </div>

                                        </div>
                                    </div>
                                </div
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Bank Details-->
                            <div class="tab-pane fade" id="bank_details_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Bank Details 1 </h4>
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
                                                <label for="">IFSC/RTGS Code *</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Qualification-->
                            <div class="tab-pane fade" id="qualification_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Degree*</label>
                                        <select class="form-control">
                                            <option value="">Matriculation (10th)</option>
                                            <option value="">Senior Secondary (12th)</option>
                                            <option value="">Graduation</option>
                                            <option value="">Post Graduation</option>
                                            <option value="">Certificate Courses</option>
                                            <option value="">Politechnic Diploma</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="panel">
                                            <div class="panel-head">
                                                <h5>Matriculation (10th)</h5>
                                            </div>

                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-3 form-group">
                                                        <label for="">Institute/College *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label for="">University *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <label for="">Course *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>
                                                    <div class="col-md-1 form-group">
                                                        <label for="">Year *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>
                                                    <div class="col-md-1 form-group">
                                                        <label for="">Percentage(%) *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane PAst Work-->
                            <div class="tab-pane fade" id="past_work_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Company*</label>
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <div class="panel">
                                            <div class="panel-head">
                                                <h5>Xonier Technologies Private Limited</h5>
                                            </div>

                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-3 form-group">
                                                        <label for="">Designation *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>
                                                    <div class="col-md-2 form-group">
                                                        <label for="">From *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>
                                                    <div class="col-md-2 form-group">
                                                        <label for="">To *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>
                                                    <div class="col-md-2 form-group">
                                                        <label for="">Duration (In Years) *</label>
                                                        <input class="form-control" type="text" name="">
                                                    </div>
                                                    <div class="col-md-3 form-group">
                                                        <input type="checkbox" name="">
                                                        <label for="">Current Company *</label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Permission-->
                            <div class="tab-pane fade" id="permission_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Employment Type *</label>
                                        <select class="form-control">
                                            <option value="">Permanent</option>
                                            <option value="">Contract</option>
                                            <option value="">Trainee</option>
                                            <option value="">New Joinee</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Department*</label>
                                        <select class="form-control">
                                            <option value="">Select the Department</option>
                                            <option value="">IT</option>
                                            <option value="">Sales</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Designation</label>
                                        <select class="form-control">
                                            <option value="">Select the Designation</option>
                                            <option value="">Account Executive</option>
                                            <option value="">HR Recruiter</option>
                                            <option value="">Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Branch *</label>
                                        <select class="form-control">
                                            <option value="">Select the Branch</option>
                                            <option value="">Noida</option>
                                            <option value="">Delhi</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Role</label>
                                        <select class="form-control">
                                            <option value="">Select the Role</option>
                                            <option value="">Account Executive</option>
                                            <option value="">HR Recruiter</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Highest Qualification *</label>
                                        <select class="form-control">
                                            <option value="">Select the Qualification</option>
                                            <option value="">Btech</option>
                                            <option value="">10th</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Skills (multiselect)</label>
                                        <select class="form-control">
                                            <option value="">Select the Skills</option>
                                            <option value="">Data Entry</option>
                                            <option value="">Java Script</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Shift</label>
                                        <select class="form-control">
                                            <option value="">Select the Shift</option>
                                            <option value="">10 to 6</option>
                                            <option value="">9:30 to 6:30</option>
                                            <option value="">02:00 to 10:00</option>
                                            <option value="">Angular</option>
                                            <option value="">UI/UX Design </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Shirt Start Time *</label>
                                        <input class="form-control" type="time" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Offer ID *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Official Phone Number *</label>
                                        <input class="form-control" type="text" name="">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <h5>Work from Home</h5>
                                        <div class="d-flex align-items-center mt-3">
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                                <input class="form-check-input" name="communication[]" type="radio"
                                                    value="1" checked>
                                                <span class="fw-semibold ps-2 fs-6">
                                                    Yes
                                                </span>
                                            </label>
                                            <!--end::Option-->

                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-custom form-check-inline form-check-solid is-valid">
                                                <input class="form-check-input" name="communication[]" type="radio"
                                                    value="2">
                                                <span class="fw-semibold ps-2 fs-6">
                                                    No
                                                </span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Family Details-->
                            <div class="tab-pane fade" id="family_details_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="">Relationship *</label>
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">Name *</label>
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="">Number *</label>
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="">Date of birth *</label>
                                        <input class="form-control" type="date">
                                    </div>
                                    <div class="col-md-2 form-group mt-5">
                                        <input type="checkbox">
                                        <label for="">Nominee</label>
                                        <i class="fa fa-plus btn btn-primary p-3 h-30px float-right"
                                            style="line-height: 0.5;"></i>
                                    </div>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane Asset Tab-->
                            <div class="tab-pane fade" id="asset_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="">Asset Name *</label>
                                        <input class="form-control" name="" type="text">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Picture (Multiple) *</label>
                                        <input class="form-control" name="" type="file">
                                    </div>

                                    <div class="panel" id="apnd">
                                        <div class="panel-head">
                                            <h4>Asset Details</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row form-group" id="apnd_1">
                                                <label class="col-md-12 control-label" for="inputSuccess">Asset
                                                    item :</label>
                                                <div class="col-md-5">
                                                    <input name="asset_level[]" class="form-control" placeholder="Level">
                                                </div>
                                                <div class="col-md-5">
                                                    <input name="asset_value[]" class="form-control" placeholder="Value">
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="add_more();">Add</button>
                                                </div>
                                                <input type="hidden" name="type[]" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel" id="apnd_access">
                                        <div class="panel-head">
                                            <h4>Asset accessories</h4>
                                        </div>

                                        <div class="panel-body">
                                            <div class="row form-group">
                                                <label class="col-md-12 control-label" for="inputSuccess">Accessory
                                                    :</label>
                                                <div class="col-md-5">
                                                    <input name="asset_level[]" class="form-control" placeholder="Level">
                                                </div>
                                                <div class="col-md-5">
                                                    <input name="asset_value[]" class="form-control" placeholder="Value">
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="add_access_more();">Add</button>
                                                </div>
                                                <input type="hidden" name="type[]" value="2">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-primary">Next</button>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                            <!--begin::Tap pane DOcument Tab-->
                            <div class="tab-pane fade" id="document_tab">
                                <!--begin::Wrapper-->
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="">Marksheet *</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Aadhar Card back Side *</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Medical Report *</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">DL *</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">VISA *</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">PAN Card *</label>
                                        <input class="form-control" type="file">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="">Resume *</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Offer Letter *</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Joining Letter *</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Other Document (Upload Multiple) </label>
                                        <input class="form-control" type="file">
                                    </div>

                                </div>
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-primary">Next</button>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Tap pane-->

                        </div>
                        <!--end::Tab Content-->
                        <!--begin::Action-->

                        <!--end::Action-->
                    </div>
                    <!--end: Card Body-->
                </div>

            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection
{{-- 
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> --}}
{{-- <script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $("#kt_create_account_form").validate({
            rules: {
                full_name: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                gender: "required",
                phone: {
                    required: true,
                    maxlength: 12,
                    minlength: 10
                }
            },
            messages: {
                full_name: "Please enter your firstname",
                email: "Please enter a valid email address",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                gender: "Please select your gender"
            },
            submitHandler: function(form) {

                var user = $(form).serialize();
                $.ajax({
                    url: "{{ route('add.employee') }}",
                    type: 'PATCH',
                    data: {
                        user: user,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {

                        console.error(xhr.responseText);
                    }
                });
            }
        });

    });
</script> --}}
