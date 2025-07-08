@extends('layouts.company.main')

@section('title', 'Add KPI Employee')

@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10">
            <div class="card card-body col-md-12">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="mb-5 mb-xl-10">
                    <div class="card-body py-3">
                        <form id="kpiForm" method="POST" action="{{ route('kpi-management.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="required">KPI Review Cycle</label>
                                    <select name="cycle_id" class="form-control">
                                        <option value="">Please Select</option>
                                        @foreach ($allkpiReviewCycle as $cycle)
                                            <option value="{{ $cycle->id }}">{{ $cycle->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="required">KPI Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Please Select</option>
                                        @foreach ($allCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="required">Company Branches</label>
                                    <select id="branch_select" name="company_branch_id[]" multiple class="form-control" data-placeholder="Select Branches">
                                        <option value="all">-- Select All --</option>
                                        @foreach ($allBranch as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="required">Departments</label>
                                    <select id="department_select" name="department_id[]" multiple class="form-control" data-placeholder="Select Departments">
                                        <option value="all">-- Select All --</option>
                                        @foreach ($allDepartment as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="required">Designations</label>
                                    <select id="designation_select" name="designation_id[]" multiple class="form-control" data-placeholder="Select Designations">
                                        <option value="all">-- Select All --</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="required">Employees</label>
                                    <select id="employee_select" name="employee_id[]" multiple class="form-control" data-placeholder="Select Employees">
                                        <option value="all">-- Select All --</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="required">Subject</label>
                                    <input type="text" name="subject" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="required">Target</label>
                                    <input type="text" name="tgt" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="required">Description</label>
                                    <textarea name="description" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-actions mt-3">
                                <button type="reset" class="btn btn-primary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Include Select2 & jQuery validation --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(function() {
    // Init Select2
    $('#branch_select, #department_select, #designation_select, #employee_select').select2({
        closeOnSelect: false,
        placeholder: function() { return $(this).data('placeholder'); },
        width: '100%'
    });

    // Select all logic + close popup when "all" selected
    function initSelectAll($select) {
        $select.on('select2:select', function(e) {
            if (e.params.data.id === 'all') {
                let all = [];
                $select.find('option').each(function() {
                    if ($(this).val() !== 'all') all.push($(this).val());
                });
                $select.val(all).trigger('change');
                $select.select2('close');  // close dropdown
            }
        });
        $select.on('select2:unselect', function(e) {
            if (e.params.data.id === 'all') {
                $select.val(null).trigger('change');
            }
        });
    }
    initSelectAll($('#branch_select'));
    initSelectAll($('#department_select'));
    initSelectAll($('#designation_select'));
    initSelectAll($('#employee_select'));

    // Load designations & employees when departments change
    $('#department_select').on('change', function() {
        let ids = $(this).val();
        if (ids && ids.length) {
            $.post("{{ route('get.designations.by-dept') }}", {department_ids: ids, _token: '{{ csrf_token() }}'}, function(res) {
                let $des = $('#designation_select');
                $des.empty().append('<option value="all">-- Select All --</option>');
                $.each(res.data, (i, des) => {
                    $des.append(`<option value="${des.id}">${des.name}</option>`);
                });
                $des.trigger('change');
            }).fail(() => alert('Failed to load designations'));

            $.post("{{ route('get.all-emp-by-dept') }}", {department_ids: ids, _token: '{{ csrf_token() }}'}, function(res) {
                let $emp = $('#employee_select');
                $emp.empty().append('<option value="all">-- Select All --</option>');
                $.each(res.data, (i, emp) => {
                    $emp.append(`<option value="${emp.id}">${emp.name}</option>`);
                });
                $emp.trigger('change');
            }).fail(() => alert('Failed to load employees'));
        } else {
            $('#designation_select').empty().append('<option value="all">-- Select All --</option>').trigger('change');
            $('#employee_select').empty().append('<option value="all">-- Select All --</option>').trigger('change');
        }
    });

    // jQuery validate
    $('#kpiForm').validate({
        ignore: [], // validate hidden select2
        rules: {
            cycle_id: { required: true },
            category_id: { required: true },
            'company_branch_id[]': { required: true, minlength: 1 },
            'department_id[]': { required: true, minlength: 1 },
            'designation_id[]': { required: true, minlength: 1 },
            'employee_id[]': { required: true, minlength: 1 },
            subject: { required: true },
            tgt: { required: true },
            description: { required: true }
        },
        messages: {
            cycle_id: "Please select a review cycle",
            category_id: "Please select a category",
            'company_branch_id[]': "Select at least one branch",
            'department_id[]': "Select at least one department",
            'designation_id[]': "Select at least one designation",
            'employee_id[]': "Select at least one employee",
            subject: "Please enter subject",
            tgt: "Please enter target",
            description: "Please enter description"
        },
        errorPlacement: function(error, element) {
            if (element.hasClass('select2-hidden-accessible')) {
                error.insertAfter(element.next('.select2'));
            } else {
                error.insertAfter(element);
            }
        }
    });
});
</script>
@endsection
