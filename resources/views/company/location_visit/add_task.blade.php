@extends('layouts.company.main')
@section('content')
@section('title', 'Add Task')
    <div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">
            <!--begin::Row-->
            <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
                <!--begin::Timeline widget 3-->
                <div class="card h-md-100">
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
                    <!--begin::Header-->
                    <div class="card-header align-items-center p-0">
                        <div class="card-body">
                            <form action="{{ route('location_visit.store_task_assign') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="assign_employee" class="required">Assign Employee</label>
                                        <select name="user_id" id="assign_employee" class="form-control select2">
                                            <option value="">Please select the Employee</option>
                                            @foreach ($allEmployeeDetails as $item)
                                                <option value="{{ $item->id }}">{{ $item->name .'-('.$item->details->emp_id.')'}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <div class="text-danger">{{ $errors->first('user_id') }}</div>
                                        @endif
                                    </div>
                                    @if (isset($fieldDetails) && !empty($fieldDetails))
                                        @foreach ($fieldDetails->formfield as $item)
                                            @php
                                                $isRequired = isset($item->required) && $item->required == 1;
                                                $requiredAttr = $isRequired ? 'required' : '';
                                                $labelClass = $isRequired ? 'required' : '';
                                                $options = isset($item->options) ? json_decode($item->options, true) : [];
                                            @endphp
                                            @if ($item->type == 'textarea')
                                                <div class="col-md-6 form-group">
                                                    <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                    <textarea name="{{ strtolower($item->label) }}" class="form-control" {{ $requiredAttr }}></textarea>
                                                </div>

                                            @elseif($item->type == 'select')
                                                <div class="col-md-3 form-group">
                                                    <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                    <select name="{{ strtolower($item->label) }}" class="form-control" {{ $requiredAttr }}>
                                                        <option value="">Please select {{ $item->label }}</option>
                                                        @foreach ($options as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            @elseif($item->type == 'checkbox')
                                                <div class="col-md-3 form-group">
                                                    <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                    <div>
                                                        @foreach ($options as $key => $value)
                                                            <label class="me-2">
                                                                <input type="checkbox" name="{{ strtolower($item->label) }}[]"
                                                                    value="{{ $key }}" {{ $requiredAttr }}>
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
                                                                <input type="radio" name="{{ strtolower($item->label) }}" value="{{ $key }}"
                                                                    {{ $requiredAttr }}>
                                                                <strong>&nbsp;{{ $value }}</strong>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            @else
                                                <div class="col-md-3 form-group">
                                                    <label class="{{ $labelClass }}">{{ $item->label }}</label>
                                                    <input type="{{ $item->type }}" name="{{ strtolower($item->label) }}"
                                                        class="form-control" {{ $requiredAttr }}>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    <div class="col-md-6">
                                        <label class="required">Visit Address</label>
                                        <input type="text" name="visit_address" id="address" class="form-control"
                                            placeholder="Enter an address" oninput="initAutocomplete('address')" />
                                        @if ($errors->has('visit_address'))
                                            <div class="text-danger">{{ $errors->first('visit_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Document</label>
                                        <input type="file" class="form-control" name="document">
                                        @if ($errors->has('document'))
                                            <div class="text-danger">{{ $errors->first('document') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Image</label>
                                        <input type="file" class="form-control" name="image">
                                        @if ($errors->has('image'))
                                            <div class="text-danger">{{ $errors->first('image') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4">
                                <button type="reset" class="btn btn-danger">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAdzVvYFPUpI3mfGWUTVXLDTerw1UWbdg&libraries=places&callback=initAutocomplete">
            </script>
        <script>
            function initAutocomplete(inputId) {
                var input = document.getElementById(inputId);
                var autocomplete = new google.maps.places.Autocomplete(input);
            }
        </script>
