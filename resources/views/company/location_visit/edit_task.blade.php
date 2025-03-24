@extends('layouts.company.main')
@section('content')
@section('title', 'Edit Task Assigned')
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
                        <form action="{{ route('location_visit.update_task_assign', $taskdetails->id) }}" method="POST" enctype="multipart/form-data">
                            @php
                            $formDetails = json_decode($taskdetails->response_data, true);
                            @endphp
                            @csrf
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="" class="required">Assign Employee</label>
                                    <select name="user_id" id="" class="form-control">
                                        <option value="">Please Select the Employee</option>
                                        @foreach ($allEmployeeDetails as $item)
                                        <option value="{{ $item->id }}" {{ $taskdetails->user_id == $item->id ?
                                            'selected' : ''}}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                    <div class="text-danger">{{ $errors->first('user_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="" class="required">User End Status</label>
                                    <select name="user_end_status" id="" class="form-control">
                                        <option value="pending" {{ $taskdetails->user_end_status == 'pending' ? 'selected' : ''  }}>Pending</option>
                                        <option value="processing" {{ $taskdetails->user_end_status == 'processing' ? 'selected' : ''  }}>Processing</option>
                                        <option value="rejected" {{ $taskdetails->user_end_status == 'rejected' ? 'selected' : ''  }}>Rejected</option>
                                        <option value="completed" {{ $taskdetails->user_end_status == 'completed' ? 'selected' : ''  }}>Completed</option>
                                        {{-- <option value="completed">Completed</option> --}}
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="" class="required">Final Status</label>
                                    <select name="final_status" id="" class="form-control">
                                        <option value="pending" {{ $taskdetails->final_status == 'pending' ? 'selected' : ''  }}>Pending</option>
                                        <option value="processing" {{ $taskdetails->final_status == 'processing' ? 'selected' : ''  }}>Processing</option>
                                        <option value="rejected" {{ $taskdetails->final_status == 'rejected' ? 'selected' : ''  }}>Rejected</option>
                                        <option value="completed" {{ $taskdetails->final_status == 'completed' ? 'selected' : ''  }}>Completed</option>
                                    </select>
                                </div>
                                @if (isset($fieldDetails) && !empty($fieldDetails))
                                @foreach ($fieldDetails->formfield as $item)
                                @if (isset($item->options) && !empty($item->options))
                                @php
                                $options = json_decode($item->options, true);
                                @endphp
                                @endif
                                @if ($item->type == 'textarea')
                                <div class="col-md-3 form-group">
                                    <label for="" class="required">{{ $item->label }}</label>
                                    <textarea name="{{ strtolower($item->label) }}" id="" class="form-control"
                                        required>{{ $formDetails[strtolower($item->label)] ?? ''  }}</textarea>
                                </div>
                                @elseif($item->type == 'select')
                                <div class="col-md-3 form-group">
                                    <label for="" class="required">{{ $item->label }}</label>
                                    <select name="{{ strtolower($item->label) }}" id="" class="form-control" required>
                                        <option value="">Please Select the {{ $item->label }}
                                        </option>
                                        @foreach ($options as $key => $value)
                                        <option value="{{ $key }}" {{ $formDetails[strtolower($item->label)] == $key ? 'selected' :''}}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @elseif($item->type == 'checkbox')
                                <div class="col-md-3 form-group">
                                    <label for="" class="required">{{ $item->label }}</label>
                                    <div>
                                        @foreach ($options as $key => $value)
                                        <input type="checkbox" name="{{ strtolower($item->label) }}" class="mt-4" value="{{ $key }}" {{
                                            $formDetails[strtolower($item->label)] == $key ? 'checked' : ''}}><strong>&nbsp;{{ $value }}</strong>
                                        @endforeach
                                    </div>
                                </div>
                                @elseif($item->type == 'radio')
                                <div class="col-md-3 form-group">
                                    <label for="" class="required">{{ $item->label }}</label>
                                    <div>
                                        @foreach ($options as $key => $value)
                                        <input type="radio" name="{{ strtolower($item->label) }}" class="mt-4" value="{{ $key }}" {{ $formDetails[strtolower($item->label)] == $key ? 'checked' : ''}}><strong>&nbsp;{{ $value}}</strong>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                <div class="col-md-3 form-group">
                                    <label for="" class="required">{{ $item->label }}</label>
                                    <input type="{{ $item->type }}" name="{{ strtolower($item->label) }}" id="" class="form-control"
                                        required value="{{ $formDetails[strtolower($item->label)] ?? ''}}">
                                </div>
                                @endif
                                @endforeach
                                @endif
                                <div class="col-md-6 form-group">
                                    <label class="required">Visit Address</label>
                                   <textarea name="visit_address" class="form-control">{{ $taskdetails->visit_address }}</textarea>
                                    @if ($errors->has('visit_address'))
                                    <div class="text-danger">{{ $errors->first('visit_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">Disposition Code</label>
                                   <select name="disposition_code_id" class="form-control">
                                    <option value="">Select the Disposition</option>
                                    @foreach ($dispositionCodeDetails as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                   </select>
                                    @if ($errors->has('document'))
                                    <div class="text-danger">{{ $errors->first('document') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">Document</label>
                                    <input type="file" class="form-control" name="document">
                                    @if ($errors->has('document'))
                                    <div class="text-danger">{{ $errors->first('document') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control" name="image">
                                    @if ($errors->has('image'))
                                    <div class="text-danger">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
