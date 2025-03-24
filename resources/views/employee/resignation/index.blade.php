@extends(Auth::user()->type == "company" ? 'layouts.company.main' : 'layouts.employee.main')
@section('content')
    @section('title')
        Resignation
    @endsection
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="row gy-5 g-xl-10">
                <div class="card card-body col-md-12">
                    <div class="card-header cursor-pointer p-0">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0"> Applied Resign</h3>
                        </div>

                        @if ($canApply)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#apply_resignation"
                                class="btn btn-sm btn-primary align-self-center">
                                Apply</a>
                        @endif
                    </div>
                    <div class="mb-xl-10 mb-5">
                        @include('employee.resignation.resignation-list')
                    </div>

                </div>
            </div>
        </div>

        <div class="modal" id="action_resignation">
            <div class="modal-dialog modal-dialog-centered mw-800px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="modal_heading">Change Progress Of Resignation</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->

                            <!--end::Svg Icon-->
                        </div>
                    </div>

                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y border-top pb-5 pt-0">
                        <form class="row g-3" id="action_resignation_form">
                            @csrf
                            <input type="hidden" name="id" id="id_status_change">
                            <div class="col-md-12">
                                <label class="form-label">Remark</label>
                                <textarea class="form-control" rows="3" name="remark" id="status_change_remark"></textarea>
                                <span class="field_error text-danger remark_error"></span>
                            </div>

                            <div class="col-md-12" id="status_wrapper">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status" id="resignation_status">
                                    @foreach ($resignationStatus as $row)
                                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <span class="field_error text-danger status_error"></span>
                            </div>

                            <div class="col-md-12 d-none" id="release_date_wrapper">
                                <label class="form-label">Release Date</label>
                                <input type="date" class="form-control" name="release_date" id="release_date">
                                <span class="field_error text-danger release_date_error"></span>
                            </div>

                            <span class="common_error text-danger"></span>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="edit_resignation">
            <div class="modal-dialog modal-dialog-centered mw-800px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2> Edit Resignation</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->

                            <!--end::Svg Icon-->
                        </div>
                    </div>

                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y border-top pb-5 pt-0">
                        <form class="row g-3" id="edit_resignation_form">
                            @csrf
                            <input type="hidden" name="id" id="id_edit">
                            <div class="col-md-12">
                                <label class="form-label">Reason</label>
                                <textarea class="form-control" rows="3" name="remark" id="remark_edit"></textarea>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="apply_resignation">
            <div class="modal-dialog modal-dialog-centered mw-800px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2> Apply Resignation</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->

                            <!--end::Svg Icon-->
                        </div>
                    </div>

                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y border-top pb-5 pt-0">
                        <form class="row g-3" id="apply_resignation_form">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label">Reason</label>
                                <textarea class="form-control" rows="3" name="remark" id="remark"></textarea>
                                <span class="field_error text-danger remark_error"></span>
                            </div>

                            <span class="common_error text-danger"></span>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function withdrawResignation(id) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure want to withdraw the resignation?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = `{{ route('resignation.change-status', ['id' => ':id']) }}`.replace(':id', id);

                    $.ajax({
                        url: url,
                        type: "post",
                        success: function (res) {
                            Swal.fire("Done!", "It was succesfully withdrawn!", "success");
                            $('#company_resignation_list').replaceWith(res.data);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            Swal.fire("Error!", "Please try again", "error");
                        }
                    });
                }
            });
        }

        function action_resignation(resignation, withdraw = false) {
            resignation = JSON.parse(resignation);
            $('#id_status_change').val(resignation.id);

            if (withdraw) {
                $('#modal_heading').text('Withdraw Resignation');
                $('#status_wrapper').addClass('d-none');
                $('#resignation_status').val('Withdrawn');
            } else {
                $('#resignation_status').val(resignation.status);
                $('#release_date').val(resignation.release_date);
            }

            if ($('#resignation_status').val() == 'Approved') {
                $('#release_date_wrapper').removeClass('d-none');
            } else {
                $('#release_date_wrapper').addClass('d-none');
            }

            $('#action_resignation').modal('show');
        }

        function edit_resignation(resignation) {
            resignation = JSON.parse(resignation);
            $('#id_edit').val(resignation.id);
            $('#remark_edit').text(resignation.remark);
            $('#edit_resignation').modal('show');
        }

        $(document).ready(function () {
            $('#resignation_status').on('change', function () {
                if ($(this).val() == 'Approved') {
                    $('#release_date_wrapper').removeClass('d-none');
                } else {
                    $('#release_date_wrapper').addClass('d-none');
                }
            });

            $("#action_resignation_form").validate({
                rules: {
                    remark: "required",
                    release_date: {
                        required: function () {
                            return $('#resignation_status').val() ===
                                'Approved';
                        }
                    }
                },
                messages: {
                    remark: "Please enter a message!",
                    release_date: "Release date is required when status is approved!"
                },
                submitHandler: function (form) {
                    var resignation_data = $(form).serialize();
                    var resignationId = $('#id_status_change').val();
                    var url = `{{ route('resignation.change-status', ['id' => ':id']) }}`.replace(':id',
                        resignationId);

                    $.ajax({
                        url: url,
                        type: 'post',
                        data: resignation_data,
                        success: function (response) {
                            $('#action_resignation').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#company_resignation_list').replaceWith(response.data);
                        },
                        error: function (jqXHR, exception) {
                            let data = JSON.parse(jqXHR.responseText);
                            $(".field_error").text('');

                            if ($.type(data.errors) == 'object') {
                                $.each(data.errors, function (key, value) {
                                    if (key.indexOf(".")) {
                                        key = key.replace(".", "_");
                                    }
                                    $("." + key + "_error").text(value);
                                });
                            } else {
                                $(".common_error").text(data.errors);
                            }
                        }
                    });
                }
            });

            $("#edit_resignation_form").validate({
                rules: {
                    remark: "required"
                },
                messages: {
                    remark: "remark is required"
                },
                submitHandler: function (form) {
                    var resignation_data = $(form).serialize();
                    var resignationId = $('#id_edit').val();

                    var url = `{{ route('resignation.edit', ['id' => ':id']) }}`.replace(':id', resignationId);

                    $.ajax({
                        url: url,
                        type: 'post',
                        data: resignation_data,
                        success: function (response) {
                            $('#edit_resignation').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#company_resignation_list').replaceWith(response.data);
                        },
                        error: function (error_messages) {
                            let errors = error_messages.responseJSON.error;
                            for (var error_key in errors) {
                                $(document).find('[name=' + error_key + ']').after(
                                    '<span id="' + error_key +
                                    '_error" class="text text-danger">' + errors[
                                    error_key] + '</span>');
                                setTimeout(function () {
                                    jQuery("#" + error_key + "_error").remove();
                                }, 3000);
                            }
                        }
                    });
                }
            });

            $("#apply_resignation_form").validate({
                rules: {
                    remark: "required"
                },
                messages: {
                    remark: "reason is required"
                },
                submitHandler: function (form) {
                    var resignation_data = $(form).serialize();
                    $.ajax({
                        url: `{{ route('resignation.apply') }}`,
                        type: 'post',
                        data: resignation_data,
                        success: function (response) {
                            $('#apply_resignation').modal('hide');
                            swal.fire("Done!", response.message, "success");
                            $('#company_resignation_list').replaceWith(response.data);
                        },
                        error: function (jqXHR, exception) {
                            let data = JSON.parse(jqXHR.responseText);
                            $(".field_error").text('');
                            if ($.type(data.errors) == 'object') {
                                $.each(data.errors, function (key, value) {
                                    if (key.indexOf(".")) {
                                        key = key.replace(".", "_");
                                    }
                                    $("." + key + "_error").text(value);
                                });
                            } else {
                                $(".common_error").text(data.errors);
                            }
                        }
                    });
                }
            });
        });

    </script>
@endsection
