@extends('layouts.company.main')
@section('title', 'Edit Task Assigned')
@section('content')
@php
    use Illuminate\Support\Str;
    $formDetails = json_decode($taskdetails->response_data ?? '{}', true);
@endphp

<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <div class="card h-md-100">

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
                @endif

                <div class="card-header align-items-center p-0">
                    <div class="card-body">
                        <form action="{{ route('location_visit.update_task_assign', $taskdetails->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-3 form-group">
                                    <label class="required">Assign Employee</label>
                                    <select name="user_id" class="form-control">
                                        <option value="">Please Select the Employee</option>
                                        @foreach ($allEmployeeDetails as $item)
                                            <option value="{{ $item->id }}" {{ old('user_id', $taskdetails->user_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 form-group">
                                    <label class="required">User End Status</label>
                                    <select name="user_end_status" class="form-control">
                                        @foreach (['pending', 'processing', 'rejected', 'completed'] as $status)
                                            <option value="{{ $status }}" {{ old('user_end_status', $taskdetails->user_end_status) == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label class="required">Final Status</label>
                                    <select name="final_status" class="form-control">
                                        @foreach (['pending', 'processing', 'rejected', 'completed'] as $status)
                                            <option value="{{ $status }}" {{ old('final_status', $taskdetails->final_status) == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @if (isset($fieldDetails) && !empty($fieldDetails))
                                    @foreach ($fieldDetails->formfield as $item)
                                        @php
                                            $isRequired = !empty($item->required);
                                            $requiredAttr = $isRequired ? 'required' : '';
                                            $labelClass = $isRequired ? 'required' : '';
                                            $options = isset($item->options) ? json_decode($item->options, true) : [];
                                            $fieldName = Str::snake($item->label);
                                            $fieldValue = old($fieldName, $formDetails[$fieldName] ?? '');
                                        @endphp

                                        @if ($item->type == 'textarea')
                                            <div class="col-md-3 form-group">
                                                <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                <textarea name="{{ $fieldName }}" class="form-control" {{ $requiredAttr }}>{{ $fieldValue }}</textarea>
                                            </div>

                                        @elseif($item->type == 'select')
                                            <div class="col-md-3 form-group">
                                                <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                <select name="{{ $fieldName }}" class="form-control" {{ $requiredAttr }}>
                                                    <option value="">Please select {{ $item->label }}</option>
                                                    @foreach ($options as $key => $value)
                                                        <option value="{{ $key }}" {{ $fieldValue == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        @elseif($item->type == 'checkbox')
                                            <div class="col-md-3 form-group">
                                                <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                <div>
                                                    @foreach ($options as $key => $value)
                                                        <label class="me-2">
                                                            <input type="checkbox" name="{{ $fieldName }}[]" value="{{ $key }}" {{ $requiredAttr }}
                                                                {{ is_array($fieldValue) && in_array($key, $fieldValue) ? 'checked' : '' }}>
                                                            <strong>&nbsp;{{ $value }}</strong>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>

                                        @elseif($item->type == 'radio')
                                            <div class="col-md-3 form-group">
                                                <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                <div>
                                                    @foreach ($options as $key => $value)
                                                        <label class="me-2">
                                                            <input type="radio" name="{{ $fieldName }}" value="{{ $key }}" {{ $requiredAttr }}
                                                                {{ $fieldValue == $key ? 'checked' : '' }}>
                                                            <strong>&nbsp;{{ $value }}</strong>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>

                                        @else
                                            <div class="col-md-3 form-group">
                                                <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                <input type="{{ $item->type }}" name="{{ $fieldName }}" class="form-control"
                                                    value="{{ $fieldValue }}" {{ $requiredAttr }}>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                                <div class="col-md-6">
                                    <label class="required">Visit Address</label>
                                    <input value="{{ old('visit_address', $taskdetails->visit_address) }}" type="text" name="visit_address"
                                        id="address" class="form-control" placeholder="Enter an address"
                                        oninput="initAutocomplete('address')" />
                                    @error('visit_address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Disposition Code</label>
                                    <select name="disposition_code_id" class="form-control">
                                        <option value="">Select the Disposition</option>
                                        @foreach ($dispositionCodeDetails as $item)
                                            <option value="{{ $item->id }}" {{ old('disposition_code_id', $taskdetails->disposition_code_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('disposition_code_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Document</label>
                                    <input type="file" class="form-control" name="document">
                                    @error('document')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAdzVvYFPUpI3mfGWUTVXLDTerw1UWbdg&libraries=places&callback=initAutocomplete"></script>
<script>
    function initAutocomplete(inputId) {
        var input = document.getElementById(inputId);
        new google.maps.places.Autocomplete(input);
    }
</script>
@endsection
