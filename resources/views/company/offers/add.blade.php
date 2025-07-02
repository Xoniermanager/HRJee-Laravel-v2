@extends('layouts.company.main')

@section('title')
    Add Offer
@endsection

@section('content')
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
                    <div class="card card-flush h-md-100">
                        <div class="card-body">
                            <form id="offerForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h4 class="mb-4">Upload Offer Images</h4>

                                <!-- Web Offer -->
                                <div class="col-md-6 mb-3">
                                    <label for="web_offer_image" class="form-label">Upload Offer Image*</label>
                                    <input type="file" class="form-control" id="web_offer_image" name="web_offer_image"
                                        accept="image/png, image/jpeg">
                                    <div class="form-text">Recommended size: 1100x270 pixels. Formats: JPEG, PNG</div>
                                    @if ($errors->has('web_offer_image'))
                                        <div class="text-danger">{{ $errors->first('web_offer_image') }}</div>
                                    @endif
                                </div>

                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title*</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                    @if ($errors->has('title'))
                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<script>
$(document).ready(function () {
    $("#offerForm").validate({
        rules: {
            title: "required",
            web_offer_image: {
                required: true,
            }
        },
        messages: {
            title: "Please enter a title",
            web_offer_image: "Please upload a valid image (jpeg, jpg, png)"
        },
        submitHandler: function(form, event) {
            event.preventDefault(); 

            const formData = new FormData(form);

            $.ajax({
                url: "{{ route('offer.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#offerForm")[0].reset();

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
                        Swal.fire("Duplicate!", xhr.responseJSON.message, "warning");
                    } else {
                        Swal.fire("Error!", "An unexpected error occurred.", "error");
                    }
                }
            });
        }
    });
});
</script>

@endsection
