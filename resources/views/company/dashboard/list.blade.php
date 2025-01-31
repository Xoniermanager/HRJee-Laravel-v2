<div class="mb-5 mb-xl-10">
    <div class="card-body py-3">
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bold">
                        <th>Sr. No.</th>
                        <th>Employee</th>
                        <th>Contact</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="">
                    @forelse ($dashboardData['all_users_details'] as $key => $item)
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-45px me-5">
                                    <img src="assets/media/user.jpg" alt="">
                                </div>
                                <div class="d-flex justify-content-start flex-column">
                                    <a href="#"
                                        class="text-dark fw-bold text-hover-primary fs-6">{{$item->name}}</a>
                                    <span
                                        class="text-muted fw-semibold text-muted d-block fs-7">{{$item->designation->name}}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="tel:{{$item->phone}}" title="{{$item->phone}}">
                                <span class="badge py-3 px-4 fs-7 badge-light-success"><i class="fa fa-phone-flip"></i></span>
                            </a>
                            <a href="mailto:{{$item->official_email_id}}" title="{{$item->official_email_id}}">
                                <span class="badge py-3 px-4 fs-7 badge-light-success"><i class="fa fa-envelope-circle-check"></i></span>
                            </a>
                            
                        </td>
                        <td> <span class="badge py-3 px-4 fs-7 badge-light-danger">
                                Leave</span> </td>

                    </tr>
                    @empty

                    @endforelse
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    </div>
</div>
