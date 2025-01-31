<div class="modal-header">
    <h1 class="modal-title fs-5">{{ transLang('add_building') }}</h1>
    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body" id="myModal">
    {{-- <p class="alert message_category_box hide"></p> --}}
    <form id="save-category-frm" class="form-horizontal custom-float-form">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <label class="col-form-label required">Name</label>
                <input type="text" class="form-control" name="name">
                <label class="field_error" id="name_error"> </label>
            </div>
            <div class="col-sm-6">
                <label class="col-form-label required">Chinese Name</label>
                <input type="text" class="form-control" name="cn_name">
                <label class="field_error" id="cn_name_error"> </label>
            </div>


            <div class="col-sm-12">
                <label class="col-form-label required">Description</label>
                <textarea rows="3" type="text" class="form-control" name="description"></textarea>
                <label class="field_error" id="description_error"> </label>
            </div>
            <div class="col-sm-12">
                <label class="col-form-label required">Chinese Description</label>
                <textarea rows="3" type="text" class="form-control" name="cn_description"></textarea>
                <label class="field_error" id="cn_description_error"> </label>
            </div>
           
            <div class="col-sm-6">
                <label class="col-form-label required">Location</label>
                <input type="text" class="form-control" name="location">
                <input type="hidden" class="form-control" name="lat">
                <input type="hidden" class="form-control" name="long">
                <label class="field_error" id="location_error"> </label>
            </div>
            <div class="col-sm-6">
                <label class="col-form-label required">Status</label>
                <select class="form-control" name="status">
                    @foreach (transLang('action_status') as $key => $status)
                        <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6">
                <div class="form-group ">
                    <label for="formFileMultiple" class="form-label required">Image</label>
                    <img id="image-cropper-preview" style="display:none; float:left;" width="60">
                    <input type="hidden" name="image">
                    <input type="file" name="image" class="image-cropper form-control file_control mt-1"
                        data-width="100" data-height="100" data-name="image">
                    <label class="field_error" id="image_error"> </label>
                    {{-- <br> <small class="grey">{{ transLang('image_dimension') }}: <span class='dir-ltr'>100 x 100</span></small> --}}
                </div>
            </div>
        </div>
    </form>
</div>
 
<script>
    $("#select2-multuple").select2({
        dropdownParent: $('#myModal')

    });
</script>
