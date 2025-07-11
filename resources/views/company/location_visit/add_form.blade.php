@extends('layouts.company.main')
@section('title', 'Location Visit')
@section('content')

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

                    <div class="card-header p-0 align-items-center">
                        <div class="card-body">
                            <form action="{{ route('location_visit.store') }}" method="POST">
                                @csrf

                                <div class="col-md-3 form-group">
                                    <label>Form Title</label>
                                    <input class="form-control" type="text" name="title"
                                        value="{{ $fieldDetails->title ?? '' }}">
                                </div>

                                {{-- Existing fields from DB --}}
                                @php $i = 0; @endphp
                                @if (isset($fieldDetails->formfield) && !empty($fieldDetails->formfield))
                                    @foreach ($fieldDetails->formfield as $item)
                                        <div class="row align-items-center panel panel-body mb-3">
                                            <div class="col-md-4 form-group">
                                                <label class="required">Field Label</label>
                                                <input class="form-control" type="text" name="fieldDetails[{{ $i }}][label]"
                                                    value="{{ $item->label }}" required>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="required">Field Type</label>
                                                <select class="form-control" name="fieldDetails[{{ $i }}][type]" required>
                                                    <option value="">Select the Field Type</option>
                                                    <option value="text" {{ $item->type == 'text' ? 'selected' : '' }}>Text</option>
                                                    <option value="textarea" {{ $item->type == 'textarea' ? 'selected' : '' }}>
                                                        TextArea</option>
                                                    <option value="number" {{ $item->type == 'number' ? 'selected' : '' }}>Number
                                                    </option>
                                                    <option value="email" {{ $item->type == 'email' ? 'selected' : '' }}>Email
                                                    </option>
                                                    <option value="select" {{ $item->type == 'select' ? 'selected' : '' }}>Select
                                                    </option>
                                                    <option value="date" {{ $item->type == 'date' ? 'selected' : '' }}>Date</option>
                                                    <option value="radio" {{ $item->type == 'radio' ? 'selected' : '' }}>Radio
                                                    </option>
                                                    <option value="checkbox" {{ $item->type == 'checkbox' ? 'selected' : '' }}>
                                                        Checkbox</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label class="required">Required?</label>
                                                <select class="form-control" name="fieldDetails[{{ $i }}][required]">
                                                    <option value="1" {{ $item->required == 1 ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ $item->required == 0 ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <a class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>

                                            @if(isset($item->options) && !empty($item->options))
                                                @php $options = json_decode($item->options, true); @endphp
                                                @foreach ($options as $key => $value)
                                                    <div class="row mb-2">
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" placeholder="Enter Key"
                                                                name="fieldDetails[{{ $i }}][key][]" value="{{ $key }}" required>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" placeholder="Enter Value"
                                                                name="fieldDetails[{{ $i }}][value][]" value="{{ $value }}" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                @endif

                                {{-- Dynamic added fields will appear here --}}
                                <div id="additionalFields"></div>

                                <div class="mb-3 text-end">
                                    <a class="btn btn-success btn-sm" onclick="addFieldRow()" title="Add New Field">
                                        <i class="fa fa-plus"></i> Add Field
                                    </a>
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script>
        var fieldIndex = {{ $i }}; // Start after existing fields

        function addFieldRow() {
            let html = `
                <div class="row align-items-center panel panel-body mb-3">
                    <div class="col-md-4 form-group">
                        <label class="required">Field Label</label>
                        <input class="form-control" type="text" name="fieldDetails[${fieldIndex}][label]" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="required">Field Type</label>
                        <select class="form-control" name="fieldDetails[${fieldIndex}][type]" required onchange="handleFieldTypeChange(this, ${fieldIndex})">
                            <option value="">Select the Field Type</option>
                            <option value="text">Text</option>
                            <option value="textarea">TextArea</option>
                            <option value="number">Number</option>
                            <option value="email">Email</option>
                            <option value="select">Select</option>
                            <option value="file">File</option>
                            <option value="date">Date</option>
                            <option value="radio">Radio</option>
                            <option value="checkbox">Checkbox</option>
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="required">Required?</label>
                        <select class="form-control" name="fieldDetails[${fieldIndex}][required]">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-md-1 text-end">
                        <a class="btn btn-danger btn-sm" onclick="removeRow(this)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                    <div id="option_html_${fieldIndex}"></div>
                </div>`;
            $('#additionalFields').prepend(html); // add at top
            fieldIndex++;
        }

        function removeRow(el) {
            $(el).closest('.row').remove();
        }

        function handleFieldTypeChange(select, index) {
            let type = select.value;
            let container = $('#option_html_' + index);
            container.html('');

            if (['select', 'radio', 'checkbox'].includes(type)) {
                addOptionRow(index);
            }
        }

        function addOptionRow(index) {
            let html = `
                <div class="row mb-2">
                    <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="Enter Key" name="fieldDetails[${index}][key][]" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="Enter Value" name="fieldDetails[${index}][value][]" required>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-primary btn-sm" onclick="addOptionRow(${index})">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" onclick="removeRow(this)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>`;
            $('#option_html_' + index).append(html);
        }
    </script>

@endsection
