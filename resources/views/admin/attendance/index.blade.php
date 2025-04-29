@extends('layouts.admin.main')
@section('title', 'Company Attendance Details')
@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header file-content border-0 pb-0">
                            <div class="d-md-flex d-sm-block">
                                {{-- <div class="ml-10px" style="margin-left: 10px;">
                                    <select name="branch" class="form-control min-w-150px" id="branch">
                                        <option value="">All Branches</option>
                                        @foreach ($branches as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ml-10px" style="margin-left: 10px;">
                                    <select name="department" class="form-control min-w-150px ml-10" id="department" onchange="getManagerByDept()">
                                        <option value="">All Departments</option>
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-container">
                                    <table class="table nowrap" id="project-status">
                                        <thead>
                                            <tr class="fw-bold">
                                                <th>Sr. No.</th>
                                                <th>Emp Id</th>
                                                <th>Employee Name</th>
                                                <th>Total Present</th>
                                                <th>Total Leave</th>
                                                <th>Total Holiday</th>
                                            </tr>
                                        </thead>
                                        @forelse ($allEmployeeDetails as $key => $employee)
                                            <tbody class="">
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $employee->details->emp_id }}</td>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->totalPresent }}</td>
                                                    <td>{{ $employee->totalLeave }}</td>
                                                    <td>{{ $employee->totalHoliday }}</td>
                                                </tr>
                                            </tbody>
                                        @empty
                                            <td colspan="3">
                                                <span class="text-danger">
                                                    <strong>No Attendance Found!</strong>
                                                </span>
                                            </td>
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                            <div class="mt-3">
                                {{ $allEmployeeDetails->links('paginate') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
