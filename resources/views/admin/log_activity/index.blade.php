@extends('layouts.admin.main')
@section('title', 'Log Activity')
@section('content')
<style>
    #modalResponseBody {
    max-height: 75vh;
    overflow-y: scroll;
    border-top: 1px solid #a1a5a5;
}
/* .modal-content {
    border-radius: 10px !important;
} */
#modalResponseBody::-webkit-scrollbar {
    width: 10px;
    height: 8px;
    border-radius: 50px;
    margin: 0 10px;
}

#modalResponseBody::-webkit-scrollbar-track {
    background: transparent !important;
    border: 1px solid blue !important;
    border-radius: 50px;
    margin: 0;
}

#modalResponseBody::-webkit-scrollbar-thumb {
    background: blue !important;
    border-radius: 50px;
    cursor: grabbing;
    margin: 1px;
}
</style>
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
                                    <table class="table" id="project-status">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <span class="f-light f-w-600">Sr No.</span>
                                                </th>
                                                <th>
                                                    <span class="f-light">URL</span>
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
                                                {{-- <th>
                                                    <span class="f-light f-w-600">User Type</span>
                                                </th> --}}
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
                                                        <p class="f-light">{{ $companiesDetails->method }}</p>
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
                                               {{-- <td>
                                                <p class="f-light">{{ $companiesDetails->user_type }}</p>
                                               </td> --}}
                                               <td>
                                                <p class="f-light">{{ $companiesDetails->request_body }}</p>
                                               </td>
                                               <td>
                                                <p class="f-light">{{ $companiesDetails->response_code }}</p>
                                               </td>
                                               <td>
                                                <p class="f-light">
                                                   <a href="#" data-bs-toggle="modal" data-bs-target="#response_body_modal"
                                                            class="btn btn-sm btn-primary"
                                                            data-item="{{ $companiesDetails->response_body }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
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
    <div class="modal fade" id="response_body_modal" aria-labelledby="responseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel">Response Body</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  </button>

            </div>
            <div class="modal-body" id="modalResponseBody">
                <!-- The response body will be injected here -->
            </div>
        </div>
    </div>
</div>
    <script>
        const responseModal = document.getElementById('response_body_modal');
        responseModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const responseBody = button.getAttribute('data-item');
            const modalBody = responseModal.querySelector('#modalResponseBody');
            modalBody.textContent = responseBody;
        });
    </script>
@endsection
