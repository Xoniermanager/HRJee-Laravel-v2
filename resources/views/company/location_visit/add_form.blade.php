@extends('layouts.company.main')
@section('content')
@section('title', 'Location Visit')
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
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
                        <form action="{{ route('location_visit.store') }}" method="POST">
                            @csrf
                            <div class="col-md-3 form-group">
                                <label for="" class="">Form Title</label>
                                <input class="form-control" type="text" name="title"
                                    value="{{ $fieldDetails->title ?? '' }}">
                            </div>
                            @php $i=0; @endphp
                            @if (isset($fieldDetails->formfield) && !empty($fieldDetails->formfield))
                            @foreach ($fieldDetails->formfield as $item)
                            <div class="row align-items-center panel panel-body mb-3">
                                <div class="col-md-4 form-group">
                                    <label for="" class="required">Field Label</label>
                                    <input class="form-control" type="text" name="fieldDetails[{{ $i }}][label]"
                                        required value="{{ $item->label }}">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="" class="required">Field Type</label>
                                    <select class="form-control" name="fieldDetails[{{ $i }}][type]" required>
                                        <option value="">Select the Field Type</option>
                                        <option value="text" {{ $item->type == 'text' ? 'selected' : '' }}>
                                            Text</option>
                                        <option value="textarea" {{ $item->type == 'textarea' ? 'selected' : ''
                                            }}>TextArea</option>
                                        <option value="number" {{ $item->type == 'number' ? 'selected' : '' }}>
                                            Number
                                        </option>
                                        <option value="email" {{ $item->type == 'email' ? 'selected' : '' }}>
                                            Email
                                        </option>
                                        <option value="select" {{ $item->type == 'select' ? 'selected' : '' }}>
                                            Select
                                        </option>
                                        <option value="Date" {{ $item->type == 'Date' ? 'selected' : '' }}>
                                            Date</option>
                                        <option value="radio" {{ $item->type == 'radio' ? 'selected' : '' }}>
                                            Radio
                                        </option>
                                        <option value="checkbox" {{ $item->type == 'checkbox' ? 'selected' : ''
                                            }}>Checkbox</option>
                                    </select>
                                </div>
                                <div class="col-md-1 form-group">
                                    <a class="btn btn-danger btn-sm" onclick="deleteHtml(this)"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                </div>
                                @if(isset($item->options) && !empty($item->options))
                                @php
                                    $options = json_decode($item->options, true);
                                @endphp
                                @foreach ($options as $key => $value)
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <input type="text" class="form-control"
                                            placeholder="Enter the Key Value" name="fieldDetails[{{ $i }}][key][]" value="{{ $key }}" required>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <input type="text" class="form-control" placeholder="Enter the Value"
                                            name="fieldDetails[{{ $i }}][value][]" value="{{ $value }}" required>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <a class="btn btn-danger btn-sm" onclick="deleteHtml(this)"><i
                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                            @endif
                            <div class="row align-items-center panel panel-body mb-3">
                                <div class="col-md-5 form-group">
                                    <label for="" class="required">Field Label</label>
                                    <input class="form-control" type="text" name="fieldDetails[{{ $i }}][label]"
                                        required>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="" class="required">Field Type</label>
                                    <select class="form-control" name="fieldDetails[{{ $i }}][type]" required
                                        onchange="getFieldLabelValue(this,{{ $i }})">
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
                                {{-- <div class="col-md-3 form-group">
                                    <label for="">Options (Comma Separated)</label>
                                    <input class="form-control" type="text" name="fieldDetails[{{ $i }}][options]">
                                </div> --}}
                                <div class="col-md-1 form-group">
                                    <a class="btn btn-primary btn-sm" onclick="createHtmlClone()"><i class="fa fa-plus"
                                            aria-hidden="true"></i></a>
                                </div>
                                <div id="option_html_{{ $i }}">
                                </div>
                            </div>
                            <div id="result"></div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var i = {{ $i + 1 }};
            function createHtmlClone() {
                let htmlDiv = '';
                htmlDiv = `<div class="row align-items-center panel panel-body mb-3">
                                                <div class="col-md-5 form-group">
                                                    <label for="" class="required">Field Label</label>
                                                    <input class="form-control" type="text" name="fieldDetails[${i}][label]" required>
                                                </div>
                                                <div class="col-md-5 form-group">
                                                    <label for="" class="required">Field Type</label>
                                                    <select name="fieldDetails[${i}][type]" id="" class="form-control" required onchange="getFieldLabelValue(this,${i})">
                                                        <option value="">Select the Field Type</option>
                                                                <option value="text">Text</option>
                                                                <option value="textarea">TextArea</option>
                                                                <option value="number">Number</option>
                                                                <option value="email">Email</option>
                                                                <option value="select">Select</option>
                                                                <option value="Date">Date</option>
                                                                <option value="radio">Radio</option>
                                                                <option value="checkbox">Checkbox</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <a class="btn btn-danger btn-sm" onclick="deleteHtml(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            <div id="option_html_${i}">
                                </div>  </div>`;
                $('#result').append(htmlDiv);
                i++;
            }

            function deleteHtml(this_ele) {
                jQuery(this_ele).parent().parent().remove();
            }

            function getFieldLabelValue(ele, index) {
                $('#option_html_' + index).html('');
                let selectedValue = ele.value;
                let optionHtml = '';
                if (selectedValue == 'select' || selectedValue == 'radio' || selectedValue == 'checkbox') {
                    optionHtml = `<div class="row">
                                        <div class="col-md-5 form-group">
                                            <input type="text" value="" class="form-control"
                                                placeholder="Enter the Key Value" name="fieldDetails[${index}][key][]" required>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="text" value="" class="form-control"
                                                placeholder="Enter the Value" name="fieldDetails[${index}][value][]" required>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <a class="btn btn-primary btn-sm" onclick="createMoreOptionHtml(${index})"><i
                                                    class="fa fa-plus" aria-hidden="true"></i> Add More Option</a>
                                        </div>
                                    </div>`;
                    $('#option_html_' + index).append(optionHtml);
                } else {
                    $('#option_html_' + index).html('');
                }
            }

            function createMoreOptionHtml(index) {
                let optionHtml = '';
                optionHtml = `<div class="row">
                                        <div class="col-md-5 form-group">
                                            <input type="text" value="" class="form-control"
                                                placeholder="Enter the Key Value" name="fieldDetails[${index}][key][]" required>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="text" value="" class="form-control"
                                                placeholder="Enter the Value" name="fieldDetails[${index}][value][]" required>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <a class="btn btn-danger btn-sm" onclick="deleteHtml(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>`;
                $('#option_html_' + index).append(optionHtml);
            }
        </script>
        @endsection
