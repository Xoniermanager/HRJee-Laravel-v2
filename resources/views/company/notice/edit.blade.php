@extends('layouts.company.main')
@section('content')
@section('title')
    Edit Notice
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mt-5">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-12">
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="card card-flush h-md-100">
                        <div class="card-body">
                            <div class="">
                                <form class="row" id="noticeEditForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{$editNoticeDetails->id}}">
                                @csrf
                                <h4 class="mb-4">Upload Attachment (.pdf only)</h4>

                                <!-- Upload PDF -->
                                <div class="col-md-6 mb-3">
                                    <label for="attachment" class="form-label">Upload Attachment</label>
                                    <input type="file" class="form-control" id="attachment" name="attachment"
                                        accept=".pdf">
                                    <div class="form-text">Only .pdf files are allowed.</div>
                                </div>

                                <!-- Title -->
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title*</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$editNoticeDetails->title ?? ''}}">
                                </div>

                                <!-- Description -->
                               <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $editNoticeDetails->description ?? '') }}</textarea>
                                    </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </div>

                            </form>
                                <!--end::Table container-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $("#noticeEditForm").validate({
            rules: {
                title: "required",
            },
            messages: {
                title: "Please enter offer title",
            },
            submitHandler: function(form, event) {
                event.preventDefault();

                const formData = new FormData(form);

                $.ajax({
                    url: "{{ route('notice.update') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#noticeEditForm")[0].reset();

                        Swal.fire("Done!", response.message, "success").then(() => {
                            window.location.href = response.redirect;
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            let message = '';
                            Object.values(xhr.responseJSON.errors).forEach(e => {
                                message += e.join('<br>');
                            });
                            Swal.fire("Validation Error!", message, "error");
                        } else if (xhr.status === 409 && xhr.responseJSON?.message) {
                            Swal.fire("Duplicate!", xhr.responseJSON.message,
                                "warning");
                        } else {
                            Swal.fire("Error!", "An unexpected error occurred.",
                                "error");
                        }
                    }
                });
            }
        });
    });
</script>

@endsection
