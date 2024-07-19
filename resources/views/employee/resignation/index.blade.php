@extends('layouts.employee.main')
@section('content')
@section('title')
    Resignation
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                <div class="card-header cursor-pointer p-0">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0"> Applied Resign</h3>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#apply_resignation"
                        class="btn btn-sm btn-primary align-self-center ">
                        Apply</a>
                    {{-- {{ $applyStatus == 0 ? 'disabled' : '' }} --}}
                    <!--end::Action-->
                </div>
                <div class="mb-5 mb-xl-10">
                    @include('employee.resignation.resignation-list')
                </div>

            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->

    <div class="modal" id="action_resignation">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-800px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2> {{ $userType == 'Employee' ? 'Cancel' : 'Action' }} Resignation</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->

                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>

                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <!--begin::Wrapper-->
                    <form class="row g-3" id="action_resignation_form">
                        @csrf

                        <input type="hidden" name="resignation_id" id="id">
                        <div class="col-md-12">
                            <label class="form-label">{{ $userType == 'Employee' ? 'Reason' : 'Remark' }}</label>
                            <textarea class="form-control" rows="3" name="remark" id="remark"></textarea>
                            <span class="field_error text-danger remark_error"></span>
                        </div>

                        <div class="col-md-12 {{ $userType == 'Employee' ? 'd-none' : '' }}">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="resignation_status_id">
                                @foreach ($resignationStatus as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <span class="common_error text-danger "></span>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <div class="modal" id="edit_resignation">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-800px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2> Edit Resignation</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->

                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>

                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <!--begin::Wrapper-->
                    <form class="row g-3" id="edit_resignation_form">
                        @csrf
                        <input type="hidden" name="id" id="id_edit">
                        <div class="col-md-12">
                            <label class="form-label">title</label>
                            <input type="text" class="form-control" rows="3" name="title" id="title">

                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <div class="modal" id="apply_resignation">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-800px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Close-->
                    <h2> Apply Resignation</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->

                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>

                <!--begin::Modal body-->
                <div class="modal-body scroll-y pt-0 pb-5 border-top">
                    <!--begin::Wrapper-->
                    <form class="row g-3" id="apply_resignation_form">
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label">title</label>
                            <input type="text" class="form-control" rows="3" name="title" id="title">
                            <span class="field_error text-danger title_error"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                            <span class="field_error text-danger description_error"></span>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
</div>

<script>
    function deleteFunction(id) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ route('resignation.delete') }}` + "/" + id,
                    type: "get",
                    success: function(res) {
                        Swal.fire("Done!", "It was succesfully deleted!", "success");
                        $('#company_resignation_list').replaceWith(res.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
        });
    }


    function action_resignation(resignation) {
        resignation = JSON.parse(resignation);
        $('#id').val(resignation.id);
        $('#action_resignation').modal('show');
    }

    function edit_resignation(resignation) {
        resignation = JSON.parse(resignation);
        $('#id_edit').val(resignation.id);
        $('#title').val(resignation.title);
        $('#description').text(resignation.description);
        $('#edit_resignation').modal('show');
    }


    $("#action_resignation_form").validate({
        rules: {
            remark: "required"
        },
        messages: {
            remark: "please enter message!"
        },
        submitHandler: function(form) {
            var resignation_data = $(form).serialize();
            $.ajax({
                url: `{{ route('resignation.actionResignation') }}`,
                type: 'post',
                data: resignation_data,
                success: function(response) {
                    $('#action_resignation').modal('hide');
                    swal.fire("Done!", response.message, "success");
                    $('#company_resignation_list').replaceWith(response.data);
                },
                error: function(jqXHR, exception) {
                    let data = JSON.parse(jqXHR.responseText);
                    $(".field_error").text('');
                    if ($.type(data.errors) == 'object') {
                        $.each(data.errors, function(key, value) {
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
            title: "required",
            description: "required"
        },
        messages: {
            title: "title is required",
            description: "description is required"
        },
        submitHandler: function(form) {
            var resignation_data = $(form).serialize();
            $.ajax({
                url: `{{ route('resignation.edit') }}`,
                type: 'post',
                data: resignation_data,
                success: function(response) {
                    $('#edit_resignation').modal('hide');
                    swal.fire("Done!", response.message, "success");
                    $('#company_resignation_list').replaceWith(response.data);
                },
                error: function(error_messages) {
                    let errors = error_messages.responseJSON.error;
                    for (var error_key in errors) {
                        $(document).find('[name=' + error_key + ']').after(
                            '<span id="' + error_key +
                            '_error" class="text text-danger">' + errors[
                                error_key] + '</span>');
                        setTimeout(function() {
                            jQuery("#" + error_key + "_error").remove();
                        }, 3000);
                    }
                }
            });
        }
    });
    $("#apply_resignation_form").validate({
        rules: {
            title: "required",
            description: "required"
        },
        messages: {
            title: "title is required",
            description: "description is required"
        },
        submitHandler: function(form) {
            var resignation_data = $(form).serialize();
            $.ajax({
                url: `{{ route('resignation.apply') }}`,
                type: 'post',
                data: resignation_data,
                success: function(response) {
                    $('#apply_resignation').modal('hide');
                    swal.fire("Done!", response.message, "success");
                    $('#company_resignation_list').replaceWith(response.data);
                },
                error: function(jqXHR, exception) {
                    let data = JSON.parse(jqXHR.responseText);
                    $(".field_error").text('');
                    if ($.type(data.errors) == 'object') {
                        $.each(data.errors, function(key, value) {
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
</script>
@endsection
