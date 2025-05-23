@extends('layouts.company.main')
@section('content')
@section('title')
Add Bulk Attendance
@endsection
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header p-0 align-items-center">
                    <div class="card-body">
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
                        <form action="{{ route('store.bulk.attendance') }}" method="post" enctype="multipart/form-data"
                            id="add_attendance">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 form-group demo-section k-header" id="example"
                                        role="application">
                                        <label class="required">Employee</label>
                                        <select id="FeaturesSelect" multiple="multiple"
                                            data-placeholder="Select Employee" name="employee_id[]">
                                            @foreach ($allEmployeeDetails as $employeeDetails)
                                            <option value="{{ $employeeDetails->id }}" {{ is_array(old('employee_id'))
                                                && in_array($employeeDetails->id, old('employee_id')) ? 'selected' : ''
                                                }}>
                                                {{ $employeeDetails->name .' - ('.$employeeDetails->details->emp_id.')'}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('employee_id'))
                                        <div class="text-danger">{{ $errors->first('employee_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="required">From Date</label>
                                        <input class="form-control" name="from_date" type="date"
                                            value="{{ old('from_date') }}" max="{{ date('Y-m-d') }}">
                                        @if ($errors->has('from_date'))
                                        <div class="text-danger">{{ $errors->first('from_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="required">To Date</label>
                                        <input class="form-control" name="to_date" type="date" max="{{ date('Y-m-d') }}"
                                            value="{{ old('to_date') }}">
                                        @if ($errors->has('to_date'))
                                        <div class="text-danger">{{ $errors->first('to_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="required">Punch In Time</label>
                                        <input class="form-control" name="punch_in" type="time"
                                            value="{{ date('H:i') ?? old('punch_in') }}">
                                        @if ($errors->has('punch_in'))
                                        <div class="text-danger">{{ $errors->first('punch_in') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="required">Punch Out Time</label>
                                        <input class="form-control" name="punch_out" type="time"
                                            value="{{ date('H:i') ?? old('punch_out') }}">
                                        @if ($errors->has('punch_out'))
                                        <div class="text-danger">{{ $errors->first('punch_out') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="required">Remark</label>
                                        <Textarea class="form-control" placeholder="Enter the remark"
                                            name="remark">{{ old('remark') }}</Textarea>
                                        @if ($errors->has('remark'))
                                        <div class="text-danger">{{ $errors->first('remark') }}</div>
                                        @endif
                                    </div>
                                </div>
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
    $(document).ready(function() {
        $("#FeaturesSelect").kendoMultiSelect({
            headerTemplate: '<div style="padding:4px 8px"><input type="checkbox" id="selectAll" /> Select All Employee</div>',
            autoClose: true,
            dataBound: function() {
                var items = this.ul.find("li");
            },
            change: function(e) {
                var totalItems = this.dataSource.data().length;
                var selected = this.value().length;
                if (totalItems != selected) {
                    $('#selectAll').prop('checked', false);
                } else {
                    $('#selectAll').prop('checked', true);
                }
            }
        }).data("kendoMultiSelect");

        $('#selectAll').change(function() {
            var multiSelect = $("#FeaturesSelect").data("kendoMultiSelect");
            if ($(this).prop('checked')) {
                selectAll();
            } else {
                multiSelect.value(null);
                $("#FeaturesSelect_listbox > li > input").prop("checked", false);
            }
        });
    });

    function selectAll() {
        var multiselect = $("#FeaturesSelect").data("kendoMultiSelect");
        var selectedValues = [];
        for (var i = 0; i < multiselect.dataSource.data().length; i++) {
            var item = multiselect.dataSource.data()[i];
            selectedValues.push(item.value);
        }

        $("#FeaturesSelect_listbox > li > input").prop("checked", true);
        multiselect.value(selectedValues);
        multiselect.close();
    }
    $(document).ready(function() {
        jQuery("#add_attendance").validate({
            rules: {
                'employee_id[]': {
                    required: true,
                    minlength: 1,
                    min: 1
                },
                from_date: {
                    required: true,
                },
                to_date: {
                    required: true,
                },
                punch_in: {
                    required: true,
                },
                punch_out: {
                    required: true,
                },
                remark: {
                    required: true,
                    maxlength: 255
                }
            },
            messages: {
                'employee_id[]': {
                    required: "Please select at least one employee.",
                    min: "Please select at least one employee."
                },
                from_date: {
                    required: "Please select a from date.",
                },
                to_date: {
                    required: "Please select a to date.",
                },
                punch_in: {
                    required: "Please enter the punch-in time.",
                },
                punch_out: {
                    required: "Please enter the punch-out time.",
                },
                remark: {
                    required: "Please enter a Remark.",
                    maxlength: "Remark cannot be longer than 255 characters."
                }
            },
            submitHandler: function(form) {
                $("button[type='submit']").prop('disabled', true);
                form.submit();
            }
        });
    });
</script>
@endsection
