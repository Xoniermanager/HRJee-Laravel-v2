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
                                <form class="form-inline" action="#" method="get">
                                    <div class="form-group d-flex align-items-center mb-0"> <i class="fa fa-search"></i>
                                        <input class="form-control-plaintext" type="text" placeholder="Search..."
                                            id="search">
                                    </div>
                                </form>
                                <div class="ml-10px" style="margin-left: 10px;">
                                    <select class="form-select h-50px" name="filterByStatus" id="filterByStatus">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-container">
                                    <table class="table nowrap" id="project-status">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span class="f-light f-w-600">Sr No.</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Company Id</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Company Name</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Email</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Contact No.</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Address</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Active Employee</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">InActive Employee</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Total Punch In</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        @forelse ($allCompanyDetails as $key => $companiesDetails)
                                            <tr>
                                                <td>
                                                    <p class="f-light">{{ $key + 1 }}</p>
                                                </td>

                                                <td>
                                                    <p class="f-light">{{ $companiesDetails->id }}</p>
                                                </td>
                                                <td>
                                                    <a href="/admin/attendance/{{$companiesDetails->id}}">
                                                        <p class="f-light">{{ $companiesDetails->name }}</p>
                                                    </a>
                                                </td>
                                                <td>
                                                    <p class="f-light">{{ $companiesDetails->email }}</p>
                                                </td>
                                                <td>
                                                    <p class="f-light">{{ $companiesDetails->companyDetails->contact_no }}</p>
                                                </td>
                                                <td>
                                                    <p class="f-light">{{ $companiesDetails->companyDetails->company_address }}</p>
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge badge-primary p-2">{{ $companiesDetails->totalActiveEmployees() }}</span>
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge badge-danger p-2 text-center">{{ $companiesDetails->totalInActiveEmployees() }}</span>
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge badge-info p-2 text-center">{{ $companiesDetails->countTodayPunchIns() }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="7">No Company Details
                                                    Available</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-3">
                                {{ $allCompanyDetails->links('paginate') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
