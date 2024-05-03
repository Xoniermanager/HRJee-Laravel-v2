@extends('layouts.employee.main')
@section('content')
@section('title')
Profile
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="{{asset('employee/assets/media/user.jpg')}}" alt="image">
                            
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">Shibli Sone</a>
                                    
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"></path>
                                            <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"></path>
                                            <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->Project Manager</a>
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor"></path>
                                            <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->h-187, sec-63</a>
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path>
                                            <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->shibli@xoniertechnologies.com</a>
                                </div>
                                <!--end::Info-->

                                <div class="border bg-light-info border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <p class="  pt-1 fw-semibold fs-4"><b>At work for:</b> 1 Year 1 Month 4 Day</p>
                                </div>
                                
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->
                            <div class="d-flex my-4">
                            
                                <a href="change_password.html" class="btn btn-sm btn-primary me-2">Change password</a>
                            
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div class="border bg-light-warning border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="">
                                            
                                            <div class="fs-2 fw-bold  text-center">3</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6  text-center ">Attendance</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div class="border bg-light-danger border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="">
                                            
                                            <div class="fs-2 fw-bold text-center ">9/12</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-center ">Leaves</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300  bg-light-success border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="">
                                        
                                            <div class="fs-2 fw-bold text-center ">0</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-center ">Awards</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Wrapper-->
                            
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
                <ul class="nav nav-pills nav-pills-custom mb-3 mt-10" role="tablist">
                    <!--begin::Item-->
                    <li class="nav-item  me-3 me-lg-6" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden  h-55px py-4 active" data-bs-toggle="pill" href="#kt_profile_details_view" aria-selected="true" role="tab" tabindex="-1">
                            
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-700 fw-bold fs-6 ">Personal Details</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                            <!--end::Bullet-->
                        
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item  me-3 me-lg-6" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden  h-55px py-4" data-bs-toggle="pill" href="#company_detail" aria-selected="false" role="tab" tabindex="-1">
                            
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-700 fw-bold fs-6 ">Company Details</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                            <!--end::Bullet-->
                            
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item  me-3 me-lg-6" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden  h-55px py-4 " data-bs-toggle="pill" href="#account_detail" aria-selected="false" role="tab" tabindex="-1">
                        
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-600 fw-bold fs-6 ">Bank Account Details</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item  me-3 me-lg-6" role="presentation">
                        <!--begin::Link-->
                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden  h-55px py-4" data-bs-toggle="pill" href="#address" aria-selected="false" tabindex="-1" role="tab">
                            
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-600 fw-bold fs-6 ">My Address</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                            <!--end::Bullet-->
                        
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                
                </ul>
                
            </div>
        </div>
        <div class="tab-content">
            <div class="card tab-pane fade active show  mb-5 mb-xl-10" id="kt_profile_details_view" role="tabpanel">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Personal Details</h3>
                    </div>
                    <!--end::Card title-->
                    
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Image *</label>
                                <input class="form-control" name="" type="file"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Name *</label>
                                <input class="form-control" name="" type="text" value="shibli"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Father's Name *</label>
                                <input class="form-control" name="" type="text" value="ssds"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">DOB *</label>
                                <input class="form-control" name="" type="date" value="10-10-1990"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Gender *</label>
                                <input class="form-control" name="" type="text" value="male"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Email Id *</label>
                                <input class="form-control" name="" type="email" value="shibli@gmail.com"> 
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Phone Number *</label>
                                <input class="form-control" name="" type="number" value="9876543210"> 
                            </div>
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0 text-primary">Local Address</h3>
                            </div>
                        
                            <div class="col-md-6 form-group">
                                <label for="">Address *</label>
                                <input class="form-control" name="" type="text" value="noida"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">City *</label>
                                <input class="form-control" name="" type="text" value="Noida"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">State *</label>
                                <input class="form-control" name="" type="text" value="u.p"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Pincode *</label>
                                <input class="form-control" name="" type="number" value="982789"> 
                            </div>

                        
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0 text-primary">Permanent Address</h3>
                            </div>
                        
                            <div class="col-md-6 form-group">
                                <label for="">Address *</label>
                                <input class="form-control" name="" type="text" value="noida"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">City *</label>
                                <input class="form-control" name="" type="text" value="Noida"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">State *</label>
                                <input class="form-control" name="" type="text" value="u.p"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Pincode *</label>
                                <input class="form-control" name="" type="number" value="982789"> 
                            </div>

                        </div>

                        <a href="#" class="btn btn-primary">Update</a>

                    </form>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::details View-->

            <div class="card tab-pane fade   mb-5 mb-xl-10" id="company_detail" role="tabpanel">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Company Details</h3>
                    </div>
                    <!--end::Card title-->
                    
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Employee Id *</label>
                                <input class="form-control" name="" type="text" value="f24e2"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Manager Id *</label>
                                <input class="form-control" name="" type="text" value="65362"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Branch *</label>
                                <input class="form-control" name="" type="text" value="delhi"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Department *</label>
                                <input class="form-control" name="" type="text" value="IT"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Designation *</label>
                                <input class="form-control" name="" type="text" value="Manager"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Date of Joining*</label>
                                <input class="form-control" name="" type="date" value="10-10-2012"> 
                            </div>
                            
                        </div>

                        <a href="#" class="btn btn-primary">Update</a>

                    </form>
                </div>
                <!--end::Card body-->

                
            </div>


            <div class="card tab-pane fade   mb-5 mb-xl-10" id="account_detail" role="tabpanel">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Bank Account Details</h3>
                    </div>
                    <!--end::Card title-->
                    
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Account Holder Name*</label>
                                <input class="form-control" name="" type="text" value="shibli"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Account No. *</label>
                                <input class="form-control" name="" type="text" value="65362"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">IFSC Code *</label>
                                <input class="form-control" name="" type="text" value="ifsc"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Branch Name *</label>
                                <input class="form-control" name="" type="text" value="delhi"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Bank Name *</label>
                                <input class="form-control" name="" type="text" value="sbi"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Pan Card No.*</label>
                                <input class="form-control" name="" type="text" value="4542435"> 
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Aadhaar Card No.*</label>
                                <input class="form-control" name="" type="text" value="3456"> 
                            </div>
                            
                        </div>

                        <a href="#" class="btn btn-primary">Update</a>

                    </form>
                </div>
                <!--end::Card body-->

                
            </div>

            <div class="card tab-pane fade   mb-5 mb-xl-10" id="address" role="tabpanel">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">My Address</h3>
                    </div>
                    <!--end::Card title-->
                    
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Location Name*</label>
                                <input class="form-control" name="" type="text" value="shibli"> 
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Address *</label>
                                <input class="form-control" name="" type="text" value="65362"> 
                            </div>
                            
                        </div>

                        <a href="#" class="btn btn-primary">save</a>

                    </form>

                    <div class="border bg-light-info border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mt-4 mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="  pt-1 fw-semibold fs-2"><b>Noida</b> </p>
                                <span class="fw-semibold fs-6">Sector 63 Workwings</span>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="d-flex justify-content-end align-items-center flex-shrink-0">
                                    <input class="form-check-input mr-10" type="radio" name="category" value="1" checked="">
                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <i class="fa fa-trash"></i>
                                        <!--end::Svg Icon-->
                                    </a>

                                </div>
                            </div>
                        </div>
                            

                        
                        
                    </div>
                </div>
                <!--end::Card body-->

                

                
            </div>

        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection