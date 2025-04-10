@extends('layouts.admin.main')
@section('title', 'Log Activity')
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
                                                    <span class="f-light f-w-600">URL</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Method</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Ip</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Company ID.</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">User ID.</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">User Name</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">User Type</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Request Body</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Response Code</span>
                                                </th>
                                                <th>
                                                    <span class="f-light f-w-600">Response Body</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        @forelse ($allLogActivityDetails as $key => $companiesDetails)
                                            <tr>
                                                <td>
                                                    <p class="f-light">{{ $key + 1 }}</p>
                                                </td>

                                                <td>
                                                    <p class="f-light">{{ $companiesDetails->url }}</p>
                                                </td>
                                                <td>
                                                    <a href="company_detail.html">
                                                        <p class="f-light">{{ $companiesDetails->method }}</p>
                                                    </a>
                                                </td>
                                                <td>
                                                    <p class="f-light">{{ $companiesDetails->ip }}</p>
                                                </td>
                                                <td>
                                                    <p class="f-light">{{ $companiesDetails->company_id }}</p>
                                                </td>
                                                <td>
                                                    <p class="f-light">{{ $companiesDetails->user_id }}</p>
                                                </td>
                                               <td>
                                                <p class="f-light">{{ $companiesDetails->user_name }}</p>
                                               </td>
                                               <td>
                                                <p class="f-light">{{ $companiesDetails->user_type }}</p>
                                               </td>
                                               <td>
                                                <p class="f-light">{{ $companiesDetails->request_body }}</p>
                                               </td>
                                               <td>
                                                <p class="f-light">{{ $companiesDetails->response_code }}</p>
                                               </td>
                                               <td>
                                                <p class="f-light">{{ $companiesDetails->response_body }}</p>
                                               </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="7">No Log Details Details
                                                    Available</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-3">
                                {{ $allLogActivityDetails->links('paginate') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
