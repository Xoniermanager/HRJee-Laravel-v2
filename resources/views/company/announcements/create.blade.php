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
            {{--enctype="multipart/form-data" method="post"
                action="{{ route('announcement.store') }}" --}}

            <form id="create_annou ncement" >
                @csrf
                <table class="_table table dt-responsive nowrap" style="width:75%; cellspacing:0;">
                    <tbody id="table_body">
                        <tr>
                            <td class="required">Branches</td>
                            <td>
                                <select class="form-control select2  mt-3" name="company_branch_id"
                                    id="company_branch_id">
                                    <option value=""></option>
                                    @foreach ($branches as $key => $row)
                                        <option value="{{ $row->id }}"
                                            {{ old('company_branch_id') == $row->id ? 'selected' : '' }}>{{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company_branch_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="required">Title</td>
                            <td>
                                <input type="text" class="form-control mt-3" name="title" id="title"
                                    value="{{ old('title') }}" placeholder="announcement title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="required">Start Date</td>
                            <td>
                                <input type="text" class="form-control mt-3 datetimepicker" name="start_date_time"
                                    placeholder="select date & time" value="{{ old('start_date_time') }}">
                                @error('start_date_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Expire At</td>
                            <td>
                                <input type="text" class="form-control mt-3 datetimepicker" name="expires_at"
                                    placeholder="select date & time" value="{{ old('expires_at') }}">
                                @error('expires_at')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>
                                <input type="file" class="form-control mt-3" name="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="required">Status</td>
                            <td>
                                <select class="form-control select2  mt-3" name="status">
                                    <option value=""></option>
                                    @foreach (transLang('action_status') as $key => $status)
                                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="required">Description </td>

                            <td>
                                <textarea rows="4" class="form-control  mt-3" name='description' placeholder="description">
                                    {{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="button" id='skdfskjjd'>save</button>
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
    $('.select2-class').select2({
        placeholder: "select",
        allowClear: true
    });
    $(".datetimepicker").each(function() {
        $(this).datetimepicker();
    });
    $(document).on('click','#',function(){
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
