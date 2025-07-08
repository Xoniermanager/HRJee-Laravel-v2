@extends('layouts.company.main')
@section('title', 'Edit Performance Review Cycle')

@section('content')
<div class="content d-flex flex-column flex-column-fluid fade-in-image" id="kt_content">
    <div class="container-xxl" id="kt_content_container">
        <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5">
            <div class="card h-md-100">

                @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <div class="card-body">
                    <form id="cycleForm" method="POST" action="{{ route('performance-cycle.update', $performanceCycle->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="required">Title</label>
                                <input class="form-control" name="title" type="text" id="title" value="{{ old('title', $performanceCycle->title ?? '') }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="required">Date</label>
                                <input type="text" id="daterange" name="daterange" class="form-control"
                                       value="{{ old('daterange', $performanceCycle ? ($performanceCycle->start_date.' - '.$performanceCycle->end_date) : '') }}">
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label class="required">Company Branches</label>
                            <select id="branch_select" name="company_branch_id[]" multiple data-placeholder="Select Branches" class="form-control">
                                <option value="all">-- Select All --</option>
                                @foreach ($allBranch as $branch)
                                <option value="{{ $branch->id }}" @if(in_array($branch->id, old('company_branch_id', $selectedBranches))) selected @endif>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label class="required">Departments</label>
                            <select id="department_select" name="department_id[]" multiple data-placeholder="Select Departments" class="form-control">
                                <option value="all">-- Select All --</option>
                                @foreach ($allDepartment as $department)
                                <option value="{{ $department->id }}" @if(in_array($department->id, old('department_id', $selectedDepartments))) selected @endif>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label class="required">Designations</label>
                            <select id="designation_select" name="designation_id[]" multiple data-placeholder="Select Designations" class="form-control">
                                <option value="all">-- Select All --</option>
                                @foreach ($allDesignations as $des)
                                <option value="{{ $des->id }}" @if(in_array($des->id, old('designation_id', $selectedDesignations))) selected @endif>{{ $des->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label class="required">Employees</label>
                            <select id="employee_select" name="employee_id[]" multiple data-placeholder="Select Employees" class="form-control">
                                <option value="all">-- Select All --</option>
                                @foreach ($allEmployees as $emp)
                                <option value="{{ $emp->id }}" @if(in_array($emp->id, old('employee_id', $selectedEmployees))) selected @endif>{{ $emp->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex flex-end flex-row-fluid pt-2 border-top">
                            <button type="reset" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Libraries -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
$(function(){
    $('#daterange').daterangepicker({ locale:{format:'YYYY-MM-DD'}, autoApply:true });

    $('#branch_select, #department_select, #designation_select, #employee_select').select2({ closeOnSelect:false, width:'100%' });

    function initSelectAll($select){
        $select.on('select2:select', function(e){
            if(e.params.data.id==='all'){
                let all=[]; $select.find('option').each(function(){ if($(this).val()!=='all') all.push($(this).val()); });
                $select.val(all).trigger('change');
            }
        });
        $select.on('select2:unselect', function(e){ if(e.params.data.id==='all') $select.val(null).trigger('change'); });
    }
    initSelectAll($('#branch_select'));
    initSelectAll($('#department_select'));
    initSelectAll($('#designation_select'));
    initSelectAll($('#employee_select'));

    // get saved IDs
    var savedDesignations=@json(old('designation_id', $selectedDesignations));
    var savedEmployees=@json(old('employee_id', $selectedEmployees));

    function loadDesAndEmp(deptIds){
        if(deptIds && deptIds.length){
            $.post("{{ route('get.designations.by-dept') }}",{department_ids:deptIds,_token:'{{csrf_token()}}'}, function(res){
                let $des=$('#designation_select');
                $des.empty().append('<option value="all">-- Select All --</option>');
                $.each(res.data,(i,des)=>{$des.append(`<option value="${des.id}">${des.name}</option>`);});
                $des.val(savedDesignations).trigger('change');
            });
            $.post("{{ route('get.all-emp-by-dept') }}",{department_ids:deptIds,_token:'{{csrf_token()}}'}, function(res){
                let $emp=$('#employee_select');
                $emp.empty().append('<option value="all">-- Select All --</option>');
                $.each(res.data,(i,emp)=>{$emp.append(`<option value="${emp.id}">${emp.name}</option>`);});
                $emp.val(savedEmployees).trigger('change');
            });
        }
    }

    // on department change
    $('#department_select').on('change',function(){ loadDesAndEmp($(this).val()); });

    // trigger once if editing
    @if($performanceCycle)
        loadDesAndEmp(@json(old('department_id', $selectedDepartments)));
    @endif
});
</script>
@endsection
