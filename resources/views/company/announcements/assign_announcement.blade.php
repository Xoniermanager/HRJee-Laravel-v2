@extends('layouts.company.main')
@section('content')
@section('title')
    Announcements
@endsection
<div class="card card-body col-md-12">
    <div class="card-header p-4">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0"> Add Announcement</h3>
        </div>
        <!--end::Card title-->
    </div>
    <div class="mb-5 mb-xl-10">
        <div class="card-body">
            {{-- enctype="multipart/form-data" method="post"
                action="{{ route('announcement.store') }}" --}}
            <form method="post" action="#" class="row">
                <div class="col-md-4">
                    <div class="mb-3 h-100">
                        <div class="row card-body">
                            <div class="form-group">
                                <label class="required">Branches </label>
                                <select class="form-control select2  " name="company_branch_id" id="company_branch_id"
                                    style="width:100%">
                                    <option value=""></option>
                                    @foreach ($branches as $key => $row)
                                        <option value="{{ $row->id }}"
                                            {{ old('company_branch_id') == $row->id ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company_branch_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="required">Announcement *</label>
                                <select class="form-control">
                                    <option value="">Option 1</option>
                                    <option value="">Option 2</option>
                                    <option value="">Option 3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="required">Title *</label>
                                <input class="form-control" name="title" type="text" id='assign_title'>
                            </div>
                            <div class="form-group">
                                <label class="required">Expiry Date *</label>
                                <input class="form-control datetimepicker" name="start_date_time" type="text"
                                    id='assign_start_date_time'>
                            </div>
                            <div class="form-group">
                                <label class="required">Description </label>
                                <textarea type="text" class="form-control" name="description" id='assign_description'></textarea>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100">
                        <div class="row card-body">
                            <div class="form-group">
                                <label class="required">Department *</label>
                                <select class="form-control">
                                    <option value="">Management</option>
                                    <option value="">Development</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="required">Designation </label>
                                <select class="form-control">
                                    <option value="">Option 1</option>
                                    <option value="">Option 2</option>
                                    <option value="">Option 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="required">Schedule Post</label>
                                <div class="d-flex align-items-center mt-3">
                                    <!--begin::Option-->
                                    <label
                                        class="form-check form-check-custom form-check-inline form-check-solid me-5 is-valid">
                                        <input class="form-check-input" name="communication[]" type="radio"
                                            value="1" selected>
                                        <span class="fw-semibold ps-2 fs-6">
                                            Yes
                                        </span>
                                    </label>
                                    <!--end::Option-->

                                    <!--begin::Option-->
                                    <label
                                        class="form-check form-check-custom form-check-inline form-check-solid is-invalid">
                                        <input class="form-check-input" name="communication[]" type="radio"
                                            value="2">
                                        <span class="fw-semibold ps-2 fs-6">
                                            No
                                        </span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="required">Schedule Date</label>
                                <input class="form-control" name="" type="date">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-">
                        <div class="card-body">
                            <div class="employee_listing">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="assets/media/user.jpg" alt="">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
                                            Name</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">emp@gmail.ccom</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="assets/media/user.jpg" alt="">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
                                            Name</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">emp@gmail.ccom</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="assets/media/user.jpg" alt="">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
                                            Name</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">emp@gmail.ccom</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="assets/media/user.jpg" alt="">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
                                            Name</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">emp@gmail.ccom</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="assets/media/user.jpg" alt="">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Full
                                            Name</a>
                                        <span
                                            class="text-muted fw-semibold text-muted d-block fs-7">emp@gmail.ccom</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="">
                    <a href="#" class="btn btn-primary mt-5">Save</a>
                </span>

            </form>

        </div>
    </div>
</div>
<!--end::Content-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<script>
    $('.select2').select2({
        placeholder: "select",
        allowClear: true
    });
    $(".datetimepicker").each(function() {
        $(this).datetimepicker();
    });
    $(document).on('click', '#', function() {
        alert('test');
    })
    $(document).ready(function() {
        $("#create_announcement").validate({
            rules: {
                company_branch_id: {
                    required: true,
                },

            },
            messages: {
                company_branch_id: "Please enter old password",

            },
            submitHandler: function(form) {
                let data = new FormData($('form#create_announcement')[0]);
                $.ajax({
                    url: "{{ route('announcement.store') }}",
                    type: 'post',
                    data: data,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {

                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection
